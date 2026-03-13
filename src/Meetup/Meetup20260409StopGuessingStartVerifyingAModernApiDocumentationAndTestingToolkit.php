<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260409StopGuessingStartVerifyingAModernApiDocumentationAndTestingToolkit extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Stop Guessing, Start Verifying: A Modern API Documentation and Testing Toolkit';
	}

	public function getDescription(): string
	{
		return <<<END
		## Abstract

		APIs are only as good as the trust developers place in them. That trust is built through clear documentation and rigorous testing — yet in many teams, both remain an afterthought. This session makes the case for treating your OpenAPI specification as the single source of truth for your entire API lifecycle, and demonstrates how a modern toolchain can turn that spec into living documentation, a contract enforcement mechanism, and an automated test suite.

		We begin with **OpenAPI** as the foundation: structuring a spec that accurately models your API's requests, responses, and error states. From there, we'll explore **Redocly** to transform that spec into polished, developer-friendly reference documentation — covering customization, linting, and the Redocly CLI for integrating docs into your CI/CD pipeline.

		The second half of the session focuses on testing across multiple layers. We'll cover **schema validation** (ensuring your implementation matches the spec), **contract testing** (verifying that producer and consumer agreements hold across deployments), and **negative testing** (probing edge cases and malformed inputs). A key focus will be validating your existing **PHPUnit test suite against your OpenAPI spec** — asserting that the responses your application actually returns conform to the schemas you've documented, using tools like `osteel/openapi-httpfoundation-testing` or the `php-openapi` library. This approach surfaces drift between your spec and implementation without requiring a running server, and slots naturally into Laravel and Symfony testing workflows.

		We'll then use **Schemathesis** to drive property-based and fuzz testing directly from your OpenAPI spec — requiring zero test case authoring for broad coverage — and compare how spec-driven fuzzing complements the response assertions you've already built into PHPUnit.

		Finally, we'll introduce **Arazzo**, the emerging OpenAPI Initiative specification for describing multi-step API workflows. We'll walk through defining realistic end-to-end scenarios — authentication flows, resource creation chains, dependent call sequences — and show how Arazzo workflows close the gap between isolated endpoint testing and real-world usage patterns.

		## Attendees Will Leave With

		- A practical strategy for keeping documentation and implementation in sync
		- Techniques for validating PHPUnit test responses directly against OpenAPI schemas
		- An understanding of contract testing and where it fits alongside unit and integration tests
		- Hands-on patterns for automated spec-driven testing with Schemathesis
		- A working knowledge of Arazzo for modeling and validating API workflows

		---

		*Whether you maintain a public API or an internal microservices mesh, this session will give you the tools to ship APIs that are easier to understand, harder to break, and faster to debug.*
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-04-09 20:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Alena Holligan';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		For over 20 years, Alena has built technical solutions that inform decisions and solve problems across diverse
		industries. She enjoys both the creativity of programming and the thrill of solving a puzzle. As a leader in
		the community, a technical trainer, and a mom, she is passionate about providing the tools and mindset
		required for everyone to learn and succeed.
		END;
	}
}
