<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use DateTimeImmutable;
use FilesystemIterator;
use Lcobucci\Clock\SystemClock;
use MergePHP\Website\Builder\Processor\ArchiveProcessor;
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

/**
 * Main service for building the static website.
 * Orchestrates all processors to generate the complete site.
 */
class SiteBuilderService
{
	/** @var string Application root directory */
	protected const string APP_ROOT = __DIR__ . '/../..';

	/** @var Environment Twig template environment */
	private Environment $twig;

	/**
	 * @param string $outputDirectory Directory where built files are written
	 * @param LoggerInterface $logger Logger for build output
	 */
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

	/**
	 * Build the complete static website.
	 * Runs all processors in sequence to generate all site files.
	 *
	 * @throws RuntimeException If build directory cannot be set up or files cannot be written
	 */
	public function build(): void
	{
		$collection = self::generateMeetupCollection();
		$this->logger->debug("Loaded {$collection->count()} meetups");

		$this->setUpBuildDir();
		$this->wipeExistingBuild();

		$twigData = self::generateCommonTwigVars();

		$clock = SystemClock::fromUTC();

		(new StaticFileProcessor($this->logger, $this->outputDirectory, self::APP_ROOT . '/public'))->run();
		(new HomepageProcessor($this->logger, $this->outputDirectory, $collection, $this->twig, $twigData))->run();
		(new PageNotFoundProcessor($this->logger, $this->outputDirectory, $this->twig, $twigData))->run();
		(new MeetupProcessor($this->logger, $this->outputDirectory, $collection, $this->twig, $twigData))->run();
		(new ArchiveProcessor($this->logger, $this->outputDirectory, $collection, $this->twig, $twigData))->run();
		(new SitemapProcessor($this->logger, $this->outputDirectory, $clock))->run();
		(new RSSFeedProcessor($this->logger, $this->outputDirectory, $collection))->run();
		(new YouTubeLinkProcessor($this->logger, $this->outputDirectory, $collection))->run();
		$this->logger->info('Finished successfully');
	}

	/**
	 * Ensure the build directory exists and is writable.
	 *
	 * @throws RuntimeException If directory cannot be created or is not writable
	 */
	protected function setUpBuildDir(): void
	{
		if (!file_exists($this->outputDirectory)) {
			$this->logger->debug("Creating $this->outputDirectory");
			mkdir($this->outputDirectory);
			if (!is_dir($this->outputDirectory)) {
				throw new RuntimeException("Could not create $this->outputDirectory");
			}
		}
		if (!is_writable($this->outputDirectory)) {
			throw new RuntimeException("$this->outputDirectory exists but is not writable");
		}
	}

	/**
	 * Delete all existing files and directories in the output directory.
	 *
	 * @throws RuntimeException If a file or directory cannot be deleted
	 */
	protected function wipeExistingBuild(): void
	{
		$this->logger->debug("Wiping $this->outputDirectory");
		$directoryIterator = new RecursiveDirectoryIterator($this->outputDirectory, FilesystemIterator::SKIP_DOTS);
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
		$this->logger->info("Wiped output directory of $deletedFiles files and $deletedDirectories directories");
	}

	/**
	 * Load all meetup classes from the Meetup directory and create a collection.
	 *
	 * @return MeetupCollection Sorted collection of all meetups
	 */
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

	/**
	 * Generate common variables to pass to all Twig templates.
	 *
	 * @return array Array of common template variables
	 */
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
