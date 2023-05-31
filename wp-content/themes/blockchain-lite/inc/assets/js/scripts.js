jQuery(function ($) {
	'use strict';

	var $window = $(window);
	var $body = $('body');

		/* -----------------------------------------
	 Responsive Menus
	 ----------------------------------------- */
	 var $mainNav = $(".navigation-main");
	 var $mobileNav = $( '.navigation-mobile-wrap' );
	 var $mobileNavTrigger = $('.mobile-nav-trigger');
	 var $mobileNavDismiss = $('.navigation-mobile-dismiss');

	 $mainNav.each( function () {
		var $this = $( this );
		$this.clone()
			.find('> li')
			.removeAttr( 'id' )
			.appendTo( $mobileNav.find( '.navigation-mobile' ) );
	} );

	$mobileNav.find( 'li' )
		.each(function () {
			var $this = $(this);
			$this.removeAttr( 'id' );

			if ( $this.find('.sub-menu').length > 0 ) {
				var $button = $( '<button />', {
					class: 'menu-item-sub-menu-toggle',
				} );

				$this.find('> a').after( $button );
			}
		});

	$mobileNav.find('.menu-item-sub-menu-toggle').on( 'click', function ( event ) {
		event.preventDefault();
		var $this = $(this);
		$this.parent().toggleClass('menu-item-expanded')
	} );

	$mobileNavTrigger.on( 'click', function ( event ) {
		event.preventDefault();
		$body.addClass('mobile-nav-open');
		$mobileNavDismiss.focus();
	} );

	$mobileNavDismiss.on( 'click', function ( event ) {
		event.preventDefault();
		$body.removeClass('mobile-nav-open');
		$mobileNavTrigger.focus();
	} );

	/* -----------------------------------------
	Menu classes based on available free space
	----------------------------------------- */
	var $navWrap = $('.nav');
	var $navSubmenus = $navWrap.find('ul');

	/* -----------------------------------------
	Menu classes based on available free space
	----------------------------------------- */
	function setMenuClasses() {
		if (!$navWrap.is(':visible')) {
			return;
		}

		var windowWidth = $window.width();

		$navSubmenus.each(function () {
			var $this = $(this);
			var $parent = $this.parent();
			$parent.removeClass('nav-open-left');
			var leftOffset = $this.offset().left + $this.outerWidth();

			if (leftOffset > windowWidth) {
				$parent.addClass('nav-open-left');
			}
		});
	}

	setMenuClasses();

	var resizeTimer;

	$window.on('resize', function () {
	  clearTimeout(resizeTimer);
	  resizeTimer = setTimeout(function () {
			setMenuClasses();
	  }, 350);
	});

	/* -----------------------------------------
	 Header Search Toggle
	 ----------------------------------------- */
	var $searchTrigger = $('.head-search-trigger');
	var $headSearchForm = $('.head-search-form');

	function dismissHeadSearch(e) {
		if (e) {
			e.preventDefault();
		}

		$headSearchForm.removeClass('head-search-expanded');
		$body.focus();
	}

	function displayHeadSearch(e) {
		if (e) {
			e.preventDefault();
		}

		$headSearchForm
			.addClass('head-search-expanded')
			.find('input')
			.focus();
	}

	function isHeadSearchVisible() {
		return $headSearchForm.hasClass('head-search-expanded')
	}

	$searchTrigger.on('click', displayHeadSearch);

	/* Event propagations */
	$(document).on('keydown', function (e) {
		e = e || window.e;
		if (e.keyCode === 27 && isHeadSearchVisible()) {
			dismissHeadSearch(e);
		}
	});

	$body
		.on('click', function (e) {
			if (isHeadSearchVisible()) {
				dismissHeadSearch();
			}
		})
		.find('.head-search-form, .head-search-trigger')
		.on('click', function (e) {
			e.stopPropagation();
		});
});

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
}() );
