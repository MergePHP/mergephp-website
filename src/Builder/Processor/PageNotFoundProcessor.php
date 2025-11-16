<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use Psr\Log\LoggerInterface;
use Twig\Environment;

/**
 * Processor that generates the 404 error page.
 */
class PageNotFoundProcessor extends HTMLProcessor
{
	/**
	 * @param LoggerInterface $logger Logger for build output
	 * @param string $outputDirectory Directory where built files are written
	 * @param Environment $twig Twig template environment
	 * @param array $twigData Common data to pass to all Twig templates
	 */
	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected Environment $twig,
		protected array $twigData,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	/**
	 * Generate the 404 error page.
	 */
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
