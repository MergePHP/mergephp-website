<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateTimeImmutable;
use League\CommonMark\CommonMarkConverter;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Exception\InvalidContentException;
use Psr\Log\LoggerInterface;
use RuntimeException;

use function str_contains;

class RSSFeedProcessor extends AbstractProcessor
{
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected MeetupCollection $meetups,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	public function run(): void
	{
		$this->logger->info('Building RSS feed');
		$converter = new CommonMarkConverter();
		$xml = simplexml_load_string('<feed xmlns="http://www.w3.org/2005/Atom" />');
		$xml->addChild('title', 'MergePHP RSS Feed');
		$link = $xml->addChild('link');
		$link->addAttribute('href', 'https://www.mergephp.com/atom.xml');
		$link->addAttribute('rel', 'self');
		$xml->addChild('link')->addAttribute('href', 'https://www.mergephp.com/');
		$xml->addChild('updated', (new DateTimeImmutable())->format('c'));
		$xml->addChild('id', 'https://www.mergephp.com/');
		$xml->addChild('icon', 'https://www.mergephp.com/icons/android-chrome-512x512.png');
		$xml->addChild('logo', 'https://www.mergephp.com/icons/android-chrome-512x512.png');
		$xml->addChild('subtitle', 'MergePHP slogan goes here');
		foreach ($this->meetups as $meetup) {
			$entry = $xml->addChild('entry');
			$entry->addChild('title', htmlspecialchars($meetup->instance->getTitle(), ENT_XML1, 'UTF-8'));
			$link = $entry->addChild('link');
			$link->addAttribute('href', 'https://www.mergephp.com' . $meetup->instance->getPermalink());
			$entry->addChild('author')->addChild('name', $meetup->instance->getSpeakerName());
			$entry->addChild('published', $meetup->instance->getDateTime()->format('c'));
			$entry->addChild('updated', $meetup->modifiedTimestamp->format('c'));
			$entry->addChild('id', 'https://www.mergephp.com' . $meetup->instance->getPermalink());
			$description = $converter->convert($meetup->instance->getDescription());
			if (str_contains((string)$description, '<pre>')) {
				/** @noinspection PhpUnhandledExceptionInspection */
				throw InvalidContentException::create($meetup->instance::class);
			}
			$description = trim(str_replace("\n", ' ', (string)$description));
			$content = $entry->addChild('content', htmlspecialchars($description, ENT_XML1, 'UTF-8'));
			$content->addAttribute('type', 'html');
		}

		if ($xml->saveXML("$this->outputDirectory/atom.xml")) {
			$this->logger->info('Saved atom.xml');

			if (@simplexml_load_file("$this->outputDirectory/atom.xml")) {
				$this->logger->debug('Verified atom.xml contains valid XML');
			} else {
				throw new RuntimeException('atom.xml contains invalid XML');
			}
		} else {
			throw new RuntimeException('Could not save atom.xml');
		}
	}
}
