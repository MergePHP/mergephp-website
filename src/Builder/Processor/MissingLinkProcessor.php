<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use MergePHP\Website\Builder\MeetupCollection;
use Psr\Log\LoggerInterface;

class MissingLinkProcessor extends HTMLProcessor
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
		$buckets = [];

		foreach ($this->meetups->withOnlyPast() as $meetup) {
			if ($meetup->instance->getYouTubeLink() === null) {
				$this->logger->warning("{$meetup->getClassName()} is missing its YouTube link");
			}
		}
	}
}
