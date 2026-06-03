<?php

namespace MergePHP\Website\Exception;

enum ImageSizeProblem
{
	case TooLarge;
	case TooSmall;
}
