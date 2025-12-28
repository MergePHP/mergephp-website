<?php

declare(strict_types=1);

namespace MergePHP\Website\Exception;

use Exception;

/**
 * Exception thrown when meetup content contains invalid markup (e.g., <pre> tags from HEREDOC).
 */
class InvalidContentException extends Exception
{
	/**
	 * Create an exception for a meetup class with invalid content.
	 *
	 * @param string $className The name of the meetup class with invalid content
	 * @return InvalidContentException The exception instance
	 */
	public static function create(string $className): InvalidContentException
	{
		return new self(sprintf(
			"The description for %s contains a <pre> tag but probably shouldn't.  Did you use HEREDOC syntax?",
			$className,
		));
	}
}
