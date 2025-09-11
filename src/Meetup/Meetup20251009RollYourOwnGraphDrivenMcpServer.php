<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20251009RollYourOwnGraphDrivenMcpServer extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Roll Your Own Graph-Driven MCP Server';
	}

	public function getDescription(): string
	{
		return <<<END
		Receive a ready-to-use blueprint for building your Model Context Protocol server with Neo4j. We'll start with
		a quick survey of driver options across languages, then dive into how we built one using the PHP driver in a
		Symfony app, covering connection setup, session, and transaction handling before wrapping it all up with a
		live demo that ties it all together.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2025-10-09 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/roll-your-own-graph-driven-mcp-server.jpg';
	}

	public function getSpeakerName(): string
	{
		return 'Ghlen Nagels';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Ghlen Nagels is a Belgian entrepreneur and senior software engineer who runs a small IT consulting firm with
		teams in Belgium and Mumbai, India. He maintains the Neo4j PHP driver, contributes to open-source projects,
		and partners with startups and SMEs on cloud applications using PHP, graph and relational databases. Beyond
		his work life, he's an avid runner with a passion for craft beer.
		END;
	}
}
