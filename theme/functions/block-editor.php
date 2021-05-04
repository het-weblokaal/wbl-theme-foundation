<?php
/**
 * Theme block functions.
 */

namespace WBL\Theme;


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