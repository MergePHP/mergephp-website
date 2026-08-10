<?php

declare(strict_types=1);

namespace Tests\Builder\Processor;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use MergePHP\Website\Builder\Processor\YouTubeLinkProcessor;
use MergePHP\Website\Exception\YouTubeLinkException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class YouTubeLinkProcessorTest extends TestCase
{
	private LoggerInterface $logger;

	public function setUp(): void
	{
		$this->logger = self::createMock(LoggerInterface::class);
		parent::setUp();
	}

	public function testItLogsAWarningOnAMeetupWithAMissingLink(): void
	{
		$collection = self::generateMeetupCollection();
		$processor = new YouTubeLinkProcessor($this->logger, 'unused', $collection);
		$this->logger->expects(self::once())->method('warning');
		$processor->run();
	}

	public function testItThrowsAnExceptionIfTheLinkIsNotToAVideo(): void
	{
		$collection = self::generateMeetupCollection('https://www.youtube.com/@MergePHP');
		$this->expectException(YouTubeLinkException::class);
		$this->expectExceptionMessageMatches(
			'/^https:\/\/www\.youtube\.com\/@MergePHP is not a valid YouTube video link in/'
		);
		$processor = new YouTubeLinkProcessor($this->logger, 'unused', $collection);
		$processor->run();
	}

	public function testItLogsNothingIfTheLinkPointsToAVideo(): void
	{
		$collection = self::generateMeetupCollection('https://www.youtube.com/watch?v=abc');
		$processor = new YouTubeLinkProcessor($this->logger, 'unused', $collection);
		$this->logger->expects(self::exactly(0))->method('warning');
		$this->logger->expects(self::exactly(0))->method('error');
		$processor->run();
	}

	private function generateMeetupCollection(?string $youTubeLink = null): MeetupCollection
	{
		$collection = new MeetupCollection();
		$collection->append(new MeetupEntry(
			new class ($youTubeLink) extends AbstractMeetup {
				public function __construct(private readonly ?string $youTubeLink)
				{
				}

				public function getTitle(): string
				{
					return 'Example Meetup';
				}

				public function getDescription(): string
				{
					return 'Example meetup';
				}

				public function getDateTime(): DateTimeImmutable
				{
					return new DateTimeImmutable('yesterday');
				}

				public function getSpeakerName(): string
				{
					return 'Speaker Name';
				}

				public function getSpeakerBio(): string
				{
					return 'Speaker Bio';
				}

				public function getYouTubeLink(): ?string
				{
					return $this->youTubeLink;
				}
			},
			new DateTimeImmutable()
		));

		return $collection;
	}
}
