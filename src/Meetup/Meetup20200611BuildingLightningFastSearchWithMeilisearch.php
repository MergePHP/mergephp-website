<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20200611BuildingLightningFastSearchWithMeilisearch extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Building lightning fast search with Meilisearch';
	}

	public function getDescription(): string
	{
		return 'MeiliSearch is a powerful, fast, open-source, easy to use and deploy search engine. Both searching ' .
			'and indexing are highly customizable. Features such as typo-tolerance, filters, and synonyms are ' .
			'provided out-of-the-box.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2020-06-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Josh Butts';
	}

	public function getSpeakerBio(): string
	{
		return '';
	}

	public function getYouTuBeLink(): string
	{
		return 'https://www.youtube.com/watch?v=fOJVr4wFgOo';
	}
}
