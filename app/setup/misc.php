<?php
/**
 * Misc theme
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Breadcrumbs
	add_filter( 'slim_seo_breadcrumbs_links', 'WBL\Theme\manage_slim_seo_breadcrumbs' );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------

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
