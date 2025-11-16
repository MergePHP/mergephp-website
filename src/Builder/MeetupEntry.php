<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;

/**
 * Represents a meetup entry with its metadata and navigation links.
 */
class MeetupEntry
{
	/** @var MeetupEntry|null The next meetup in chronological order */
	public ?MeetupEntry $next;

	/** @var MeetupEntry|null The previous meetup in chronological order */
	public ?MeetupEntry $previous;

	/**
	 * @param AbstractMeetup $instance The meetup instance
	 * @param DateTimeImmutable $modifiedTimestamp When the meetup file was last modified
	 */
	public function __construct(
		public readonly AbstractMeetup $instance,
		public readonly DateTimeImmutable $modifiedTimestamp,
	) {
	}

	/**
	 * Get the short class name of the meetup instance.
	 *
	 * @return string The class name without namespace
	 */
	public function getClassName(): string
	{
		return (new \ReflectionClass($this->instance))->getShortName();
	}
}
