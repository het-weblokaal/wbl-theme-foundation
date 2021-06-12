<?php
/**
 * Site-related functions and filters.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Viewport and charset
	add_action( 'wp_head', 'WBL\Theme\site_meta_charset',   0 );
	add_action( 'wp_head', 'WBL\Theme\site_meta_viewport',  1 );

	// HTML <head> cleanup
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 ); // remove REST API link
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' ); // remove Oembed links which allow the site to be embedded in other sites
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // remove Shortlink meta

	// Make theme data available in JS
	add_action( 'wp_footer',    'WBL\Theme\add_theme_data_script' );
	add_action( 'admin_footer', 'WBL\Theme\add_theme_data_script' );

	// Automatically add the `<title>` tag.
	add_theme_support( 'title-tag' );

	// HTML5 Support
	add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ] );

	// Body Class
	add_filter( 'body_class', 'WBL\Theme\body_class' );

}, 5 );

add_action( 'init', function() { 

	// Oembed: Remove javascript which is used to embed other sites in a page
	wp_deregister_script( 'wp-embed' );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------


/**
 * Adds the meta charset to the header.
 */
function site_meta_charset() {

	echo sprintf( '<meta charset="%s" />' . "\n", esc_attr( \get_bloginfo( 'charset' ) ) );
}

/**
 * Adds the meta viewport to the header.
 */
function site_meta_viewport() {

	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";
}

/**
 * Make theme data (like version) available to scripts
 */
function add_theme_data_script() {

	$theme = [
		'id' => App::get_id(),
		'version' => App::get_version(),
		'assetUri' => App::get_asset_uri(),
	];

	echo "<script>var theme = ", json_encode( $theme, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ), "</script>";
}

/**
 * Returns the body classes.
 *
 * @return string
 */
function body_class( $classes ) {

	// Reset..
	$classes = [];

	// Get template types
	$template_types = Template::get_template_types();

	// Reverse the types to make more sense as css classes
	$template_types = array_reverse( $template_types );

	foreach ($template_types as $template_type) {
		$classes[] = "is-{$template_type}";
	}

	/**
	 * Other classes
	 */

	if ($status = get_password_protection_status()) {
		$classes[] = 'is-password-protected';
		$classes[] = "is-password-protected--$status";
	}

	if ( \is_admin_bar_showing() ) {
		$classes[] = 'has-admin-bar';
	}

	if ( App::is_debug_mode() ) {
		$classes[] = "is-debug-mode";
		$classes[] = "is-debug-mode--" . wp_get_environment_type();
	}

	return array_map( 'esc_attr', $classes );
}
