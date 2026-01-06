<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Watcher;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
	name: 'watch',
	description: 'Watch for file changes and rebuild the site automatically',
)]
class WatchCommand extends Command
{
	/** @var array<string> */
	private array $watchDirs = ['src', 'templates', 'public'];

	public function __construct(
		private readonly string $outputDirectory,
		private readonly string $projectRoot
	) {
		parent::__construct();
	}

	protected function configure(): void
	{
		$this->addOption(
			'host',
			null,
			InputOption::VALUE_REQUIRED,
			'Host to bind the server to (use 0.0.0.0 for Docker)',
			'localhost'
		);
		$this->addOption(
			'port',
			'p',
			InputOption::VALUE_REQUIRED,
			'Port for the development server',
			'8000'
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$host = (string) $input->getOption('host');
		$port = (int) $input->getOption('port');
		$watcher = new FileWatcher($this->watchDirs);

		$output->writeln('Starting file watcher...');
		$output->writeln('Watching: ' . implode(', ', $this->watchDirs));
		$output->writeln('Press Ctrl+C to stop.');
		$output->writeln('');

		// Initial build
		$output->writeln('Running initial build...');
		$this->runBuild($output);
		$output->writeln('');

		// Start the PHP server in the background
		$displayHost = $host === '0.0.0.0' ? 'localhost' : $host;
		$output->writeln("Starting server at http://$displayHost:$port");
		$output->writeln('');

		$serverProcess = $this->startServer($host, $port);
		if ($serverProcess === null) {
			$output->writeln('<error>Failed to start server</error>');
			return Command::FAILURE;
		}

		$pipes = $serverProcess['pipes'];

		// Make pipes non-blocking
		stream_set_blocking($pipes[1], false);
		stream_set_blocking($pipes[2], false);

		// Get initial file states
		$lastModTimes = $watcher->getFileModTimes();

		// Handle shutdown
		$running = true;
		$process = $serverProcess['process'];

		if (function_exists('pcntl_signal')) {
			pcntl_signal(SIGINT, function () use (&$running, $process, $pipes, $output) {
				$running = false;
				$output->writeln('');
				$output->writeln('Shutting down...');
				fclose($pipes[0]);
				fclose($pipes[1]);
				fclose($pipes[2]);
				proc_terminate($process);
			});
		}

		// Main watch loop
		$loopCount = 0;
		while ($running) {
			if (function_exists('pcntl_signal_dispatch')) {
				pcntl_signal_dispatch();
			}

			// Check for server output
			$this->drainPipes($pipes, $output);

			// Check for file changes
			$currentModTimes = $watcher->getFileModTimes();
			$changes = $watcher->detectChanges($lastModTimes, $currentModTimes);

			// Debug output every 10 loops
			$loopCount++;
			if ($output->isVerbose() && $loopCount % 10 === 0) {
				$output->writeln("<comment>[Debug] Polling... " . count($currentModTimes) . " files</comment>");
			}

			if ($watcher->shouldRebuild($changes)) {
				$output->writeln('');
				$output->writeln('[' . date('H:i:s') . '] Changes detected:');
				foreach ($watcher->formatChangesForDisplay($changes) as $line) {
					$output->writeln($line);
				}

				$output->writeln('Rebuilding...');
				$this->runBuild($output);
				$output->writeln('Done.');

				$lastModTimes = $currentModTimes;
			}

			sleep(1);
		}

		return Command::SUCCESS;
	}

	private function runBuild(OutputInterface $output): void
	{
		// Use passthru to run the build as a separate process
		// This is more reliable than calling the command internally
		$returnCode = 0;
		passthru('php console.php build', $returnCode);
		if ($returnCode !== 0) {
			$output->writeln('<error>Build failed with exit code ' . $returnCode . '</error>');
		}
	}

	/**
	 * @return array{process: resource, pipes: array<int, resource>}|null
	 */
	private function startServer(string $host, int $port): ?array
	{
		// File descriptors for the child process (mode is from child's perspective)
		$descriptors = [
			0 => ['pipe', 'r'], // stdin  - child reads from this pipe
			1 => ['pipe', 'w'], // stdout - child writes to this pipe
			2 => ['pipe', 'w'], // stderr - child writes to this pipe
		];

		$process = proc_open(
			"php -S $host:$port -t {$this->outputDirectory}",
			$descriptors,
			$pipes,
			$this->projectRoot
		);

		if (!is_resource($process)) {
			return null;
		}

		return ['process' => $process, 'pipes' => $pipes];
	}

	/**
	 * @param array<int, resource> $pipes
	 */
	private function drainPipes(array $pipes, OutputInterface $output): void
	{
		$serverOutput = stream_get_contents($pipes[1]);
		$serverErrors = stream_get_contents($pipes[2]);

		if ($serverOutput) {
			$output->write($serverOutput);
		}
		if ($serverErrors) {
			$output->write($serverErrors);
		}
	}
}
