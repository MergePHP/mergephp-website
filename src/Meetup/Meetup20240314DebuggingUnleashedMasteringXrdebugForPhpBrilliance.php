<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20240314DebuggingUnleashedMasteringXrdebugForPhpBrilliance extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Debugging Unleashed: Mastering xrDebug for PHP Brilliance';
	}

	public function getDescription(): string
	{
		return 'xrDebug is the Open-Source alternative to some paid debugging tools. xrDebug is a portable debug ' .
			'utility that lets you debug PHP code on the fly without any extensions. It has features like multi-peer ' .
			'support, pause functionality, an HTTP API, and end-to-end encryption. In this Meetup, we will show you ' .
			'how to use xrDebug effectively, explain its ideal use cases, and highlight the advantages it has over ' .
			'conventional debuggers.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-03-14 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/dalle.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Rodolfo Berrios';
	}

	public function getSpeakerBio(): string
	{
		return 'Rodolfo Berrios is a software engineer from Chile, author of [Chevereto](https://chevereto.com) and ' .
			'[Chevere](https://chevere.org) with over 19 years of experience building software systems. In his spare ' .
			'time he enjoys playing with the neighbor\'s cat and to chill out playing Nintendo.';
	}
}
