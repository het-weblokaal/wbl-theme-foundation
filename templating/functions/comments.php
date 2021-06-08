<?php
/**
 * Comment functions.
 *
 * Inspired/copied from Justin Tadlock <justintadlock@gmail.com>
 */

namespace WBL\Theme;


/**
 * Outputs the comment date HTML.
 *
 * @param  array   $args
 * @return void
 */
function display_comment_date( array $args = [] ) {

	echo render_comment_date( $args );
}

/**
 * Returns the comment date HTML.
 *
 * @param  array   $args
 * @return string
 */
function render_comment_date( array $args = [] ) {

	$html = '';

	$args = wp_parse_args( $args, [
		'text'   => '%s',
		'format' => '',
	] );

	$html = sprintf(
		'<time datetime="%s">%s</time>',
		esc_attr( get_comment_date( DATE_W3C ) ),
		sprintf( $args['text'], esc_html( get_comment_date( $args['format'] ) ) )
	);

	return $html;
}

/**
 * Returns the comment reply link HTML.  Note that WP's `comment_reply_link()`
 * doesn't work outside of `wp_list_comments()` without passing in the proper
 * arguments (it isn't meant to).  This function is just a wrapper for
 * `get_comment_reply_link()`, which adds in the arguments automatically.
 *
 * @param  array  $args
 * @return string
 */
function render_reply_link( array $args = [] ) {

	// Array of comment types that are not allowed to have replies.
	$disallowed = [
		'pingback',
		'trackback'
	];

	if ( ! get_option( 'thread_comments' ) || in_array( get_comment_type(), $disallowed ) ) {
		return '';
	}

	$args = wp_parse_args( $args, [
		'depth'     => intval( $GLOBALS['comment_depth'] ),
		'max_depth' => get_option( 'thread_comments_depth' ),
		// 'class'     => 'comment__reply'
	] );

	$html = get_comment_reply_link( $args );

	// if ( $html ) {

	// 	$html = preg_replace(
	// 		"/class=(['\"]).+?(['\"])/i",
	// 		'class=$1' . esc_attr( $args['class'] ) . ' comment-reply-link$2',
	// 		$html,
	// 		1
	// 	);
	// }

	return $html;
}

/**
 * Conditional function to check if a comment is approved.
 *
 * @since  5.0.0
 * @access public
 * @param  \WP_Comment|int  Comment object or ID.
 * @return bool
 */
function is_approved_comment( $comment = null ) {
	$comment = get_comment( $comment );

	return 'approved' === wp_get_comment_status( $comment->ID );
}
