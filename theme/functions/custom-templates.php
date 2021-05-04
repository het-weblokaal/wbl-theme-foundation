<?php
/**
 * Theme page template functions.
 */

namespace WBL\Theme;


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

	$templates['landing-page'] = 'Landing Page';

	return $templates;
}

