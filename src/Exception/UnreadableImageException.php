<?php

declare(strict_types=1);

namespace MergePHP\Website\Exception;

use Exception;

class UnreadableImageException extends Exception
{
	public static function create(string $filename, string $className): UnreadableImageException
	{
		return new self(sprintf("Unable to read %s (defined in %s)", $filename, $className));
	}
}
