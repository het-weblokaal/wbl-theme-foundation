<?php
/**
 * Misc theme
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Improve archive description
	add_filter( 'get_the_archive_description', 'WBL\Theme\get_the_archive_description' );

	add_filter( 'get_the_archive_description', 'WBL\Theme\archive_description_do_blocks', 99 );

	// Breadcrumbs
	add_filter( 'slim_seo_breadcrumbs_links', 'WBL\Theme\manage_slim_seo_breadcrumbs' );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------


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

function archive_description_do_blocks( $desc ) {

	if ( ! has_block( 'wbl-blocks/archive-loop', $desc ) ) {

		$loop_format = apply_filters( 'wbl/theme/template/loop_format', 'blog', get_post_type_on_archive() );

		$desc .= Template::render( "loop/$loop_format" );
	}
	
	if ( has_blocks( $desc ) ) {
		$desc = do_blocks($desc);
	}

	return $desc;
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
