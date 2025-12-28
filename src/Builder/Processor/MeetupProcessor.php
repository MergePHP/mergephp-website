<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use MergePHP\Website\Builder\MeetupCollection;
use Psr\Log\LoggerInterface;
use Twig\Environment;

/**
 * Processor that generates individual meetup pages.
 */
class MeetupProcessor extends HTMLProcessor
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
	 * Generate HTML pages for all meetups.
	 */
	public function run(): void
	{
		$this->logger->info('Building meetup pages');
		foreach ($this->meetups as $meetup) {
			$data = array_merge($this->twigData, [
				'meetup' => $meetup->instance,
				'nextMeetup' => $meetup->next?->instance,
				'previousMeetup' => $meetup->previous?->instance,
			]);

			/** @noinspection PhpUnhandledExceptionInspection */
			$html = $this->twig->render('meetup.twig.html', $data);
			$filename = ltrim($meetup->instance->getPermalink(), '/');
			$this->writeHtml($html, $filename, $meetup->modifiedTimestamp);
		}
	}
}
