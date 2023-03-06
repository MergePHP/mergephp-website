<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20201112WhatsNewInPhp80 extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'What\'s new in PHP 8.0';
	}

	public function getDescription(): string
	{
		return 'From attributes and named arguments to union types and a JIT, there\'s a lot of new functionality ' .
			'large and small landing in PHP 8, due out around Thanksgiving. We\'ll take a look at the highlights, as ' .
			'well as backward compatibility breaks to be aware of prior to upgrading.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2020-11-12 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Ian Littman';
	}

	public function getSpeakerBio(): string
	{
		return 'Ian Littman is an Austin-based developer focusing on architecting APIs for a smattering of contract ' .
			'clients, plus a startup that\'s.well, you\'ll hear about the startup eventually. Pre-pandemic, he could ' .
			'be found biking between successively later-closing coffee shops, opining on transportation ' .
			'infrastructure, or speaking at conferences ranging from Cascadia PHP in Portland to PHP Bulgaria in ' .
			'Sofia. He also helps organize Longhorn PHP Conference, scheduled for early May of next year in Austin.';
	}
}
