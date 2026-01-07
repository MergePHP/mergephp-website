<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateTimeImmutable;
use MergePHP\Website\Builder\MeetupCollection;
use Psr\Log\LoggerInterface;
use Twig\Environment;

/**
 * Processor that generates the homepage.
 */
class HomepageProcessor extends HTMLProcessor
{
	/**
	 * @param LoggerInterface $logger Logger for build output
	 * @param string $outputDirectory Directory where built files are written
	 * @param MeetupCollection $meetups Collection of all meetups
	 * @param Environment $twig Twig template environment
	 * @param array $twigData Common data to pass to all Twig templates
	 */
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected MeetupCollection $meetups,
		protected Environment $twig,
		protected array $twigData,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	/**
	 * Generate the homepage with next meetup and archive year.
	 */
	public function run(): void
	{
		$this->logger->info('Building homepage');
		$futureMeetups = $this->meetups->withOnlyFuture();
		$pastMeetups = $this->meetups->withOnlyPast();


		$nextMeetup = count($futureMeetups) ? reset($futureMeetups)->instance : null;

		$data = array_merge($this->twigData, [
			'archiveYear' => end($pastMeetups)->instance->getDateTime()->format('Y'),
			'nextMeetup'  => $nextMeetup,
		]);

		$this->logger->debug("Building homepage with reference to {$data['nextMeetup']?->getTitle()}");

		/** @noinspection PhpUnhandledExceptionInspection */
		$html = $this->twig->render('index.twig.html', $data);
		$this->writeHtml($html, 'index.html', new DateTimeImmutable());
	}
}
