<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Watcher;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

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
			name: 'host',
			shortcut: null,
			mode: InputOption::VALUE_REQUIRED,
			description: 'Host to bind the server to (use 0.0.0.0 for Docker)',
			default: 'localhost'
		);
		$this->addOption(
			name: 'port',
			shortcut: 'p',
			mode: InputOption::VALUE_REQUIRED,
			description: 'Port for the development server',
			default: '8000'
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

		// Get initial file states
		$lastModTimes = $watcher->getFileModTimes();

		// Handle shutdown
		$running = true;
		$shutdown = function () use (&$running, $serverProcess, $output): void {
			$running = false;
			$output->writeln('');
			$output->writeln('Shutting down...');
			$serverProcess->stop(1);
		};

		if (function_exists('pcntl_signal')) {
			pcntl_signal(signal: SIGINT, handler: $shutdown);
		} elseif (function_exists('sapi_windows_set_ctrl_handler')) {
			sapi_windows_set_ctrl_handler(handler: static function () use ($shutdown): bool {
				$shutdown();
				return true;
			});
		} else {
			register_shutdown_function($shutdown);
		}

		// Main watch loop
		$loopCount = 0;
		while ($running) {
			if (function_exists('pcntl_signal_dispatch')) {
				pcntl_signal_dispatch();
			}

			// Check for server output
			$output->write($serverProcess->getIncrementalOutput());
			$output->write($serverProcess->getIncrementalErrorOutput());

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
		$command = [PHP_BINARY, 'console.php', 'build'];
		$verbosityFlag = $this->getVerbosityFlag($output);
		if ($verbosityFlag !== null) {
			$command[] = $verbosityFlag;
		}

		$process = new Process(command: $command, cwd: $this->projectRoot);
		$process->setTimeout(timeout: null);
		$process->run(function (string $type, string $buffer) use ($output): void {
			$output->write($buffer);
		});

		if (!$process->isSuccessful()) {
			$output->writeln('<error>Build failed with exit code ' . $process->getExitCode() . '</error>');
		}
	}

	/**
	 * @return Process|null
	 */
	private function startServer(string $host, int $port): ?Process
	{
		$process = new Process(
			command: [PHP_BINARY, '-S', "$host:$port", '-t', $this->outputDirectory],
			cwd: $this->projectRoot
		);
		$process->setTimeout(timeout: null);
		$process->start();

		return $process->isRunning() ? $process : null;
	}

	private function getVerbosityFlag(OutputInterface $output): ?string
	{
		return match ($output->getVerbosity()) {
			OutputInterface::VERBOSITY_QUIET => '-q',
			OutputInterface::VERBOSITY_VERBOSE => '-v',
			OutputInterface::VERBOSITY_VERY_VERBOSE => '-vv',
			OutputInterface::VERBOSITY_DEBUG => '-vvv',
			default => null,
		};
	}
}
