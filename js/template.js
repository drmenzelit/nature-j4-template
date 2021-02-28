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

		/**
		 * Search toggle
		 */
		// Select the button on which the 
        // class has to be toggled 
        const searchToggle = document.querySelector("#search-icon");
		const search = document.querySelector(".container-search");
  
		// Select the entire HTML document 
		const html = document.querySelector("html"); 
		
		if (backToTop) {
			// Add an event listener for  
			// a click to the button 
			searchToggle.addEventListener("click", function () { 
	
				// Add the required class 
				search.classList.toggle("open"); 
			}); 
		}
        // Add an event listener for a 
        // click to the html document 
        html.addEventListener("click", function (e) { 
  
            // If the element that is clicked on is 
            // not the button itself, then remove 
            // the class that was added earlier 
            if (e.target !== searchToggle) {
				search.classList.remove("open"); 
			}
		}); 
	});

	/**
	 * Initialize when a part of the page was updated
	 */
	document.addEventListener('joomla:updated', initTemplate);

})(Joomla, document);

