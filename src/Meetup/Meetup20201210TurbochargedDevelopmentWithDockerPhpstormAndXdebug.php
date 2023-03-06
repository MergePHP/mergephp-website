<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20201210TurbochargedDevelopmentWithDockerPhpstormAndXdebug extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Turbocharged Development with Docker, PHPStorm, and Xdebug';
	}

	public function getDescription(): string
	{
		return 'My name is James, and I have a confession to make: I\'ve been a var_dump()er my whole life. I tried ' .
			'Xdebug once years back, but a chance brush with social media from its author prompted the question: is ' .
			"Xdebug still relevant? Is it hard to set up?\n\nIn a modern developer world of Docker containers and " .
			'advanced IDEs, it was time to revisit how we go about writing software at Jump24 - in this talk, I\'ll ' .
			'set up Xdebug on a test project and show you how you can turbocharge your development like we did.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2020-12-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'James Seconde';
	}

	public function getSpeakerBio(): string
	{
		return 'Speaker, Writer, Software Engineer, Developer Relations Strategist, Podcast host. Pushing Developer ' .
			'Relations forward as an Advocate for Laravel, Partner Jump24 in Birmingham, UK.';
	}
}
