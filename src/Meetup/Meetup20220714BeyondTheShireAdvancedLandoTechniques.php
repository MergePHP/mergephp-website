<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220714BeyondTheShireAdvancedLandoTechniques extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Beyond the Shire: Advanced Lando Techniques';
	}

	public function getDescription(): string
	{
		return 'Every hero starts their journey from the comforts of home. However, the real adventure starts when ' .
			"you set aside the comforts of Bag End to head for parts unknown.\n\nNow that you have a few projects " .
			"running in Lando, aren't you curious to see what this puppy can really do?\n\nIn this presentation " .
			"we'll cover…\n\nGoblin Fighting: Tips and tricks to help consultants and web teams dealing with LOTS of " .
			"projects.\nRing Forging: The foundations of custom Lando plugin creation.\nFellowship Founding: Getting " .
			"started with Lando contribution.\nWhether you\'ve been up-and running with Lando for years or have just " .
			'started using it, this presentation will help you find new tricks with Lando and encourage you to use ' .
			'your new powers for the good of all developers!';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-07-14 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/beyond-the-shire-advanced-lando-techniques.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Alec Reynolds';
	}

	public function getSpeakerBio(): string
	{
		return 'Alec Reynolds is the co-founder and CEO of Lando. He is happy to be Lando\'s bard, singing tales of ' .
			'its prowess in hopes that Lando will aid you in your next quest. Before Lando, Alec founded Kalamuna ' .
			'and Tandem, two successful software consultancies. His natural habitat is the Sierra Nevada foothills, ' .
			'where he is often seen trail running, camping with his family, and tending his garden.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=acg33gtq5qc';
	}
}
