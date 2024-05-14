<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20240509MergephpCodingCompetition extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'MergePHP Coding Competition';
	}

	public function getDescription(): string
	{
		return 'Get ready for something new at our latest meetup! This month, we\'re shaking things up with an ' .
		'interactive, live coding competition.  Participants will embark on a journey through several challenging ' .
		'coding questions designed to test their skills, creativity, PHP knowledge, and agility under pressure. As ' .
		"you tackle each question, you'll earn points and climb the leaderboard.\n\n🏆 The champion will not only " .
		'claim the coveted title but also walk away with an ElePHPant as a symbol of their triumph.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-05-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Ben Edmunds';
	}

	public function getImage(): string
	{
		return '/images/mergephp-coding-competition.png';
	}

	public function getSpeakerBio(): string
	{
		return 'Staff Engineer at Seatgeek. Host of the PHP Town Hall and More Than Code podcasts. Author of ' .
		'Securing PHP Apps and Securing Node Apps books. Open source advocate. PHP-FIG CC alum.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=N4DGPtzGD9E';
	}
}
