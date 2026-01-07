<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use Countable;
use DateTimeImmutable;
use DateTimeZone;
use Iterator;

/**
 * Collection of meetup entries with iterator and filtering capabilities.
 */
class MeetupCollection implements Iterator, Countable
{
	/** @var MeetupEntry[] Array of meetup entries */
	private array $array = [];

	/** @var int Current iterator position */
	private int $pointer = 0;

	/**
	 * Sort meetups by date and set up next/previous links.
	 */
	public function sort(): void
	{
		usort($this->array, function (MeetupEntry $a, MeetupEntry $b) {
			return $a->instance->getDateTime() <=> $b->instance->getDateTime();
		});

		for ($i = 0; $i < count($this->array); $i++) {
			$this->array[$i]->previous = $this->array[$i - 1] ?? null;
			$this->array[$i]->next = $this->array[$i + 1] ?? null;
		}
	}

	/**
	 * Get the current meetup entry.
	 *
	 * @return MeetupEntry Current entry
	 */
	public function current(): MeetupEntry
	{
		return $this->array[$this->pointer];
	}

	/**
	 * Move to the next meetup entry.
	 */
	public function next(): void
	{
		$this->pointer++;
	}

	/**
	 * Get the current iterator key.
	 *
	 * @return int Current position
	 */
	public function key(): int
	{
		return $this->pointer;
	}

	/**
	 * Check if the current position is valid.
	 *
	 * @return bool True if position is valid
	 */
	public function valid(): bool
	{
		return array_key_exists($this->pointer, $this->array);
	}

	/**
	 * Reset iterator to the beginning.
	 */
	public function rewind(): void
	{
		$this->pointer = 0;
	}

	/**
	 * Get the number of meetups in the collection.
	 *
	 * @return int Number of meetups
	 */
	public function count(): int
	{
		return count($this->array);
	}

	/**
	 * Add a meetup entry to the collection.
	 *
	 * @param MeetupEntry $meetup The meetup entry to add
	 */
	public function append(MeetupEntry $meetup): void
	{
		$this->array[] = $meetup;
	}

	/**
	 * @return MeetupEntry[]
	 * @noinspection PhpDocMissingThrowsInspection
	 */
	public function withOnlyPast(): array
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		$NOW = new DateTimeImmutable('now', new DateTimeZone('America/New_York'));
		return array_filter($this->array, (function (MeetupEntry $meetupEntry) use ($NOW) {
			return $meetupEntry->instance->getDateTime() < $NOW;
		}));
	}

	/**
	 * @return MeetupEntry[]
	 * @noinspection PhpDocMissingThrowsInspection
	 */
	public function withOnlyFuture(): array
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		$NOW = new DateTimeImmutable('now', new DateTimeZone('America/New_York'));
		return array_filter($this->array, (function (MeetupEntry $meetupEntry) use ($NOW) {
			return $meetupEntry->instance->getDateTime() > $NOW;
		}));
	}
}
