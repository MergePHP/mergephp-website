<?php

declare(strict_types=1);

namespace Tests\Builder\Processor;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use MergePHP\Website\Builder\Processor\ICalProcessor;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class ICalProcessorTest extends TestCase
{
	public function setUp(): void
	{
		$this->directory = vfsStream::setup();
		parent::setUp();
	}

	public function testItGeneratesAnIcalFeed(): void
	{
		$collection = new MeetupCollection();
		$collection->append(
			new MeetupEntry(
				new class extends AbstractMeetup
				{
					public function getTitle(): string
					{
						return 'Meetup Title';
					}

					public function getDescription(): string
					{
						return <<<END
							This description spans multiple lines and uses the heredoc syntax
							This description spans multiple lines and uses the heredoc syntax
						END;
					}

					public function getDateTime(): DateTimeImmutable
					{
						return new DateTimeImmutable('2000-01-01 00:00:00', new DateTimeZone('America/New_York'));
					}

					public function getSpeakerName(): string
					{
						return 'Speaker Name';
					}

					public function getSpeakerBio(): string
					{
						return 'Speaker has no bio';
					}
				},
				new DateTimeImmutable('2001-01-01 01:01:01', new DateTimeZone('America/New_York')),
			)
		);

		$processor = new ICalProcessor(new NullLogger(), 'vfs://root', $collection);
		$processor->run();

		$this->assertFileEquals(__DIR__ . '/../../fixtures/mergephp.ical', 'vfs://root/mergephp.ical');
	}
}
