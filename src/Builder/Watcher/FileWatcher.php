<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Watcher;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Watches directories for file changes by comparing modification times.
 */
class FileWatcher
{
	/**
	 * @param array<string> $directories Directories to watch
	 */
	public function __construct(
		private readonly array $directories
	) {
	}

	/**
	 * Get modification times for all files in the watched directories.
	 *
	 * @return array<string, int> Map of file paths to modification timestamps
	 */
	public function getFileModTimes(): array
	{
		// Clear PHP's stat cache to get fresh modification times
		clearstatcache();

		$modTimes = [];

		foreach ($this->directories as $dir) {
			if (!is_dir($dir)) {
				continue;
			}

			$iterator = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
			);

			foreach ($iterator as $file) {
				if ($file->isFile()) {
					$path = $file->getPathname();
					// Use filemtime() directly instead of SplFileInfo::getMTime()
					// as SplFileInfo may cache the value internally
					$modTimes[$path] = filemtime($path);
				}
			}
		}

		return $modTimes;
	}

	/**
	 * Detect which files have changed between two snapshots.
	 *
	 * @param array<string, int> $previous Previous modification times
	 * @param array<string, int> $current Current modification times
	 * @return array<string> List of changed file paths (added, modified, or removed)
	 */
	public function detectChanges(array $previous, array $current): array
	{
		$changed = [];

		// Find modified or added files
		foreach ($current as $path => $mtime) {
			if (!isset($previous[$path]) || $previous[$path] !== $mtime) {
				$changed[] = $path;
			}
		}

		// Find removed files
		foreach ($previous as $path => $mtime) {
			if (!isset($current[$path])) {
				$changed[] = $path;
			}
		}

		return $changed;
	}

	/**
	 * Check if any changes were detected that require a rebuild.
	 *
	 * @param array<string> $changes List of changed files
	 * @return bool True if rebuild is needed
	 */
	public function shouldRebuild(array $changes): bool
	{
		return count($changes) > 0;
	}

	/**
	 * Format changed files for display output.
	 *
	 * @param array<string> $changes List of changed files
	 * @param int $maxDisplay Maximum number of files to show individually
	 * @return array<string> Formatted lines for display
	 */
	public function formatChangesForDisplay(array $changes, int $maxDisplay = 5): array
	{
		$lines = [];

		foreach (array_slice($changes, 0, $maxDisplay) as $file) {
			$lines[] = "  - $file";
		}

		$remaining = count($changes) - $maxDisplay;
		if ($remaining > 0) {
			$lines[] = "  ... and $remaining more";
		}

		return $lines;
	}
}
