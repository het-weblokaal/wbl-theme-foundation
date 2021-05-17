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

	// Manage default scripts & styles
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\add_frontend_scripts_and_styles' );

	// Add theme editor style to editor
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\add_editor_scripts_and_styles' );

	// Remove google font from block editor
	add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\remove_google_font_from_block_editor' );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------

/**
 * Add default scripts/styles
 */
function add_frontend_scripts_and_styles() {

	// Add default script js/theme.js
	wp_enqueue_script( 
		Theme::handle(), 
		Theme::asset( 'js/theme.js' ), 
		null, 
		null, 
		true 
	);

	// Add default stylesheet css/styles.css
	wp_enqueue_style( Theme::handle(), Theme::asset( 'css/style.css' ), null, null );
}

/**
 * Remove block-editor styles
 */
function remove_frontend_block_editor_styles() {
	wp_dequeue_style( 'wp-block-library' );
}


/**
 * Remove core editor google font
 */
function add_editor_scripts_and_styles() {

	// Add script for block editor
	wp_enqueue_script( 
		Theme::handle('block-editor'), 
		Theme::asset( 'js/block-editor.js' ), 
		[ 
			'wp-blocks', 
			'wp-i18n', 
			'wp-data', 
			'wp-dom-ready', 
			'wp-edit-post', 
			'wp-hooks'
		] 
	);

	// Add styles for block editor
	wp_enqueue_style( Theme::handle('editor'), Theme::asset( 'css/editor-style.css' ), null, null );
}


/**
 * Remove core editor google font
 */
function remove_google_font_from_block_editor() {
	wp_deregister_style( 'wp-editor-font' );
	wp_register_style( 'wp-editor-font', '' );
}
