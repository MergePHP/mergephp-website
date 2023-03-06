<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use Countable;
use DateTimeImmutable;
use DateTimeZone;
use Iterator;

class MeetupCollection implements Iterator, Countable
{
	/** @var MeetupEntry[] */
	private array $array = [];
	private int $pointer = 0;

	public function sort(): void
	{
		usort($this-> array, function (MeetupEntry $a, MeetupEntry $b) {
			return $a->instance->getDateTime() <=> $b->instance->getDateTime();
		});

		for ($i = 0; $i < count($this->array); $i++) {
			$this->array[$i]->previous = $this->array[$i - 1] ?? null;
			$this->array[$i]->next = $this->array[$i + 1] ?? null;
		}
	}

	public function current(): MeetupEntry
	{
		return $this->array[$this->pointer];
	}

	public function next(): void
	{
		$this->pointer++;
	}

	public function key(): int
	{
		return $this->pointer;
	}

	public function valid(): bool
	{
		return array_key_exists($this->pointer, $this->array);
	}

	public function rewind(): void
	{
		$this->pointer = 0;
	}

	public function count(): int
	{
		return count($this->array);
	}

	public function append(MeetupEntry $meetup)
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
