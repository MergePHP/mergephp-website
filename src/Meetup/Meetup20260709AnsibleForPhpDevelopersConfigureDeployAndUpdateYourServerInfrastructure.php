<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20260709AnsibleForPhpDevelopersConfigureDeployAndUpdateYourServerInfrastructure extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Ansible for PHP Developers: Configure, Deploy, and Update Your Server Infrastructure';
	}

	public function getDescription(): string
	{
		return <<<END
		Most PHP developers learn server administration the hard way: SSHing into a box, editing config files by hand,
		and hoping the next deploy doesn't break what the last one fixed. This talk introduces Ansible as the way out
		— not as a checklist of commands to copy, but as a set of concepts (declarative state, idempotency,
		inventory, roles) that lets attendees author their own infrastructure code. Starting from zero Ansible
		experience, we build up the mental model: control nodes and managed nodes, modules and tasks, then roles and
		playbooks. From there we work through a realistic example — provisioning a server for a PHP application,
		deploying the app, and performing a zero-downtime update using release directories and a `current` symlink.
		END;
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2026-07-09 20:00:00', new DateTimeZone('America/New_York'));
	}


	public function getImage(): string
	{
		return '/images/ansible-for-php-devs-mergephp.png';
	}

	public function getSpeakerName(): string
	{
		return 'Joe Ferguson';
	}

	public function getSpeakerBio(): string
	{
		return <<<END
		DevOps Dev. Writer. Open Source, Linux, Python, PHP, Ansible, ❤️ DevOps. ⚽, 🏒, & 🏎  Fan
		END;
	}
}
