<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20231214BDDandCodeception extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Behavior Driven Development and Browser Testing using Codeception';
	}

	public function getDescription(): string
	{
		return "Codeception provides **PHP TESTING FOREVERYONE**" .
		 "by collecting and sharing best practices and solutions for testing PHP web applications. With a flexible" .
		 "set of included modules, tests are easy to write, easy to use, and easy to maintain. Join Alena Holligan" .
		 "to start writing your own tests today. We'll focus on acceptance testing with a browser, but Codeception" .
		 "also provides functional, unit, and API testing. We'll take a look at setting up Codeception and writing" .
		 "basic tests before jumping into Behavior Driven Development and the Gherkins syntax.\n" .
			"\n" .
		"Behavior Driven Development (BDD) is a popular software development methodology." .
		 "BDD is an extension of Test Driven Development (TDD) inspired by Agile practices. But is the added layer" .
		 "really worth it? The primary reason to choose BDD as your development process is to break down" .
		 "communication barriers between business and technical teams. BDD encourages automated testing to verify" .
		 "all documented features of a project from the beginning.\n" .
			"\n" .
		"Narrow the idea of story BDD:\n" .
		"* describe features in a scenario with a formal text\n" .
		"* use examples to make abstract things concrete\n" .
		"* implement each step of a scenario for testing\n" .
		"* write actual code implementing the feature\n" .
			"\n" .
		"By writing every feature in User Story format that is automatically executable as a test, " .
		 "we ensure that: businesses, developers, QAs, and managers are all on the same page. BDD encourages " .
		 "exploration and debate to formalize the requirements and features by writing the User Stories so " .
		 "everyone can understand. By making tests part of the User Story, BDD allows non-technical personnel to " .
		 "write (or edit) Acceptance tests. This procedure also ensures that everyone in a team knows what was" .
		 "developed, what was not, what was tested, and what was not.\n" .
			"\n" .
		"If you write your tests in a reusable way, it can often make your tests LESS complicated." .
		 "Codeception collects and shares best practices and solutions for testing PHP web applications. With a" .
		 "flexible set of included modules, tests are easy to write, use, and maintain. Get started today " .
		 "writing your first BDD test.";
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-12-14 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/202312_codeception.png';
	}

	public function getSpeakerName(): string
	{
		return 'Alena Holligan';
	}

	public function getSpeakerBio(): string
	{
		return 'For over 20 years, Alena has built technical solutions that inform decisions and solve problems ' .
			'across diverse industries. She enjoys both the creativity of programming and the thrill of solving a ' .
			'puzzle. As a leader in the community, a technical trainer, and a mom, she is passionate about providing ' .
			'the tools and mindset required for everyone to learn and succeed.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=qLYDXoxj7qg';
	}
}
