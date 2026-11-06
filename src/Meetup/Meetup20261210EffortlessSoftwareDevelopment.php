<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20261210EffortlessSoftwareDevelopment extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Effortless Software Development';
	}

	public function getDescription(): string
	{
		return <<<END
		Software development can be an eternal struggle, or it can be code that pretty much writes itself. In this
		talk, we’ll look at how simple acceptance tests and a few diagrams help us dive right into the code, which
		we in turn outline using DDD, This allows us to have a clean and testable design without worrying about
		implementation details. Code can be then implemented without developers worrying about stepping on each
		others’ toes, while still be confident that everything will work once put together. Discover how my team can
		build features faster than the client can sign them off.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-12-10 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Anna Filina';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Developer, mentor, author, and public speaker on a mission to help developers write automated tests and
		maintainable code. Anna mostly works with legacy apps that have millions of lines of code.
		END;
	}
}
