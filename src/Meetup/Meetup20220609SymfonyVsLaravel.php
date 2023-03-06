<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220609SymfonyVsLaravel extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Symfony vs. Laravel';
	}

	public function getDescription(): string
	{
		return 'In this meetup, we will be having an open discussion on the features of Laravel and Symfony which ' .
			'are the two biggest frameworks in the world of PHP. We will be discussing pros and cons of each ' .
			'framework and going through setup examples, documentation, and just covering the 101 classes of these ' .
			'two amazing frameworks.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-06-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/symfony-vs-laravel.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Joshua Copeland';
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
		return 'https://www.youtube.com/watch?v=j1DHL12Vb8Y';
	}
}
