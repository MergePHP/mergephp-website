<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Meetups;

class Meetup20230608SymfonyToLaravelLessonsLearned extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Symfony to Laravel: Lessons Learned';
	}

	public function getDescription(): string
	{
		return 'Symfony and Laravel have emerged as the leading MVC frameworks for rapidly building and deploying ' .
			'web applications using PHP. While each has its advocates and naysayers, let\'s compare them in a way ' .
			'that highlights the strengths of each and their approaches to aiding the delivery of value. Whether ' .
			'you\'re a tech lead wanting to better guide the maturity of your systems, an engineer looking to ' .
			'broaden your knowledge, or just wanting to know if PHP is a viable option as a component in your ' .
			'stack, awareness of these differences can help smooth the path ahead of you.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-06-08 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/symfony-to-laravel-lessons-learned.png';
	}

	public function getSpeakerName(): string
	{
		return 'Israel Carberry';
	}

	public function getSpeakerBio(): string
	{
		return 'Israel J. Carberry has been tricking magical rocks to do his bidding ever since meeting his first ' .
			'Tandy on the Great Plains of Wyoming, which he found to be more fun than chucking tumbleweeds. ' .
			'Continuing his family\'s migratory tradition, Israel wound up in Austin, where he escaped the cubical ' .
			'tech world of the 90\'s by pursuing other ostensibly gainful enterprises, such as rebuilding concert ' .
			'pianos and training empty nesters how to parallel park a school bus. However, his old love of ' .
			'algorithmic incantations, together with a growing family and an acute aversion to hunger, drew Israel ' .
			'back to the life of computational wizardry. Now an Engineer of ye Staff at Atmosphere TV, he conjures ' .
			'architectural diagrams from the murky mists of uncertainty and crafts potions to help engineers fall ' .
			'in love with test driven development.';
	}

	public function getMeetupLinks(): array
	{
		return [
			Meetups::Austin->value => 'https://www.meetup.com/austinphp/events/292881946/',
			Meetups::Seattle->value => 'https://www.meetup.com/seaphp/events/293618983/',
		];
	}
}
