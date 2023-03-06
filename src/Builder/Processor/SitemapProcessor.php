<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateTimeImmutable;
use DateTimeInterface;
use FilesystemIterator;
use MergePHP\Website\Builder\MeetupCollection;
use Psr\Log\LoggerInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use SimpleXMLElement;
use SplFileInfo;

class SitemapProcessor extends AbstractProcessor
{
	protected SimpleXMLElement $xml;

	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected MeetupCollection $meetups,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	public function run(): void
	{
		$this->logger->info('Building sitemap');
		/** @noinspection HttpUrlsUsage */
		$this->xml = simplexml_load_string('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

		$this->appendURL('/', new DateTimeImmutable(), 1, SitemapChangeFrequency::Daily);

		$x = new RecursiveDirectoryIterator($this->outputDirectory . '/meetups', FilesystemIterator::SKIP_DOTS);
		$it = new RecursiveIteratorIterator($x);
		foreach ($it as $file) {
			/** @var SplFileInfo $file */
			if (!$file->isFile()) {
				continue;
			}
			$path = str_replace($this->outputDirectory, '', $file->getPathname());
			$path = str_replace(DIRECTORY_SEPARATOR, '/', $path);
			$this->appendURL($path, new DateTimeImmutable("@{$file->getMTime()}"));
		}

		$dom = dom_import_simplexml($this->xml)->ownerDocument;
		$dom->formatOutput = true;
		if ($bytes = file_put_contents("$this->outputDirectory/sitemap.xml", $dom->saveXML())) {
			$this->logger->info("Wrote $bytes bytes to sitemap.xml");

			if (@simplexml_load_file("$this->outputDirectory/sitemap.xml")) {
				$this->logger->debug('Verified sitemap.xml contains valid XML');
			} else {
				throw new RuntimeException('sitemap.xml contains invalid XML');
			}
		} else {
			throw new RuntimeException('Could not save sitemap.xml');
		}
	}

	protected function appendURL(
		string $path,
		DateTimeInterface $lastModified,
		float $priority = 0.5,
		SitemapChangeFrequency $changeFrequency = SitemapChangeFrequency::Weekly,
	): void {
		$url = $this->xml->addChild('url');
		$url->addChild('loc', 'https://www.mergephp.com' . $path);
		$url->addChild('lastmod', $lastModified->format('c'));
		$url->addChild('changefreq', $changeFrequency->value);
		$url->addChild('priority', (string)round($priority, 1));
	}
}
