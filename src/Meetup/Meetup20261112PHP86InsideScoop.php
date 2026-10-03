<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20261112PHP86InsideScoop extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'PHP 8.6: The Inside Scoop';
	}

	public function getDescription(): string
	{
		return <<<END
		Join PHP core developer and veteran release manager Daniel Scherzer for
		a deep dive into the new features, syntax updates, deprecations, and
		surprises coming in PHP 8.6. While PHP 8.6 is still in the release
		candidate phase, now is the time to start preparing to upgrade.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable(
			'2026-11-12 17:00:00',
			new DateTimeZone('America/Los_Angeles'),
		);
	}

	public function getSpeakerName(): string
	{
		return 'Daniel Scherzer';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Daniel is an open source contributor. He contributes as
		[@DanielEScherzer](https://github.com/DanielEScherzer) on GitHub, and
		is currently serving as a release manager for PHP 8.5, and as the
		veteran release manager for PHP 8.6. See <https://scherzer.dev/> for more.
		END;
	}
}
