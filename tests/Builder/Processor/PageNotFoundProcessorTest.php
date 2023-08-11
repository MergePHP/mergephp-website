<?php

declare(strict_types=1);

namespace Tests\Builder\Processor;

use MergePHP\Website\Builder\Processor\PageNotFoundProcessor;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class PageNotFoundProcessorTest extends TestCase
{
	public function setUp(): void
	{
		$this->directory = vfsStream::setup();
		parent::setUp();
	}

	public function testItGeneratesA404Page(): void
	{
		$environment = new Environment(new ArrayLoader(['404.twig.html' => '404']));
		$processor = new PageNotFoundProcessor(new NullLogger(), "vfs://root/", $environment, []);
		$processor->run();

		$this->assertFileExists('vfs://root/404.html');
		$this->assertStringContainsString('404', file_get_contents('vfs://root/404.html'));
	}
}
