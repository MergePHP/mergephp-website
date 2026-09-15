<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20261008BeforeTheFirstPrompt extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Before the First Prompt';
	}

	public function getDescription(): string
	{
		return <<<END
		Last month Matt showed us what eight months of heavy Claude adoption looks like at Gymdesk: the MCP
		server, the specs, the triage packets, the bots, and the 2,385 pull requests. He also showed us the part
		nobody warns you about: the silos, the lost stopping points, and a team that can be overwhelmed by its own
		output.

		There is no shortage of content on what AI coding agents can do. Almost all of it is filmed on a toy
		project or a clean greenfield codebase with no technical debt. There is very little on how to think about
		agents before you type your first prompt into a legacy, brownfield application, and even less on how to
		keep a team sane once they work. We will cover the mental models that hold up (an agent is not
		autocomplete, not a junior engineer, and not a search engine), what an agent needs from a codebase and why
		it is the same list your team always needed, the small set of habits that separate a good first week from
		a frustrating one, and the progression from one engineer experimenting to a team shipping with guardrails.
		Then we will answer Matt's closing questions from the engineering leadership side: which gates we put in
		place, what we measure, and how to say "not faster" when the numbers make everyone want to go faster.

		You will leave with a starting point, not a feature list.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable(
			'2026-10-08 20:00:00',
			new DateTimeZone('America/New_York'),
		);
	}

	public function getImage(): string
	{
		return '/images/before-the-first-prompt.svg';
	}

	public function getSpeakerName(): string
	{
		return 'David Stanley';
	}

	public function getSpeakerBio(): string
	{
		return 'David is the VP of Engineering at Gymdesk, where he leads the fully remote team of engineers and ' .
			'QA folks that Matt\'s September talk came out of. A PHP developer for most of his career, he now ' .
			'spends his days on the parts of AI adoption that happen after the demo: compliance, infrastructure, ' .
			'modernizing a Zend Framework 1 monolith, and keeping a small team steady while the tooling changes ' .
			'under it. He lives in Kansas City. You can find him on ' .
			'[LinkedIn](https://www.linkedin.com/in/davidstanley01/).';
	}
}
