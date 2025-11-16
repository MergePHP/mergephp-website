<?php

declare(strict_types=1);

namespace MergePHP\Website\Generator;

use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use Exception;
use MergePHP\Website\AbstractMeetup;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Printer;
use RuntimeException;

/**
 * Service for generating meetup class files.
 */
class MeetupGeneratorService
{
	/**
	 * @param string $directory Directory where meetup files are stored
	 * @throws RuntimeException If the directory is not writable
	 */
	public function __construct(public string $directory)
	{
		if (!is_writable($this->directory)) {
			throw new RuntimeException("$this->directory is not writable");
		}
	}

	/** @var string Date format for suggested dates */
	protected const string SUGGESTED_DATE_FORMAT = 'Y-m-d';

	/**
	 * Get a suggested date for the next meetup (second Thursday of current or next month).
	 *
	 * @param string $baseDate Base date to calculate from (default: 'now')
	 * @return string Suggested date in Y-m-d format
	 */
	public function getSuggestedDate(string $baseDate = 'now'): string
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		$fallback = (new DateTimeImmutable($baseDate));
		$thisMonth = $fallback->format('F Y');
		$nextMonth = $fallback->modify('next month')->format('F Y');
		foreach (["first day of $thisMonth", "first day of $nextMonth"] as $startingDate) {
			try {
				$date = new DateTimeImmutable($startingDate);
			} catch (Exception) {
				return $fallback->format(self::SUGGESTED_DATE_FORMAT);
			}
			$thursdays = 0;
			do {
				if ($date->format('D') === 'Thu') {
					$thursdays++;
				}
				$date = $date->add(new DateInterval('P1D'));
			} while ($thursdays < 2);
			$date = $date->sub(new DateInterval('P1D'));
			if ($date > $fallback) {
				return $date->format('Y-m-d');
			}
		}
		return $fallback->format(self::SUGGESTED_DATE_FORMAT); // this should not happen
	}

	/**
	 * Generate a new meetup class file.
	 *
	 * @param string $title Meetup title
	 * @param string $description Meetup description (markdown supported)
	 * @param string $date Meetup date in Y-m-d format
	 * @param string $speakerName Speaker's name
	 * @param string $speakerBio Speaker's bio (markdown supported)
	 * @param string|null $image Optional image URL or path
	 * @return MeetupGeneratorResponse Response containing filename and bytes written
	 */
	public function generate(
		string $title,
		string $description,
		string $date,
		string $speakerName,
		string $speakerBio,
		?string $image = null,
	): MeetupGeneratorResponse {
		$dateTime = new DateTimeImmutable("$date 19:00");

		$className = implode('', [
			'Meetup',
			$dateTime->format('Ymd'),
			preg_replace('/[^a-zA-Z0-9_\x7f-\xff]/', '', ucwords(strtolower($title))),
		]);
		$filename = "$this->directory/$className.php";
		$formattedDateTime = $dateTime->format('Y-m-d H:i:s');

		$file = new PhpFile();
		$file->setStrictTypes();
		$namespace = new PhpNamespace('MergePHP\Website\Meetup');
		$file->addNamespace($namespace);

		$namespace->addUse(AbstractMeetup::class);
		$namespace->addUse(DateTimeImmutable::class);
		$namespace->addUse(DateTimeZone::class);

		$class = $namespace->addClass($className);
		$class->setExtends(AbstractMeetup::class);

		$class
			->addMethod('getTitle')
			->setReturnType('string')
			->setBody('return \'' . addslashes($title) . '\';');
		$class
			->addMethod('getDescription')
			->setReturnType('string')
			->setBody('return <<<END' . PHP_EOL . wordwrap($description, 110, PHP_EOL) . PHP_EOL . 'END;');
		$class
			->addMethod('getDateTime')
			->setReturnType('DateTimeImmutable')
			->setBody(implode("\n", [
				"/** @noinspection PhpUnhandledExceptionInspection */",
				"return new DateTimeImmutable('$formattedDateTime', new DateTimeZone('America/New_York'));"
			]));
		if ($image) {
			$image = addslashes($image);
			$body = strlen($image) > 102 ? "// phpcs:ignore\nreturn '$image';" : "return '$image';";
			$class
				->addMethod('getImage')
				->setReturnType('string')
				->setBody($body);
		}
		$class
			->addMethod('getSpeakerName')
			->setReturnType('string')
			->setBody('return \'' . addslashes($speakerName) . '\';');
		$class
			->addMethod('getSpeakerBio')
			->setReturnType('string')
			->setBody('return <<<END' . PHP_EOL . wordwrap($speakerBio, 110, PHP_EOL) . PHP_EOL . 'END;');

		$printer = new class extends Printer {
			public int $wrapLength = 120;
			public int $linesBetweenMethods = 1;
		};

		$bytes = file_put_contents($filename, $printer->printFile($file));
		return new MeetupGeneratorResponse($filename, $bytes);
	}
}
