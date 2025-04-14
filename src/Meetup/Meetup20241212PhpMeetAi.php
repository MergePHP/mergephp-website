<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20241212PhpMeetAi extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'PHP, Meet AI';
	}

	public function getDescription(): string
	{
		return 'With new advances in machine learning, advanced integrations with AI platforms are now available to ' .
			'everyone! You can easily build AI into your application without a Ph.D. or advanced knowledge of linear ' .
			"algebra or the algorithms that make machine learning work.\n\nIn this talk, we'll cover some simple " .
			'integrations with commonly available tools to make your application truly \"smart.\" No prior ' .
			'experience in machine learning is required, just come prepared to learn, ask questions, and get your ' .
			'hands dirty with state of the art tools.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-12-12 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Eric Mann';
	}

	public function getSpeakerBio(): string
	{
		return 'Eric is a web developer, technical leader, and polyglot with over a decade of experience working ' .
			'with companies and projects big and small. He\'s been working with PHP through his entire career, both ' .
			'professionally and recreationally. Today, Eric focuses his time on helping developers get started with ' .
			'and level up their skills with their technology of choice.';
	}

	public function getImage(): string
	{
		return '/images/php-meet-ai.jpg';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=Ul5D8Rmojwk';
	}
}
