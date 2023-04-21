<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Meetups;

class Meetup20230511WhatsUpWithZendErLaminas extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'What\'s up with Zend, er, Laminas?';
	}

	public function getDescription(): string
	{
		return 'At the beginning of 2020, Zend spun off Zend Framework to the Linux Foundation under the name "The ' .
			'Laminas Project". When it did so, it also spun off its two subprojects, Apigility and Expressive, as ' .
			'Laminas API Tools and Mezzio, respectively.\nWhat has the project been up to since then? And what are ' .
			'some of the things you can expect in the future? Who\'s running the project now?\nCome join Matthew ' .
			'Weier O\'Phinney as he tells the tale of two frameworks.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-05-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/what-s-up-with-zend-er-laminas.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Matthew Weier O\'Phinney';
	}

	public function getSpeakerBio(): string
	{
		return 'Matthew Weier O\'Phinney is a long-term OSS contributor and PHP developer. He has been project lead ' .
			'for Zend Framework and now the Laminas Project; acted as a founding member, editor, and Core Committee ' .
			'member of the PHP Framework Interop Group (PHP-FIG); and provided a number of standalone tools, such as ' .
			'his PHP-based Keep-A-Changelog tooling. He currently acts as the Zend Product Manager at Perforce, ' .
			'where he oversees the Zend product line. When not working, he spends time creating tangle art across ' .
			'the desk from his multimedia artist wife. You can find him at his online home, ' .
			'[https://mwop.net/](https://mwop.net/).';
	}

	public function getMeetupLinks(): array
	{
		return [
			Meetups::Seattle->value => 'https://www.meetup.com/seaphp/events/293029085/',
		];
	}
}
