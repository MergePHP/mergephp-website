<?php

declare(strict_types=1);

namespace MergePHP\Website\Generator;

/**
 * Response object containing information about a generated meetup file.
 */
class MeetupGeneratorResponse
{
	/**
	 * @param string $filename Path to the generated file
	 * @param int $bytesWritten Number of bytes written to the file
	 */
	public function __construct(
		public readonly string $filename,
		public readonly int $bytesWritten,
	) {
	}
}
