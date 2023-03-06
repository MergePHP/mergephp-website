<?php

declare(strict_types=1);

namespace MergePHP\Website\Builder\Processor;

enum SitemapChangeFrequency: string
{
	case Always  = 'always';
	case Hourly  = 'hourly';
	case Daily   = 'daily';
	case Weekly  = 'weekly';
	case Monthly = 'monthly';
	case Yearly  = 'yearly';
	case Never   = 'never';
}
