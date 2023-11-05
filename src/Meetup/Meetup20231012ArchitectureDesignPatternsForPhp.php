<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20231012ArchitectureDesignPatternsForPhp extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Architecture Design Patterns for PHP';
	}

	public function getDescription(): string
	{
		return 'Understanding the various code architecture design patterns can take years of hands-on experience, ' .
		'and benefits from surveying the wider development community. Get all caught up with this overview of a ' .
		'variety of best-practice patterns, including Strategy, Factory, Adapter, Facade, Repository, and more. ' .
		'Learn about the different pattern classifications, dig into pros and cons for each pattern, discuss SOLID ' .
		'implementation considerations, and see useful code examples to get you using each pattern.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-10-12 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/architecture-design-patterns-for-php.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Mark Niebergall';
	}

	public function getSpeakerBio(): string
	{
		return 'Mark Niebergall is a security-minded PHP Senior Software Engineer and Team Lead at a cybersecurity ' .
		'software company, with many years of hands-on experience with PHP projects. He is the Utah PHP User Group ' .
		'Co-Organizer, a regular conference speaker, and an occasional author. Mark has a Masters degree in MIS, is ' .
		'CSSLP and SSCP cybersecurity certified, and volunteers for (ISC)2 security exam development. Mark enjoys ' .
		'endurance sports, being outdoors, and teaching his five sons how to push buttons and use technology.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=8QHMeb3M_-I';
	}
}
