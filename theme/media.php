<?php
/**
 * Theme media functions.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {
	
	// Featured image support for all post types
	add_theme_support( 'post-thumbnails' );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------

/**
 * Get the post featured image id
 *
 * We use has_post_thumbnail to trigger core-filter. This is a standard.
 *
 * @return int|false
 */
function get_featured_image_id() {

    return has_post_thumbnail() ? get_post_thumbnail_id() : false;
}

/**
 * Get the post featured image source
 *
 * @param  string $size
 * @return string
 */
function get_featured_image_src( $size = 'thumbnail' ) {

	$src = '';

    if ($image_id = get_featured_image_id()) {
	    $src = \wp_get_attachment_image_src( $image_id, $size )[0] ?? $src;
	}

	return $src;
}