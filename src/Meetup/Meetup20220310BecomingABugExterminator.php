<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220310BecomingABugExterminator extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Becoming a Bug Exterminator!';
	}

	public function getDescription(): string
	{
		return 'Have you struggled setting up XDebug or finding out what\'s wrong on Production? If the answer is ' .
			'yes then this talk is for you! We will cover how XDebug works, Debugging in PHPStorm or VS Code, ' .
			'advanced features of XDebug, what has changed from XDebug version 2 to 3, debugging javascript, ' .
			'framework debug toolbars, common pitfalls using XDebug & Docker, war stories from my experience with ' .
			'production issues, SASS products to help you get more insight into your application, monitoring, ' .
			'logging, and much more. By the end, you will know all the secrets of how to become a Bug Exterminator.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-03-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/becoming-a-bug-exterminator.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Joshua Ray Copeland';
	}

	public function getSpeakerBio(): string
	{
		return 'Joshua Copeland is CTO of Remote Dev Force and works with clients all over the world to build high ' .
			'quality systems. His team regularly works on building features for mission critical projects in ' .
			'Laravel/Symfony using AWS, setting up and maintaining servers with Terraform/AWS, building CI pipelines ' .
			'with Jenkins/GitLab/GitHub Actions, and pen-testing. He leads the PHP Vegas Users\' Group and loves to ' .
			'give back by speaking at conferences and educating the community.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=5728Jp1jfZw';
	}
}
