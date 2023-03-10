<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210610UsingTheAgileMethodologyToRunMyLife extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'Using the Agile Methodology to Run My Life';
	}

	public function getDescription(): string
	{
		return 'Interested in learning more about Agile? Me too! I am here to tell you that Agile can be applied to ' .
			'your life outside of software. Don\'t worry, there is a method to these processes or routines we are ' .
			'doing on a regular basis. Let\'s learn about how we can get better at these systems and turn them into ' .
			'more productive practices. Irene is here to teach you all things Agile.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-06-10 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Irene Mangem';
	}

	public function getSpeakerBio(): string
	{
		return 'Irene Mangem is a SAFe Program Consultant, an Agile Coach, a Social Entrepreneur and philanthropist, ' .
			'who is giving shelter, education and hopes to the homeless, rejected, abused and underprivileged girls ' .
			'in her birth country Cameroon. Irene manages her time between being there for her husband and family, ' .
			'the girls, working as an Agile Coach at Team Treehouse, teaching Scrum, consulting with companies and, ' .
			'using Agile/Scrum to facilitate the activities in her nonprofit work.';
	}

	public function getYouTubeLink(): string
	{
		return 'https://www.youtube.com/watch?v=c16ng-kdmFI';
	}
}
