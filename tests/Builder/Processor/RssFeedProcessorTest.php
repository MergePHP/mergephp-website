<?php

declare(strict_types=1);

namespace Tests\Builder\Processor;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Builder\MeetupEntry;
use MergePHP\Website\Builder\Processor\RSSFeedProcessor;
use MergePHP\Website\Exception\InvalidContentException;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use SimpleXMLElement;

class RssFeedProcessorTest extends TestCase
{
	public const string MEETUP_DATE_STRING = '2000-01-01T00:00:00+00:00';
	private const string MODIFIED_DATE_STRING = '2000-01-02T00:00:00+00:00';
	private const string EXPECTED_FILENAME = 'vfs://root/atom.xml';
	private const string FIXTURES_DIR = __DIR__ . '/../../fixtures/';

	public function setUp(): void
	{
		$this->directory = vfsStream::setup();
		parent::setUp();
	}

	public function testItGeneratesARSSFeed(): void
	{
		$collection = new MeetupCollection();
		$collection->append(new MeetupEntry(self::generateMeetup(), new DateTimeImmutable(self::MODIFIED_DATE_STRING)));
		$processor = new RSSFeedProcessor(new NullLogger(), "vfs://root/", $collection);
		$now = (new DateTimeImmutable())->format('c');
		/** @noinspection PhpUnhandledExceptionInspection */
		$processor->run();

		$xml = simplexml_load_file(self::FIXTURES_DIR . 'atom.xml');
		$this->assertInstanceOf(SimpleXMLElement::class, $xml);

		// replace the date/time the file declares it was generated at with a static time
		file_put_contents(
			self::EXPECTED_FILENAME,
			str_replace($now, self::MODIFIED_DATE_STRING, file_get_contents(self::EXPECTED_FILENAME))
		);

		/** @noinspection PhpUnitMisorderedAssertEqualsArgumentsInspection */
		$this->assertFileEqualsCanonicalizing(self::FIXTURES_DIR . 'atom.xml', self::EXPECTED_FILENAME);
	}

	public function testItThrowsWhenADescriptionContainsAPreTag(): void
	{
		$collection = new MeetupCollection();
		$meetup = self::generateMeetup('Foo<pre>bar</pre>baz');
		$collection->append(new MeetupEntry($meetup, new DateTimeImmutable(self::MODIFIED_DATE_STRING)));
		$processor = new RSSFeedProcessor(new NullLogger(), "vfs://root/", $collection);
		$this->expectException(InvalidContentException::class);
		$processor->run();
	}

	public function testItIgnoresTheMeetupImageURL(): void
	{
		$imageLink = '/images/placeholder.webp';

		$collection = new MeetupCollection();
		$meetup = self::generateMeetup();
		$this->assertEquals($imageLink, $meetup->getImage(), 'Did the default url change on AbstractMeetup::getImage?');
		$collection->append(new MeetupEntry($meetup, new DateTimeImmutable(self::MODIFIED_DATE_STRING)));
		$processor = new RSSFeedProcessor(new NullLogger(), "vfs://root/", $collection);
		/** @noinspection PhpUnhandledExceptionInspection */
		$processor->run();
		$this->assertStringNotContainsString($imageLink, file_get_contents(self::EXPECTED_FILENAME));
	}

	private function generateMeetup(string $description = 'Example description'): AbstractMeetup
	{
		return new class ($description) extends AbstractMeetup
		{
			public function __construct(private readonly string $description)
			{
			}

			public function getTitle(): string
			{
				return 'Example Meetup';
			}
			public function getDescription(): string
			{
				return $this->description;
			}
			public function getDateTime(): DateTimeImmutable
			{
				return new DateTimeImmutable(RssFeedProcessorTest::MEETUP_DATE_STRING);
			}
			public function getSpeakerName(): string
			{
				return 'Speaker Name';
			}
			public function getSpeakerBio(): string
			{
				return 'Speaker Bio';
			}
		};
	}
}
