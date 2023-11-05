<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Meetups;

class Meetup20230413UsingStaticAnalysisAndSpeedingUpJsonQueries extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Using Static Analysis To Improve Code Quality Across Both Backend and Frontend + Speeding up JSON ' .
			'queries with MySQL Multi-Valued Indexes';
	}

	public function getDescription(): string
	{
		return "This month we will have two talks!\n\nFirst, from Daniel Abernathy:\nThis talk will cover " .
			"Multi-Valued Indexes, a feature released in MySQL 8 which lets you index an array of values per row - " .
			"perfect for improving queries that rely on certain JSON functions.\n\nAnd from Hunter Skrasek:\n\n" .
			'Numerous technologies exist for creating web applications, with PHP and JavaScript being the most ' .
			'prevalent. Their dynamic typing and runtime execution capabilities allow for a seamless transition ' .
			'from prototype to finished product. However, as apps grow in complexity and significance in our ' .
			'everyday lives, the absence of type safety and compilation checks might be felt. In this ' .
			'presentation, we will explore the concept of static analysis and its potential to enhance ' .
			'your team\'s software development process.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-04-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		// phpcs:ignore
		return '/images/using-static-analysis-to-improve-code-quality-across-both-backend-and-frontend-speeding-up-json-queries-with-mysql-multi-valued-indexes.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Daniel Abernathy & Hunter Skrasek';
	}

	public function getSpeakerBio(): string
	{
		return 'Daniel Abernathy is a senior web developer who has worked with PHP and JavaScript for over 10 ' .
			"years. He is currently enjoying writing code with Vue.js at QAD Redzone.\n\nHunter is a Software " .
			'Architect at Modernize Home Services and has been a software engineer since 2014. He has been using ' .
			'PHP, the Laravel framework, and containers for the last five years to enhance and expand the lead ' .
			'generation and marketing operations. When Hunter is not at work, he is either in charge of the Laravel ' .
			'Austin meetup or planning the next Longhorn PHP conference.';
	}

	public function getMeetupLinks(): array
	{
		return [
			Meetups::Seattle->value => 'https://www.meetup.com/seaphp/events/292420263/',
		];
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=4FxdRVbegDg';
	}
}
