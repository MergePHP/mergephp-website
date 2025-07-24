<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20250814VibeCodingLaravelWithClaudeDevin extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Vibe Coding Laravel with Claude & Devin';
	}

	public function getDescription(): string
	{
		return <<<END
		When I enter the matrix, I bring two friends. It ain't Neo & Morpheus, it's my two favorite developers Devin
		and Claude. After helping Devin setup our codebase on his machine, he's been fixing issues quickly when we tag
		him in Slack and jumps on feedback in his PRs. My other developer Claude isn't as independent but charges way
		less than Devin. Both need to be given well-defined tasks so they don't get too off track which I've been
		using GPT to help me with. I've been 10x developer all my life but with both Devin & Claude, I'm at 100x now.
		At this point my day consists of waking up, grabbing my coffee & sunglasses, sitting in the computer chair,
		and I start vibing. Wait, did I mention Devin and Claude are not actual developers, they are AI. This talk
		covers my modern workflow for developing features, tests, and documentation with AI using [Claude
		Code](https://claude.ai/) and [Devin AI](https://devin.ai) - I cover best practices, ways to get the most out
		of AI to code depending on your budget.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-08-14 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		// phpcs:ignore
        return '/images/VIBE-CODING.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Joshua Copeland';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Joshua Copeland is CTO of [Remote Dev Force](https://www.remotedevforce.com) and works with clients all over the
		 world to build high quality systems. With over 15 years as a software architect and serial entrepreneur, Joshua
		  has gained a good blend of start-up and enterprise experience. Developing PHP applications is a big part of
		  his day-to-day work and keeps security first-in-mind. Joshua’s team of engineers regularly work on building
		  features for mission critical projects, setting up and maintaining infrastructure with
		  Terraform, building pipelines, Pen-testing, putting out fires, and much more. He has led the
		  PHP Vegas Users Group for over 9 years and loves to give back by speaking at conferences and educating
		  the community.
		END;
	}
}
