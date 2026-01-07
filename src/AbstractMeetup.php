<?php

declare(strict_types=1);

namespace MergePHP\Website;

/**
 * Abstract base class for meetup implementations.
 * Provides default implementations for common meetup functionality.
 */
abstract class AbstractMeetup implements MeetupInterface
{
	/**
	 * Generate a URL-friendly slug from the meetup title.
	 *
	 * @return string The slug, or 'untitled' if the title produces an empty slug
	 */
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

	/**
	 * Get the permalink URL for this meetup.
	 *
	 * @return string The permalink path
	 */
	public function getPermalink(): string
	{
		return '/meetups/' . $this->getDateTime()->format('Y/m/d') . "/{$this->getSlug()}.html";
	}

	/**
	 * Get the image path for this meetup.
	 *
	 * @return string The image path, defaults to placeholder
	 */
	public function getImage(): string
	{
		return '/images/placeholder.webp';
	}

	/**
	 * Get the full URL for the meetup image.
	 * If the image path is already a full URL, returns it as-is.
	 * Otherwise, prepends the base URL.
	 *
	 * @return string The full image URL
	 */
	public function getImageUrl(): string
	{
		if (str_starts_with($this->getImage(), 'http')) {
			return $this->getImage();
		} else {
			return 'https://www.mergephp.com' . $this->getImage();
		}
	}

	/**
	 * Get the YouTube link for this meetup.
	 *
	 * @return string|null The YouTube URL, or null if not available
	 */
	public function getYouTubeLink(): ?string
	{
		return null;
	}

	/**
	 * Get links to meetup event pages.
	 *
	 * @return array Array of meetup links
	 */
	public function getMeetupLinks(): array
	{
		return [];
	}
}
