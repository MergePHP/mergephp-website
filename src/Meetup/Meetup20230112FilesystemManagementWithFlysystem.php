<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20230112FilesystemManagementWithFlysystem extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Filesystem Management with Flysystem';
	}

	public function getDescription(): string
	{
		return 'Reading and writing files locally comes with many nuances and difficulties. It becomes even more ' .
			'complex when files are hosted on external servers like SFTP, AWS S3, Azure, and other providers. ' .
			'Flysystem provides an abstraction layer between an application and interacting with the filesystems. ' .
			'Explore how to use Flysystem Adapters for seamless file management for writing, reading, moving, ' .
			'copying, deleting, and other file interactions. See how to set permissions, configure adapters, get ' .
			'file information, stream files, write unit tests, and more in this technical dive into file management ' .
			'with Flysystem.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-01-12 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/filesystem-management-with-flysystem.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Mark Niebergall';
	}

	public function getSpeakerBio(): string
	{
		return 'Mark Niebergall is a security-minded PHP senior software engineer at a cybersecurity software ' .
			'company, with many years of hands-on experience with PHP projects. He is the Utah PHP User Group ' .
			'Co-Organizer, a regular conference speaker, and an occasional author. Mark has a Masters degree in MIS, ' .
			'is CSSLP and SSCP cybersecurity certified, and volunteers for (ISC)2 security exam development. Mark ' .
			'enjoys endurance sports, being outdoors, and teaching his five boys how to push buttons and use ' .
			'technology.';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=jejZPoVkPHQ';
	}
}
