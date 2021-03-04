Joomla = window.Joomla || {};

(function(Joomla, document) {
	'use strict';

	function initTemplate(event) {
		var target = event && event.target ? event.target : document;

		/**
		 * Prevent clicks on buttons within a disabled fieldset
		 */
		var fieldsets = target.querySelectorAll('fieldset.btn-group');
		for (var i = 0; i < fieldsets.length; i++) {
			var self = fieldsets[i];
			if (self.getAttribute('disabled') ===  true) {
				self.style.pointerEvents = 'none';
				var btns = self.querySelectorAll('.btn');
				for (var ib = 0; ib < btns.length; ib++) {
					btns[ib].classList.add('disabled');
				}
			}
		}
	}

	document.addEventListener('DOMContentLoaded', function (event) {
		initTemplate(event);

		/**
		 * Back to top
		 */
		var backToTop = document.getElementById('back-top');
		if (backToTop) {
			backToTop.addEventListener('click', function(event) {
				event.preventDefault();
				window.scrollTo(0, 0);
			});
		}

		let navToggle = document.querySelector(".nav__toggle");
		let navWrapper = document.querySelector(".navbar__with-burger .mod-menu");
		
		if (navToggle) {
			navToggle.addEventListener("click", function () {
			if (navWrapper.classList.contains("active")) {
				this.setAttribute("aria-expanded", "false");
				this.setAttribute("aria-label", "menu");
				navWrapper.classList.remove("active");
			} else {
				navWrapper.classList.add("active");
				this.setAttribute("aria-label", "close menu");
				this.setAttribute("aria-expanded", "true");
				searchForm.classList.remove("active");
				searchToggle.classList.remove("active");
			}
			});
		}
		let searchToggle = document.querySelector(".search__toggle");
		let searchForm = document.querySelector(".container-search");
		
		searchToggle.addEventListener("click", showSearch);
		
		function showSearch() {
		  searchForm.classList.toggle("active");
		  searchToggle.classList.toggle("active");
		  if (navToggle) {
			navToggle.setAttribute("aria-expanded", "false");
		  	navToggle.setAttribute("aria-label", "menu");
		  	navWrapper.classList.remove("active");
		  }
		  if (searchToggle.classList.contains("active")) {
			searchToggle.setAttribute("aria-label", "Close search");
		  } else {
			searchToggle.setAttribute("aria-label", "Open search");
		  }
		}
	});

	/**
	 * Initialize when a part of the page was updated
	 */
	document.addEventListener('joomla:updated', initTemplate);

})(Joomla, document);

