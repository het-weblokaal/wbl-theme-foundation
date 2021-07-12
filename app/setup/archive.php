<?php
/**
 * Misc theme
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Improve archive title
	add_filter( 'get_the_archive_title_prefix', 'WBL\Theme\get_the_archive_title_prefix' );
	add_filter( 'get_the_archive_title', 'WBL\Theme\get_the_archive_title', 10, 3 );



	// Improve archive description
	add_filter( 'get_the_archive_description', 'WBL\Theme\get_the_archive_description' );
	add_filter( 'get_the_archive_description', 'WBL\Theme\archive_description_archive_loop', 89 );
	add_filter( 'get_the_archive_description', 'WBL\Theme\archive_description_do_blocks', 99 );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------


function get_the_archive_title_prefix( $prefix ) {

	if (is_post_type_archive()) {
		$prefix = '';
	}

	return $prefix;
}

function get_the_archive_title( $title, $original_title, $prefix ) {

	if ( is_search() ) {
		$title = get_search_title();
	}
	elseif ( is_home() && !is_front_page() ) {
		$title = get_post_type_archive_title();
	}

	return $title;
}

function get_the_archive_description( $desc ) {

	$new_desc = '';

	if ( is_home() && ! is_front_page() ) {
		$new_desc = get_post_field( 'post_content', get_queried_object_id(), 'raw' );

	} elseif ( is_post_type_archive() ) {

		// This takes the assigned page in account because it uses get_post_type_object
		$new_desc = get_the_post_type_description();

	} elseif ( is_category() ) {
		$new_desc = get_term_field( 'description', get_queried_object_id(), 'category', 'raw' );

	} elseif ( is_tag() ) {
		$new_desc = get_term_field( 'description', get_queried_object_id(), 'post_tag', 'raw' );

	} elseif ( is_tax() ) {
		$new_desc = get_term_field( 'description', get_queried_object_id(), get_query_var( 'taxonomy' ), 'raw' );

	} elseif ( is_author() ) {
		$new_desc = get_the_author_meta( 'description', get_query_var( 'author' ) );
	}
	
	return $new_desc ?: $desc;
}

/**
 * Manage the loop in archive descriptions
 */
function archive_description_archive_loop( $desc = '' ) {

	// Add archive loop if archive description has no archive loop block
	if ( ! has_block( 'wbl-blocks/archive-loop', $desc ) ) {

		$loop_type = apply_filters( 'wbl/theme/template/loop/type', 'default', get_post_type_on_archive() );

		$desc .= Template::render( "loop/$loop_type" );
	}

	return $desc;
}

/**
 * Parse blocks on archive descriptions
 */
function archive_description_do_blocks( $desc = '' ) {

	if ( has_blocks( $desc ) ) {
		$desc = do_blocks($desc);
	}

	return $desc;
}
