<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250612HostingAPhpAppInAHomelab extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Hosting a PHP app in a Homelab';
	}

	public function getDescription(): string
	{
		return <<<END
		We all love fun and exotic ways to deploy web applications, but sometimes you just want to keep things simple.
		You might reach for a VPS - but why not try hosting that app from your house? With Cloudflare Tunnels and a
		cheap mini PC you can easily and securely deploy a web application directly from your closet!
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-06-12 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/homelab_2025.png';
	}

	public function getSpeakerName(): string
	{
		return 'Daniel Abernathy';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Daniel Abernathy has been a web developer for 13 years.
		He spent much of that time working with PHP, although he works solely with TypeScript today.
		He lives outside of Austin, Texas with his wife and two boys.
		END;
	}
}
