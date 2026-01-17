<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use DateTimeImmutable;
use FilesystemIterator;
use Lcobucci\Clock\SystemClock;
use MergePHP\Website\Builder\Processor\ArchiveProcessor;
use MergePHP\Website\Builder\Processor\ICalProcessor;
use MergePHP\Website\Builder\Processor\MeetupProcessor;
use MergePHP\Website\Builder\Processor\HomepageProcessor;
use MergePHP\Website\Builder\Processor\YouTubeLinkProcessor;
use MergePHP\Website\Builder\Processor\PageNotFoundProcessor;
use MergePHP\Website\Builder\Processor\RSSFeedProcessor;
use MergePHP\Website\Builder\Processor\SitemapProcessor;
use MergePHP\Website\Builder\Processor\StaticFileProcessor;
use MergePHP\Website\Meetups;
use Psr\Log\LoggerInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use SplFileInfo;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Extra\Markdown\MarkdownExtension;
use Twig\Loader\FilesystemLoader;

class SiteBuilderService
{
	protected const string APP_ROOT = __DIR__ . '/../..';
	private Environment $twig;

	public function __construct(protected string $outputDirectory, protected LoggerInterface $logger)
	{
		$this->twig = new Environment(new FilesystemLoader(self::APP_ROOT . '/templates/'), [
			'debug' => true,
			'strict_variables' => true,
		]);
		$this->twig->addExtension(new MarkdownExtension());
		$this->twig->addExtension(new DebugExtension());
		$this->twig->addRuntimeLoader(new TwigRuntimeLoader());
	}

	public function build(): void
	{
		$collection = self::generateMeetupCollection();
		$this->logger->debug("Loaded {$collection->count()} meetups");

		// Build to a temporary directory, then swap atomically
		// This prevents race conditions with the dev server during watch mode
		$buildDir = $this->outputDirectory . '.build';
		$oldDir = $this->outputDirectory . '.old';

		$this->setUpBuildDir($buildDir);
		$this->wipeDirectory($buildDir);

		$twigData = self::generateCommonTwigVars();

		$clock = SystemClock::fromUTC();

		(new StaticFileProcessor($this->logger, $buildDir, self::APP_ROOT . '/public'))->run();
		(new HomepageProcessor($this->logger, $buildDir, $collection, $this->twig, $twigData))->run();
		(new PageNotFoundProcessor($this->logger, $buildDir, $this->twig, $twigData))->run();
		(new MeetupProcessor($this->logger, $buildDir, $collection, $this->twig, $twigData))->run();
		(new ArchiveProcessor($this->logger, $buildDir, $collection, $this->twig, $twigData))->run();
		(new SitemapProcessor($this->logger, $buildDir, $clock))->run();
		(new RSSFeedProcessor($this->logger, $buildDir, $collection))->run();
		(new ICalProcessor($this->logger, $this->outputDirectory, $collection))->run();
		(new YouTubeLinkProcessor($this->logger, $buildDir, $collection))->run();

		// Atomic swap: move old dist out, move new build in
		$this->swapDirectories($buildDir, $this->outputDirectory, $oldDir);
		$this->logger->info('Finished successfully');
	}

	protected function setUpBuildDir(string $directory): void
	{
		if (!file_exists($directory)) {
			$this->logger->debug("Creating $directory");
			mkdir($directory);
			if (!is_dir($directory)) {
				throw new RuntimeException("Could not create $directory");
			}
		}
		if (!is_writable($directory)) {
			throw new RuntimeException("$directory exists but is not writable");
		}
	}

	protected function wipeDirectory(string $directory): void
	{
		if (!is_dir($directory)) {
			$this->logger->debug("Would have wiped $directory but it doesn't exist");
			return;
		}
		$this->logger->debug("Wiping $directory");
		$directoryIterator = new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS);
		$iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::CHILD_FIRST);
		$deletedFiles = $deletedDirectories = 0;
		foreach ($iterator as $file) {
			/** @var SplFileInfo $file */
			if ($file->isDir()) {
				if (rmdir($file->getRealPath())) {
					$deletedDirectories++;
				} else {
					throw new RuntimeException("Could not remove directory $file");
				}
			} else {
				if (unlink($file->getRealPath())) {
					$deletedFiles++;
				} else {
					throw new RuntimeException("Could not delete file $file}");
				}
			}
		}
		$this->logger->info("Wiped directory of $deletedFiles files and $deletedDirectories directories");
	}

	protected function swapDirectories(string $newDir, string $targetDir, string $oldDir): void
	{
		// Clean up any leftover old directory from previous builds
		$this->wipeDirectory($oldDir);
		if (is_dir($oldDir)) {
			rmdir($oldDir);
		}

		// Swap: target -> old, new -> target
		if (is_dir($targetDir)) {
			$this->logger->debug("Moving $targetDir to $oldDir");
			if (!rename($targetDir, $oldDir)) {
				throw new RuntimeException("Could not move $targetDir to $oldDir");
			}
		}

		$this->logger->debug("Moving $newDir to $targetDir");
		if (!rename($newDir, $targetDir)) {
			// Try to restore the old directory if the swap failed
			if (is_dir($oldDir)) {
				rename($oldDir, $targetDir);
			}
			throw new RuntimeException("Could not move $newDir to $targetDir");
		}

		// Clean up the old directory
		$this->wipeDirectory($oldDir);
		if (is_dir($oldDir)) {
			rmdir($oldDir);
		}
	}

	protected static function generateMeetupCollection(): MeetupCollection
	{
		$meetups = new MeetupCollection();
		foreach (glob(self::APP_ROOT . '/src/Meetup/*.php') as $filename) {
			$fileInfo = new SplFileInfo($filename);
			$fileModificationTime = new DateTimeImmutable("@{$fileInfo->getMTime()}");
			$className = '\\MergePHP\\Website\\Meetup\\' . str_replace('.php', '', basename($filename));
			$instance = new $className();
			$meetups->append(new MeetupEntry($instance, $fileModificationTime));
		}
		$meetups->sort();
		return $meetups;
	}

	protected static function generateCommonTwigVars(): array
	{
		$meetupLocations = [];
		foreach (Meetups::cases() as $case) {
			$meetupLocations[] = $case->value;
		}

		return [
			'meetupLocations' => $meetupLocations,
		];
	}
}
