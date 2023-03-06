<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20220908BuildingAwsEcsStacksWithTerraformGithubActions extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Building AWS ECS Stacks with Terraform & GitHub Actions';
	}

	public function getDescription(): string
	{
		return 'In this talk, we will be going over an open source project called PHPobos which shows how to use ' .
			'AWS, GitHub, Docker, and Terraform to build a seamless test, build, & deployment pipeline for your PHP ' .
			'App. Both GitHub Actions and Terraform are very powerful tools but become extraordinarily powerful when ' .
			'combined to build CI/CD pipelines. We will go over how the GitHub Actions test & package your app in a ' .
			'Docker container, how it pushes that image up to AWS, and how the Elastic Container service works to ' .
			'host your PHP app in a highly-scalable way.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2022-09-08 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Joshua Copeland';
	}

	public function getSpeakerBio(): string
	{
		return 'Joshua Copeland is CTO of Remote Dev Force and works with clients all over the world to build high ' .
			'quality systems. His team regularly works on building features for mission critical projects in ' .
			'Laravel/Symfony using AWS, setting up and maintaining servers with Terraform/AWS, building CI pipelines ' .
			'with Jenkins/GitLab/GitHub Actions, and pen-testing. He leads the PHP Vegas Users\' Group and loves to ' .
			'give back by speaking at conferences and educating the community.';
	}
}
