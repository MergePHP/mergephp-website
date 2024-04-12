<?php

declare(strict_types=1);

namespace Tests\Generator;

use MergePHP\Website\Generator\MeetupGeneratorService;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class MeetupGeneratorServiceTest extends TestCase
{
	private MeetupGeneratorService $generator;
	private const string FIXTURES_DIR = __DIR__ . '/../fixtures/';

	public function setUp(): void
	{
		$this->directory = vfsStream::setup();
		$this->generator = new MeetupGeneratorService($this->directory->url());
		parent::setUp();
	}

	public function testItGeneratesTheFirstThursdayOfTheCurrentMonthWhenRunBeforeTheSecondThursdayOfTheMonth(): void
	{
		$date = $this->generator->getSuggestedDate('January 1, 2023');
		$this->assertEquals('2023-01-12', $date);
	}

	public function testItGeneratesADateNextMonthWhenRunAfterTheSecondThursdayOfTheMonth(): void
	{
		$date = $this->generator->getSuggestedDate('January 13, 2023');
		$this->assertEquals('2023-02-09', $date);
	}

	public function testItGeneratesAFileWithAllRequiredInputsSpecified(): void
	{
		$expectedFilename = 'Meetup20230101Title.php';
		$expectedFilenameAndPath = "vfs://root/$expectedFilename";
		$response = $this->generator->generate('Title', 'Description', '2023-01-01', 'Speaker', 'Bio');
		$this->assertEquals(672, $response->bytesWritten);
		$this->assertEquals($expectedFilenameAndPath, $response->filename);
		$this->assertFileEqualsCanonicalizing(
			self::FIXTURES_DIR . $expectedFilename . '.txt',
			$expectedFilenameAndPath,
		);
	}

	public function testItGeneratesAFileWithAllInputsSpecified(): void
	{
		$expectedFilename = 'Meetup20220101Title.php';
		$expectedFilenameAndPath = "vfs://root/$expectedFilename";
		$response = $this->generator->generate(
			'Title',
			'Description',
			'January 1, 2022',
			'Speaker',
			'Bio',
			'https://www.example.com/image.jpg',
		);
		$this->assertEquals(761, $response->bytesWritten);
		$this->assertEquals($expectedFilenameAndPath, $response->filename);
		$this->assertFileEqualsCanonicalizing(
			self::FIXTURES_DIR . $expectedFilename . '.txt',
			$expectedFilenameAndPath,
		);
	}

	public function testItGeneratesAFileWithAllInputsSpecifiedAndALongImageName(): void
	{
		$expectedFilename = 'Meetup20221231MultipleWordTitle.php';
		$expectedFilenameAndPath = "vfs://root/$expectedFilename";
		$response = $this->generator->generate(
			'Multiple Word Title',
			'Multiple word description',
			'December 31, 2022',
			'Speaker Name',
			'Speaker biography',
			// phpcs:ignore
			'https://www.example.com/this/entire/url/is/greater/than/102/characters/which/normally/makes/phpcs/unhappy.jpg',
		);

		$this->assertEquals(914, $response->bytesWritten);
		$this->assertEquals($expectedFilenameAndPath, $response->filename);
		$this->assertFileEqualsCanonicalizing(
			self::FIXTURES_DIR . $expectedFilename . '.txt',
			$expectedFilenameAndPath,
		);
	}
}
