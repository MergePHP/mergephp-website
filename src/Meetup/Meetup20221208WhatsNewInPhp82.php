<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20221208WhatsNewInPhp82 extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'What\'s New In PHP 8.2';
	}

	public function getDescription(): string
	{
		return 'From new features like readonly classes, improvements to the type system, constants in traits, and ' .
			'backtrace parameter redaction, to changes and deprecations like dynamic properties, locale sensitivity ' .
			'in strtolower/upper(), and ${} in string interopolation, the latest version of PHP has something (or ' .
			'something to be aware of) for everyone...and it\'ll be released the day of this presentation! Tune in ' .
			'for info on how to get the latest version of PHP, detailed info on new features and changes, and a ' .
			'heads-up on how to most easily get your code up to date. Spoiler: if you aren\'t using dynamic ' .
			'properties, this is an easier jump than 8.1.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-12-08 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/whats-new-in-php-8.2.png';
	}

	public function getSpeakerName(): string
	{
		return 'Ian Littman';
	}

	public function getSpeakerBio(): string
	{
		return 'When Ian isn\'t CTO\'ing a startup throwing APIs around insurance data or helping organize Longhorn ' .
			'PHP conference, he\'s soaking up the Texas Hill Country, or talking about mobile or airline networks on ' .
			'Twitter.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=ceEy8i-zGQI';
	}
}
