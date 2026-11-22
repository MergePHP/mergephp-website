<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use Psr\Log\LoggerInterface;
use RuntimeException;

/**
 * @see public/openapi.yaml for the OpenAPI documentation of the files built here
 */
class ApiProcessor extends AbstractProcessor
{
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected MeetupCollection $meetups,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	public function run(): void
	{
		$this->logger->info('Building API JSON files');

		$apiDir = $this->outputDirectory . '/api/v1/meetups';
		if (!is_dir($apiDir) && !mkdir($apiDir, 0755, true)) {
			throw new RuntimeException("Could not create directory $apiDir");
		}

		$this->meetups->sort();

		/** @noinspection PhpUnhandledExceptionInspection */
		$this->writeJsonFile("$apiDir/all.json", $this->instances(iterator_to_array($this->meetups)));
		/** @noinspection PhpUnhandledExceptionInspection */
		$this->writeJsonFile("$apiDir/upcoming.json", $this->instances($this->meetups->withOnlyFuture()));
		/** @noinspection PhpUnhandledExceptionInspection */
		$this->writeJsonFile("$apiDir/past.json", $this->instances($this->meetups->withOnlyPast()));

		$this->logger->info('Saved API JSON files');
	}

	/**
	 * @param MeetupEntry[] $entries
	 * @return AbstractMeetup[]
	 */
	protected function instances(array $entries): array
	{
		return array_values(array_map(fn(MeetupEntry $entry) => $entry->instance, $entries));
	}

	/**
	 * @param AbstractMeetup[] $meetups
	 * @noinspection PhpDocMissingThrowsInspection
	 */
	protected function writeJsonFile(string $path, array $meetups): void
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		$json = json_encode(
			value: $meetups,
			flags: JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
		);

		$bytes = file_put_contents($path, $json . PHP_EOL);

		if ($bytes === false) {
			throw new RuntimeException("Could not write $path");
		}

		$this->logger->debug("Wrote {$bytes} bytes to $path");
	}
}
