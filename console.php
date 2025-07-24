#!/usr/bin/env php
<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use MergePHP\Website\Builder\SiteBuilderCommand;
use MergePHP\Website\Generator\MeetupGeneratorCommand;
use MergePHP\Website\Generator\MeetupGeneratorService;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new MeetupGeneratorCommand(new MeetupGeneratorService(__DIR__ . '/src/Meetup')));
$application->add(new SiteBuilderCommand(__DIR__ . '/dist'));

/** @noinspection PhpUnhandledExceptionInspection */
$application->run();
