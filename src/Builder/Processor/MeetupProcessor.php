<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use MergePHP\Website\Builder\MeetupCollection;
use Psr\Log\LoggerInterface;
use Twig\Environment;

class MeetupProcessor extends HTMLProcessor
{
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected MeetupCollection $meetups,
		protected Environment $twig,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	public function run(): void
	{
		$this->logger->info('Building meetup pages');
		foreach ($this->meetups as $meetup) {
			$data = [
				'meetup' => $meetup->instance,
				'nextMeetup' => $meetup->next?->instance,
				'previousMeetup' => $meetup->previous?->instance,
			];
			/** @noinspection PhpUnhandledExceptionInspection */
			$html = $this->twig->render('meetup.twig.html', $data);
			$filename = ltrim($meetup->instance->getPermalink(), '/');
			$this->writeHtml($html, $filename, $meetup->modifiedTimestamp);
		}
	}
}
