<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20211014LivingWithOpenSourceResponsibility extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Living With Open Source Responsibility';
	}

	public function getDescription(): string
	{
		return 'It is straightforward to open source a piece of code and call it a library. It is effortless to ' .
			'maintain it when you are the only user, but what happens when you reach the first hundred or thousand ' .
			"downloads.\n\nSemantic versioning, changelog, stable release, backward compatibility, continuous " .
			'integration, and code coverage would probably be some of the buzzwords that would pop up into your ' .
			"head.\n\nLet's go through the process of being a responsible open-source developer and maintainer.";
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-10-14 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Mario Blazek';
	}

	public function getSpeakerBio(): string
	{
		return 'Mario Blazek is a Senior Backend Developer at Q Agency and a Lead Developer of Jenz. Most of the ' .
			'time, he uses PHP as a language of choice. He promotes open-source software and PHP-related ' .
			'technologies as one of the organizers of Zagreb PHP User Group (ZgPHP). He likes working with Symfony ' .
			"framework and explores the dark sides of it. He is a Symfony and Twig certified developer.\n\nWhen not " .
			'on his primary job, he volunteers as a Chief fire officer at the local fire department. He\'s married ' .
			'to a beautiful wife and is a father of two sons. He tweets at ' .
			'[@phpanarchist](https://twitter.com/phpanarchist).';
	}
}
