<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateTimeImmutable;
use MergePHP\Website\Groups;
use Psr\Log\LoggerInterface;
use Twig\Environment;

class GroupsPageProcessor extends HTMLProcessor
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
		$this->logger->info('Building affiliated groups page');

		$data = array_merge($this->twigData, [
			'groups' => Groups::all(),
		]);

		/** @noinspection PhpUnhandledExceptionInspection */
		$html = $this->twig->render('groups.twig.html', $data);
		$this->writeHtml($html, 'groups/index.html', new DateTimeImmutable());
	}
}
