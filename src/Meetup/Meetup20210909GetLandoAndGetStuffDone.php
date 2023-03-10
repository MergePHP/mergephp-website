<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210909GetLandoAndGetStuffDone extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Get Lando and Get Stuff Done';
	}

	public function getDescription(): string
	{
		return 'How we develop software has come a long way since I started working with PHP 4.0. Today with tools ' .
			'like Docker, we can put each project in a container and isolate it from all other projects. The promise ' .
			'of Docker though has been difficult to deliver on. Crafting the proper config files and making sure all ' .
			'the pieces work together and talk together can be a daunting task, especially for a developer that just ' .
			"wants to get something done.\n\nEnter Lando. Lando is an abstraction layer on top of Docker that makes " .
			"bringing up complex applications easy.\n\nIn this talk, I'll demonstrate how easy it is to bring Lando " .
			"up and start a project. Along the way I'll share a few of the things that I've learned about Lando and " .
			"how it can make the lives of PHP developers easier.\n\np.s. No StarWars jokes, I promise. :)";
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-09-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Cal Evans';
	}

	public function getSpeakerBio(): string
	{
		return 'Many moons ago, at the tender age of 14, Cal touched his first computer. (We\'re using the term ' .
			'"computer" loosely here, it was a TRS-80 Model 1) Since then his life has never been the same. He ' .
			'graduated from TRS-80s to Commodores and eventually to IBM PCs.For the past 15 years Cal has worked ' .
			'with PHP and MySQL on Linux, OSX, and Windows. He has built a variety of projects ranging in size from ' .
			"simple web pages to multi-million dollar web applications.\n\nWhen not banging his head on his monitor, " .
			'attempting a blood sacrifice to get a particular piece of code working, he enjoys building and managing ' .
			'development teams using his widely imitated but never patented management style of "management by ' .
			"wandering around\".\n\nThese days, when not working with PHP, Cal can be found working on a variety of " .
			'projects like Day Camp 4 Developers. He gives motivational talks to developers around the world. If ' .
			"you happen to meet him at a conference, don't be afraid to buy him a shot of Rum.\n\nCal is based in " .
			'West Palm Beach, FL – US where he is happily married to wife 1.36, the lovely and talented Kathy. ' .
			'Together they have 2 wonderful kids who were both smart enough not to pursue a job in IT.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=ypppG0A3y5g';
	}
}
