<?php

/**
 * HTML <head> functions
 *
 * Things like charset, viewport
 */

namespace WBL\Theme;


/**
 * Render attributes for the HTML element
 */
function render_html_attributes() {
	$attr = [];

	$parts = \wp_kses_hair( \get_language_attributes(), [ 'http', 'https' ] );

	if ( $parts ) {

		foreach ( $parts as $part ) {

			$attr[ $part['name'] ] = $part['value'];
		}
	}

	return html_attributes( $attr );
}

/**
 * Display attributes for the HTML element
 */
function display_html_attributes() {
	echo render_html_attributes();
}

/**
 * Render classes for the body element
 */
function render_body_classes() {
	return html_classes( \get_body_class(), false );
}

/**
 * Display classes for the body element
 */
function display_body_classes() {
	echo render_body_classes();
}

/**
 * Adds the meta charset to the header.
 */
function display_meta_charset() {

	echo sprintf( '<meta charset="%s" />' . "\n", esc_attr( \get_bloginfo( 'charset' ) ) );
}

/**
 * Adds the meta viewport to the header.
 */
function display_meta_viewport() {

	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";
}