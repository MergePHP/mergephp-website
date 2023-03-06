<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use RuntimeException;
use Twig\Extra\Markdown\DefaultMarkdown;
use Twig\Extra\Markdown\MarkdownRuntime;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{
	public function load($class): MarkdownRuntime
	{
		if (MarkdownRuntime::class === $class) {
			return new MarkdownRuntime(new DefaultMarkdown());
		}

		throw new RuntimeException("Unknown class $class");
	}
}
