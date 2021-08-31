<?php
/**
 * Site Logo template functions
 *
 * Just the site logo :)
 */

namespace WBL\Theme;

/**
 * Get the site logo (theme image, theme svg, custom-logo or text fallback)
 *
 * @return string
 */
function render_site_logo() {
	$html = '';

	// Try theme image logo
	if (file_exists(App::assets_path('img/logo.png'))) {

		// Setup theme logo
		$html = sprintf( '<img class="%s" src="%s" alt="%s" />', 
			'site-logo site-logo--image',
			App::assets_uri('img/logo.png'),
			'Logo ' . App::get_name()
		);
	}

	// Try theme svg logo
	elseif (file_exists(App::assets_path('svg/logo.svg'))) {

		$html = App::svg('logo');
	}

	// Try custom logo
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

	return apply_filters( 'wbl/theme/site-logo', $html );
}

function display_site_logo() {

    echo render_site_logo();
}
