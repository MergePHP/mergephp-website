<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use Psr\Log\LoggerInterface;
use Twig\Environment;

class PageNotFoundProcessor extends HTMLProcessor
{
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected Environment $twig,
		protected array $twigData,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	public function run(): void
	{
		$this->logger->info('Building 404 page');

		$data = array_merge($this->twigData, [
			'title' => 404,
		]);

		/** @noinspection PhpUnhandledExceptionInspection */
		$html = $this->twig->render('404.twig.html', $data);
		$this->writeHtml($html, '404.html');
	}
}
