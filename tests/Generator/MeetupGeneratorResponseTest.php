<?php

declare(strict_types=1);

namespace Tests\Generator;

use MergePHP\Website\Generator\MeetupGeneratorResponse;
use PHPUnit\Framework\TestCase;

class MeetupGeneratorResponseTest extends TestCase
{
	public function testItContainsTwoSettableProperties(): void
	{
		$response = new MeetupGeneratorResponse('foo', 123);
		$this->assertSame('foo', $response->filename);
		$this->assertSame(123, $response->bytesWritten);
	}
}
