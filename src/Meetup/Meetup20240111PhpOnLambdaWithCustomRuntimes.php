<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20240111PhpOnLambdaWithCustomRuntimes extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'PHP on Lambda with Custom Runtimes';
	}

	public function getDescription(): string
	{
		return 'It\'s 2024 and, while AWS still doesn\'t have an official PHP runtime for Lambda, ' .
			'it doesn\'t need one thanks to both custom runtime and container support in Lambda.' .
			' This talk will show you how Lambda custom runtimes work, how to build one that speaks PHP, ' .
			'and how to set up Lambda to either handle web requests or hook into other AWS services to process jobs ' .
			'in a highly elastic manner. As a bonus, you\'ll see how things work with Lambda\'s Docker ' .
			'container support, as well as with Bref, the tooling you\'ll likely want to use if you choose to deploy ' .
			'PHP Lambdas in production without restoring to e.g. Laravel Vapor.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-01-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Ian Littman';
	}

	public function getSpeakerBio(): string
	{
		return 'Ian Littman is a co-organizer for AustinPHP and MergePHP, helps run Longhorn PHP Conference, ' .
			'helps moderate and administer the phpc.social Mastodon instance, ' .
			'and helps maintain Joind.in and OpenCFP. Coincidentally none of those things run on AWS, ' .
			'but the majority of the work he\'s done for both contract clients and full-time jobs has been on AWS. ' .
			'These days, he\'s load-balancing a handful of contract clients from either home or a local coffee shop' .
			' in Austin, TX...or maybe opining on air travel or telecom, depending on when you catch him.';
	}
}
