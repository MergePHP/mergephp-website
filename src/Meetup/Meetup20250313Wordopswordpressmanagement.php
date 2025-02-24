<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250313Wordopswordpressmanagement extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'WordOps Wordpress Management';
	}

	public function getDescription(): string
	{
		return 'Discover the power of WordOps, a modern solution for WordPress and PHP project management, ' .
			'in this technical talk. We\'ll start by walking you through the setup process of WordOps, ' .
			'equipping you with the knowledge to deploy and manage WordPress sites efficiently. We will also delve ' .
			'into migrating existing sites to WordOps, highlighting strategies for a smooth transition with minimal ' .
			'downtime. We\'ll also explore how WordOps isn’t just limited to WordPress—it’s a robust tool that can ' .
			'streamline the creation and management of any PHP project. Finally, we’ll introduce WordOps Server ' .
			'Observability, a critical feature that provides insight into your server’s performance and health, ' .
			'ensuring you can monitor, troubleshoot, and optimize your environment effectively.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-03-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/wordopswordpressmanagement.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Joshua Copeland';
	}

	public function getSpeakerBio(): string
	{
		return 'Joshua Copeland is CTO of Remote Dev Force and works with clients all over the world to build high ' .
			'quality systems. With over 15 years as a software architect and serial entrepreneur, Joshua has gained a' .
			'good blend of start-up and enterprise experience. Developing PHP applications is a big part of his ' .
			'day-to-day work and keeps security first-in-mind. Joshua’s team of engineers throughout the U.S. ' .
			'regularly work on building features for mission critical projects in Laravel/Symfony, setting up and' .
			'maintaining servers with Terraform/AWS, building CI pipelines with Jenkins/GitLab/GitHub Actions, ' .
			'Pen-testing, and much more. He has led the PHP Vegas Users\' Group for over 5 years and loves to give' .
			'back by speaking at conferences and educating the community.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=pcSV0Sq-cxo';
	}
}
