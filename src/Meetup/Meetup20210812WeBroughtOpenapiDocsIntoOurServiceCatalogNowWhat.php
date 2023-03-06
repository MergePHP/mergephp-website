<?php

declare(strict_types=1);

namespace MergePHP\Website\Meetup;

use DateTimeImmutable;
use DateTimeZone;
use MergePHP\Website\AbstractMeetup;

class Meetup20210812WeBroughtOpenapiDocsIntoOurServiceCatalogNowWhat extends AbstractMeetup
{
	public function getTitle(): string
	{
		return 'We brought OpenAPI Docs into our service catalog. Now what?';
	}

	public function getDescription(): string
	{
		return 'With a large, globally distributed engineering department of over 2,000 engineers, service ' .
			'discoverability and access to API documentation are important problems at Wayfair. Integrations between ' .
			'systems require close coordination and overhead, making these kinds of projects expensive and brittle. ' .
			'To address this problem, we sought to surface OpenAPI documentation in our Backstage Service ' .
			"Catalog.\n\nWe will discuss how over 175 API specifications are shared amongst teams at Wayfair. Our " .
			'solution leverages the Kubernetes API, together with our home-grown tool for project generation, to ' .
			'programmatically surface OpenAPI files for inspection in Backstage. Backstage is a service catalog and ' .
			'developer portal recently released as open source by Spotify. Our work has had immediate service ' .
			'discoverability benefits for developers across our enterprise, with thousands of API doc page views ' .
			'since it launched. Of course, our work is never complete! As the solution rolled out, we discovered a ' .
			'lot of complexity in the space of surfacing API docs. We\'ll discuss some of the problems we\'ve ' .
			'encountered, as well as the solutions we\'re trying, along the way. These problems include: whether to ' .
			'support code-first or schema-first development; how to store API schemas; and how to enforce versioning ' .
			'as part of the CI/CD pipeline. At the end of the talk, we want the audience to have a good ' .
			'understanding of the benefits of service discoverability, as well as the trade-offs inherent in making ' .
			'API specs discoverable.';
	}

	public function getDateTime(): DateTimeImmutable
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return new DateTimeImmutable('2021-08-12 19:00:00', new DateTimeZone('America/New_York'));
	}

	public function getSpeakerName(): string
	{
		return 'Harsha Reddy and Zoe Song';
	}

	public function getSpeakerBio(): string
	{
		return 'Harsha Reddy: Engineer on the Service to Service platform team at Wayfair. I am building a modern ' .
			'security ecosystem for the Service oriented world and am educating developers to follow best practices ' .
			'for the same. Making developers\' life easi”er” is what I consider awesome GIF, emoji enthusiast. Love ' .
			"good hard hikes without any creepy crawlies\n\nZoe Song: On the Developer Experience team. Working on " .
			'Backstage at Wayfair, that is the go-to place for discovering services, creating resources, and ' .
			'executing workflows. Tap water enthusiast.';
	}
}
