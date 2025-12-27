<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260108MasteringAgenticPhpDevelopmentWithMcp extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Mastering Agentic PHP Development with MCP';
	}

	public function getDescription(): string
	{
		return <<<END
		AI coding assistants are powerful, but they're only as good as the context they have access to. Without
		real-time documentation, even the best models can hallucinate APIs or bridging AI agents with live,
		authoritative data. We'll cover MCP's core concepts, then build a functional server using the Official PHP SDK
		that connects directly to PHP.net documentation. We'll also implement Composer package search for intelligent
		dependency discovery. Join me to see how this Master Control Program...unlike the TRON original...is actually
		here to help.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-01-08 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Hunter Skrasek';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Fullstack Web Developer who specializes in PHP and APIs; Currently a Software Architect @ Modernize Home
		Services. Co-organizer at Longhorn PHP Conference.
		END;
	}
}
