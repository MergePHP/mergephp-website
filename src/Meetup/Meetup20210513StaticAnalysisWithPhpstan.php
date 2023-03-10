<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210513StaticAnalysisWithPhpstan extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Static Analysis with PHPStan';
	}

	public function getDescription(): string
	{
		return 'PHPStan is an excellent open-source static analysis tool. It\'s easy to add to your build and ' .
			'catches lots of bugs without writing a line of test code. This makes it especially useful for  ' .
			'maintaining stability in older codebases which don\'t always have extensive test suites. I\'ll show  ' .
			'you how to configure and run it, as well as some examples of subtle mistakes it will catch.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-05-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Brian Morto';
	}

	public function getSpeakerBio(): string
	{
		return 'Brian Morton has been a developer and system administrator for more than 15 years. He currently  ' .
			'works at ShootProof as a Software Architect, working extensively with PHP and Python codebases.   ' .
			'[Find Brian on LinkedIn](https://www.linkedin.com/in/brian-morton-1aa9971/)';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=XFgylNvyIg8';
	}
}
