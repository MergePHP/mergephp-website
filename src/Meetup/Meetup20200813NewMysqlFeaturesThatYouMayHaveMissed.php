<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20200813NewMysqlFeaturesThatYouMayHaveMissed extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'New MySQL Features That You May Have Missed';
	}

	public function getDescription(): string
	{
		return 'MySQL has gone to a continuous release cycle so that new features are added several times a year. ' .
			'This quickly provides a better product to customers. The news about these new facets may have escaped ' .
			'your notice if you were not paying attention. So you may have missed the addition of hash joins, ' .
			'multi-valued indexes, the ability to validate JSON documents before the are stored, dual passwords, the ' .
			'clone replication tool, and other improvements. This session will cover not only what is new, but how ' .
			'to use those new goodies.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2020-08-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/new-mysql-features-that-you-may-have-missed.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Dave Stokes';
	}

	public function getSpeakerBio(): string
	{
		return '';
	}
}
