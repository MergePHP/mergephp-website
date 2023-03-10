<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210211NeverUseArrays extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Never* Use Arrays';
	}

	public function getDescription(): string
	{
		return 'PHP loves its arrays. Arrays are the uber-data structure. They’re a list, a map, a stack, a queue, ' .
			"everything in one! Which is the problem.\n\nModern PHP grossly over-uses arrays. In most cases there " .
			'are better options today, and when you find yourself reaching for “oh I’ll just make this an ' .
			'associative array”, stop. An extra 60 seconds of thought and code will often give you a more readable, ' .
			'faster, more memory-efficient, more flexible alternative. Classes, iterables, and collections can and ' .
			"should replace arrays in most of your day to day coding.\n\nThis talk will go through what PHP arrays " .
			'actually are (hint: they are not, in fact, arrays at all), why they’re so problematic, and what to do ' .
			'instead. By the end, you should find yourself (almost) never reaching for arrays to solve a problem.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-02-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Larry Garfield';
	}

	public function getSpeakerBio(): string
	{
		return 'Larry Garfield is an aspiring blacksmith who moonlights as Director of Developer Experience for ' .
			'Platform.sh. When not trying to hand-forge his own medieval armory from scratch he tries to teach ' .
			'developers and development managers the skills of yesteryear that the industry has forgotten. He is ' .
			'the author of several books on PHP, including "Thinking Functionally in PHP" and "Exploring PHP 8.0."';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=oK2q5SCbs5E';
	}
}
