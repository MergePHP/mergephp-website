<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateTimeImmutable;
use RuntimeException;

abstract class HTMLProcessor extends AbstractProcessor
{
	protected function writeHtml(string $html, string $filename, DateTimeImmutable $modifiedTime = null)
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
