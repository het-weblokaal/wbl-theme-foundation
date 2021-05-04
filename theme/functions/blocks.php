<?php
/**
 * Setup blocks, categories and patterns.
 */

namespace WBL\Theme;

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

