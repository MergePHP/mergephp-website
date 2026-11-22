<?php

declare(strict_types=1);

namespace Tests\Builder;

use DateTimeImmutable;
use DateTimeZone;
use Lcobucci\Clock\FrozenClock;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use PHPUnit\Framework\TestCase;

class MeetupCollectionTest extends TestCase
{
	private MeetupCollection $collection;

	public function setUp(): void
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		$clock = new FrozenClock(new DateTimeImmutable('2020-06-15 12:00:00', new DateTimeZone('America/New_York')));
		$this->collection = new MeetupCollection($clock);
		$this->collection->append($this->generateEntry('2020-06-15 11:59:59'));
		$this->collection->append($this->generateEntry('2020-06-15 12:00:01'));

		parent::setUp();
	}

	public function testItFiltersToPastMeetups(): void
	{
		$past = $this->collection->withOnlyPast();

		$this->assertCount(1, $past);
		$this->assertSame('2020-06-15 11:59:59', reset($past)->instance->getDateTime()->format('Y-m-d H:i:s'));
	}

	public function testItFiltersToFutureMeetups(): void
	{
		$future = $this->collection->withOnlyFuture();

		$this->assertCount(1, $future);
		$this->assertSame('2020-06-15 12:00:01', reset($future)->instance->getDateTime()->format('Y-m-d H:i:s'));
	}

	private function generateEntry(string $dateString): MeetupEntry
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		$dateTime = new DateTimeImmutable($dateString, new DateTimeZone('America/New_York'));

		return new MeetupEntry(
			new class ($dateTime) extends AbstractMeetup {
				public function __construct(private readonly DateTimeImmutable $dateTime)
				{
				}

				public function getTitle(): string
				{
					return 'Example Meetup';
				}

				public function getDescription(): string
				{
					return 'Example description';
				}

				public function getDateTime(): DateTimeImmutable
				{
					return $this->dateTime;
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
			$dateTime
		);
	}
}
