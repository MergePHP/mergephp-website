<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260212DomainDrivenPhp extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Domain Driven PHP';
	}

	public function getImage(): string
  {
      return '/images/domain-driven-php.png';
  }

	public function getDescription(): string
	{
		return <<<END
		In the modern PHP ecosystem, we often let frameworks dictate our application's architecture. We start with composer create-project and immediately begin molding our business logic to fit the constraints of a specific "Way." But what happens when the framework becomes a hurdle rather than a helper?
		
		This session explores the Art of Domain-Driven Design (DDD) by stripping away the safety net of frameworks. We will start from a "naked" PHP environment, demonstrating how to build a robust, testable, and scalable application using only pure PHP and the principles of DDD. By focusing on Entities, Value Objects, Aggregates, and Domain Services without the noise of an ORM or a heavy container, you will learn to see your business logic as the primary citizen of your codebase.
		
		Once we have established the "Pure Domain" foundation, we will pivot to the pragmatic reality of modern development: Integration. We will discuss how to take these framework-agnostic principles and safely "plug" them into popular frameworks like Laravel or Symfony. You’ll learn how to treat the framework as a replaceable infrastructure detail—leveraging its power for routing and delivery while keeping your core logic untainted and portable.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-02-12 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Chris Miller';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		- x: [@ccmiller2018](https://x.com/ccmiller2018)
		- LinkedIn: [https://linkedin.com/in/ccmiller2018](https://linkedin.com/in/ccmiller2018)
		END;
	}
}
