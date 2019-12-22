/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'nav-expanded' ) ) {
			container.className = container.className.replace( ' nav-expanded', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' nav-expanded';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
					container.classList.add( 'nav-expanded' );
				} else {
					menuItem.classList.remove( 'focus' );
					container.classList.remove( 'nav-expanded' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
	
} )();

//Begin jQuery code

(function($) {
	var container = $( '#site-navigation' );
	if ( ! container ) {
		return;
	}
	var parentLink = container.find( '.menu-item-has-children > a, .page_item_has_children > a' );
	var firstTier = container.find('ul#primary-menu > li.menu-item-has-children > a');
	var secondTier = container.find('ul.sub-menu li.menu-item-has-children > a');
	var thirdTier = container.find('ul.sub-menu li.menu-item-has-children ul.sub-menu li.menu-item-has-children > a').siblings('ul.sub-menu');
	parentLink.each(function(){
		$(this).bind("mouseenter", function(){
			container.addClass("nav-expanded");
		});
		$(this).bind("tap", function(){
			container.addClass("nav-expanded");
		});
	});
	
/*
	container.bind("mouseleave", function(e){
		container.find('ul.sub-menu.slide-in').removeClass("slide-in");
		container.removeClass("nav-expanded");
		secondTier.removeClass("carrot-added");	
	});
*/
	
	firstTier.bind('click', function(e){
		e.preventDefault();
	});
	
	secondTier.bind('click', function(e){
		e.preventDefault(); //prevent normal click activity
		$(this).siblings('ul.sub-menu').first().toggleClass("slide-in"); //open the child menu instead
		$(this).toggleClass("carrot-added");
		e.stopPropagation(); //prevent bubbling
	});
	
	thirdTier.bind('click', function(e){
		secondTier.unbind('click');
	});
		
})( jQuery );

