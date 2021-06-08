<?php
/**
 * Polylang setup.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Set the classname of the language switcher in the navigation menu
	add_filter( 'nav_menu_css_class', 'WBL\Theme\add_polylang_menu_class', 9, 2 );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------

/**
 * Add polylang class
 */
function add_polylang_menu_class( $classes, $item ) {

	// Check item for polylang identifier
	if ( $item->url === '#pll_switcher' ) {

		// Add polylang indicator to classes
		$classes[] = 'menu__item--language-switcher';
	}

	return $classes;
}
