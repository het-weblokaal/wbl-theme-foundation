<?php
/**
 * Theme entry functions.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Change entry classes
	add_filter( 'wbl/theme/template/data/entry/blog', 'WBL\Theme\default_entry_classes' );

	// Remove link from excerpt
	add_filter( 'excerpt_more', 'WBL\Theme\edit_excerpt_more' ); 

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------

/**
 * Manage the extra entry classes
 */
function default_entry_classes( $template_data ) {

	if ($status = get_password_protection_status()) {
		$template_data['args']['extra_classes'][] = 'is-password-protected';
		$template_data['args']['extra_classes'][] = "is-password-protected--$status";
	}

	if ( has_post_thumbnail() ) {
		$template_data['args']['extra_classes'][] = 'has-featured-image';
	}

	return $template_data;
}


/**
 * Excerpts
 */
function edit_excerpt_more( $more ) {

    return "&nbsp;<span class=\"excerpt__delimiter\">...<span>";
}
