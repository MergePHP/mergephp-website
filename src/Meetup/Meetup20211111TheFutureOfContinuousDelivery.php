<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20211111TheFutureOfContinuousDelivery extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'The Future of Continuous Delivery';
	}

	public function getDescription(): string
	{
		return "It's the year 2021, an exciting time for the tech industry. Globally, software organisations and " .
			'internet companies are delivering more and more software, at a rate and scale that we\'ve never faced ' .
			"before.\n\nThis unprecedented demand has created new challenges for us all, which have been hurting our " .
			"organizations when creating continuous delivery solutions.\n\nThe great thing about these new " .
			"challenges is that they've sparked new and amazing innovations in the CI/CD industry.\n\nIn Paul's talk " .
			"he will be showing you:\n * What new innovations the CI/CD, Cloud Native and Open Source communities " .
			"have been developing.\n * Where these innovations are taking the world of continuous delivery.\n * What " .
			'to expect, from the CD community, later this year, and into the future';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-11-11 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Paul Dragoonis';
	}

	public function getSpeakerBio(): string
	{
		return "* Open source contributor\n* A member of the Jenkins (Blue Ocean and JenkinsX) projects.\n* A member " .
			"of the PHP core language team, and PHP-FIG member and standards author.\n* A member of the CDF " .
			"(Continuous Delivery Foundation), which is part of the Linux Foundation.\n\nPaul works as an " .
			'independent consultant in roles ranging from CTO, to Head of Engineering, to principal ' .
			"architect/developer/QA/DevOps consultant.\n\nPaul spends a significant amount of his time rolling out " .
			'CI/CD pipelines, and embedding continuous delivery processes and solutions into companies in the public ' .
			"and private sector.\n\nPaul is very passionate about what he does and enjoys sharing his experiences " .
			"with the wider community by way of private training or conference/meetup speaking.\n\nTwitter: " .
			"[@dr4goonis](https://twitter.com/dr4goonis)\n\nLinkedin: " .
			"[https://www.linkedin.com/in/pauldragoonis](https://www.linkedin.com/in/pauldragoonis)\n\nJenkinsX: " .
			"[https://jenkins-x.io/](https://jenkins-x.io/)\n\nCDF: [https://cd.foundation/](https://cd.foundation/)" .
			"\n\nPHP-FIG: [https://www.php-fig.org/psr/](https://www.php-fig.org/psr/)\n\nPHP: " .
			"[https://www.php.net/](https://www.php.net/)";
	}

	public function getYouTubeLink(): ?string
	{
		return 'https://www.youtube.com/watch?v=dQcRaXdTESc';
	}
}
