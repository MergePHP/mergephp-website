<?php

declare(strict_types=1);

namespace MergePHP\Website\Exception;

use Exception;

class InvalidContentException extends Exception
{
	public static function create(string $className): InvalidContentException
	{
		return new self(sprintf(
			"The description for %s contains a <pre> tag but probably shouldn't.  Did you use HEREDOC syntax?",
			$className,
		));
	}
}
