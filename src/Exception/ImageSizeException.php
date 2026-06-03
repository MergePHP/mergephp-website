<?php

declare(strict_types=1);

namespace MergePHP\Website\Exception;

use Exception;

class ImageSizeException extends Exception
{
	public static function create(
		string $filename,
		string $className,
		int $height,
		int $width,
		ImageSizeProblem $problem,
		int $boundaryHeight,
		int $boundaryWidth,
		string $ratio,
	): ImageSizeException {
		$description = match ($problem) {
			ImageSizeProblem::TooLarge => 'most',
			ImageSizeProblem::TooSmall => 'least',
			default => '',
		};
		return new self(
			sprintf(
				'%s in %s is %d × %d but must be at %s %d wide by %d high and %s ratio',
				$filename,
				$className,
				$height,
				$width,
				$description,
				$boundaryWidth,
				$boundaryHeight,
				$ratio,
			)
		);
	}
}
