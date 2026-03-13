(function () {
	const output = document.getElementById('next-meeting-local');
	if (!output) {
		return;
	}

	const timeZone = 'America/New_York';
	const weekdayMap = {
		Sun: 0,
		Mon: 1,
		Tue: 2,
		Wed: 3,
		Thu: 4,
		Fri: 5,
		Sat: 6
	};

	function getTimeZoneParts(date, zone) {
		const parts = new Intl.DateTimeFormat('en-US', {
			timeZone: zone,
			year: 'numeric',
			month: '2-digit',
			day: '2-digit'
		}).formatToParts(date);
		const values = {};
		parts.forEach(function (part) {
			values[part.type] = part.value;
		});

		return {
			year: Number(values.year),
			month: Number(values.month),
			day: Number(values.day)
		};
	}

	function getWeekdayInTimeZone(year, monthIndex, day, zone) {
		const date = new Date(Date.UTC(year, monthIndex, day, 12, 0, 0));
		const weekday = new Intl.DateTimeFormat('en-US', {
			timeZone: zone,
			weekday: 'short'
		}).format(date);

		return weekdayMap[weekday];
	}

	function getTimeZoneOffsetMinutes(date, zone) {
		const parts = new Intl.DateTimeFormat('en-US', {
			timeZone: zone,
			hour12: false,
			year: 'numeric',
			month: '2-digit',
			day: '2-digit',
			hour: '2-digit',
			minute: '2-digit',
			second: '2-digit'
		}).formatToParts(date);
		const values = {};
		parts.forEach(function (part) {
			values[part.type] = part.value;
		});
		const asUtc = Date.UTC(
			Number(values.year),
			Number(values.month) - 1,
			Number(values.day),
			Number(values.hour),
			Number(values.minute),
			Number(values.second)
		);

		return (asUtc - date.getTime()) / 60000;
	}

	function getSecondThursdayMeetingUtc(year, monthIndex) {
		const firstDay = getWeekdayInTimeZone(year, monthIndex, 1, timeZone);
		const firstThursday = ((4 - firstDay + 7) % 7) + 1;
		const secondThursday = firstThursday + 7;
		const naiveUtc = Date.UTC(year, monthIndex, secondThursday, 20, 0, 0);
		const offsetMinutes = getTimeZoneOffsetMinutes(new Date(naiveUtc), timeZone);

		return naiveUtc - (offsetMinutes * 60000);
	}

	const nowUtc = Date.now();
	const nowParts = getTimeZoneParts(new Date(nowUtc), timeZone);
	let year = nowParts.year;
	let month = nowParts.month - 1;
	let meetingUtc = getSecondThursdayMeetingUtc(year, month);

	if (nowUtc >= meetingUtc) {
		month += 1;
		if (month > 11) {
			month = 0;
			year += 1;
		}
		meetingUtc = getSecondThursdayMeetingUtc(year, month);
	}

	const meetingLocal = new Date(meetingUtc);
	const locales = (navigator.languages && navigator.languages.length)
		? navigator.languages
		: [navigator.language];
	const formatter = new Intl.DateTimeFormat(locales, {
		year: 'numeric',
		month: 'long',
		day: '2-digit',
		hour: '2-digit',
		minute: '2-digit',
		timeZoneName: 'short',
		hour12: false,
		hourCycle: 'h23'
	});

	output.textContent = formatter.format(meetingLocal);
})();
