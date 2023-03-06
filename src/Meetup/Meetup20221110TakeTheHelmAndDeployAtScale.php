<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20221110TakeTheHelmAndDeployAtScale extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Take the helm and deploy at scale';
	}

	public function getDescription(): string
	{
		return 'This talk will take you through the beginner basics of K8s and will show a good example of how to ' .
			'deploy a PHP app to a kube cluster. This will cover the basics of kube deployments, monitoring, and ' .
			'scaling.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-11-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/take-the-helm-and-deploy-at-scale.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Cody Moss';
	}

	public function getSpeakerBio(): string
	{
		return 'Cody Moss is an Infrastructure Architect and Software Developer. He is a video game lover and works ' .
			'for Bethesda Studios under the Microsoft corporate umbrella. In his spare time he enjoys playing with ' .
			'his Raspberry Pi cluster, playing new games, geeking over ninja turtles, and spending time with his ' .
			'wife & Spyder motorcycle.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=s018FdMR_bU';
	}
}
