<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20231109WhatsNewInPhp83 extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'What\'s New In PHP 8.3';
	}

	public function getDescription(): string
	{
		return 'All the new features in PHP 8.3';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-11-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/what-s-new-in-php-8-3.svg';
	}

	public function getSpeakerName(): string
	{
		return 'Tim Bond';
	}

	public function getSpeakerBio(): string
	{
		return 'Tim is a senior full stack PHP developer that has been working with PHP for over 19 years and has ' .
			'seen PHP grow from its hodgepodged roots to a modern development language. When not in front of a ' .
			'computer, you\'ll probably find him hiking or playing bike tag around beautiful Seattle, or putting ' .
			'together a new Lego set on one of the rare rainy days.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=qLYDXoxj7qg';
	}
}
