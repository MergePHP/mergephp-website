<?php

declare(strict_types=1);

namespace MergePHP\Website\Generator;

class MeetupGeneratorResponse
{
	public function __construct(
		public readonly string $filename,
		public readonly int $bytesWritten,
	) {
	}
}
