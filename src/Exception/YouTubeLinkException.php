<?php

declare(strict_types=1);

namespace MergePHP\Website\Exception;

use Exception;

class YouTubeLinkException extends Exception
{
	public static function create(string $link, string $className): YouTubeLinkException
	{
		return new self(sprintf("%s is not a valid YouTube video link in %s", $link, $className));
	}
}
