<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20221013MicroservicesInYourMonolith extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Microservices in Your Monolith';
	}

	public function getDescription(): string
	{
		return 'In this talk we\'ll look at how you can take advantage of some of the serverless platforms without ' .
			'taking on the complexity of managing a separate deploy process, development repository, or having to ' .
			'worry about securing your microservice\'s API. We\'ll see how to package, deploy, and execute small ' .
			'functions to serverless platforms, all from your existing monolithic application.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-10-13 19:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/microservices-in-your-monolith.png';
	}

	public function getSpeakerName(): string
	{
		return 'Aaron Francis';
	}

	public function getSpeakerBio(): string
	{
		return 'Aaron Francis is a Developer Educator at PlanetScale. He\'s the co-founder of Hammerstone, a company ' .
			'that creates components for your Rails and Laravel applications. He\'s also the co-host of the ' .
			'Framework Friends podcast. Most importantly, he\'s dad to a perfect pair of 1-year-old twins!';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=hRE_v6G7kts';
	}
}
