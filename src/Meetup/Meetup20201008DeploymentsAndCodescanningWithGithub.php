<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20201008DeploymentsAndCodescanningWithGithub extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Deployments and CodeScanning with Github';
	}

	public function getDescription(): string
	{
		return 'Github Actions have been in general release for almost a year now. How far have we come in that time ' .
			'and what is left to do? Let\'s take a deep dive into several new features to have recently come out of ' .
			'Github. Last time we covered some other deployment options, but how does it compare? Come join the ' .
			'discussion this month with your friendly local user group. Live chat on YouTube or watch Zoom.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2020-10-08 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Logan Lindquist';
	}

	public function getSpeakerBio(): string
	{
		return 'Logan Lindquist will be your speaker this month. He is focused on building a full stack Development, ' .
			'DevOps and Mobile consultancy since 2014. Enjoys solving problems, building maintainable things and ' .
			'keeping clients happy. Calling Austin home since 2009. Remembers green screen terminals and the Atari ' .
			'2600. Imagines a world where Programming is a Functional Imperative. Believes in Privacy, Trust and ' .
			'Kindness.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=aoCTeL1oAPk';
	}
}
