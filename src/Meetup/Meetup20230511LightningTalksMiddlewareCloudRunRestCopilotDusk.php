<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20230511LightningTalksMiddlewareCloudRunRestCopilotDusk extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Lightning Talks: Middleware, Cloud Run, REST, CoPilot, Dusk';
	}

	public function getDescription(): string
	{
		return "Mark on Laminias middleware\nLogan on using PHP with Cloud Run\nIan on REST Requests\nJoshua on " .
			"ChatGPT Github CoPilot\nChris on Frontend testing with Laravel Dusk";
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-05-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Mark Niebergall, Logan Lindquist, Ian Littman, Joshua Copeland, Chris Spruck';
	}

	public function getSpeakerBio(): string
	{
		return '';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=AcAeIYFilfs';
	}
}
