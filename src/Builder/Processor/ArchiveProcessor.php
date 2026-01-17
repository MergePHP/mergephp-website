<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateTimeImmutable;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use Psr\Log\LoggerInterface;
use Twig\Environment;

class ArchiveProcessor extends HTMLProcessor
{
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected MeetupCollection $meetups,
		protected Environment $twig,
		protected array $twigData,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	public function run(): void
	{
		$this->logger->info('Building archive pages');

		// Bucket all meetups by year
		$buckets = [];
		foreach ($this->meetups as $meetup) {
			$year = $meetup->instance->getDateTime()->format('Y');
			if (!isset($buckets[$year])) {
				$buckets[$year] = [];
			}
			$buckets[$year][] = $meetup;
		}

		foreach ($buckets as $year => $meetups) {
			$this->logger->debug('Writing ' . count($meetups) . " meetups to the $year archive page");
			$this->generateArchivePage((int) $year, $meetups);
		}
	}

	/**
	 * @param int $year
	 * @param MeetupEntry[] $meetups
	 * @return void
	 * @noinspection PhpDocMissingThrowsInspection
	 */
	protected function generateArchivePage(int $year, array $meetups): void
	{
		$modifiedTimestamp = 0;
		foreach ($meetups as $meetup) {
			$modifiedTimestamp = max($modifiedTimestamp, $meetup->modifiedTimestamp->getTimestamp());
		}

		$previousYear = reset($meetups)->previous?->instance->getDateTime()->format('Y');
		$nextYear = end($meetups)->next?->instance->getDateTime()->format('Y');
		if ($nextYear == $year) {
			$nextYear = null; // Avoid linking to the same year
		}

		$meetups = array_map(fn(MeetupEntry $meetupEntry) => $meetupEntry->instance, $meetups);
		rsort($meetups);

		$data = array_merge($this->twigData, [
			'year' => $year,
			'meetups' => $meetups,
			'previousYear' => $previousYear,
			'nextYear' => $nextYear
		]);
		/** @noinspection PhpUnhandledExceptionInspection */
		$html = $this->twig->render('archive.twig.html', $data);
		$this->writeHtml($html, "meetups/$year/index.html", new DateTimeImmutable("@$modifiedTimestamp"));
	}
}
