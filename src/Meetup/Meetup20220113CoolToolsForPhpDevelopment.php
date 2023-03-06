<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220113CoolToolsForPhpDevelopment extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Cool Tools for PHP Development';
	}

	public function getDescription(): string
	{
		return 'In this talk, I\'ll crack open my toolbox and share some of the tools I use in daily development and ' .
			'why I think they improve the DX of projects I work on. We\'ll look at some familiar tools, such as ' .
			'PHPUnit and PHP_CodeSniffer, along with new tools like PHPStan and Psalm. I\'ll show how to configure ' .
			'these tools for better workflows through Composer scripts and plugins. We\'ll also see how to ' .
			'standardize your team\'s workflow with CaptainHook. By the end, I hope you\'ll leave with some good ' .
			'ideas for improving your team\'s DX.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-01-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/cool-tools-for-php-development.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Ben Ramsey';
	}

	public function getSpeakerBio(): string
	{
		return 'Ben Ramsey is a coder, writer, and speaker. Recently selected as a release manager for PHP 8.1, he ' .
			'is an avid proponent of open source software and maintains several popular open source packages, ' .
			'including ramsey/uuid and league/oauth2-client. In his free time, Ben enjoys beer, bourbon, board ' .
			'games, and TTRPGs. He co-organizes the PHP user group in Nashville, where he lives with his wife, son, ' .
			'and two dogs. Ben will blog again one day soon at [benramsey.com](https://benramsey.com) and is ' .
			'[@ramsey](https://twitter.com/ramsey) on Twitter.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=1xIWbT5SEc0';
	}
}
