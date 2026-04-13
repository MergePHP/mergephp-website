<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260514MoreThanJustACacheDataStructureDatabases extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'More than Just a Cache: Data Structure Databases';
	}

	public function getDescription(): string
	{
		return <<<END
		Redis is best known as a high performance, in-memory, key-value database used for distributed caching.
		However, data structure databases like Redis, Valkey, and Key DB can do so much more than just operate on
		string values! With over a dozen different data types like hashes, lists, sets, sorted sets, bloom filters,
		and streams, these databases provide a number of tools that can help solve common problems.

		We’ll explore these basic data structures in Redis and Valkey, with real world examples of using them to solve
		problems like rate limiting, distributed resource locking, and efficiently checking membership in **massive**
		sets of data.

		We'll also discuss some of the newer functionality designed for AI and LLM applications, like vector similarity
		searches and vector sets.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-05-14 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return 'images/more-than-just-a-cache.webp';
	}

	public function getSpeakerName(): string
	{
		return 'Andy Snell';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		Andy Snell is a polyglot software engineer and consultant with over fifteen years of experience building,
		maintaining, and modernizing web applications. Through his consulting company, WickedByte, he helps clients
		modernize legacy systems, untangle difficult architectural problems, and work through the kinds of systems-level
		challenges that resist simple answers. He found his way into full-stack web development around the PHP 6 era,
		and has been speaking at PHP conferences since 2019. Andy brings a practical, approachable perspective to design
		patterns, software architecture, and modern engineering practice.

		Visit [https://wickedbyte.com](https://wickedbyte.com) for more information or to connect with Andy.
		END;
	}
}
