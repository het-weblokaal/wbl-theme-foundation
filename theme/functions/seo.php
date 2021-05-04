<?php
/**
 * Theme setup functions.
 */

namespace WBL\Theme;


/**
 * Manage the Site Meta Title
 *
 * @return string
 */
function manage_site_meta_title( $meta_title ) {

	if ( is_home() && ! is_front_page() ) {

		// Set meta if we find an archive page
		if ( $blog_page_id = get_option( 'page_for_posts' ) ) {
			$meta_description = get_site_meta_title( $blog_page_id );
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
	return get_slim_seo_data( $post_id )['title'] ?? wp_get_document_title();
}

/**
 * Get Site meta description
 *
 * @param int $post_id
 * @return string
 */
function get_site_meta_description( $post_id ) {
	return get_slim_seo_data( $post_id )['description'] ?? wp_get_document_title();
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

/**
 * Manage Slime SEO breadcrubms
 */
function manage_slim_seo_breadcrumbs( $links ) {

	/* Don't show category in breadcrumbs */
	if (is_singular('post')) {
		array_pop($links);
	}

	if ( is_category() || is_tag() ) {

		if ( $blog_page_id = get_option( 'page_for_posts' ) ) {
			$links[] = [
				'url' => get_permalink( $blog_page_id ),
				'text' => get_the_title( $blog_page_id ),
			];
		}
	}

	return $links;
}
