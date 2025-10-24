<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20251113WhatsNewInPhp85 extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'What\'s New in PHP 8.5';
	}

	public function getDescription(): string
	{
		return '';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-11-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/whats-new-in-php-85.png';
	}

	public function getSpeakerName(): string
	{
		return 'Ian Littman';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		When Ian isn't CTO'ing a startup throwing APIs around insurance data or helping organize Longhorn PHP
		conference, he's soaking up the Texas Hill Country, or talking about mobile or airline networks on Twitter.
		END;
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=JrkUdEswSSo';
	}
}
