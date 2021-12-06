<?php
/**
 * Theme page template functions.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Add template for landing page.
	add_filter( 'theme_templates', 'WBL\Theme\custom_templates', 10, 4 );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------

/**
 * Filter used on `theme_templates` to add custom templates to the template
 * drop-down.
 *
 * @param  array   $templates
 * @param  object  $theme
 * @param  object  $post
 * @param  string  $post_type
 * @return array
 */
function custom_templates( $templates, $theme, $post, $post_type ) {

	$templates['landing-page'] = 'Landingspagina';

	return $templates;
}

