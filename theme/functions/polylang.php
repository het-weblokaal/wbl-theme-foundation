<?php
/**
 * Polylang setup.
 */

namespace WBL\Theme;

/**
 * Add polylang class
 */
function add_polylang_menu_class( $classes, $item ) {

	// Check item for polylang identifier
	if ( $item->url === '#pll_switcher' ) {

		// Add polylang indicator to classes
		$classes[] = 'menu__item--language-switcher';

		// Try to remove active states from classes
		// $classes = array_diff( $classes, [ "menu__item--current", "menu__item--parent", "menu__item--ancestor" ] );
	}

	return $classes;
}
