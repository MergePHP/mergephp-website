<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use FilesystemIterator;
use Psr\Log\LoggerInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use SplFileInfo;

/**
 * Processor that copies static files from the public directory to the output directory.
 */
class StaticFileProcessor extends AbstractProcessor
{
	/**
	 * @param LoggerInterface $logger Logger for build output
	 * @param string $outputDirectory Directory where built files are written
	 * @param string $inputDirectory Directory containing static files to copy
	 */
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected string $inputDirectory,
	) {
		parent::__construct($this->logger, $this->outputDirectory);
	}

	/**
	 * Copy all static files from input to output directory.
	 *
	 * @throws RuntimeException If a directory cannot be created or file cannot be copied
	 */
	public function run(): void
	{
		$this->logger->info('Copying static files');
		$directoryIterator = new RecursiveDirectoryIterator($this->inputDirectory, FilesystemIterator::SKIP_DOTS);
		$iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST);
		$createdDirs = $copiedFiles = 0;
		foreach ($iterator as $file) {
			/** @var SplFileInfo $file */
			$new = str_replace($this->inputDirectory, $this->outputDirectory, (string)$file);

			if (is_dir($file->getRealPath())) {
				$this->logger->debug("Making directory $new");
				if (mkdir($new)) {
					$createdDirs++;
				} else {
					throw new RuntimeException("Could not make directory $new");
				}
			} else {
				$this->logger->debug("Copying from $file to $new");
				if (copy($file->getRealPath(), $new)) {
					$copiedFiles++;
				} else {
					throw new RuntimeException("Could not copy $file to $new");
				}
			}
		}
		$this->logger->info("Copied $copiedFiles static files and $createdDirs directories to support those files");
	}
}
