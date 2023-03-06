<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20230209DockerIsDeadLongLiveContainers extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Docker is Dead, Long Live Containers';
	}

	public function getDescription(): string
	{
		return 'Since Docker burst onto the scene, programmers have seen a radical shift in almost every ecosystem. ' .
			'From setting up environments to tooling to deployment, containers now influence many applications. The ' .
			'good news is that the idea of containers has taken hold, and we are no longer beholden to a ' .
			'technological monopoly. Let\'s look at the container ecosystem outside Docker and what a genuinely ' .
			'open, containerized future holds.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-02-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/docker-is-dead-long-live-containers.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Chris Tankersly';
	}

	public function getSpeakerBio(): string
	{
		return 'Chris Tankersley is a husband, father, author, speaker, PHP developer, podcast host, and probably ' .
			'lots of other things he\'s forgetting to mention. He works for Vonage as a Senior Developer Relations ' .
			'Advocate, helping developers use and integrate Vonage\'s communication platform into their applications ' .
			'and third party services. Chris has worked with many different frameworks and languages throughout his ' .
			'fifteen years of programming, but spends most of his day working in PHP and TypeScript. He is the ' .
			'author of \"Docker for Developers,\" and helps developers integrate containers into their workflows.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=EZNlgmZchZ0';
	}
}
