<?php

declare(strict_types=1);

namespace Tests;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AbstractMeetupTest extends TestCase
{
	private function generateMock(string $title): AbstractMeetup|MockObject
	{
		$mock = $this->getMockForAbstractClass(AbstractMeetup::class);
		$mock->method('getTitle')->willReturn($title);
		return $mock;
	}

	public function testItGeneratesASlugIgnoringEmojis(): void
	{
		$mock = $this->generateMock('50 Ways To Leave Your ♥er');

		$this->assertEquals('50-ways-to-leave-your-er', $mock->getSlug());
	}

	public function testItGeneratesASlugWithoutConsecutiveDashes(): void
	{
		$mock = $this->generateMock('First Part - Second Part');

		$this->assertEquals('first-part-second-part', $mock->getSlug());
	}

	public function testItGeneratesASlugThatDoesNotStartOrEndWithADash(): void
	{
		$mock = $this->generateMock('@ slug !');

		$this->assertEquals('slug', $mock->getSlug());
	}

	public function testItGeneratesASlugThatDoesNotReallyDoWellWithAccentedCharacters(): void
	{
		$mock = $this->generateMock('slúg');

		$this->assertEquals('sl-g', $mock->getSlug());
	}

	public function testItReturnsADefaultImageUrlOnlyWhenTheImageIsNotDefined(): void
	{
		$mock = $this->getMockForAbstractClass(AbstractMeetup::class);

		$this->assertEquals(
			'/images/placeholder.webp',
			$mock->getImage(),
		);
	}

	public function testItAllowsANullYouTubeLink(): void
	{
		$mock = $this->getMockForAbstractClass(AbstractMeetup::class);

		$this->assertNull($mock->getYouTubeLink());
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
