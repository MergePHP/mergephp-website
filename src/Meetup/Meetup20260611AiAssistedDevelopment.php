<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260611AiAssistedDevelopment extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'AI Assisted Development';
	}

	public function getDescription(): string
	{
		return <<<END
		Maximize developer productivity with AI-driven coding assistants. Discover how AI can speed up development by
		generating code, suggesting improvements, and helping with debugging. This session will equip you with
		strategies to effectively integrate AI into your workflow, enhancing efficiency and innovation.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-06-11 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/7721046a-bbb2-4c77-9350-e80598f07146.png';
	}

	public function getSpeakerName(): string
	{
		return 'Mark Niebergall';
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=f5jLUMt7Uk8';
	}

	public function getSpeakerBio(): string
	{
		return 'Mark Niebergall is a security-minded PHP senior software engineer at a cybersecurity company, with ' .
			'many years of hands-on experience with PHP projects. He is the Utah PHP User Group Co-Organizer, a ' .
			'regular conference speaker, and an occasional author. Mark has a Masters degree in MIS, is CSSLP and ' .
			'SSCP cybersecurity certified, and volunteers for ISC2 security exam development.';
	}
}
