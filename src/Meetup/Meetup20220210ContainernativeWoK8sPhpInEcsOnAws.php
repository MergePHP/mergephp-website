<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220210ContainernativeWoK8sPhpInEcsOnAws extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Container-Native w/o k8s: PHP in ECS on AWS';
	}

	public function getDescription(): string
	{
		return 'When building Covie, I got to pick our tech stack, including where and how to run it. The choice was ' .
			'containerized on ECS with AWS, starting on Fargate.and so far, so good. We\'ll walk through how to set ' .
			'this stack up, with some tips and tricks along the way.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-02-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Ian Littman';
	}

	public function getSpeakerBio(): string
	{
		return 'When Ian isn\'t CTO\'ing a startup throwing APIs around insurance data or helping organize Longhorn ' .
			'PHP conference, he\'s soaking up the Texas Hill Country, or talking about mobile or airline networks on ' .
			'Twitter.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=egAjtS-z9xo';
	}
}
