<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250710ReturnToRest extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Return to REST';
	}

	public function getDescription(): string
	{
		return <<<END
		We don't talk about REST much these days. Why is that? Was REST too hard? Did we get tired of it? Did GraphQL
		win? Let's revisit REST to learn how its concepts can be put into practice to build great APIs. Along the way,
		we'll talk about some of the criticisms of REST and why GraphQL is an attractive alternative. We'll also
		discuss when it's okay to bend or break the rules, and we'll cover hypermedia, content negotiation, and API
		versioning pitfalls.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-07-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Ben Ramsey';
	}

	public function getSpeakerBio(): string
	{
		return 'Ben is a seasoned software engineer with 25+ years of experience in web applications. As a Senior ' .
			'Staff Software Engineer at Intuit Mailchimp, he leads the API Core team managing the Mailchimp public ' .
			'API. A passionate advocate for open source, Ben is a PHP release manager, creator of the ramsey/uuid ' .
			'library, and an active community contributor. A prolific writer and speaker, he has contributed to ' .
			'books, articles, and conferences. Connect with him on the web at https://ben.ramsey.dev or on the ' .
			'Fediverse at @ramsey@phpc.social.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=LRceBSGlqnU';
	}
}
