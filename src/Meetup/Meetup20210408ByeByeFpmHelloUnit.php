<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210408ByeByeFpmHelloUnit extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Bye Bye FPM 😓 Hello Unit!';
	}

	public function getDescription(): string
	{
		return 'NGINX Unit replaced PHP-FPM! Nginx Unit replaced the php fpm and brings an dynamically restful ' .
			'configurable implementation of an process manager for the PHP SAPI. With NGINX Unit we will have Full ' .
			'control over the Network as well as the Application Stack. Join us to learn more about how I moved my ' .
			'workload to NGINX Unit and why I would do it anytime again!';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-04-08 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Timo Stark';
	}

	public function getSpeakerBio(): string
	{
		return 'Timo Stark has been a passionate web developer for more than 15 years, having started when he was ' .
			'just 12 years old. He started his professional career as a web developer and solutions architect in the ' .
			'automotive industry. He joined NGINX as a Professional Services Engineer in February 2020 and focuses ' .
			'on helping customers integrate NGINX products into their solutions.';
	}
}
