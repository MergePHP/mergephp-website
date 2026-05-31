<?php

declare(strict_types=1);

namespace MergePHP\Website;

use DateTimeZone;

class Groups
{
	/**
	 * @return Group[]
	 */
	public static function all(): array
	{
		return [
			new Group(
				'Atlanta',
				new DateTimeZone('America/New_York'),
				'https://www.meetup.com/atlantaphp/',
			),
			new Group(
				'Austin',
				new DateTimeZone('America/Chicago'),
				'https://www.meetup.com/austinphp/',
			),
			new Group(
				'Boston',
				new DateTimeZone('America/New_York'),
				'https://www.meetup.com/bostonphp/',
			),
			new Group(
				'Kansas City',
				new DateTimeZone('America/Chicago'),
				'https://www.meetup.com/kcphpug/',
			),
			new Group(
				'Las Vegas',
				new DateTimeZone('America/Los_Angeles'),
				'https://www.meetup.com/vegas-programmers/',
			),
			new Group(
				'Portland',
				new DateTimeZone('America/Los_Angeles'),
				'https://www.meetup.com/pdx-php/',
			),
			new Group(
				'San Diego',
				new DateTimeZone('America/Los_Angeles'),
				'https://www.meetup.com/sandiegophp/',
			),
			new Group(
				'Seattle',
				new DateTimeZone('America/Los_Angeles'),
				'https://www.meetup.com/seaphp/',
			),
			new Group(
				'Utah',
				new DateTimeZone('America/Denver'),
				'https://www.meetup.com/utah-php-user-group/',
			),
		];
	}
}
