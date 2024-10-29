<?php

declare(strict_types=1);

namespace Tests\Builder\Processor;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use MergePHP\Website\Builder\Processor\SitemapProcessor;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class SitemapProcessorTest extends TestCase
{
	private const string FIXTURES_DIR = __DIR__ . '/../../fixtures/';

	private FrozenClock $clock;

	public function setUp(): void
	{
		vfsStream::setup();
		mkdir('vfs://root/meetups/');

		$this->clock = new FrozenClock(new DateTimeImmutable('2000-01-01 00:00:00', new \DateTimeZone('UTC')));

		parent::setUp();
	}

	public function testItGeneratesASitemapWithJustTheHomepage(): void
	{
		$processor = new SitemapProcessor(new NullLogger(), 'vfs://root', $this->clock);
		$processor->run();

		/** @noinspection PhpUnitMisorderedAssertEqualsArgumentsInspection because they are ordered correctly */
		$this->assertFileEquals(self::FIXTURES_DIR . 'sitemap_no_image.xml', 'vfs://root/sitemap.xml');
	}

	public function testItGeneratesASitemapExtractingTheImageFromAPage(): void
	{

		$processor = new SitemapProcessor(new NullLogger(), 'vfs://root', $this->clock);
		mkdir(directory: 'vfs://root/meetups/2000/01/01/', recursive: true);
		/** @noinspection HtmlRequiredTitleElement */
		file_put_contents(
			filename: 'vfs://root/meetups/2000/01/01/test.html',
			data: '<head><meta property="og:image" content="https://www.mergephp.com/images/example.png"></head>'
		);
		$at = gmdate('c');
		$processor->run();

		$this->assertFileExists('vfs://root/sitemap.xml');
		$this->assertStringContainsString("<url>
    <loc>https://www.mergephp.com/meetups/2000/01/01/test.html</loc>
    <lastmod>$at</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.5</priority>
    <image xmlns=\"image\">
      <loc>https://www.mergephp.com/images/example.png</loc>
    </image>
  </url>
", file_get_contents('vfs://root/sitemap.xml'));
	}
}
