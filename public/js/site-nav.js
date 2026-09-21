(function () {
	const toggle = document.querySelector('.nav-toggle');
	const nav = document.getElementById('site-nav');
	if (!toggle || !nav) {
		return;
	}

	function setOpen(open) {
		toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		nav.classList.toggle('is-open', open);
		document.body.classList.toggle('nav-open', open);
	}

	toggle.addEventListener('click', function () {
		setOpen(toggle.getAttribute('aria-expanded') !== 'true');
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
			setOpen(false);
			toggle.focus();
		}
	});

	document.addEventListener('click', function (event) {
		if (
			toggle.getAttribute('aria-expanded') === 'true'
			&& !nav.contains(event.target)
			&& !toggle.contains(event.target)
		) {
			setOpen(false);
		}
	});

	// Reset state if the viewport grows past the mobile breakpoint while the menu is open.
	const mediaQuery = window.matchMedia('(min-width: 992px)');
	mediaQuery.addEventListener('change', function (event) {
		if (event.matches) {
			setOpen(false);
		}
	});

	// Show/hide the back-to-top link without depending on jQuery.
	const backToTop = document.querySelector('.back-to-top');
	if (backToTop) {
		function updateBackToTop() {
			backToTop.style.display = window.scrollY > 200 ? 'block' : 'none';
		}
		window.addEventListener('scroll', updateBackToTop, { passive: true });
		updateBackToTop();
		backToTop.addEventListener('click', function (event) {
			event.preventDefault();
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	}
})();
