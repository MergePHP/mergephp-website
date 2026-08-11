<?php

declare(strict_types=1);

namespace MergePHP\Website\Exception;

use Exception;

class PhpCTvLinkException extends Exception
{
	public static function create(string $link, string $className): PhpCTvLinkException
	{
		return new self(sprintf("%s is not a valid phpc.tv video link in %s", $link, $className));
	}
}
