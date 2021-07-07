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

	// Blog
	// [object_id] => 5
	// [object] => page
	// [type] => post_type

    // [1] => menu-item
    // [2] => menu-item-type-post_type
    // [3] => menu-item-object-page
    // [4] => current-menu-item
    // [5] => page_item
    // [6] => page-item-5
    // [7] => current_page_item
    // [8] => current_page_parent
    // [9] => menu-item-13

    // Werk
    // [object_id] => 93
	// [object] => page
	// [type] => post_type

    // [1] => menu-item
    // [2] => menu-item-type-post_type
    // [3] => menu-item-object-page
    // [4] => menu-item-95

    // Kolommenpagina
	// [object] => page
    // [type] => post_type

    // [1] => menu-item
    // [2] => menu-item-type-post_type
    // [3] => menu-item-object-page
    // [4] => menu-item-14

	$_classes = [ 'menu__item' ];

	// 404 has no active menu items
	if (is_404()) {
		return $_classes;
	}

	// App::log($classes);
	// App::log($item);

	// 1. Make the available classes BEM
	foreach ( [ 'item', 'parent', 'ancestor' ] as $type ) {

		if ( in_array( "current-menu-{$type}", $classes ) ) {

			$_classes[] = ('item' === $type) ? 'menu__item--current' : "menu__item--{$type}";
		}
	}

	// 2. Add new classes

	// If the menu item is a post type archive and we're viewing a single
	// post of that post type, the menu item should be an ancestor.
	if ( 'post_type_archive' === $item->type && is_singular( $item->object ) && ! in_array( 'menu__item--ancestor', $_classes ) ) {
		$_classes[] = 'menu__item--ancestor';
	}

	// // Fix modifiers for agenda archive page
	// if ( $item->object_id === get_post_type_archive_page() ) {

	// 	if ( \is_post_type_archive('wbl_project') ) {
	// 		$_classes[] = 'menu__item--current';
	// 	}
	// 	elseif ( \is_singular('wbl_project') ) {
	// 		$_classes[] = 'menu__item--ancestor';
	// 	}
	// }

	// Add a class if the menu item has children.
	if ( in_array( 'menu-item-has-children', $classes ) ) {
		$_classes[] = 'has-children';
	}

	// 3. Custom classes by user

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
