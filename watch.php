<?php

declare(strict_types=1);

/**
 * Simple file watcher that rebuilds the site on changes.
 * Watches src/, templates/, and public/ directories.
 */

$watchDirs = ['src', 'templates', 'public'];
$pollInterval = 1; // seconds
$distDir = 'dist';

echo "Starting file watcher...\n";
echo "Watching: " . implode(', ', $watchDirs) . "\n";
echo "Press Ctrl+C to stop.\n\n";

// Initial build
echo "Running initial build...\n";
passthru('php console.php build');
echo "\n";

// Start the PHP server in the background
$serverPort = 8000;
echo "Starting server at http://localhost:$serverPort\n\n";

// File descriptors for the child process (mode is from child's perspective)
$descriptors = [
	0 => ['pipe', 'r'], // stdin  - child reads from this pipe
	1 => ['pipe', 'w'], // stdout - child writes to this pipe
	2 => ['pipe', 'w'], // stderr - child writes to this pipe
];

$serverProcess = proc_open(
	"php -S localhost:$serverPort -t $distDir",
	$descriptors,
	$pipes
);

if (!is_resource($serverProcess)) {
	echo "Failed to start server\n";
	exit(1);
}

// Make pipes non-blocking
stream_set_blocking($pipes[1], false);
stream_set_blocking($pipes[2], false);

// Get initial file states
$lastModTimes = getFileModTimes($watchDirs);

// Handle shutdown
$running = true;
pcntl_signal(SIGINT, function () use (&$running, $serverProcess, $pipes) {
	$running = false;
	echo "\nShutting down...\n";
	fclose($pipes[0]);
	fclose($pipes[1]);
	fclose($pipes[2]);
	proc_terminate($serverProcess);
	exit(0);
});

// Main watch loop
while ($running) {
	pcntl_signal_dispatch();

	// Check for server output
	$serverOutput = stream_get_contents($pipes[1]);
	$serverErrors = stream_get_contents($pipes[2]);
	if ($serverOutput) {
		echo $serverOutput;
	}
	if ($serverErrors) {
		echo $serverErrors;
	}

	// Check for file changes
	$currentModTimes = getFileModTimes($watchDirs);

	if ($currentModTimes !== $lastModTimes) {
		$changed = array_keys(array_diff_assoc($currentModTimes, $lastModTimes));
		echo "\n[" . date('H:i:s') . "] Changes detected:\n";
		foreach (array_slice($changed, 0, 5) as $file) {
			echo "  - $file\n";
		}
		if (count($changed) > 5) {
			echo "  ... and " . (count($changed) - 5) . " more\n";
		}

		echo "Rebuilding...\n";
		passthru('php console.php build');
		echo "Done.\n";

		$lastModTimes = $currentModTimes;
	}

	sleep($pollInterval);
}

/**
 * Recursively get modification times for all files in the given directories.
 *
 * @param array<string> $dirs
 * @return array<string, int>
 */
function getFileModTimes(array $dirs): array
{
	$modTimes = [];

	foreach ($dirs as $dir) {
		if (!is_dir($dir)) {
			continue;
		}

		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
		);

		foreach ($iterator as $file) {
			if ($file->isFile()) {
				$path = $file->getPathname();
				$modTimes[$path] = $file->getMTime();
			}
		}
	}

	return $modTimes;
}
