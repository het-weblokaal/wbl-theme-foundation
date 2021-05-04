<?php
/**
 * Theme entry functions.
 */

namespace WBL\Theme;


/**
 * Manage the extra entry classes
 */
function extra_entry_classes( $template_data ) {

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
