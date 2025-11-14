<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
	name: 'build',
	description: 'Build the site',
)]
class SiteBuilderCommand extends Command
{
	public function __construct(protected string $outputDirectory)
	{
		parent::__construct();
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$logger = new ConsoleLogger($output);
		$builder = new SiteBuilderService($this->outputDirectory, $logger);
		$builder->build();

		return $logger->hasErrored() ? Command::FAILURE : Command::SUCCESS;
	}
}
