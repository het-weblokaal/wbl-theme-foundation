<?php
/**
 * Asset-related functions and filters.
 *
 * This file holds some setup actions for scripts and styles as well as a helper
 * functions for work with assets.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Remove google font from block editor
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\remove_google_font_from_block_editor' );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------


/**
 * Remove core editor google font
 */
function remove_google_font_from_block_editor() {
	wp_deregister_style( 'wp-editor-font' );
	wp_register_style( 'wp-editor-font', '' );
}
