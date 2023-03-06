<?php

declare(strict_types=1);

namespace MergePHP\Website;

use DateTimeImmutable;

interface MeetupInterface
{
	public function getTitle(): string;
	public function getDescription(): string;
	public function getDateTime(): DateTimeImmutable;
	public function getImage(): string;
	public function getSpeakerName(): string;
	public function getSpeakerBio(): string;
	public function getYouTubeLink(): ?string;
	public function getMeetupLinks(): array;
}
