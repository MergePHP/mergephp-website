<?php

declare(strict_types=1);

namespace Tests\Builder\Processor;

use DateTimeImmutable;
use DateTimeZone;
use Lcobucci\Clock\FrozenClock;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use MergePHP\Website\Builder\Processor\ApiProcessor;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class ApiProcessorTest extends TestCase
{
	private FrozenClock $clock;
	private const string FILE_ROOT = 'vfs://root/api/v1/meetups/';

	public function setUp(): void
	{
		vfsStream::setup();

		/** @noinspection PhpUnhandledExceptionInspection */
		$this->clock = new FrozenClock(new DateTimeImmutable('2020-01-01 00:00:00', new DateTimeZone('UTC')));

		parent::setUp();
	}

	public function testItGeneratesJsonFiles(): void
	{
		$collection = new MeetupCollection($this->clock);
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Future Meetup', '2099-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2099-01-01T00:00:00-05:00')
		));
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Past Meetup', '2000-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2000-01-01T00:00:00-05:00')
		));

		$processor = new ApiProcessor(new NullLogger(), 'vfs://root/', $collection);
		$processor->run();

		$this->assertFileExists(self::FILE_ROOT . 'all.json');
		$this->assertFileExists(self::FILE_ROOT . 'upcoming.json');
		$this->assertFileExists(self::FILE_ROOT . 'past.json');
	}

	public function testAllJsonContainsAllMeetupsSortedOldestFirst(): void
	{
		$collection = new MeetupCollection($this->clock);
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Newer Meetup', '2099-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2099-01-01T00:00:00-05:00')
		));
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Older Meetup', '2000-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2000-01-01T00:00:00-05:00')
		));

		$processor = new ApiProcessor(new NullLogger(), 'vfs://root/', $collection);
		$processor->run();

		/** @noinspection PhpUnhandledExceptionInspection */
		$allJson = json_decode(file_get_contents(self::FILE_ROOT . 'all.json'), false, 512, JSON_THROW_ON_ERROR);

		$this->assertCount(2, $allJson);
		$this->assertEquals('Older Meetup', $allJson[0]->title);
		$this->assertEquals('Newer Meetup', $allJson[1]->title);
	}

	public function testUpcomingJsonContainsOnlyFutureMeetups(): void
	{
		$collection = new MeetupCollection($this->clock);
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Past Meetup', '2000-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2000-01-01T00:00:00-05:00')
		));
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Future Meetup', '2099-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2099-01-01T00:00:00-05:00')
		));

		$processor = new ApiProcessor(new NullLogger(), 'vfs://root/', $collection);
		$processor->run();

		/** @noinspection PhpUnhandledExceptionInspection */
		$json = json_decode(file_get_contents(self::FILE_ROOT . 'upcoming.json'), false, 512, JSON_THROW_ON_ERROR);

		$this->assertCount(1, $json);
		$this->assertEquals('Future Meetup', $json[0]->title);
	}

	public function testPastJsonContainsOnlyPastMeetups(): void
	{
		$collection = new MeetupCollection($this->clock);
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Past Meetup', '2000-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2000-01-01T00:00:00-05:00')
		));
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Future Meetup', '2099-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2099-01-01T00:00:00-05:00')
		));

		$processor = new ApiProcessor(new NullLogger(), 'vfs://root/', $collection);
		$processor->run();

		/** @noinspection PhpUnhandledExceptionInspection */
		$pastJson = json_decode(file_get_contents(self::FILE_ROOT . 'past.json'), false, 512, JSON_THROW_ON_ERROR);

		$this->assertCount(1, $pastJson);
		$this->assertEquals('Past Meetup', $pastJson[0]->title);
	}

	public function testMeetupDataStructure(): void
	{
		$collection = new MeetupCollection($this->clock);
		$collection->append(new MeetupEntry(
			$this->generateMeetup(
				'Test Meetup',
				'2099-01-01T00:00:00-05:00',
				'Test Description',
				'/images/test.jpg',
				'Test Speaker',
				'Test Bio',
				'https://www.youtube.com/watch?v=example',
				'https://www.phpc.tv/w/example',
			),
			new DateTimeImmutable('2099-01-01T00:00:00-05:00')
		));

		$processor = new ApiProcessor(new NullLogger(), 'vfs://root/', $collection);
		$processor->run();

		/** @noinspection PhpUnhandledExceptionInspection */
		$allJson = json_decode(file_get_contents(self::FILE_ROOT . 'all.json'), false, 512, JSON_THROW_ON_ERROR);
		$meetup = $allJson[0];

		$this->assertEquals('Test Meetup', $meetup->title);
		$this->assertEquals('Test Description', $meetup->description);
		$this->assertEquals('2099-01-01T00:00:00-05:00', $meetup->dateTime);
		$this->assertEquals('https://www.mergephp.com/meetups/2099/01/01/test-meetup.html', $meetup->permalink);
		$this->assertEquals('https://www.mergephp.com/images/test.jpg', $meetup->image);
		$this->assertEquals('Test Speaker', $meetup->speakerName);
		$this->assertEquals('Test Bio', $meetup->speakerBio);
		$this->assertEquals('https://www.youtube.com/watch?v=example', $meetup->youTubeLink);
		$this->assertEquals('https://www.phpc.tv/w/example', $meetup->phpCTvLink);
	}

	public function testFilesAreDeterministic(): void
	{
		$collection = new MeetupCollection($this->clock);
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Meetup 1', '2099-01-01T00:00:00-05:00'),
			new DateTimeImmutable('2099-01-01T00:00:00-05:00')
		));
		$collection->append(new MeetupEntry(
			$this->generateMeetup('Meetup 2', '2099-01-02T00:00:00-05:00'),
			new DateTimeImmutable('2099-01-02T00:00:00-05:00')
		));

		$processor = new ApiProcessor(new NullLogger(), 'vfs://root/', $collection);
		$processor->run();

		$firstRunAll = file_get_contents(self::FILE_ROOT . 'all.json');
		$firstRunUpcoming = file_get_contents(self::FILE_ROOT . 'upcoming.json');
		$firstRunPast = file_get_contents(self::FILE_ROOT . 'past.json');

		// Run again with same data
		$processor = new ApiProcessor(new NullLogger(), 'vfs://root/', $collection);
		$processor->run();

		$secondRunAll = file_get_contents(self::FILE_ROOT . 'all.json');
		$secondRunUpcoming = file_get_contents(self::FILE_ROOT . 'upcoming.json');
		$secondRunPast = file_get_contents(self::FILE_ROOT . 'past.json');

		$this->assertEquals($firstRunAll, $secondRunAll);
		$this->assertEquals($firstRunUpcoming, $secondRunUpcoming);
		$this->assertEquals($firstRunPast, $secondRunPast);
	}

	private function generateMeetup(
		string $title = 'Example Meetup',
		string $dateString = '2000-01-01T00:00:00-05:00',
		string $description = 'Example description',
		string $image = '/images/placeholder.webp',
		string $speakerName = 'Speaker Name',
		string $speakerBio = 'Speaker Bio',
		?string $youTubeLink = null,
		?string $phpCTvLink = null
	): AbstractMeetup {
		return new class (
			$title,
			$dateString,
			$description,
			$image,
			$speakerName,
			$speakerBio,
			$youTubeLink,
			$phpCTvLink
		) extends AbstractMeetup {
			public function __construct(
				private readonly string $title,
				private readonly string $dateString,
				private readonly string $description,
				private readonly string $image,
				private readonly string $speakerName,
				private readonly string $speakerBio,
				private readonly ?string $youTubeLink,
				private readonly ?string $phpCTvLink
			) {
			}

			public function getTitle(): string
			{
				return $this->title;
			}

			public function getDescription(): string
			{
				return $this->description;
			}

			public function getDateTime(): DateTimeImmutable
			{
				return new DateTimeImmutable($this->dateString, new DateTimeZone('America/New_York'));
			}

			public function getSpeakerName(): string
			{
				return $this->speakerName;
			}

			public function getSpeakerBio(): string
			{
				return $this->speakerBio;
			}

			public function getImage(): string
			{
				return $this->image;
			}

			public function getYouTubeLink(): ?string
			{
				return $this->youTubeLink;
			}

			public function getPhpCTvLink(): ?string
			{
				return $this->phpCTvLink;
			}
		};
	}
}
