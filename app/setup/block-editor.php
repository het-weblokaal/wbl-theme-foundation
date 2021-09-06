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
	 * Show block-editor on page_for_posts page (blog/home)
	 *
	 * @link 
	 */
	add_filter( 'replace_editor', __NAMESPACE__ . '\enable_block_editor_on_blog_page', 10, 2 );

	/**
	 * Disable block editor functionality
	 */
	add_filter( 'block_editor_settings_all', __NAMESPACE__ . '\disable_drop_cap_feature' );
	add_filter( 'block_editor_settings_all', __NAMESPACE__ . '\disable_duotone_feature' );
	add_filter( 'block_editor_settings_all', __NAMESPACE__ . '\disable_layout_feature' );
	add_filter( 'block_editor_settings_all', __NAMESPACE__ . '\disable_template_editor' );

}, 5 );

# ------------------------------------------------------------------------------
# Elaborate functionality
# ------------------------------------------------------------------------------

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

/**
 * Disable the drop cap feature
 * 
 * @link https://github.com/joppuyo/disable-drop-cap/blob/master/remove-drop-cap.php
 */
function disable_drop_cap_feature( $editor_settings ) {

	if (isset($editor_settings['__experimentalFeatures']['typography']['dropCap'])) {
		$editor_settings['__experimentalFeatures']['typography']['dropCap'] = false;
	}

    return $editor_settings;
}

/**
 * Disable the duotone feature
 */
function disable_duotone_feature( $editor_settings ) {

	if (isset($editor_settings['__experimentalFeatures']['color']['duotone'])) {
	    $editor_settings['__experimentalFeatures']['color']['customDuotone'] = false;
	    $editor_settings['__experimentalFeatures']['color']['duotone'] = false;
	}

    return $editor_settings;
}

/**
 * Disable the layout feature
 */
function disable_layout_feature( $editor_settings ) {

	// App::log($editor_settings);
	if (isset($editor_settings['supportsLayout'])) {
    	$editor_settings['supportsLayout'] = false;
    }

    return $editor_settings;
}

/**
 * Disable the template editor
 */
function disable_template_editor( $editor_settings ) {

	if (isset($editor_settings['supportsTemplateMode'])) {
    	$editor_settings['supportsTemplateMode'] = false;
    }

    return $editor_settings;
}


/**
 * Get global styles (wp 5.8)
 * 
 * We don't use theme.json (yet). There are some things which won't coorperate
 * with what we want for our websites. Like the opionated layout styling which
 * we cannot disable.
 * 
 * But there are some things about theme.json which are nice. It injects some of
 * the values as inline css to the frontend and the editor. This prevents us from
 * having to duplicate the values. With this function we intend to mimic this
 * behavior. We define our color palette and our typography with theme-support and
 * we inject this in the same way as with theme.json WP5.8.
 * 
 * The theme needs to enqueue the global styles
 * 
 * @link: https://github.com/WordPress/gutenberg/blob/trunk/lib/global-styles.php
 * 
 * @return string $css
 */
function get_global_styles( $root = ':root' ) {

	// Get theme colors and font-sizes from theme-support
	$colors = get_theme_support( 'editor-color-palette' )[0] ?? [];
	$font_sizes = get_theme_support( 'editor-font-sizes' )[0] ?? [];

	if ( !$colors && !$font_sizes ) {
		return;
	}

	$css = "{$root} { \n";

	/**
	 * 1. Add custom properties
	 */

	// Colors
	foreach ( $colors as $color ) {
		$css .= "   --wp--preset--color--{$color['slug']}: {$color['color']};\n";
	}

	// Font-sizes
	foreach ( $font_sizes as $font_size ) {
		$css .= "   --wp--preset--font-size--{$font_size['slug']}: {$font_size['size']};\n";
	}

	$css .= "}\n";

	/**
	 * 2. Add helpers
	 */

	// Colors
	foreach ( $colors as $color ) {

		// background-color
		$css .= ".has-{$color['slug']}-background-color { background-color: var(--wp--preset--color--{$color['slug']}); }\n";

		// color
		$css .= ".has-{$color['slug']}-color { color: var(--wp--preset--color--{$color['slug']}); }\n";
	}

	// Font-sizes
	foreach ( $font_sizes as $font_size ) {
		$css .= ".has-{$font_size['slug']}-font-size { font-size: var(--wp--preset--font-size--{$font_size['slug']}); }\n";
	}

	$css = rtrim($css, "\n");

	return $css;
}
