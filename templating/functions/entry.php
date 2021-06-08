<?php
/**
 * Template entry functions.
 *
 * Most functions are inspired by Justin Tadlocks Hybrid Core: 
 * https://github.com/themehybrid/hybrid-core/blob/master/src/Post/functions-post.php
 */

namespace WBL\Theme;

/**
 * Returns the post title HTML.
 *
 * @param  array  $args
 * @return string
 */
function render_entry_title( array $args = [] ) {

	$args = wp_parse_args( $args, [
		'text'   => '%s',
		'tag'    => 'h2',
		'link'   => false,
		'class'  => 'entry__title',
	] );

	$text = sprintf( $args['text'], get_the_title() );

	if ( $args['link'] ) {
		$text = render_permalink( [ 'text' => $text ] );
	}

	$html = sprintf(
		'<%1$s class="%2$s">%3$s</%1$s>',
		tag_escape( $args['tag'] ),
		esc_attr( $args['class'] ),
		$text
	);

	return apply_filters( 'wbl/theme/entry/title', $html );
}

/**
 * Returns the post permalink HTML.
 *
 * @param  array  $args
 * @return string
 */
function render_entry_permalink( array $args = [] ) {

	$args = wp_parse_args( $args, [
		'text'   => '%s',
		'class'  => 'entry__permalink',
	] );

	$url = get_permalink();

	$html = sprintf(
		'<a class="%s" href="%s">%s</a>',
		esc_attr( $args['class'] ),
		esc_url( $url ),
		sprintf( $args['text'], esc_url( $url ) )
	);

	return apply_filters( 'wbl/theme/entry/permalink', $html );
}

/**
 * Returns the post author HTML.
 *
 * @param  array  $args
 * @return string
 */
function render_entry_author( array $args = [] ) {

	$args = wp_parse_args( $args, [
		'text'   => '%s',
		'class'  => 'entry__author',
		'link'   => false,
	] );

	$author = get_the_author();

	if ( $args['link'] ) {
		$url = get_author_posts_url( get_the_author_meta( 'ID' ) );

		$author = sprintf(
			'<a class="entry__author-link" href="%s">%s</a>',
			esc_url( $url ),
			$author
		);
	}

	$html = sprintf( '<span class="%s">%s</span>', esc_attr( $args['class'] ), $author );

	return apply_filters( 'wbl/theme/entry/author', $html );
}

/**
 * Returns the post date HTML.
 *
 * @param  array  $args
 * @return string
 */
function render_entry_date( array $args = [] ) {

	$args = wp_parse_args( $args, [
		'text'   => '%s',
		'class'  => 'entry__date',
		'format' => get_option( 'date_format' ),
		'nicename' => true,
	] );

	// Get post date
	$date = get_the_date( $args['format'] );

	// Get nicename of the date
	if ($args['nicename']) {

		// return 'today', 'yesterday' or date
		if ($date == wp_date( $args['format'] ) ) {
			$date = __('Vandaag', 'wbl-theme');
		}
		elseif ($date == wp_date( $args['format'], strtotime("-1 days") ) ) {
			$date = __('Gisteren', 'wbl-theme');
		}
		elseif ($date == wp_date( $args['format'], strtotime("-2 days") ) ||
			    $date == wp_date( $args['format'], strtotime("-3 days") ) ||
			    $date == wp_date( $args['format'], strtotime("-4 days") ) ) {
			$date = sprintf( _x('Afgelopen %s', 'datum', 'wbl-theme'), get_the_date( 'l' ) );
		}
	}

	$html = sprintf(
		'<time class="%s" datetime="%s">%s</time>',
		esc_attr( $args['class'] ),
		esc_attr( get_the_date( DATE_W3C ) ),
		sprintf( $args['text'], $date )
	);

	return apply_filters( 'wbl/theme/entry/date', $html	);
}

/**
 * Returns the post terms HTML.
 *
 * @param  array  $args
 * @return string
 */
function render_entry_terms( array $args = [] ) {

	$html = '';

	$args = wp_parse_args( $args, [
		'taxonomy'      => 'category',
		'text'          => '%s',
		'base_class'    => 'entry',
		'extra_classes' => '',
		'sep'           => ', ',
	] );

	// Append taxonomy to class name.
	$class = "{$args['base_class']}__terms {$args['base_class']}__terms--{$args['taxonomy']}";

	$terms = get_the_term_list( get_the_ID(), $args['taxonomy'], '', $args['sep'], '' );

	if ( $terms ) {

		$html = sprintf(
			'<span class="%s">%s</span>',
			esc_attr( $class ),
			sprintf( $args['text'], $terms )
		);
	}

	return apply_filters( 'wbl/theme/entry/terms', $html );
}


/**
 * Returns the password status HTML.
 *
 * @return string
 */
function render_entry_password_protection_status() {

	$html = '';

	$status = get_password_protection_status();

	if ($status == 'locked') {
		$html = '<span class="password-protection-status">Slotje</span>';
	}
	elseif ($status == 'opened') {
		$html = '<span class="password-protection-status">Slotje open</span>';
	}

	return $html;
}

/**
 * Render the post featured image
 *
 * @param  array  $args
 * @return string
 */
function render_featured_image( array $args = [] ) {

	$html = '';

	$args = wp_parse_args( $args, [
		'size' => 'thumbnail',
		'class' => ''
	] );

    if ($image_id = get_featured_image_id()) {
	    $html = \wp_get_attachment_image( $image_id, $args['size'], false, ['class' => $args['class']] );
	}

	return apply_filters( 'wbl/theme/entry/image', $html, $image_id, $args );
}
