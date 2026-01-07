<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateTimeImmutable;
use RuntimeException;

/**
 * Base class for processors that generate HTML files.
 */
abstract class HTMLProcessor extends AbstractProcessor
{
	/**
	 * Write HTML content to a file in the output directory.
	 *
	 * @param string $html The HTML content to write
	 * @param string $filename The filename relative to output directory
	 * @param DateTimeImmutable|null $modifiedTime Optional modification time to set on the file
	 * @throws RuntimeException If the directory cannot be created or file cannot be written
	 */
	protected function writeHtml(string $html, string $filename, ?DateTimeImmutable $modifiedTime = null): void
	{
		$destination = "$this->outputDirectory/$filename";
		$path = substr($destination, 0, strlen(basename($destination)) * -1);
		if (!is_dir($path)) {
			if (mkdir($path, 0755, true)) {
				$this->logger->debug("Created directory $path");
			} else {
				throw new RuntimeException("Could not create directory $path");
			}
		}
		$bytes = file_put_contents($destination, $html);
		$this->logger->info("Wrote $bytes bytes to $destination");
		if ($modifiedTime) {
			touch($destination, $modifiedTime->getTimestamp());
		}
	}
}
