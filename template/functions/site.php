<?php
/**
 * Site Logo template functions
 *
 * Just the site logo :)
 */

namespace WBL\Theme;

/**
 * Get the site logo (theme, custom-logo or text fallback)
 *
 * @return string
 */
function render_site_logo() {
	$html = '';

	// Try to get logo
	$theme_logo = apply_filters( 'wbl/theme/site-logo', Theme::get_asset_uri('img/logo.png') );

	if ($theme_logo) {

		// Setup theme logo
		$html = sprintf( '<img class="%s" src="%s" alt="%s" />', 
			'site-logo site-logo--image',
			$theme_logo,
			'Logo ' . Theme::get_name()
		);
	}

	elseif ( get_theme_support('custom-logo') ) {

		// Setup custom logo
		$html = get_custom_logo();
	}

	// Fallback to textlogo
	if ( ! $html ) {
		$html = sprintf( '<span class="%s">%s</span>', 
			'site-logo site-logo--text',
			get_bloginfo( 'name' )
		);
	} 

	return $html;
}

function display_site_logo() {

    echo render_site_logo();
}
