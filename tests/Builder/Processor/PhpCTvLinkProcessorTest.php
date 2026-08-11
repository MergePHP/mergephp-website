<?php

declare(strict_types=1);

namespace Tests\Builder\Processor;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use MergePHP\Website\Builder\Processor\PhpCTVLinkProcessor;
use MergePHP\Website\Exception\PhpCTvLinkException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class PhpCTvLinkProcessorTest extends TestCase
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
		$processor = new PhpCTVLinkProcessor($this->logger, 'unused', $collection);
		$this->logger->expects(self::once())->method('warning');
		$processor->run();
	}

	public function testItThrowsAnExceptionIfTheLinkIsNotToAVideo(): void
	{
		$collection = self::generateMeetupCollection('https://phpc.tv/c/mergephp');
		$this->expectException(PhpCTvLinkException::class);
		$this->expectExceptionMessageMatches(
			'/^https:\/\/phpc.tv\/c\/mergephp is not a valid phpc.tv video link in/'
		);
		$processor = new PhpCTVLinkProcessor($this->logger, 'unused', $collection);
		$processor->run();
	}

	public function testItLogsNothingIfTheLinkPointsToAVideo(): void
	{
		$collection = self::generateMeetupCollection('https://phpc.tv/w/abc123');
		$processor = new PhpCTVLinkProcessor($this->logger, 'unused', $collection);
		$this->logger->expects(self::exactly(0))->method('warning');
		$this->logger->expects(self::exactly(0))->method('error');
		$processor->run();
	}

	private static function generateMeetupCollection(?string $phpCTvLink = null): MeetupCollection
	{
		$collection = new MeetupCollection();
		$collection->append(new MeetupEntry(
			new class ($phpCTvLink) extends AbstractMeetup {
				public function __construct(private readonly ?string $phpCTvLink)
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

				public function getPhpCTvLink(): ?string
				{
					return $this->phpCTvLink;
				}
			},
			new DateTimeImmutable()
		));

		return $collection;
	}
}
