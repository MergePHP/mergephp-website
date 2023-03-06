<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210708CodeInterfacesPatentsAndCopyrights extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Code Interfaces, Patents, and Copyrights';
	}

	public function getDescription(): string
	{
		return 'In a landmark decision that marked the end of a ten year saga, the Supreme Court ruled that APIs are ' .
			'not copyrightable. In this talk, we\'ll take a look at the claims from copyright to patent ' .
			'infringement, review the history of decisions, and look into the key statements behind the Supreme ' .
			'Court ruling. We\'ll discuss what this likely means for the future of code interfaces and what it means ' .
			'for interoperability. Note - this is not legal advice.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-07-08 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Mike Stowe';
	}

	public function getSpeakerBio(): string
	{
		return 'About Mike: Michael Stowe is a professional, Zend Certified Engineer with over 10 years experience ' .
			'building applications for law enforcement, the medical field, nonprofits, and numerous industrial ' .
			'companies. Over the last several years he has been focused on APIs and ways to improve industry ' .
			'standards and efficiency. He now works for RingCentral, a company on the leading edge of cloud ' .
			'communications. You can view slides from his other talks at ' .
			'[https://mikestowe.com/slides](https://mikestowe.com/slides) or follow him: ' .
			'[https://twitter.com/mikegstowe](https://twitter.com/mikegstowe)';
	}
}
