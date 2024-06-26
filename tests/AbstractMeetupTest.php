<?php

declare(strict_types=1);

namespace Tests;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;
use PHPUnit\Framework\TestCase;
use Tests\fixtures\TestMeetup;

class AbstractMeetupTest extends TestCase
{
	public function testItGeneratesASlugIgnoringEmojis(): void
	{
		$meetup = new TestMeetup('50 Ways To Leave Your ♥er');

		$this->assertEquals('50-ways-to-leave-your-er', $meetup->getSlug());
	}

	public function testItGeneratesASlugWithoutConsecutiveDashes(): void
	{
		$meetup = new TestMeetup('First Part - Second Part');

		$this->assertEquals('first-part-second-part', $meetup->getSlug());
	}

	public function testItGeneratesASlugThatDoesNotStartOrEndWithADash(): void
	{
		$meetup = new TestMeetup('@ slug !');

		$this->assertEquals('slug', $meetup->getSlug());
	}

	public function testItGeneratesASlugThatDoesNotReallyDoWellWithAccentedCharacters(): void
	{
		$meetup = new TestMeetup('slúg');

		$this->assertEquals('sl-g', $meetup->getSlug());
	}

	public function testItReturnsADefaultImageUrlOnlyWhenTheImageIsNotDefined(): void
	{
		$meetup = new TestMeetup('');

		$this->assertEquals('/images/placeholder.webp', $meetup->getImage());
	}

	public function testItAllowsANullYouTubeLink(): void
	{
		$meetup = new TestMeetup('');

		$this->assertNull($meetup->getYouTubeLink());
	}

	public function testItAllowsTheImageAndYouTubeLinkToBeOverridden(): void
	{
		$class = new class extends AbstractMeetup
		{
			public function getImage(): string
			{
				return 'https://www.example.com/image.jpg';
			}
			public function getYouTubeLink(): string
			{
				return 'https://www.youtube.com/';
			}
			public function getTitle(): string
			{
				return '';
			}
			public function getDescription(): string
			{
				return '';
			}
			public function getDateTime(): DateTimeImmutable
			{
				return new DateTimeImmutable();
			}
			public function getSpeakerName(): string
			{
				return '';
			}
			public function getSpeakerBio(): string
			{
				return '';
			}
		};

		$this->assertEquals('https://www.example.com/image.jpg', (new $class())->getImage());
		$this->assertEquals('https://www.youtube.com/', (new $class())->getYouTubeLink());
	}

	public function testItGeneratesAPermalink(): void
	{
		$class = new class extends AbstractMeetup
		{
			public function getTitle(): string
			{
				return 'Meetup Title';
			}
			public function getDescription(): string
			{
				return '';
			}
			public function getDateTime(): DateTimeImmutable
			{
				return new DateTimeImmutable('2020-07-04');
			}
			public function getSpeakerName(): string
			{
				return '';
			}
			public function getSpeakerBio(): string
			{
				return '';
			}
		};

		$this->assertEquals('/meetups/2020/07/04/meetup-title.html', $class->getPermalink());
	}
}
