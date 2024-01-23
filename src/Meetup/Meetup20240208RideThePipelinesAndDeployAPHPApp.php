<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20240208RideThePipelinesAndDeployAPHPApp extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Ride the Pipelines and Deploy a PHP App. Cowabunga!';
	}

	public function getDescription(): string
	{
		return "In the rapidly evolving landscape of web development, the deployment of PHP applications can be a complex and time-consuming process. This talk aims to demystify and streamline the deployment process by leveraging the powerful capabilities of GitHub Actions and GitLab Pipelines. We will start by introducing Continuous Integration/Continuous Deployment (CI/CD) principles and how they can be effectively applied to PHP projects.
\nThe first part of the talk will focus on GitHub Actions. We will explore how to set up a basic workflow that includes steps for testing, building, and deploying a PHP application. This section will cover creating custom workflow files, configuring jobs, and managing dependencies. Special attention will be given to best practices for security and efficiency in a GitHub Actions environment.
\nTransitioning to GitLab Pipelines, the second part of the talk will delve into its unique features. We will demonstrate how to configure a .gitlab-ci.yml file for a PHP project, including setting up different stages for testing, building, and deploying. We’ll also discuss how to use GitLab’s built-in features like environment variables and caching to optimize the deployment process.
\nThroughout the talk, practical examples and real-world scenarios will be used to illustrate key concepts.
\nBy the end of this session, attendees will have a comprehensive understanding of how to effectively use GitHub Actions and GitLab Pipelines for deploying PHP applications. They will be equipped with the knowledge to set up their own CI/CD pipelines, leading to more efficient, reliable, and automated deployment processes.
\nSlides can be found [here](https://docs.google.com/presentation/d/1vF7mbstn58jUsd1t2OIdMeymi0Q0Y7k4ozh12PQvxGg/edit?usp=sharing)";
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2024-02-08 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Josh Copeland';
	}

	public function getSpeakerBio(): string
	{
		return 'Joshua Copeland is CTO of [Remote Dev Force](https://www.remotedevforce.com) and works with clients all over the world to build high quality systems. With over 15 years as a software architect and serial entrepreneur, Joshua has gained a good blend of start-up and enterprise experience. Developing PHP applications is a big part of his day-to-day work and keeps security first-in-mind. Joshua’s team of engineers regularly work on building features for mission critical projects in Laravel/Symfony, setting up and maintaining servers with Terraform/AWS, building CI pipelines with Jenkins/ADO/GitLab/GitHub Actions, Pen-testing, and much more. He has led the PHP Vegas Users Group for over 7 years and loves to give back by speaking at conferences and educating the community.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=aGS8N94Csv0';
	}
}
