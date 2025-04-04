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

class MeetupGeneratorService
{
	public function __construct(public string $directory)
	{
		if (!is_writable($this->directory)) {
			throw new RuntimeException("$this->directory is not writable");
		}
	}

	protected const string SUGGESTED_DATE_FORMAT = 'Y-m-d';

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
				if ($date->format('D') == 'Thu') {
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
			->setBody('return \'' . addslashes($description) . '\';');
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
			->setBody('return \'' . addslashes($speakerBio) . '\';');

		$printer = new class extends Printer {
			public int $wrapLength = 120;
			public int $linesBetweenMethods = 1;
		};

		$bytes = file_put_contents($filename, $printer->printFile($file));
		return new MeetupGeneratorResponse($filename, $bytes);
	}
}
