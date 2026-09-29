<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

use DateTimeImmutable;
use MergePHP\Website\AbstractMeetup;
use MergePHP\Website\Builder\MeetupCollection;
use MergePHP\Website\Exception\ImageLinkException;
use MergePHP\Website\Exception\ImageRatioException;
use MergePHP\Website\Exception\ImageSizeException;
use MergePHP\Website\Exception\ImageSizeProblem;
use MergePHP\Website\Exception\UnreadableImageException;
use Psr\Log\LoggerInterface;

/**
 * Validates that meetup images exist locally and meet minimum (meetup.com) and maximums (YouTube thumbnails)
 * @link https://help.meetup.com/hc/en-us/articles/360002879831-Why-can-t-I-upload-a-photo-to-my-group-or-profile
 * @link https://support.google.com/youtube/answer/72431#zippy=%2Cimage-size-resolution
 */
class ImageLinkProcessor extends HTMLProcessor
{
	protected const int MAXIMUM_HEIGHT = 2160;
	protected const int MAXIMUM_WIDTH = 3840;
	protected const int MINIMUM_HEIGHT = 675;
	protected const int MINIMUM_WIDTH = 1200;
	protected const string RATIO_ENFORCEMENT_DATE = '2026-03-01';
	protected const string IMAGE_PATH_REGEX = '/^\/images\/[^\/]+$/';
	protected const string RATIO = '16:9';

	public function __construct(
		protected LoggerInterface $logger,
		protected string $outputDirectory,
		protected MeetupCollection $meetups,
	) {
		parent::__construct($logger, $this->outputDirectory);
	}

	public function run(): void
	{
		$this->logger->info('Checking for missing image files and image dimensions');
		foreach ($this->meetups as $meetup) {
			$this->checkImagePath($meetup->instance);
			$this->checkImageDimension($meetup->instance);
		}
	}

	protected function checkImagePath(AbstractMeetup $meetup): void
	{
		$image = $meetup->getImage();
		if (str_starts_with($image, 'http')) {
			$this->logger->info(sprintf(
				'%s contains an external image and may or may not exist on the remote server',
				$meetup::class,
			));
		} elseif (preg_match(self::IMAGE_PATH_REGEX, $image)) {
			if (!file_exists($this->outputDirectory . $image)) {
				throw ImageLinkException::create($image, $meetup::class);
			}
		} else {
			$this->logger->warning(
				$meetup::class . ' contains an image which may not exist or is referenced incorrectly'
			);
		}
	}

	protected function checkImageDimension(AbstractMeetup $meetup): void
	{
		$image = $meetup->getImage();
		if (str_starts_with($image, 'http')) {
			$this->logger->warning('Remote image on ' . $meetup::class . ' will not be checked');
			return;
		} elseif (!preg_match(self::IMAGE_PATH_REGEX, $image)) {
			$this->logger->warning(sprintf(
				'Image %s on %s uses a nonstandard path and will not have its dimensions checked',
				$image,
				$meetup::class,
			));
			return;
		}

		@$info = getimagesize($this->outputDirectory . $image);

		if ($info === false) {
			throw UnreadableImageException::create($image, $meetup::class);
		}

		[$width, $height] = $info;

		$this->logger->debug("Loaded image $image a {$info['mime']} that is $width × $height");

		if ($info['mime'] == 'image/svg+xml') {
			$this->logger->debug("$image is a SVG; skipping minimum/maximum resolution checks");
		} else {
			if ($height < self::MINIMUM_HEIGHT || $width < self::MINIMUM_WIDTH) {
				throw ImageSizeException::create(
					filename: $image,
					className: $meetup::class,
					height: $height,
					width: $width,
					problem: ImageSizeProblem::TooSmall,
					boundaryHeight: self::MINIMUM_HEIGHT,
					boundaryWidth: self::MINIMUM_WIDTH,
					ratio: self::RATIO,
				);
			} elseif ($height > self::MAXIMUM_HEIGHT || $width > self::MAXIMUM_WIDTH) {
				throw ImageSizeException::create(
					filename: $image,
					className: $meetup::class,
					height: $height,
					width: $width,
					problem: ImageSizeProblem::TooLarge,
					boundaryHeight: self::MAXIMUM_WIDTH,
					boundaryWidth: self::MAXIMUM_HEIGHT,
					ratio: self::RATIO,
				);
			}
		}
		if ($meetup->getDateTime() < new DateTimeImmutable(self::RATIO_ENFORCEMENT_DATE)) {
			$this->logger->debug(sprintf(
				'%s is before the enforcement date of %s and will not have its ratio checked',
				$meetup::class,
				self::RATIO_ENFORCEMENT_DATE,
			));

			return;
		}

		$ratio = number_format(floor($width / $height * 100) / 100, 2); // truncate to 2 decimal places

		if ($ratio != '1.77') {
			throw ImageRatioException::create($image, $meetup::class, self::RATIO);
		}
	}
}
