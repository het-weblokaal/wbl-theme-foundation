<?php
/**
 * Theme setup functions.
 */

namespace WBL\Theme;


# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Page SEO Meta
	add_filter( 'slim_seo_meta_title',       'WBL\Theme\manage_site_meta_title'       );
	add_filter( 'slim_seo_meta_description', 'WBL\Theme\manage_site_meta_description' );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------


/**
 * Manage the Site Meta Title
 *
 * @return string
 */
function manage_site_meta_title( $meta_title ) {

	if ( is_home() && ! is_front_page() ) {

		// Set meta if we find an archive page
		if ( $blog_page_id = get_option( 'page_for_posts' ) ) {
			$meta_title = get_site_meta_title( $blog_page_id );
		}
	}

	return $meta_title;
}

/**
 * Manage the Site Meta Description
 *
 * @return string
 */
function manage_site_meta_description( $meta_description ) {

	if ( is_home() && ! is_front_page() ) {

		// Set meta if we find an archive page
		if ( $blog_page_id = get_option( 'page_for_posts' ) ) {
			$meta_description = get_site_meta_description( $blog_page_id );
		}
	}

	return $meta_description;
}

/**
 * Get Site meta title
 *
 * @param int $post_id
 * @return string
 */
function get_site_meta_title( $post_id ) {
	return get_slim_seo_data( $post_id )['title'] ?? false;
}

/**
 * Get Site meta description
 *
 * @param int $post_id
 * @return string
 */
function get_site_meta_description( $post_id ) {
	return get_slim_seo_data( $post_id )['description'] ?? false;
}

/**
 * Get Slim SEO meta data
 *
 * @param int $post_id
 * @return array
 */
function get_slim_seo_data( $post_id ) {
	return get_post_meta( $post_id, 'slim_seo', true );
}
