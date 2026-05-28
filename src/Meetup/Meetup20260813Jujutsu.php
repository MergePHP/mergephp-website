<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260813Jujutsu extends AbstractMeetup
{
	public function getTitle(): string
	{
		return "Jujutsu: A New Take on Version Control";
	}

	public function getDescription(): string
	{
		return <<<END
		Git has been the de facto standard for version control for nearly two decades, but a new contender has arrived.
		Jujutsu (jj) is a modern version control system that reimagines the developer experience while remaining fully
		compatible with Git repositories. In this talk, we'll explore what makes Jujutsu different — its first-class
		conflict handling, automatic rebasing, and a mental model that makes complex history manipulation feel natural.
		Jujutsu offers unlocks that can seriously level-up your version control game.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable(
			"2026-08-13 20:00:00",
			new DateTimeZone("America/New_York"),
		);
	}

	public function getImage(): string
	{
		return '/images/jujutsu.png';
	}

	public function getSpeakerName(): string
	{
		return "Nick Vahalik";
	}

	public function getSpeakerBio(): string
	{
		return "Nick Vahalik has been writing PHP for over two decades and has a passion for lazy development and " .
			"whatever helps make software development more enjoyable.";
	}
}
