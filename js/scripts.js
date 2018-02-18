( function() {
	/**
	 * Handles toggling the navigation menu for small screens and enables TAB key
	 * navigation support for dropdown menus.
	 */
	var container, button, menu, links, subMenus, i, len;

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
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			button.innerHTML = halleL10n.menu;
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			button.innerHTML = halleL10n.close;
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

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

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( event ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					event.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );

	/**
	 * Hides comment list and adds button to reveal
	 */
	var commentList = document.getElementById('comment-list');

	if ( commentList ) {
		// Add hidden class to comment list
		commentList.classList.toggle('comments-hidden');

		// Create toggle button
		var commentToggle = document.createElement('button');
		commentToggle.className = 'comment-toggle';
		var toggleText = halleL10n.comments_show;
		commentToggle.innerHTML = toggleText;

		// Insert button immediately before comment list
		commentList.insertBefore(commentToggle, commentList.firstChild);

		// Use button to toggle class 'hidden' on parent element
		commentToggle.onclick = function() {
			commentList.classList.toggle('comments-hidden');
			if(this.innerHTML == toggleText) {
				commentToggle.innerHTML = halleL10n.comments_hide;
			}
			else {
				commentToggle.innerHTML = toggleText;
			};
		};
	}

	function whichTransitionEvent() {
		var t,
		el = document.createElement("fakeelement");

		var transitions = {
			"transition": "transitionend",
			"OTransition": "oTransitionEnd",
			"MozTransition": "transitionend",
			"WebkitTransition": "webkitTransitionEnd"
		}

		for (t in transitions){
			if (el.style[t] !== undefined){
				return transitions[t];
			}
		}
	}

	var searchToggle = document.getElementsByClassName('search-toggle'),
		searchOverlay = document.getElementsByClassName('search-overlay'),
		searchForm = document.getElementsByClassName('search-form'),
		searchField = document.getElementsByClassName('search-field'),
		transitionEvent = whichTransitionEvent();

	if ( searchToggle ) {
		// Use button to toggle class 'toggled' on search overlay element
		searchToggle[0].onclick = function() {
			searchOverlay[0].classList.toggle('toggled');
			searchField[0].value = '';
			searchOverlay[0].addEventListener(transitionEvent, focusFunction);
			bindTabKeydown();
		};

		function focusFunction(event) {
			searchOverlay[0].removeEventListener(transitionEvent, focusFunction);
			searchField[0].focus();
		}

		searchOverlay[0].onclick = function() {
			searchOverlay[0].classList.toggle('toggled');
			unbindTabKeydown();
		}

		searchForm[0].onclick = function(event) {
			event.stopPropagation();
		}

		document.onkeydown = function(event) {
			event = event || window.event;
			var isEscape = false;

			if ("key" in event) {
				isEscape = (event.key == "Escape" || event.key == "Esc");
			} else {
				isEscape = (event.keyCode == 27);
			}

			if (isEscape) {
				searchOverlay[0].classList.remove('toggled');
				unbindTabKeydown();
			}
		};

		function bindTabKeydown() {
			document.addEventListener('keydown', handleTabEvent);
		}

		function unbindTabKeydown() {
			document.removeEventListener('keydown', handleTabEvent);
		}

		// Set up variables for use in handleTabEvent() function.
		var focusableSelectors = ['input', 'button'];

		function handleTabEvent (e) {
			// Only perform function if tab key initiated
			if (e.keyCode === 9) {
				// Take list of possible focusable elements and return those that match within context
				function getFocusableElements(elements, context) {
					return [].slice.call(context.querySelectorAll(elements));
				}

				// Create up to date list of all focusable elements within search container
				var focusableElements = getFocusableElements(focusableSelectors.join(), searchOverlay[0]);

				// Get the index of the current active element within search
				var focusedIndex = focusableElements.indexOf(document.activeElement);

				// If shift key is not in use and last element has focus
				if (!e.shiftKey && focusedIndex === focusableElements.length - 1) {
					// Set focus to first item within search
					focusableElements[0].focus();
					e.preventDefault();
				// If shift key is in use and first element has focus
				} else if (e.shiftKey && (focusedIndex === 0 || focusedIndex === -1)) {
					// Set focus to last item within search
					focusableElements[focusableElements.length - 1].focus();
					e.preventDefault();
				}
			}
		}
	}

	/**
	 * Applies Stickyfill to any element with class 'stick'
	 */
	var stickyElements = document.getElementsByClassName('stick');
	
	for (var i = stickyElements.length - 1; i >= 0; i--) {
		Stickyfill.add(stickyElements[i]);
	}
} )();
