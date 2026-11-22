<?php

declare(strict_types=1);

namespace MergePHP\Website;

use JsonSerializable;

abstract class AbstractMeetup implements MeetupInterface, JsonSerializable
{
	private const string BASE_URL = 'https://www.mergephp.com';

	public function getSlug(): string
	{
		$slug = $this->getTitle();
		$slug = mb_strtolower($slug); // make lowercase
		$slug = preg_replace('/ /', '-', $slug); // replace spaces with dashes
		$slug = preg_replace('/[^a-z0-9\-]/', '-', $slug); // replace non-alphanumeric characters with dashes
		$slug = preg_replace('/-{2,}/', '-', $slug); // replace two or more consecutive dashes with a single dash
		$slug = trim($slug, '-'); // ensure the first and last character is a letter or number

		return strlen($slug) ? $slug : 'untitled';
	}

	public function getPermalink(): string
	{
		return '/meetups/' . $this->getDateTime()->format('Y/m/d') . "/{$this->getSlug()}.html";
	}

	public function getImage(): string
	{
		return '/images/placeholder.webp';
	}

	public function getImageUrl(): string
	{
		if (str_starts_with($this->getImage(), 'http')) {
			return $this->getImage();
		} else {
			return self::BASE_URL . $this->getImage();
		}
	}

	public function getYouTubeLink(): ?string
	{
		return null;
	}

	public function getPhpCTvLink(): ?string
	{
		return null;
	}

	final public function jsonSerialize(): array
	{
		return [
			'title' => $this->getTitle(),
			'permalink' => self::BASE_URL . $this->getPermalink(),
			'description' => $this->getDescription(),
			'dateTime' => $this->getDateTime()->format('c'),
			'image' => $this->getImageUrl(),
			'speakerName' => $this->getSpeakerName(),
			'speakerBio' => $this->getSpeakerBio(),
			'youTubeLink' => $this->getYouTubeLink(),
			'phpCTvLink' => $this->getPhpCTvLink(),
		];
	}
}
