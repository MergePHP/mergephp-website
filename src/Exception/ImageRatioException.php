<?php

declare(strict_types=1);

namespace MergePHP\Website\Exception;

use Exception;

class ImageRatioException extends Exception
{
	public static function create(string $filename, string $className, string $ratio): ImageRatioException
	{
		return new self(sprintf('%s in %s is the wrong ratio; must be %s', $filename, $className, $ratio));
	}
}
