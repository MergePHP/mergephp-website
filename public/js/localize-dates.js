(function () {
	var elements = document.querySelectorAll('time[data-localize="date"]');
	if (!elements.length) {
		return;
	}

	var locales = (navigator.languages && navigator.languages.length)
		? navigator.languages
		: [navigator.language];
	var formatter;
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
		var value = element.getAttribute('datetime');
		if (!value) {
			return;
		}

		var parsed = new Date(value);
		if (Number.isNaN(parsed.getTime())) {
			return;
		}

		element.lastChild.textContent = ' ' + formatter.format(parsed);
	});
})();
