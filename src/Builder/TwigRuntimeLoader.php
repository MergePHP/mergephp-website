<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use RuntimeException;
use Twig\Extra\Markdown\DefaultMarkdown;
use Twig\Extra\Markdown\MarkdownRuntime;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

/**
 * Runtime loader for Twig extensions, specifically for Markdown support.
 */
class TwigRuntimeLoader implements RuntimeLoaderInterface
{
	/**
	 * Load a runtime class for Twig.
	 *
	 * @param string $class The class name to load
	 * @return MarkdownRuntime The runtime instance
	 * @throws RuntimeException If the class is not supported
	 */
	public function load($class): MarkdownRuntime
	{
		if (MarkdownRuntime::class === $class) {
			return new MarkdownRuntime(new DefaultMarkdown());
		}

		throw new RuntimeException("Unknown class $class");
	}
}
