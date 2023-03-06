<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220512DocsAndTestsAndToolsOhMy extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Docs and tests and tools, oh my!';
	}

	public function getDescription(): string
	{
		return 'You may have heard the call for contributions to PHP, and you want to help. However, you don\'t know ' .
			'C, and don\'t want to become a C developer. Worry not, fellow PHP dev! There are other areas of PHP ' .
			'internals that need your help! This talk will pull back the veil on some of the lesser known areas of ' .
			'PHP docs and tooling that need sprucing up and improving.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-05-12 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/docs-and-tests-and-tools-oh-my.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Tiffany Taylor';
	}

	public function getSpeakerBio(): string
	{
		return 'Tiffany Taylor is a member of the PHP docs team, and is a backend developer at Covie, when not ' .
			'playing with her cats.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=j49eLMYgOEQ';
	}
}
