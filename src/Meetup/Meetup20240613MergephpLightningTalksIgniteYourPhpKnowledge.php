<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20240613MergephpLightningTalksIgniteYourPhpKnowledge extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'MergePHP Lightning Talks: Ignite Your PHP Knowledge!';
	}

	public function getDescription(): string
	{
		return 'This month, we\'re trying something new: lightning talks! If you have an interesting PHP-related ' .
			'topic you\'d like to share with the group in a 5-10-minute presentation, now\'s your chance. ' .
			'[Fill out the sign-up form]([https://mphp.io/june24](https://mphp.io/june24)), and we\'ll email you a ' .
			'link to join the event 15-20 minutes beforehand. We\'ll bring up each speaker one at a time to give ' .
			'their talk. Remember, we value contributions from everyone in the community, so don\'t hesitate to ' .
			"share your knowledge!\n\nHere are some ideas:\n* What's new with JavaScript\n* Alternative PHP run " .
			"times\n* An update on PHP internals\n* Security\n* New testing strategies\n* Something related to APIs\n" .
			"* That side project you've been putting off\n\nDepending on the number of lightning talks, we also " .
			'plan to have a panel discussion. This won\'t be your typical panel discussion-we\'ll watch a YouTube ' .
			'video together and share our reactions. It\'ll be a fun and interactive experience, similar to the ' .
			'reaction videos you see on YouTube. Don\'t miss out on this opportunity to learn, share, and engage ' .
			'with the MergePHP community! 🌩️⚡🗣️';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-06-13 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		// phpcs:ignore
		return '/images/llbbl_imagine_prompt_A_panel_discussion_setup_with_lightning-_3ed8a024-4de2-4fe6-8d52-06cb4e789f7d_3.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Logan Lindquist';
	}

	public function getSpeakerBio(): string
	{
		return 'Logan is one of the MergePHP organizers';
	}
}
