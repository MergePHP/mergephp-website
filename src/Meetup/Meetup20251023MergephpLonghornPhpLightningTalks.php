<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20251023MergephpLonghornPhpLightningTalks extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'MergePHP @ Longhorn PHP: Lightning Talks';
	}

	public function getDescription(): string
	{
		return <<<END
		We're doing something special in concert with [Longhorn PHP Conference](https://longhornphp.com): a special
		live-streamed hybrid meetup with lightning talks! WWWe'll both live-stream the event _and_ allow folks to
		present virtually. Want to sign up to speak ahead of time? We have
        [a form for that](https://forms.gle/R2NagrbUkLK4Lvvd9).
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-10-23 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'The PHP community';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Whether you're in Austin or joining from online, if you've got a lightning talk, we want to hear it. We'll
		update this bio after the fact with info on whoever winds up presenting.
		END;
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=S8SDtZce_mk';
	}
}
