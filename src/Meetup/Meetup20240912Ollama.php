<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20240912Ollama extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Ollama';
	}

	public function getDescription(): string
	{
		return 'We are going to just have a quick talk on Ollama. This is a lightning talk put together by Joshua ' .
			'Copeland with RemoteDevForce.com';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-09-12 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/ollama.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Joshua Copeland';
	}

	public function getSpeakerBio(): string
	{
		return 'Joshua Copeland is CTO of [Remote Dev Force](https://www.remotedevforce.com) and works with clients ' .
			'all over the world to build high quality systems. With over 15 years as a software architect and serial ' .
			'entrepreneur, Joshua has gained a good blend of start-up and enterprise experience. Developing PHP ' .
			'applications is a big part of his day-to-day work and keeps security first-in-mind. Joshua’s team of ' .
			'engineers regularly work on building features for mission critical projects in Laravel/Symfony, setting ' .
			'up and maintaining servers with Terraform/AWS, building CI pipelines with Jenkins/ADO/GitLab/GitHub  ' .
			'Actions, Pen-testing, and much more. He has led the PHP Vegas Users Group for over 7 years and loves  ' .
			'to give back by speaking at conferences and educating the community.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=iLK9D9A6iMw';
	}
}
