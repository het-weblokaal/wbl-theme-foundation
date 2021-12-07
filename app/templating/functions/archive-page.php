<?php

/**
 * Archive page functions
 *
 * Functionality archive pages for posts and custom post types like wbl_projects 
 */

namespace WBL\Theme;

/**
 * Get post type archive page
 * 
 * This functions supports 'post' and 'wbl_project'
 *
 * @return string or false
 */
function get_post_type_archive_page( $post_type = null ) {

	$post_id   = false;
	$post_type = ($post_type) ? $post_type : get_queried_post_type();

	// Posts
	if ($post_type == 'post') {
		$post_id = get_option( 'page_for_posts', false );
	}

	// WBL Projects
	elseif ($post_type == 'wbl_project') {

		if ( method_exists( 'WBL\Projects\PostType', 'get_archive_page' ) ) {
			$post_id = \WBL\Projects\PostType::get_archive_page();
		}
	}

	// Allow theme to override
	$post_id = apply_filters( 'wbl/theme/post_type_archive_page', $post_id, $post_type );

	return $post_id;
}

/**
 * Get post type archive url
 *
 * @return string or false
 */
function get_post_type_archive_url( $post_type = null ) {

	$url       = false;
	$post_type = ($post_type) ? $post_type : get_queried_post_type();

	// Get post-id of archive page
	$archive_post_id = get_post_type_archive_page( $post_type );

	// Get archive url
	if ($archive_post_id) {
		$url = get_permalink($archive_post_id);
	}
	else {

		// Fallback to home_url for posts
		if ($post_type == 'post') {
			$url = get_home_url();
		}
	}

	$url = apply_filters( 'wbl/theme/post_type_archive_url', $url, $post_type );

	return $url;
}

/**
 * Get post type archive title
 *
 * @return string or false
 */
function get_post_type_archive_title( $post_type = null ) {

	$title     = false;
	$post_type = ($post_type) ? $post_type : get_post_type();

	// Set the archive page as the title
	if ($post_id = get_post_type_archive_page( $post_type )) {
		$title = get_the_title($post_id);
	}

	// Or fallback to default titles
	else {
		if ($post_type == 'post') {
			$title = 'Blog';
		}
		elseif ($post_type == 'wbl_project') {

			if ( function_exists('WBL\Projects\PostType::get_name') ) {
				$title = \WBL\Projects\PostType::get_name();
			}
			else {
				$title = 'Projects';
			}
		}
	}

	$title = apply_filters( 'wbl/theme/post_type_archive_title', $title, $post_type );

	return $title;
}

/**
 * Get post type archive title
 *
 * @return string or false
 */
function get_post_type_archive_link( $post_type = null ) {

	$link = false;
	$post_type = ($post_type) ? $post_type : get_post_type();

	$url = get_post_type_archive_url( $post_type );
	$title = get_post_type_archive_title( $post_type );

	$link = sprintf( '<a href="%s">%s</a>',
		$url,
		$title
	);

	return $link;
}



/**
 * Get archive post type
 *
 * If there are zero results (or other parameters) in the archive query, get_post_type() isn't reliable for knowing
 * what the archive's post type is. This function gets the post type from the global $wp_query object instead.
 *
 * @link https://wordpress.stackexchange.com/a/377345/133100
 *
 * @return string or false
 */
function get_post_type_on_archive() {

    return get_queried_post_type();
}
