<?php

declare(strict_types=1);

namespace MergePHP\Website\Exception;

use Exception;

class ImageLinkException extends Exception
{
	public static function create(string $link, string $className): ImageLinkException
	{
		return new self(sprintf("Image %s does not exist (defined in %s)", $link, $className));
	}
}
