<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Meetups;

class Meetup20230914UsingHasuraToAddAGraphqlApiToExistingApplications extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Using Hasura to add a GraphQL API to existing applications';
	}

	public function getDescription(): string
	{
		return 'Hasura is an open-source application written in Haskell which provides a robust GraphQL API for any ' .
			'Postgres and MySQL database. This talk will provide a brief introduction to Hasura but focus more on ' .
			"pathways to integrate it into an existing PHP application - with a Laravel example.\n\nWe will cover:\n" .
			"* Authentication\n" .
			"* Access control of database records\n" .
			'* Applying mutations in server code';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2023-09-14 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getImage(): string
	{
		return '/images/using-hasura-to-add-a-graphql-api-to-existing-applications.svg';
	}

	public function getSpeakerName(): string
	{
		return 'Anirudh Sanjeev';
	}

	public function getSpeakerBio(): string
	{
		return 'Anirudh is a Full Stack Engineer living near Toronto. He enjoys building things with PHP, Vue and ' .
			'Tailwind, and tinkering with vintage audio equipment.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=bAHzuLgRlBQ';
	}

	public function getMeetupLinks(): array
	{
		return [
			Meetups::Seattle->value => 'https://www.meetup.com/seaphp/events/295371487/',
		];
	}
}
