<?php
/**
 * Theme menu functions.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Menu Class
	add_filter( 'nav_menu_css_class',         'WBL\Theme\nav_menu_css_class',         5, 2 );
	add_filter( 'nav_menu_item_id',           'WBL\Theme\nav_menu_item_id',           5    );
	add_filter( 'nav_menu_submenu_css_class', 'WBL\Theme\nav_menu_submenu_css_class', 5    );
	add_filter( 'nav_menu_link_attributes',   'WBL\Theme\nav_menu_link_attributes',   5    );

}, 5 );

/**
 * Init hook menus
 */
add_action( 'init', function() {

	// Register site navigation
	register_nav_menus( [
		'site-nav'     => esc_html_x( 'Website navigation', 'nav menu location' ),
	] );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------


/**
 * Get menu_name by location
 */
function get_menu_name_by_location( $location ) {
	$locations = get_nav_menu_locations();

	$menu = isset( $locations[ $location ] ) ? wp_get_nav_menu_object( $locations[ $location ] ) : '';

	return $menu->name ?? '';
}

/**
 * Get menu id by location
 */
function get_menu_id_by_location( $location ) {
	$locations = get_nav_menu_locations();

	$menu = isset( $locations[ $location ] ) ? wp_get_nav_menu_object( $locations[ $location ] ) : '';

	return $menu->term_id ?? false;
}


# ------------------------------------------------------------------------------
# Filters
# ------------------------------------------------------------------------------

/**
 * Simplifies the nav menu class system.
 *
 * @param  array   $classes
 * @param  object  $item
 * @return array
 */
function nav_menu_css_class( $classes, $item ) {

	$_classes = [ 'menu__item' ];

	foreach ( [ 'item', 'parent', 'ancestor' ] as $type ) {

		if ( in_array( "current-menu-{$type}", $classes ) || in_array( "current_page_{$type}", $classes ) ) {

			$_classes[] = 'item' === $type ? 'menu__item--current' : "menu__item--{$type}";
		}
	}

	// If the menu item is a post type archive and we're viewing a single
	// post of that post type, the menu item should be an ancestor.
	if ( 'post_type_archive' === $item->type && is_singular( $item->object ) && ! in_array( 'menu__item--ancestor', $_classes ) ) {
		$_classes[] = 'menu__item--ancestor';
	}

	// Add a class if the menu item has children.
	if ( in_array( 'menu-item-has-children', $classes ) ) {
		$_classes[] = 'has-children';
	}

	// Add custom user-added classes if we have any.
	$custom = get_post_meta( $item->ID, '_menu_item_classes', true );

	if ( $custom ) {
		$_classes = array_merge( $_classes, (array) $custom );
	}

	return $_classes;
}


/**
 * Removes the nav menu item id
 *
 * @param string $item_id
 * @return string
 */
function nav_menu_item_id( $item_id ) {
	return '';
}

/**
 * Adds a custom class to the nav menu link.
 *
 * @param  array   $attr;
 * @return array
 */
function nav_menu_link_attributes( $attr ) {

	$attr['class'] = 'menu__link';

	return $attr;
}

/**
 * Adds a custom class to the submenus in nav menus.
 *
 * @param  array   $classes
 * @return array
 */
function nav_menu_submenu_css_class( $classes ) {

	$classes = [ 'menu__sub-menu' ];

	return $classes;
}
