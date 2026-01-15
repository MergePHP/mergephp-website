<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20240711Php84AlphaAndHowToPickABlogPlatform extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'PHP 8.4 Alpha and How to Pick A Blog Platform';
	}

	public function getDescription(): string
	{
		return 'This month, Ian will provide an intro on PHP 8.4 and discuss upcoming new features and changes. ' .
			'Logan will present "The Best Blog Platforms of 2024: A Comprehensive Comparison"';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-07-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		// phpcs:ignore
		return '/images/llbbl_imagine_prompt_A_panel_discussion_setup_with_lightning-_3ed8a024-4de2-4fe6-8d52-06cb4e789f7d_3.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Ian Littman and Logan Lindquist';
	}

	public function getSpeakerBio(): string
	{
		return '';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=d0lenfoh4Z8';
	}
}
