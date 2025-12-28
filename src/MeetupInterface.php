<?php

declare(strict_types=1);

namespace MergePHP\Website;

use DateTimeImmutable;

/**
 * Interface for meetup implementations.
 * Defines the contract for all meetup data classes.
 */
interface MeetupInterface
{
	/**
	 * Get the meetup title.
	 *
	 * @return string The title
	 */
	public function getTitle(): string;

	/**
	 * Get the meetup description (markdown supported).
	 *
	 * @return string The description
	 */
	public function getDescription(): string;

	/**
	 * Get the meetup date and time.
	 *
	 * @return DateTimeImmutable The date and time
	 */
	public function getDateTime(): DateTimeImmutable;

	/**
	 * Get the image path or URL for the meetup.
	 *
	 * @return string The image path or URL
	 */
	public function getImage(): string;

	/**
	 * Get the speaker's name.
	 *
	 * @return string The speaker name
	 */
	public function getSpeakerName(): string;

	/**
	 * Get the speaker's bio (markdown supported).
	 *
	 * @return string The speaker bio
	 */
	public function getSpeakerBio(): string;

	/**
	 * Get the YouTube link for the meetup recording.
	 *
	 * @return string|null The YouTube URL, or null if not available
	 */
	public function getYouTubeLink(): ?string;

	/**
	 * Get links to meetup event pages.
	 *
	 * @return array Array of meetup links
	 */
	public function getMeetupLinks(): array;
}
