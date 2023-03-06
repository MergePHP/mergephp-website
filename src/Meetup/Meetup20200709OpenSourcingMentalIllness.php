<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20200709OpenSourcingMentalIllness extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Open Sourcing Mental Illness';
	}

	public function getDescription(): string
	{
		return 'Years ago, Ed Finkler opened up and told the community about his struggles with depression and ' .
			'anxiety. Fast forward today, and he has successful led a group of passionate people in an organization ' .
			'called Open Sourcing Mental Illness.\n\nThis talk will focus on our efforts as an organization, where ' .
			'we have been, where we are going and also dive into some numbers and stories along the way. While this ' .
			'is a heavier talk, I tend to inject humor where I can to keep it light while still delivering an ' .
			'impactful message.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2020-07-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Matt Trask';
	}

	public function getSpeakerBio(): string
	{
		return 'Matt is a self proclaimed API nerd who spends a lot time on his bike or behind a camera these days. ' .
			'He actively maintains OSS projects like openapi.tools an league\\fractal (it\'s not dead I swear). He ' .
			'is a backend team lead at a healthcare company doing fun things with PHP. You can find him on Twitter ' .
			'[@matthewtrask](https://twitter.com/matthewtrask)';
	}
}
