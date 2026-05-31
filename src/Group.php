<?php

declare(strict_types=1);

namespace MergePHP\Website;

use DateTimeZone;

final readonly class Group
{
	public function __construct(
		public string $name,
		public DateTimeZone $timezone,
		public string $url,
	) {
	}

	public function timezoneLabel(): string
	{
		return match ($this->timezone->getName()) {
			'America/New_York' => 'Eastern (ET)',
			'America/Chicago' => 'Central (CT)',
			'America/Denver' => 'Mountain (MT)',
			'America/Los_Angeles' => 'Pacific (PT)',
			default => $this->timezone->getName(),
		};
	}
}
