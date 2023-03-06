<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use Psr\Log\LoggerInterface;

abstract class AbstractProcessor
{
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
	) {
	}

	abstract public function run(): void;
}
