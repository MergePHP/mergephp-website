<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260312AdvancedPhpunitShenanigans extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Advanced PHPUnit Shenanigans';
	}

	public function getDescription(): string
	{
		return <<<END
		Hopefully by now, you know that testing is important, and you've integrated PHPUnit into your workflow.  (If
		not, go watch one of those talks.)  So now what??

		In this "testing 202" course, we'll explore some
		features of PHPUnit you may not be using (but should), some techniques you may not have thought of, and how to
		extend PHPUnit yourself for your own nefarious testing purposes.  And we'll answer the question, "so what are
		traits actually good for"?
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-03-12 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/advanced-phpunit-shenanigans.svg';
	}

	public function getSpeakerName(): string
	{
		return 'Larry Garfield';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Larry Garfield has been building websites since he was a sophomore in high school, which is longer ago than
		he'd like to admit. Larry was most recently Principal Engineer at MakersHub. He has also been a Staff Engineer
		at both TYPO3 and LegalZoom, and Director of Developer Experience for Platform.sh. A long-time Drupal
		contributor and consultant, Larry led the Drupal 8 Web Services initiative that helped transform Drupal into a
		modern PHP platform. Larry is a member of the PHP-FIG Core Committee, co-author of several PHP RFCs, and has
		authored several books on PHP development including "Thinking Functionally in PHP" and "Exploring PHP 8.0."

		Larry holds a Master’s degree in Computer Science from DePaul University. He blogs occasionally at
		[https://www.garfieldtech.com](https://www.garfieldtech.com).
		END;
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=BmZCUzcu2nY';
	}
}
