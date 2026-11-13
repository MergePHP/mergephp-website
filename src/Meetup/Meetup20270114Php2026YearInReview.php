<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20270114Php2026YearInReview extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'PHP: 2026 Year in Review';
	}

	public function getDescription(): string
	{
		return <<<END
		What a year it has been for PHP! We'll review major milestones,
		language progress, community movements, the impact of AI, and
		newsworthy events including php2shell. Review the 2026 PHP Landscape
		highlights from Zend and preview what is coming for 2027.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2027-01-14 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Mark Niebergall';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Mark Niebergall is a security-minded PHP Staff Software Engineer and
		Team Lead at a cybersecurity software company, with many years of
		hands-on experience with PHP projects. He is the Utah PHP User Group
		Co-Organizer, a regular conference speaker, and a PHP-FIG Secretary.
		Mark has a Masters degree in MIS, is CSSLP and SSCP cybersecurity
		certified, and volunteers for (ISC)2 security exam development. Mark
		enjoys endurance sports, being outdoors, and time with his family.
		END;
	}

	public function getImage(): string
	{
		return '/images/php-2026-year-in-review.png';
	}
}
