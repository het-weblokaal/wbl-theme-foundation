<?php
/**
 * Theme block functions.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hook it up
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	/**
	 * Add support for wide and full aligned blocks
	 *
	 * This adds nice layout diversity
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#wide-alignment
	 */
	add_theme_support( 'align-wide' );

	/**
	 * Automatically transform editor styles by selectively rewriting or adjusting certain CSS selectors.  
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#editor-styles
	 */
	add_theme_support( 'editor-styles' );

	/**
	 * Disable Core Block Patterns.
	 *
	 * They are not relevant for our users.
	 */
	remove_theme_support( 'core-block-patterns' );

	
	/**
	 * Remove access to the Block Directory (ie. installation of new blocks through the editor)
	 *
	 * We don't want our users to just install any block they like.
	 *
	 * @link https://developer.wordpress.org/block-editor/reference-guides/filters/editor-filters/#block-directory
	 */ 
	remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
	remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );

	/**
	 * Restrict the allowed blocks (opinionated)
	 *
	 * Themes can override this by hooking later to this filter.
	 *
	 * @link https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#hiding-blocks-from-the-inserter
	 */
	add_filter( 'allowed_block_types_all', __NAMESPACE__ . '\allowed_block_types', 10, 2 );

	/**
	 * Show block-editor on page_for_posts page (blog/home)
	 *
	 * @link 
	 */
	add_filter( 'replace_editor', __NAMESPACE__ . '\enable_block_editor_on_blog_page', 10, 2 );

}, 5 );

# ------------------------------------------------------------------------------
# Elaborate functionality
# ------------------------------------------------------------------------------

/**
 * Restrict allowed blocks
 *
 * @link https://gist.github.com/erikjoling/7b05c3e3411244d126808bab46529d78
 * @link https://github.com/WordPress/gutenberg/blob/trunk/packages/block-library/src/index.js 
 */
function allowed_block_types( $allowed_blocks, $post ) {

	$allowed_blocks = [

		// Core blocks
		'core/button',
		'core/buttons',
		'core/column',
		'core/columns',
		'core/cover',
		'core/embed',
		'core/file',
		'core/group',
		'core/heading',
		'core/html',
		'core/image',
		'core/list',
		'core/paragraph',
		'core/pullquote',
		'core/quote',
		'core/table',

		// WBL blocks
		'wbl-blocks/archive-loop',
		'wbl-blocks/posts',

		// WBL other blocks
		'wbl-projects/projects',

		// Third Party blocks
		'contact-form-7/contact-form-selector',
	];

	// Uncomment to allow all blocks
	// $allowed_blocks = true;

    return $allowed_blocks;
}


/**
 * Simulate non-empty content to enable Gutenberg editor
 *
 * @link   https://wordpress.stackexchange.com/a/350563/133100
 * @param  bool    $replace Whether to replace the editor.
 * @param  WP_Post $post    Post object.
 * @return bool
 */
function enable_block_editor_on_blog_page( $replace, $post ) {

    if ( ! $replace && absint( get_option( 'page_for_posts' ) ) === $post->ID && empty( $post->post_content ) ) {
        # This comment will be removed by Gutenberg since it won't parse into block.
        $post->post_content = '<!--non-empty-content-->';
    }

    return $replace;

}

/**
 * Add menu_order to the list of permitted orderby values
 *
 * Fixes an error in the block editor. `rest_invalid_param` orderby
 *
 * @link https://www.timrosswebdevelopment.com/wordpress-rest-api-post-order/
 */
function filter_add_rest_orderby_params( $params ) {
	$params['orderby']['enum'][] = 'menu_order';
	return $params;
}
