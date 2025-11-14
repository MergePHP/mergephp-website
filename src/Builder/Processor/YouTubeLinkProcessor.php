<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use MergePHP\Website\Builder\MeetupCollection;
use Psr\Log\LoggerInterface;

class YouTubeLinkProcessor extends HTMLProcessor
{
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected MeetupCollection $meetups,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	public function run(): void
	{
		$this->logger->info('Checking for missing YouTube links');

		foreach ($this->meetups->withOnlyPast() as $meetup) {
			if ($meetup->instance->getYouTubeLink() === null) {
				$this->logger->warning("{$meetup->getClassName()} is missing its YouTube link");
			}
		}

		$this->logger->info('Checking for invalid YouTube links');

		foreach ($this->meetups as $meetup) {
			$link = $meetup->instance->getYouTubeLink();
			if ($link === null) {
				continue;
			}
			if (!preg_match('/^https:\/\/www.youtube\.com\/watch\?v=[A-Za-z0-9_-]+(?:&t=(\d+))?$/', $link)) {
				$this->logger->error("{$meetup->getClassName()} does not have a valid YouTube link");
			}
		}
	}
}
