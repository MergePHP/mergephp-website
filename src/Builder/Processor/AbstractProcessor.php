<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use Psr\Log\LoggerInterface;

/**
 * Abstract base class for site build processors.
 * Each processor handles a specific aspect of the site generation.
 */
abstract class AbstractProcessor
{
	/**
	 * @param LoggerInterface $logger Logger for build output
	 * @param string $outputDirectory Directory where built files are written
	 */
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
	) {
	}

	/**
	 * Execute the processor's build logic.
	 */
	abstract public function run(): void;
}
