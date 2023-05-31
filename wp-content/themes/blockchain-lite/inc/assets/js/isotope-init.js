jQuery(function ($) {
	'use strict';

	var $window = $(window);

	$window.on('load', function () {
		/* -----------------------------------------
		 Isotope
		 ----------------------------------------- */
		$('.row-isotope').isotope();
	});
});