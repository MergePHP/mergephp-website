<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;

class MeetupEntry
{
	public ?MeetupEntry $next;
	public ?MeetupEntry $previous;

	public function __construct(
		public readonly AbstractMeetup $instance,
		public readonly DateTimeImmutable $modifiedTimestamp,
	) {
	}
}
