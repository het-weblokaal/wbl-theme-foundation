<?php
/**
 * Theme JSON functions
 *
 * Our own simple API for getting the theme.json data
 */

namespace WBL\Theme\Foundation;

/**
 * Get theme colors from theme.json
 * 
 * @return array
 */
function get_theme_colors() {

	return \WP_Theme_JSON_Resolver::get_theme_data()->get_settings()['color']['palette']['theme'] ?? false;
}

/**
 * Get theme color by slug
 * 
 * @return string #HEX | bool false
 */
function get_theme_color_by_slug( $slug ) {

	$color_to_return = '';
	$colors = get_theme_colors();

	foreach ($colors as $color) {

		if ($color['slug'] == $slug) {
			$color_to_return = $color['color'];
		}
	}

	return $color_to_return;
}