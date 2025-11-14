<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20251113WhatsNewInPhp85 extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'PHP 8.5: New Features from the Source';
	}

	public function getDescription(): string
	{
		return <<<END
		Join PHP 8.5 release manager Daniel Scherzer for a deep dive into the
		new features, syntax updates, deprecations, and surprises coming in the
		latest version of PHP. These are already available for testing in PHP
		8.5.0RC5, and will be ready for production use a week after the
		MergePHP talk.

		Whether you're maintaining legacy apps or building bleeding-edge
		libraries, this talk will help you prepare for PHP 8.5 and adopt its
		features with confidence.

		Features include

		* A new URL handling extension
		* Expanded syntax support in constant expressions
		* The pipe operator (|>)
		* Attribute changes
		* Object cloning with property changes

		and more
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-11-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/whats-new-in-php-85.png';
	}

	public function getSpeakerName(): string
	{
		return 'Daniel Scherzer';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Daniel is an open source contributor mainly focused on PHP and its
		ecosystem. He contributes as
		[@DanielEScherzer](https://github.com/DanielEScherzer) on GitHub, and
		is currently serving as a release manager for PHP 8.5. See
		<https://scherzer.dev/> for more.
		END;
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=JrkUdEswSSo';
	}
}
