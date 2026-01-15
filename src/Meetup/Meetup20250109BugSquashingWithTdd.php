<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250109BugSquashingWithTdd extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Bug Squashing with TDD';
	}

	public function getDescription(): string
	{
		return 'TDD is perceived as a best practice, but has struggled with adoption. Get past that hurdle by using ' .
			'a practical starting point for TDD by using it to fix bugs. Practical tips will be shared, and how to ' .
			'get started with TDD will be explained. An actionable takeaway TDD pattern will be shown to help speed ' .
			'up bug fixing and ensure bugs are actually squashed and fixed.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-01-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/bug-squashing-with-tdd.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Mark Niebergall';
	}

	public function getSpeakerBio(): string
	{
		return 'Mark Niebergall is a security-minded PHP senior software engineer at a cybersecurity company, with ' .
			'many years of hands-on experience with PHP projects. He is the Utah PHP User Group Co-Organizer, a ' .
			'regular conference speaker, and an occasional author. Mark has a Masters degree in MIS, is CSSLP and ' .
			'SSCP cybersecurity certified, and volunteers for ISC2 security exam development.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=MX59V-Q56Q0';
	}
}
