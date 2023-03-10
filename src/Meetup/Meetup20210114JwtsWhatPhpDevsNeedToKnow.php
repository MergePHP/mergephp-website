<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210114JwtsWhatPhpDevsNeedToKnow extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'JWTs What PHP Devs Need To Know';
	}

	public function getDescription(): string
	{
		return 'What is a JSON Web Token (JWT) and why do you care? JWTs are a stateless, standardized way to ' .
			'represent user data. This talk will discuss why JWTs matter and the nuts and bolts of JWTs. We\'ll ' .
			'also discuss how you might use a JWT in your web application and how to avoid certain common mistakes.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-01-14 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Dan Moore';
	}

	public function getSpeakerBio(): string
	{
		return 'Dan Moore is head of developer relations for FusionAuth. He\'s been using PHP off and on since the ' .
			'2000s. A former CTO, engineering manager and longtime developer, he\'s been writing software for ' .
			'(checks watch) over 20 years.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=ezuN5opxqus';
	}
}
