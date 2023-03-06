<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220811JavascriptDevelopmentInTheModernMonolith extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'JavaScript Development In The Modern Monolith';
	}

	public function getDescription(): string
	{
		return 'Writing modern JavaScript applications can sometimes be such a pain. We know that JavaScript can be ' .
			'great for a user\'s experience and add whole new layers of exciting interactivity, but sometimes just ' .
			'the thought of having to leave our server-side PHP applications in the dust to build a single-page app ' .
			'can have us running for the hills. Surely, there must be a better way. And there is. Enter the Modern ' .
			'Monolith.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-08-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/javascript-development-in-the-modern-monolith.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Alex Six';
	}

	public function getSpeakerBio(): string
	{
		return 'Alex Six ([@alexandersix_](https://twitter.com/alexandersix_)) is a Project Lead & Senior Web ' .
			'Application Developer from Columbia, South Carolina who builds full-stack Laravel applications for ' .
			'Kirschbaum Development Group. He is a Software Development streamer on Twitch, where he and his chat ' .
			'learn about web frameworks and build web software together. Alex is passionate about mentorship and ' .
			'apprenticeship, having built apprenticeship programs for organizations in the past to help prepare new ' .
			'developers for professional roles. He is also a mentor for new developers looking to land their first ' .
			'job in tech. He is a husband and father and is a proud dog dad to the cutest corgi in the world, Leia.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=7Fd-Q-EDV5g';
	}
}
