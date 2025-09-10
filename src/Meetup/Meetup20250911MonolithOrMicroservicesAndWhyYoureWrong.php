<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250911MonolithOrMicroservicesAndWhyYoureWrong extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Monolith or Microservices? And why you\'re wrong!';
	}

	public function getImage(): string
	{
		return '/images/monolith-vs-microservices-and-why-youre-wrong.jpg';
	}

	public function getDescription(): string
	{
		return <<<END
		It's a debate as old as time. .well since at least 2014 anyway. Are microservices better than monolithic
		development? Are you a "legacy" developer stuck with a clunky monolith? Or are you a "modern" engineer lost in
		a sea of microservices?

		This talk will define both architectures, what they are and what they are NOT, pros and cons of each and walk
		you through how to determine which architecture, or even an alternative, is right for your project. You will
		also learn how to get there safely and pitfalls to avoid along the way.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-09-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Bobby Cahill​';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Bobby Cahill is a Senior Software Engineer with over a decade of experience building scalable, user-centric
		web platforms and developer tools. With a strong background in full-stack development, cloud-native
		architectures, and modern DevOps practices, he's passionate about building readable, maintainable, and secure
		code. Previously, Bobby spent eight years at Wayfair, where he was a key player in a company-wide initiative to
		decouple a massive monolithic codebase, and led the development of new tools to improve engineering
		productivity. He’s also the lead organizer of the BostonPHP Meetup Group and a co-founder of MergePHP.

		In his free time Bobby supports the open-source and dev communities and enjoys traveling, hiking, basketball
		and gaming.
		END;
	}
}
