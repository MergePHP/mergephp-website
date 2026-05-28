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
		return 'Jujutsu: A New Take on Version Control';
	}

	public function getDescription(): string
	{
		return <<<END
		Git has been the de facto standard for version control for nearly two decades, but a new contender has arrived.
		Jujutsu (jj) is a modern version control system that reimagines the developer experience while remaining fully
		compatible with Git repositories. In this talk, we'll explore what makes Jujutsu different — its first-class
		conflict handling, automatic rebasing, and a mental model that makes complex history manipulation feel natural.
		Whether you're a Git power user or someone who still dreads a merge conflict, Jujutsu offers a fresh
		perspective on how version control can work for you.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-08-13 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Nick Vahalik';
	}

	public function getSpeakerBio(): string
	{
		return 'Nick Vahalik is a software engineer and one of the organizers of MergePHP. He has been writing PHP ' .
			'for over two decades and has a passion for developer tooling, workflows, and anything that makes ' .
			'the craft of software development more enjoyable.';
	}
}
