<?php

declare(strict_types=1);

namespace Tests\Builder\Watcher;

use MergePHP\Website\Builder\Watcher\FileWatcher;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class FileWatcherTest extends TestCase
{
	private vfsStreamDirectory $root;

	protected function setUp(): void
	{
		$this->root = vfsStream::setup('root', null, [
			'src' => [
				'File1.php' => '<?php // file 1',
				'File2.php' => '<?php // file 2',
				'SubDir' => [
					'Nested.php' => '<?php // nested',
				],
			],
			'templates' => [
				'layout.twig' => '<html></html>',
			],
			'public' => [
				'style.css' => 'body {}',
			],
		]);

		parent::setUp();
	}

	public function testGetFileModTimesReturnsAllFilesInWatchedDirectories(): void
	{
		$watcher = new FileWatcher([
			vfsStream::url('root/src'),
			vfsStream::url('root/templates'),
		]);

		$modTimes = $watcher->getFileModTimes();

		$this->assertCount(4, $modTimes);
		$this->assertArrayHasKey(vfsStream::url('root/src/File1.php'), $modTimes);
		$this->assertArrayHasKey(vfsStream::url('root/src/File2.php'), $modTimes);
		$this->assertArrayHasKey(vfsStream::url('root/src/SubDir/Nested.php'), $modTimes);
		$this->assertArrayHasKey(vfsStream::url('root/templates/layout.twig'), $modTimes);
	}

	public function testGetFileModTimesReturnsIntegerTimestamps(): void
	{
		$watcher = new FileWatcher([vfsStream::url('root/src')]);

		$modTimes = $watcher->getFileModTimes();

		foreach ($modTimes as $path => $mtime) {
			$this->assertIsInt($mtime, "Modification time for $path should be an integer");
		}
	}

	public function testGetFileModTimesSkipsNonexistentDirectories(): void
	{
		$watcher = new FileWatcher([
			vfsStream::url('root/src'),
			vfsStream::url('root/nonexistent'),
		]);

		$modTimes = $watcher->getFileModTimes();

		$this->assertCount(3, $modTimes);
	}

	public function testGetFileModTimesReturnsEmptyArrayForEmptyDirectoryList(): void
	{
		$watcher = new FileWatcher([]);

		$modTimes = $watcher->getFileModTimes();

		$this->assertSame([], $modTimes);
	}

	public function testDetectChangesFindsModifiedFiles(): void
	{
		$watcher = new FileWatcher([]);

		$previous = [
			'/path/file1.php' => 1000,
			'/path/file2.php' => 2000,
		];
		$current = [
			'/path/file1.php' => 1000,
			'/path/file2.php' => 3000, // modified
		];

		$changes = $watcher->detectChanges($previous, $current);

		$this->assertCount(1, $changes);
		$this->assertContains('/path/file2.php', $changes);
	}

	public function testDetectChangesFindsAddedFiles(): void
	{
		$watcher = new FileWatcher([]);

		$previous = [
			'/path/file1.php' => 1000,
		];
		$current = [
			'/path/file1.php' => 1000,
			'/path/file2.php' => 2000, // added
		];

		$changes = $watcher->detectChanges($previous, $current);

		$this->assertCount(1, $changes);
		$this->assertContains('/path/file2.php', $changes);
	}

	public function testDetectChangesFindsRemovedFiles(): void
	{
		$watcher = new FileWatcher([]);

		$previous = [
			'/path/file1.php' => 1000,
			'/path/file2.php' => 2000,
		];
		$current = [
			'/path/file1.php' => 1000,
			// file2.php removed
		];

		$changes = $watcher->detectChanges($previous, $current);

		$this->assertCount(1, $changes);
		$this->assertContains('/path/file2.php', $changes);
	}

	public function testDetectChangesReturnsEmptyArrayWhenNoChanges(): void
	{
		$watcher = new FileWatcher([]);

		$previous = [
			'/path/file1.php' => 1000,
			'/path/file2.php' => 2000,
		];
		$current = [
			'/path/file1.php' => 1000,
			'/path/file2.php' => 2000,
		];

		$changes = $watcher->detectChanges($previous, $current);

		$this->assertSame([], $changes);
	}

	public function testDetectChangesHandlesMultipleChanges(): void
	{
		$watcher = new FileWatcher([]);

		$previous = [
			'/path/file1.php' => 1000,
			'/path/file2.php' => 2000,
			'/path/file3.php' => 3000,
		];
		$current = [
			'/path/file1.php' => 1500, // modified
			'/path/file3.php' => 3000,
			'/path/file4.php' => 4000, // added
			// file2.php removed
		];

		$changes = $watcher->detectChanges($previous, $current);

		$this->assertCount(3, $changes);
		$this->assertContains('/path/file1.php', $changes);
		$this->assertContains('/path/file2.php', $changes);
		$this->assertContains('/path/file4.php', $changes);
	}

	public function testShouldRebuildReturnsTrueWhenChangesExist(): void
	{
		$watcher = new FileWatcher([]);

		$this->assertTrue($watcher->shouldRebuild(['/path/file.php']));
	}

	public function testShouldRebuildReturnsFalseWhenNoChanges(): void
	{
		$watcher = new FileWatcher([]);

		$this->assertFalse($watcher->shouldRebuild([]));
	}

	public function testFormatChangesForDisplayShowsUpToMaxFiles(): void
	{
		$watcher = new FileWatcher([]);

		$changes = [
			'/path/file1.php',
			'/path/file2.php',
			'/path/file3.php',
		];

		$lines = $watcher->formatChangesForDisplay($changes, 5);

		$this->assertCount(3, $lines);
		$this->assertSame('  - /path/file1.php', $lines[0]);
		$this->assertSame('  - /path/file2.php', $lines[1]);
		$this->assertSame('  - /path/file3.php', $lines[2]);
	}

	public function testFormatChangesForDisplayTruncatesWithMessage(): void
	{
		$watcher = new FileWatcher([]);

		$changes = [
			'/path/file1.php',
			'/path/file2.php',
			'/path/file3.php',
			'/path/file4.php',
			'/path/file5.php',
		];

		$lines = $watcher->formatChangesForDisplay($changes, 3);

		$this->assertCount(4, $lines);
		$this->assertSame('  - /path/file1.php', $lines[0]);
		$this->assertSame('  - /path/file2.php', $lines[1]);
		$this->assertSame('  - /path/file3.php', $lines[2]);
		$this->assertSame('  ... and 2 more', $lines[3]);
	}

	public function testFormatChangesForDisplayHandlesEmptyChanges(): void
	{
		$watcher = new FileWatcher([]);

		$lines = $watcher->formatChangesForDisplay([]);

		$this->assertSame([], $lines);
	}

	public function testFormatChangesForDisplayUsesDefaultMaxDisplay(): void
	{
		$watcher = new FileWatcher([]);

		$changes = array_map(fn($i) => "/path/file$i.php", range(1, 10));

		$lines = $watcher->formatChangesForDisplay($changes);

		$this->assertCount(6, $lines); // 5 files + "and X more" message
		$this->assertSame('  ... and 5 more', $lines[5]);
	}

	public function testIntegrationWatcherDetectsNewFileCreation(): void
	{
		$watcher = new FileWatcher([vfsStream::url('root/src')]);

		$before = $watcher->getFileModTimes();

		// Add a new file
		file_put_contents(vfsStream::url('root/src/NewFile.php'), '<?php // new');

		$after = $watcher->getFileModTimes();
		$changes = $watcher->detectChanges($before, $after);

		$this->assertTrue($watcher->shouldRebuild($changes));
		$this->assertContains(vfsStream::url('root/src/NewFile.php'), $changes);
	}

	public function testIntegrationWatcherDetectsFileDeletion(): void
	{
		$watcher = new FileWatcher([vfsStream::url('root/src')]);

		$before = $watcher->getFileModTimes();

		// Delete a file
		unlink(vfsStream::url('root/src/File1.php'));

		$after = $watcher->getFileModTimes();
		$changes = $watcher->detectChanges($before, $after);

		$this->assertTrue($watcher->shouldRebuild($changes));
		$this->assertContains(vfsStream::url('root/src/File1.php'), $changes);
	}
}
