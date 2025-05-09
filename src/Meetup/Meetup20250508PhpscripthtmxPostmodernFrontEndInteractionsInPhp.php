<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250508PhpscripthtmxPostmodernFrontEndInteractionsInPhp extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'PHPScript (HTMX): Postmodern front end interactions in PHP';
	}

	public function getDescription(): string
	{
		return <<<END
		Interactivity in applications has always been important to providing a world-class user experience, but modern
		frontend frameworks can make this difficult for small teams or those without frontend experience. We've been
		writing interactive applications for decades, so has  anything changed for PHP developers? This talk will
		cover the history of how PHP developers have typically built applications, and how building great experiences
		may not always need new languages and frameworks.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-05-08 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/htmx_2025.png';
	}

	public function getSpeakerName(): string
	{
		return 'Jose Diaz-Gonzalez';
	}

	public function getSpeakerBio(): string
	{
		return 'CakePHP Core Developer and Platform Engineer';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=nIHBQQl4H-4';
	}
}
