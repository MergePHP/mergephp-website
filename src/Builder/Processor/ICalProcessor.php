<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateInterval;
use DateTimeZone;
use Eluceo\iCal\Domain\Entity\Calendar;
use Eluceo\iCal\Domain\Entity\Event;
use Eluceo\iCal\Domain\Entity\TimeZone;
use Eluceo\iCal\Domain\Enum\EventStatus;
use Eluceo\iCal\Domain\ValueObject\DateTime;
use Eluceo\iCal\Domain\ValueObject\EmailAddress;
use Eluceo\iCal\Domain\ValueObject\Location;
use Eluceo\iCal\Domain\ValueObject\Organizer;
use Eluceo\iCal\Domain\ValueObject\TimeSpan;
use Eluceo\iCal\Domain\ValueObject\Timestamp;
use Eluceo\iCal\Domain\ValueObject\UniqueIdentifier;
use Eluceo\iCal\Domain\ValueObject\Uri;
use Eluceo\iCal\Presentation\Factory\CalendarFactory;
use Generator;
use League\CommonMark\CommonMarkConverter;
use MergePHP\Website\Builder\MeetupCollection;
use Psr\Log\LoggerInterface;
use RuntimeException;

class ICalProcessor extends AbstractProcessor
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
		$this->logger->info('Building iCal feed');
		$converter = new CommonMarkConverter();

		$calendar = new Calendar($this->generateEvents($converter));

		$this->meetups->sort();
		$oldestTimestamp = $this->meetups[0]->instance->getDateTime();
		$newestTimestamp = $this->meetups[count($this->meetups) - 1]->instance->getDateTime();
		$calendar->addTimeZone(
			TimeZone::createFromPhpDateTimeZone(
				new DateTimeZone('America/New_York'),
				$oldestTimestamp,
				$newestTimestamp,
			)
		);

		$componentFactory = new CalendarFactory();
		$calendar = $componentFactory->createCalendar($calendar);

		$outputFilename = "$this->outputDirectory/mergephp.ical";
		$bytes = file_put_contents($outputFilename, (string)$calendar);

		if ($bytes === false) {
			throw new RuntimeException("Could not write $outputFilename");
		}
		$this->logger->info("Saved $bytes bytes to $outputFilename");
	}

	protected function generateEvents(CommonMarkConverter $converter): Generator
	{
		foreach ($this->meetups as $meetup) {
			$this->logger->debug("Generating iCal event for {$meetup->instance->getTitle()}");

			$permalink = 'https://www.mergephp.com' . $meetup->instance->getPermalink();
			$description = $converter->convert($meetup->instance->getDescription());
			$description = trim(strip_tags((string)$description));

			yield (new Event(
				new UniqueIdentifier($permalink),
			))
				->setSummary(
					$meetup->instance->getTitle(),
				)
				->setDescription(
					$description,
				)
				->setOccurrence(
					new TimeSpan(
						new DateTime($meetup->instance->getDateTime(), true),
						new DateTime($meetup->instance->getDateTime()->add(new DateInterval('PT1H')), true),
					),
				)
				->setLocation(
					new Location($meetup->instance->getYouTubeLink() ?: 'https://www.mergephp.com/'),
				)
				->setOrganizer(
					new Organizer(new EmailAddress('nobody@mergephp.com'), $meetup->instance->getSpeakerName()),
				)
				->setUrl(
					new Uri($permalink),
				)
				->setLastModified(
					new Timestamp($meetup->modifiedTimestamp),
				)
				->touch(
					new Timestamp($meetup->modifiedTimestamp),
				)
				->setStatus(
					(new EventStatus())->CONFIRMED(),
				)
			;
		}
	}
}
