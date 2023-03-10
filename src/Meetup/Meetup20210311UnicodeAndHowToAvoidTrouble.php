<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210311UnicodeAndHowToAvoidTrouble extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Unicode and how to avoid trouble';
	}

	public function getDescription(): string
	{
		return 'In this talk, I\'ll be documenting the trials and tribulations I\'ve experienced when working with ' .
			'Unicode; from encoding, to normalization, and the not-so-obvious differences between alphabets. I\'ll ' .
			'take you on the usual Product/Engineering journey where requirements can change, bugs are discovered ' .
			'where you least expect them, and your knowledge of Unicode needs to be as flexible as your Product ' .
			"Manager's priorities. You think 'Gemüse' === 'Gemüse'? You might be wrong!\n\nAttendees will walk away " .
			'wielding newfound Unicode knowledge like a mighty sword, ready to slay an array of production issues ' .
			'related to characters and bytes. You\'ll get the most out of this session if you\'re required to show ' .
			'or produce text to users, but don\'t quite understand the barriers that exist. I\'ve befriended the ' .
			'Unicode monster, and you can, too!';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-03-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Pawel Luczkiewicz';
	}

	public function getSpeakerBio(): string
	{
		return 'Pawel Luczkiewicz is a software engineer at Wayfair in Berlin, Germany. They describe themselves as ' .
			'\"the laziest ambitious person they know\", which often leads them to find simple solutions to complex ' .
			'problems. Pawel loves understanding technology in very intricate detail, and on a Friday evening, you ' .
			'can probably find them reading Unicode specification, Intel\'s manuals, or PHP source code.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=-veq5CINIYs';
	}
}
