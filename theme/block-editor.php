<?php
/**
 * Theme block functions.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	add_theme_support( 'editor-styles' );

	// Alignment
	add_theme_support( 'align-wide' );

	// Disable custom colors
	add_theme_support( 'disable-custom-colors' );

	// Disable gradients
	add_theme_support( 'editor-gradient-presets' );
	add_theme_support( 'disable-custom-gradients' );

	// Disable font-sizes
	add_theme_support( 'editor-font-sizes' );
	add_theme_support( 'disable-custom-font-sizes' );

	// Custom Spacing (Experimental)
	// add_theme_support( 'experimental-custom-spacing' );

	// Core Block Patterns
	remove_theme_support( 'core-block-patterns' );
	
	// Remove block directory (installation of new blocks through the editor)
	remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
	remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );

	// Setup allowed blocks
	add_filter( 'allowed_block_types', 'WBL\Theme\allowed_block_types', 10, 2 );

	// Show gutenberg on page_for_posts page (blog/home)
	add_filter( 'replace_editor', 'WBL\Theme\enable_block_editor_on_blog_page', 10, 2 );

}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------

/**
 * Get the allowed blocks (used by filter)
 */
function allowed_block_types( $allowed_blocks, $post ) {

	$allowed_blocks = [
		// 'core/archives',
		// 'core/audio',
		// 'core/block',
		'core/button',
		'core/buttons',
		// 'core/calendar',
		// 'core/categories',
		// 'core/classic',
		// 'core/code',
		'core/column',
		'core/columns',
		'core/cover',
		'core/embed',
		// 'core-embed/youtube',
		'core/file',
		// 'core/gallery',
		'core/group',
		'core/heading',
		'core/html',
		'core/image',
		// 'core/latest-comments',
		// 'core/latest-posts',
		// 'core/legacy-widget',
		'core/list',
		// 'core/media-text',
		// 'core/missing',
		// 'core/more',
		// 'core/navigation-link',
		// 'core/navigation',
		// 'core/nextpage',
		'core/paragraph',
		// 'core/post-author',
		// 'core/post-comments-count',
		// 'core/post-comments-form',
		// 'core/post-comments',
		// 'core/post-content',
		// 'core/post-date',
		// 'core/post-excerpt',
		// 'core/post-featured-image',
		// 'core/post-tags',
		// 'core/post-title',
		// 'core/preformatted',
		'core/pullquote',
		// 'core/query-loop',
		// 'core/query-pagination',
		// 'core/query',
		'core/quote',
		// 'core/rss',
		// 'core/search',
		// -- 'core/separator',
		// 'core/shortcode',
		// 'core/site-logo',
		// 'core/site-tagline',
		// 'core/site-title',
		// 'core/social-link',
		// 'core/social-links',
		// 'core/spacer',
		// 'core/subhead',
		'core/table',
		// 'core/tag-cloud',
		// 'core/template-part',
		// 'core/text-columns',
		// 'core/verse',
		// 'core/video',
		// 'core/widget-area',

		// 'wbl/segment',
		// 'wbl/container',

		'contact-form-7/contact-form-selector',
	];

	// Uncomment to allow all blocks
	// return true;

	// Allow all blocks if no blocks are specified
    return apply_filters( 'wbl/theme/allowed_block_types', $allowed_blocks );
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
