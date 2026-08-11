<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Exception\PhpCTvLinkException;
use Psr\Log\LoggerInterface;

class PhpCTvLinkProcessor extends HTMLProcessor
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
		$this->logger->info('Checking for missing PhpCTv links');

		foreach ($this->meetups->withOnlyPast() as $meetup) {
			if ($meetup->instance->getPhpCTvLink() === null) {
				$this->logger->warning("{$meetup->getClassName()} is missing its phpc.tv link");
			}
		}

		$this->logger->info('Checking for invalid PhpCTv links');

		foreach ($this->meetups as $meetup) {
			$link = $meetup->instance->getPhpCTvLink();
			if ($link === null) {
				continue;
			}
			// https://phpc.tv/videos/watch/abc is allowable but redirects to /w/abc
			if (!preg_match('/^https:\/\/phpc\.tv\/w\/[A-Za-z0-9]+$/', $link)) {
				throw PhpCTvLinkException::create($link, $meetup->getClassName());
			}
		}
	}
}
