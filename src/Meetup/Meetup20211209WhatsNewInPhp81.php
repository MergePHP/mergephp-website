<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20211209WhatsNewInPhp81 extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'What\'s New in PHP 8.1';
	}

	public function getDescription(): string
	{
		return 'This month, we\'ll look at what\'s new, changed, and deprecated in the brand-new PHP 8.1. From ' .
			'larger changes like enums, fibers, readonly properties, and first-class callables, to smaller quality ' .
			'of life improvements like string-unpacked array keys and the array_is_list function, Laravel Austin\'s ' .
			'(and co-organizer of Longhorn PHP) Hunter Skrasek will guide you through what makes PHP 8.1 worth the ' .
			'upgrade effort.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-12-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/what-s-new-in-php-8-1.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Hunter Skrasek';
	}

	public function getSpeakerBio(): string
	{
		return 'I\'m an Austin based web developer that started programming in PHP when I was 14. When I first ' .
			'started programming in PHP it was all spaghetti code, and I wasn\'t even aware Object Oriented ' .
			'Programming was a thing, since I was self taught. Fast forward eight years and I have learned a couple ' .
			'of things, such as MVC, OOP, Version Control, Agile, and more. After graduating from St. Edwards ' .
			'University this May (2014), I started working on RESTful API\'s, and it\'s become my new favorite thing ' .
			'to do.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=K52VpQh88bQ';
	}
}
