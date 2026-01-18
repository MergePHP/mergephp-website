(function () {
	const elements = document.querySelectorAll('time[data-localize="date"]');
	if (!elements.length) {
		return;
	}

	const locales = (navigator.languages && navigator.languages.length)
		? navigator.languages
		: [navigator.language];
	let formatter;
	try {
		formatter = new Intl.DateTimeFormat(locales, {
			dateStyle: 'long'
		});
	} catch (error) {
		formatter = new Intl.DateTimeFormat(locales, {
			year: 'numeric',
			month: 'long',
			day: 'numeric'
		});
	}

	elements.forEach(function (element) {
		const value = element.getAttribute('datetime');
		if (!value) {
			return;
		}

		const parsed = new Date(value);
		if (Number.isNaN(parsed.getTime())) {
			return;
		}

		element.lastChild.textContent = ' ' + formatter.format(parsed);
	});
})();
