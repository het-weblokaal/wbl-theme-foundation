<?php

/**
 * Page template functions
 *
 * Things title, featured image
 */

namespace WBL\Theme;

/**
 * Get the queried post type
 * 
 * On a regular page it will be just the page. But on archives it will be
 * the queried post_type
 * 
 * @return string $post_type
 */
function get_queried_post_type() {

	$post_type = get_post_type();

	if ( is_home() || is_archive() ) {

		// There is no post_type when there are zero results in archive query
		if ( !$post_type ) {

    		// Try to get post type form wp_query object
    		$post_type = $GLOBALS['wp_query']->query['post_type'] ?? $post_type;
		}
	}
	
	return $post_type;
}

/**
 * Get page title
 *
 * Note: we use `get_queried_object_id()` so we can get page title even inside other loops
 */
function get_page_title() {

	$page_title = '';

	if ( \is_singular() ) {
		$page_title = get_the_title(get_queried_object_id());
	}

	elseif ( \is_404() ) {
		$page_title = get_404_title();
	}

	elseif ( \is_search() ) {
		$page_title = get_search_title();
	}

	elseif (is_home()) {

		if (is_front_page()) {
			$page_title = 'Home';
		}
		else {
			$page_title = get_the_title(get_queried_object_id());
		}
	}

	elseif ( \is_post_type_archive() ) {
		$page_title = post_type_archive_title( '', false );
	}

	elseif ( \is_tax() || \is_category() || \is_tag() ) {
		$page_title = get_the_archive_title();
		// $page_title = single_term_title( '', false );
	}

	elseif ( \is_author() ) {
		$page_title = get_the_author_meta( 'display_name', absint( get_query_var( 'author' ) ) );
	}

	return apply_filters( 'page_title', $page_title );
}

function get_single_title() {

	$single_title = '';

	if ( \is_singular() ) {
		$single_title = get_the_title(get_queried_object_id());
	}

	elseif ( \is_404() ) {
		$single_title = get_404_title();
	}

	return $single_title;
}

/**
 * Get archive title
 *
 * Note: we use `get_queried_object_id()` so we can get page title even inside other loops
 */
function get_archive_title() {
		
	$archive_title = '';

	if ( \is_search() ) {
		$archive_title = get_search_title();
	}

	elseif (is_home()) {

		if (is_front_page()) {
			$archive_title = 'Home';
		}
		else {
			$archive_title = get_the_title(get_queried_object_id());
		}
	}

	elseif ( \is_post_type_archive() ) {
		$archive_title = post_type_archive_title( '', false );
	}

	elseif ( \is_tax() || \is_category() || \is_tag() ) {
		$archive_title = get_the_archive_title();
		// $archive_title = single_term_title( '', false );
	}

	elseif ( \is_author() ) {
		$archive_title = get_the_author_meta( 'display_name', absint( get_query_var( 'author' ) ) );
	}

	return $archive_title;
}


function get_search_title() {

	$title = sprintf( esc_html__( 'Zoekresultaten voor: %s', 'wbl-theme' ), get_search_query() );

	return apply_filters( 'wbl/theme/search/title', $title );
}

function get_404_title() {

	$title = __('Pagina niet gevonden', 'wbl-theme');

	return apply_filters( 'wbl/theme/404/title', $title );
}

function get_404_content() {

	$content = __("Sorry, we kunnen de opgevraagde pagina niet vinden... :(", 'wbl-theme');

	return apply_filters( 'wbl/theme/404/content', $content );
}

