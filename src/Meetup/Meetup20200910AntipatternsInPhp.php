<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20200910AntipatternsInPhp extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Anti-Patterns in PHP';
	}

	public function getDescription(): string
	{
		return 'PHP is one of the easiest programming languages to use ever and powers more than half of the ' .
			"internet.\n\nWith this ease of use, certain common patterns emerge that become harmful. This is " .
			'especially true when your product or service is not expected to die soon. Some anti-patterns are ' .
			'coding, others are related to operating your service, especially with new docker stacks. We will go ' .
			'over some of the most common pitfalls with a focus on enterprise development.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2020-09-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/anti-patterns-in-php.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Ahmed Abdou';
	}

	public function getSpeakerBio(): string
	{
		return 'Ahmed has been in the industry for more than 9 years. He has worked as an SRE and a PM but he lost ' .
			'most of his hair as a Software Engineer working in PHP. He\'s worked with PHP since the early days of ' .
			'PHP4, Smarty, Zend 1, Symfony 2, etc. Currently working for Wayfair engineering, helping accelerate ' .
			"engineers daily work.\n\n Ahmed is an open source advocate. He has been contributing to open source " .
			'since 2008 by using it, giving talks, patches, bug reports.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=_9nLBUTo1rM';
	}
}
