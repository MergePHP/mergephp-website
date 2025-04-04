<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250410HeapsOfFunInPhp extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Heaps of Fun in PHP';
	}

	public function getDescription(): string
	{
		return 'Can PHP be performant for advanced computer science and algorithms? Yes, it can! And it\'s a lot easier and more fun than you might expect due to some unique data structures. A data structure is a way to organize data, and using the proper data structure for each job can make a massive difference in performance. This session will introduce some Standard PHP Library (SPL) data structures you may not have used before and where they come in handy. We\'ll also look into tools for testing performance to find bottlenecks and evaluate the best way to address a challenge. Jump into a heap of fun as we explore data structures, performance and algorithms in PHP.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-04-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/heaps_of_fun.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Alena Holligan';
	}

	public function getSpeakerBio(): string
	{
		return 'For over 20 years, Alena has built technical solutions that inform decisions and solve problems across diverse industries. She enjoys both the creativity of programming and the thrill of solving a puzzle. As a leader in the community, a technical trainer, and a mom, she is passionate about providing the tools and mindset required for everyone to learn and succeed.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=VV8HYhNwPec';
	}
}
