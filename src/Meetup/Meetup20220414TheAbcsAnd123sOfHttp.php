<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220414TheAbcsAnd123sOfHttp extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'The ABCs and 123s of HTTP';
	}

	public function getDescription(): string
	{
		return 'This talk is the ABCs and 123s of HTTP. We look at the verbs, the status codes, the headers as well ' .
			'as things like CORS, OpenAPI, and JSON Schema';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-04-14 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/the-abcs-and-123s-of-http.webp';
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

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=9--QuEh_Ci8';
	}
}
