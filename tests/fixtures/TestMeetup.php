<?php

namespace Tests\fixtures;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;

class TestMeetup extends AbstractMeetup
{
	public function __construct(private readonly string $title)
	{
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getDescription(): string
	{
		return 'Description';
	}

	public function getDateTime(): DateTimeImmutable
	{
		return new DateTimeImmutable();
	}

	public function getSpeakerName(): string
	{
		return 'Speaker name';
	}

	public function getSpeakerBio(): string
	{
		return 'Speaker bio';
	}
}
