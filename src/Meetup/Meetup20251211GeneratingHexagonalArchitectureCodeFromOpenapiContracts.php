<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20251211GeneratingHexagonalArchitectureCodeFromOpenapiContracts extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Generating Hexagonal Architecture Code From OpenAPI Contracts';
	}

	public function getDescription(): string
	{
		return <<<END
		With an api contract first design in mind, we can generate ton of our code
		using hexagonal architecture and CQRS patterns.
		The code generated will have a 100% code coverage and mutant testing.
		In this talk we will cover on how to approach the openapi/swagger contracts,
		small introduction to cqrs and hexagonal architecture, and how all together
		merges in a beautiful code generator.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-12-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/hexagonal-architecture.png';
	}

	public function getSpeakerName(): string
	{
		return 'Carlos Agudo';
	}

	public function getSpeakerBio(): string
	{
		return '';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=A5WVaFYUb1c';
	}
}
