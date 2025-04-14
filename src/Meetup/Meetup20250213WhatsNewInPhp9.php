<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250213WhatsNewInPhp9 extends AbstractMeetup
{
	public function getTitle(): string
	{
		return "What's new in PHP 9: See the future and discover the past in PHP RFCs";
	}

	public function getDescription(): string
	{
		return "Reading the comments is always a bad idea in social media; "
		. "however, for a socially developed language like PHP, reading the comments will give you "
		. "insight into the background of existing and upcoming features. Since version 5.3, PHP itself "
		. "has had a social side to its curation and development. Features and deprecations are proposed, "
		. "discussed, and voted on in the formal RFC ('Request For Comments') process before they can be "
		. "implemented in the core language. Let's look at some features, including up-and-coming features, "
		. "through the lens of the RFC and see how we can use that new knowledge to improve the development "
		. "experience of our daily dev work.";
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-02-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/whats-new-in-php9-poe.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Eric Poe';
	}

	public function getSpeakerBio(): string
	{
		return 'Gentle coder, reader, and half-knit/half-wit. '
		. 'Co-organizer of KCPHPUG and MergePHP, Advisor and former Curriculum Director of CoderDojoKC. '
		. 'Plaid Belt in Kung Fu movies. Connoisseur of dad jokes. Dev Manager by day, '
		. 'Lifelong Student before bedtime.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=fMAPoMbCtCk';
	}
}
