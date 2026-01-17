<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20230713WpcliForPhpDevelopers extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'WP-CLI for PHP developers';
	}

	public function getDescription(): string
	{
		return "When was the last time you tested code in production? Your own website doesn't count.\nWP-CLI for " .
			'PHP developers is the sequel of WordPress through the Terminal talk with a focus on a set of commands ' .
			"and tools, useful for PHP developers.\nThis is not just a live demo of WP-CLI commands. This is zooming " .
			'out and seeing WP-CLI in collaboration with other tools in the context of PHP developer needs and ' .
			'everyday tasks. We"ll probably release the Kraken as well.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-07-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/wp-cli.png';
	}

	public function getSpeakerName(): string
	{
		return 'Milana Cap';
	}

	public function getSpeakerBio(): string
	{
		return 'Milana Cap is a WordPress engineer at XWP, WordPress Documentation Team representative, and ' .
			"Documentation Focus lead for WordPress 5.8 and co-lead for WordPress 5.9, 6.0, and 6.1 release cycles.\n" .
			'She helped organise some of the largest WordPress conferences, WordCamp Europe 2018 and 2019, with a ' .
			'focus on Contributor Days.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=d3Q2PMnn1Bw';
	}
}
