<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20240411PhpApplicationsAtScale extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'PHP Applications at Scale';
	}

	public function getDescription(): string
	{
		return 'Making PHP applications fast at scale is hard! As the saying goes, "Make it work, make it right, ' .
			'make it fast". Having worked with PHP and SQL at scale in the range of billions of data sets, I\'ll ' .
			'share some tips and tricks that I have learned that you can take and try out to tackle making an ' .
			'application scale to size. Learn about various strategies and patterns that may or may not be ' .
			'intuitive, including database denormalization, chunking, caching, workers, optimizing SQL statements, ' .
			'and indexes. Jump into some statistics of PHP function benchmarking to see what scales and what does ' .
			'not for a little trivia game of "Will It Scale?".';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-04-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/php-applications-at-scale.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Mark Niebergall';
	}

	public function getSpeakerBio(): string
	{
		return 'Mark Niebergall is a security-minded PHP Staff Software Engineer and Team Lead at a cybersecurity ' .
			'software company, with many years of hands-on experience with PHP projects. He is the Utah PHP User ' .
			'Group Co-Organizer, a regular conference speaker, and a PHP-FIG Secretary. Mark has a Masters degree ' .
			'in MIS, is CSSLP and SSCP cybersecurity certified, and volunteers for (ISC)2 security exam ' .
			'development. Mark enjoys endurance sports, being outdoors, and teaching his five sons about writing ' .
			'code.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=YtiKIZlzPbc';
	}
}
