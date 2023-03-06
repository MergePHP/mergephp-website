<?php

declare(strict_types=1);

namespace MergePHP\Website;

abstract class AbstractMeetup implements MeetupInterface
{
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

	public function getYouTubeLink(): ?string
	{
		return null;
	}

	public function getMeetupLinks(): array
	{
		return [];
	}
}
