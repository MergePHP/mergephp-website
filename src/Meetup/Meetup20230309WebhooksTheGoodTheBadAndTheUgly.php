<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Meetups;

class Meetup20230309WebhooksTheGoodTheBadAndTheUgly extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Webhooks: The Good, The Bad, and the Ugly';
	}

	public function getDescription(): string
	{
		return 'Webhooks are a pillar of modern application development. They notify us of that new commit, an ' .
			'incoming text message, our email was delivered, and a payment was processed. Our systems can\'t ' .
			"function without webhooks sending data seamlessly and securely across the internet.\nBut what happens " .
			'if they\'re not secure? What happens if your webhooks are intercepted, manipulated, or even replayed ' .
			'against your systems? What are the best ways - as both a provider and consumer - to protect our ' .
			"systems?\nIn this session, we'll delve into the 100+ implementations we explored to build webhooks. " .
			'fyi to identify the best and worst patterns to protect our systems now and in the future.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-03-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/webhooks-the-good-the-bad-and-the-ugly.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Keith Casey';
	}

	public function getSpeakerBio(): string
	{
		return 'Keith Casey serves on the Product/GTM Team at ngrok helping teams launch their systems faster and ' .
			'easier than ever before. Previously, he served on the Product Team at Okta working on Identity and ' .
			'Authentication APIs, as an early Developer Evangelist at Twilio, and worked to answer the Ultimate Geek ' .
			'Question at the Library of Congress. His underlying goal is to get good technology into the hands of ' .
			'good people to do great things. In his spare time, he writes at CaseySoftware.com and lives in the ' .
			'woods. He is also a co-author of \"A Practical Approach to API Design.\"';
	}

	public function getMeetupLinks(): array
	{
		return [
			Meetups::Atlanta->value => 'https://www.meetup.com/atlantaphp/events/291892502/',
			Meetups::Austin->value => 'https://www.meetup.com/austinphp/events/xsbbctyfcfbmb/',
			Meetups::KansasCity->value => 'https://www.meetup.com/kcphpug/events/zlfpzsyfcfbmb/',
			Meetups::LasVegas->value => 'https://www.meetup.com/vegas-programmers/events/291655784/',
			Meetups::SanDiego->value => 'https://www.meetup.com/sandiegophp/events/292081010/',
			Meetups::Seattle->value => 'https://www.meetup.com/seaphp/events/291540671/',
			Meetups::Utah->value => 'https://www.meetup.com/utah-php-user-group/events/292010849/',
		];
	}
}
