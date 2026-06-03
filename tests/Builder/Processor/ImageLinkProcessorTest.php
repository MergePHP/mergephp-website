<?php

declare(strict_types=1);

namespace Tests\Builder\Processor;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use MergePHP\Website\Builder\Processor\ImageLinkProcessor;
use MergePHP\Website\Exception\ImageLinkException;
use MergePHP\Website\Exception\ImageRatioException;
use MergePHP\Website\Exception\ImageSizeException;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ImageLinkProcessorTest extends TestCase
{
	private LoggerInterface $logger;
	private const string FIXTURES_DIR = __DIR__ . '/../../fixtures/';

	public function setUp(): void
	{
		$this->logger = self::createMock(LoggerInterface::class);
		vfsStream::setup('root', null, [
			'images' => [
				'ideal.png'  => file_get_contents(self::FIXTURES_DIR . 'ideal.png'),
				'large.png'  => file_get_contents(self::FIXTURES_DIR . 'large.png'),
				'small.gif'  => file_get_contents(self::FIXTURES_DIR . 'small.gif'),
				'square.png' => file_get_contents(self::FIXTURES_DIR . 'square.png'),
			],
		]);
		parent::setUp();
	}

	public function testItLogsAnInfoOnAMeetupWithAnExternalImageLink(): void
	{
		$collection = self::generateMeetupCollection('https://www.example.com/image.jpg');
		$processor = new ImageLinkProcessor($this->logger, 'unused', $collection);
		$this->logger
			->expects($this->exactly(2))
			->method('info')
			->willReturnCallback(function (...$args) use (&$callCount) {
				$callCount++;

				if ($callCount === 2) {
					self::assertStringEndsWith(
						'contains an external image and may or may not exist on the remote server',
						$args[0]
					);
				}
			});
		$processor->run();
	}

	public function testItThrowsWhenAMeetupContainsALinkToALocalImageThatDoesNotExist(): void
	{
		$collection = self::generateMeetupCollection('/images/invalid.jpg');
		$processor = new ImageLinkProcessor($this->logger, 'unused', $collection);
		$this->expectException(ImageLinkException::class);
		$this->expectExceptionMessageMatches(
			'/^Image \/images\/invalid\.jpg does not exist \(defined in MergePHP\\\Website\\\AbstractMeetup@/'
		);
		$processor->run();
	}

	public function testItPrintsAWarningForOtherImageLinks(): void
	{
		$collection = self::generateMeetupCollection('foo.jpg');
		$processor = new ImageLinkProcessor($this->logger, 'unused', $collection);
		$this->logger
			->expects($this->exactly(2))
			->method('warning')
			->willReturnCallback(function (...$args) use (&$callCount) {
				$callCount++;

				if ($callCount === 2) {
					self::assertMatchesRegularExpression(
						'/^Image foo\.jpg on .+ uses a nonstandard path and will not have its dimensions checked$/',
						$args[0]
					);
				}
			});
		$processor->run();
	}

	public function testItThrowsWhenImageDimensionsAreTooSmall(): void
	{
		$collection = self::generateMeetupCollection('/images/small.gif');
		$processor = new ImageLinkProcessor(new NullLogger(), 'vfs://root', $collection);
		$this->expectException(ImageSizeException::class);
		$this->expectExceptionMessageMatches(
			'/^\/images\/small.gif in .+ is 32 × 32 but must be at least \d+ wide by \d+ high and \d+:\d+ ratio$/'
		);
		$processor->run();
	}

	public function testItThrowsWhenImageDimensionsAreTooLarge(): void
	{
		$collection = self::generateMeetupCollection('/images/large.png');
		$processor = new ImageLinkProcessor(new NullLogger(), 'vfs://root', $collection);
		$this->expectException(ImageSizeException::class);
		$this->expectExceptionMessageMatches(
			'/^\/images\/large.png in .+ is 2161 × 1200 but must be at most \d+ wide by \d+ high and \d+:\d+ ratio$/'
		);
		$processor->run();
	}

	public function testItThrowsWhenImageDimensionsAreTheWrongRatio(): void
	{
		$collection = self::generateMeetupCollection('/images/square.png');
		$processor = new ImageLinkProcessor(new NullLogger(), 'vfs://root', $collection);
		$this->expectException(ImageRatioException::class);
		$this->expectExceptionMessageMatches('/^\/images\/square\.png in .+ is the wrong ratio; must be \d+:\d+$/');
		$processor->run();
	}

	public function testItAllowsOlderMeetupsWithImagesThatAreTheWrongRatio(): void
	{
		$collection = self::generateMeetupCollection('/images/square.png', new DateTimeImmutable('2000-01-01'));
		$processor = new ImageLinkProcessor(new NullLogger(), 'vfs://root', $collection);
		$processor->run();
		$this->assertInstanceOf(ImageLinkProcessor::class, $processor);
	}

	private function generateMeetupCollection(
		string $imageLink,
		?DateTimeImmutable $meetupDateTime = null,
	): MeetupCollection {
		$collection = new MeetupCollection();
		$collection->append(new MeetupEntry(
			new class ($imageLink, $meetupDateTime) extends AbstractMeetup {
				public function __construct(private readonly string $imageLink, private $meetupDateTime = null)
				{
					if (!$meetupDateTime) {
						$this->meetupDateTime = new DateTimeImmutable();
					}
				}

				public function getTitle(): string
				{
					return 'Example Meetup';
				}

				public function getDescription(): string
				{
					return 'Example meetup';
				}

				public function getImage(): string
				{
					return $this->imageLink;
				}

				public function getDateTime(): DateTimeImmutable
				{
					return $this->meetupDateTime;
				}

				public function getSpeakerName(): string
				{
					return 'Speaker Name';
				}

				public function getSpeakerBio(): string
				{
					return 'Speaker Bio';
				}
			},
			new DateTimeImmutable()
		));

		return $collection;
	}
}
