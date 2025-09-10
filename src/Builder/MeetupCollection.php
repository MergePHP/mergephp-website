<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use ArrayAccess;
use Countable;
use DateTimeImmutable;
use DateTimeZone;
use Iterator;
use MergePHP\Website\Exception\NotImplementedException;

class MeetupCollection implements Iterator, Countable, ArrayAccess
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

	public function offsetExists(mixed $offset): bool
	{
		return array_key_exists($offset, $this->array);
	}

	public function offsetGet(mixed $offset): ?MeetupEntry
	{
		return $this->array[$offset] ?? null;
	}

	public function offsetSet(mixed $offset, mixed $value): void
	{
		throw new NotImplementedException('Setting values directly is not allowed');
	}

	public function offsetUnset(mixed $offset): void
	{
		throw new NotImplementedException('Unsetting values directly is not allowed');
	}
}
