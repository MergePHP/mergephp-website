<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Meetups;

class Meetup20230810MasteringResilienceMyAccidentalActingAdventure extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Mastering Resilience: My Accidental Acting Adventure';
	}

	public function getDescription(): string
	{
		return 'Are you ready to explore leadership from one of the galaxy\'s most badass Jedi Padawans? ' .
			'Luckygirliegirl Christina Aldan learned first-hand how embodying the character of Asohka Tano, ' .
			'a Jedi Padawan from the Star Wars universe, can help us understand essential leadership principles. ' .
			'Asohka\'s courage, compassion, and resilience have inspired countless fans around the world. Drawing ' .
			'from her personal experience playing the Asohka Tano character on the Las Vegas Strip, Christina ' .
			'shares practical insights on how to apply Asohka\'s leadership traits to the real world. You\'ll ' .
			'learn how to embrace change, foster growth, and empower others to reach their fullest potential, ' .
			'all while staying true to your values and purpose. So grab your lightsaber and join Christina on a ' .
			'journey through a galaxy far, far away to discover the timeless wisdom of one of Star Wars\' most ' .
			'fierce warriors.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-08-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/mastering-resilience.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Christina Aldan';
	}

	public function getSpeakerBio(): string
	{
		return 'Christina Aldan is a brand strategy consultant, keynote speaker, trainer, and mentor. ' .
			'She offers businesses brand consulting and creative content for everyday media. With over 15 years ' .
			'of experience in the digital realm, Christina is highly regarded for her approach to business, ' .
			'partnering with clients to find unique strategies that ensure their goals are met. Christina builds ' .
			'connections through her keynote addresses, training workshops, and technological education. She uses ' .
			'these tools to help individuals and businesses cultivate value in everyday media. Christina has ' .
			'delivered talks on all 7 continents, presenting training workshops for the Microsoft MVP community, ' .
			'international corporations, and conferences worldwide. Christina uses her charisma and expertise to ' .
			'inspire others by mentoring women in business like herself. She also has sat on state and local boards ' .
			'supporting women in tech, entrepreneurship, mental health, and children with learning disabilities.' .
			'<br><br>She is the recipient of the Las Vegas Women in Tech Community Service Award, the Distinguished ' .
			'Woman of the Year Award in STEM. Learn more at: [Luckygirliegirl.com](https://Luckygirliegirl.com).';
	}

	public function getMeetupLinks(): array
	{
		return [
			Meetups::Atlanta->value => 'https://www.meetup.com/atlantaphp/events/295363086/',
			Meetups::Austin->value => 'https://www.meetup.com/austinphp/events/xsbbctyfclbnb/',
			Meetups::KansasCity->value => 'https://www.meetup.com/kcphpug/events/zlfpzsyfclbnb/',
			Meetups::Portland->value => 'https://www.meetup.com/pdx-php/events/295356836/',
			Meetups::Seattle->value => 'https://www.meetup.com/seaphp/events/294565808/',
			Meetups::Utah->value => 'https://www.meetup.com/utah-php-user-group/events/spfxftyfclbnb/',
		];
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=kr_A9GKsIlo';
	}
}
