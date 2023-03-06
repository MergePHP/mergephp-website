<?php

declare(strict_types=1);

namespace MergePHP\Website\Generator;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\MissingInputException;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
	name: 'generate',
	description: 'Generate a new Meetup instance',
)]
class MeetupGeneratorCommand extends Command
{
	public function __construct(protected MeetupGeneratorService $meetupGeneratorService)
	{
		parent::__construct();
	}

	protected function configure(): void
	{
		$this->setHelp('This command will prompt for input and generate a new Meetup instance');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$helper = $this->getHelper('question');
		/** @var QuestionHelper $helper */
		$suggestedDate = $this->meetupGeneratorService->getSuggestedDate();

		try {
			$title = $helper->ask($input, $output, new Question('Title: '));
		} catch (MissingInputException $e) {
			// Windows will throw if the command is run through Composer
			return $this->handleFirstMissingInputException($e, $output, $input->isInteractive());
		}

		$response = $this->meetupGeneratorService->generate(
			title: $title,
			description: $helper->ask($input, $output, new Question('Description (markdown OK): ')),
			date: $helper->ask($input, $output, new Question("Date: [$suggestedDate]: ", $suggestedDate)),
			speakerName: $helper->ask($input, $output, new Question('Speaker name: ')),
			speakerBio: $helper->ask($input, $output, new Question('Speaker bio (markdown OK): ')),
			image: $helper->ask($input, $output, new Question('Image URL [none]: ', null)),
		);

		$output->writeln("Wrote $response->bytesWritten bytes to $response->filename\n");
		return Command::SUCCESS;
	}

	protected function handleFirstMissingInputException(
		MissingInputException $e,
		OutputInterface $output,
		bool $isInteractive,
	): int {
		if (PHP_OS_FAMILY === 'Windows' && !$isInteractive) {
			$output->writeln('<error>Sorry, due to a bug in composer this command cannot be run this way</error>');
			$output->writeln('Run `<info>php console.php generate</info>` from the project root instead');
			return Command::FAILURE;
		}
		throw $e;
	}
}
