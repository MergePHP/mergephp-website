<?php

declare(strict_types=1);

namespace Tests\Generator;

use MergePHP\Website\Generator\MeetupGeneratorCommand;
use MergePHP\Website\Generator\MeetupGeneratorResponse;
use MergePHP\Website\Generator\MeetupGeneratorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class MeetupGeneratorCommandTest extends TestCase
{
	// generate args simulate what the user types in to the command line
	private const array GENERATE_1_ARGS  = ['Title', 'Description', null        , 'Name', 'Bio', null];
	private const array GENERATE_2_ARGS  = ['Title', 'Description', '2023-01-01', 'Name', 'Bio', null];
	private const array GENERATE_3_ARGS  = [
		'Title',
		'Description',
		'2023-01-01',
		'Name',
		'Bio',
		'https://example.com/f.jpg'
	];
	// command args are what the generator command expects to be called with given a certain set of generate args
	private const array COMMAND_1_2_ARGS = ['Title', 'Description', '2023-01-01', 'Name', 'Bio', null];
	private const array COMMAND_3_ARGS   = [
		'Title',
		'Description',
		'2023-01-01',
		'Name',
		'Bio',
		'https://example.com/f.jpg'
	];

	private CommandTester $commandTester;

	public function setUp(): void
	{
		if (PHP_OS_FAMILY == 'Windows') {
			$this->markTestSkipped('This test can\'t run on Windows :(');
		}

		$response = new MeetupGeneratorResponse('foo', 123);
		$service = $this->createMock(MeetupGeneratorService::class);
		$service->method('getSuggestedDate')->willReturn('2023-01-01');
		$service->method('generate')->will(
			$this->returnValueMap(
				[
					// arg1, arg2, arg3, arg4, arg5, arg6, return
					[...self::COMMAND_1_2_ARGS, $response],
					[...self::COMMAND_3_ARGS, $response],
				]
			)
		);

		$application = new Application();
		$command = new MeetupGeneratorCommand($service);
		$application->add($command);
		$this->commandTester = new CommandTester($command);
	}

	public function testItPromptsFor5InputsAllowingNullDateAndImage(): void
	{
		$this->commandTester->setInputs(self::GENERATE_1_ARGS);

		$exitCode = $this->commandTester->execute([], ['interactive' => true]);

		$actual = trim($this->commandTester->getDisplay());
		// phpcs:ignore
		$expected = "Title: Description (markdown OK): Date: [2023-01-01]: Speaker name: Speaker bio (markdown OK): Image URL [none]: Wrote 123 bytes to foo";
		$this->assertEquals($expected, $actual);
		$this->assertSame(0, $exitCode);
	}

	public function testItPromptsFor5InputsAllowingNullImage(): void
	{
		$this->commandTester->setInputs(self::GENERATE_2_ARGS);

		$exitCode = $this->commandTester->execute([], ['interactive' => true]);

		$actual = trim($this->commandTester->getDisplay());
		// phpcs:ignore
		$expected = "Title: Description (markdown OK): Date: [2023-01-01]: Speaker name: Speaker bio (markdown OK): Image URL [none]: Wrote 123 bytes to foo";
		$this->assertEquals($expected, $actual);
		$this->assertSame(0, $exitCode);
	}

	public function testItPromptsFor5InputsAndAcceptsStringsForEach(): void
	{
		$this->commandTester->setInputs(self::GENERATE_3_ARGS);

		$exitCode = $this->commandTester->execute([], ['interactive' => true]);

		$actual = trim($this->commandTester->getDisplay());
		// phpcs:ignore
		$expected = "Title: Description (markdown OK): Date: [2023-01-01]: Speaker name: Speaker bio (markdown OK): Image URL [none]: Wrote 123 bytes to foo";
		$this->assertEquals($expected, $actual);
		$this->assertSame(0, $exitCode);
	}
}
