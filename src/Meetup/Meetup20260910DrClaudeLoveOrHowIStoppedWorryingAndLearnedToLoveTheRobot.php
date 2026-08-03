<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260910DrClaudeLoveOrHowIStoppedWorryingAndLearnedToLoveTheRobot extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Dr. Claude-Love or, How I stopped worrying and learned to love the robot.';
	}

	public function getDescription(): string
	{
		return <<<END
		At this point, Claude is near ubiquitous when it comes to coding tooling. It has stormed on the scene,
		taken over our terminal apps, and created more load-bearing phrases than anyone thought possible. We will
		explore how we've used Claude in our monolithic codebase that started as a Zend Framework 1 project and
		some jQuery and started to transform it to modern PHP and using Vue with Typescript in place of jQuery.
		The load-bearing result here is that this talk should leave you with some tips and tricks so you don't
		have to push back as much. We will look at where Claude excels, where Claude falls down, and how we've
		shaped our Claude to do the work we need it to do the most.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable(
			'2026-09-10 20:00:00',
			new DateTimeZone('America/New_York'),
		);
	}

	public function getImage(): string
	{
		return '/images/dr-claude-love.svg';
	}

	public function getSpeakerName(): string
	{
		return 'Matt Trask';
	}

	public function getSpeakerBio(): string
	{
		return 'Matt is a self proclaimed API nerd who spends a lot time on his bike or behind a camera these days. ' .
			'He actively maintains OSS projects like openapi.tools an league\\fractal (it\'s not dead I swear). He ' .
			'is a backend team lead at a healthcare company doing fun things with PHP. You can find him on Twitter ' .
			'[@matthewtrask](https://twitter.com/matthewtrask)';
	}
}
