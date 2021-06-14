<?php
namespace WBL\Theme;


/**
 * Transform array to HTML attributes
 *
 * Example ['lang' => 'nl'] becomes lang="nl"
 *
 * @param 	array
 * @return 	string
 */
function html_attributes( $attr ) {
	$html = '';

	foreach ( $attr as $name => $value ) {

		$esc_value = '';

		// If the value is a link `href`, use `esc_url()`.
		if ( $value !== false && 'href' === $name ) {
			$esc_value = esc_url( $value );

		} elseif ( $value !== false ) {
			$esc_value = esc_attr( $value );
		}

		$html .= false !== $value ? sprintf( ' %s="%s"', esc_html( $name ), $esc_value ) : esc_html( " {$name}" );
	}

	return trim( $html );
}

/**
 * Transform array to HTML classes
 *
 * Example ['class-1', 'class-2'] becomes "class-1 class-2"
 *
 * @param array|string $classes
 * @param bool  $show_class_attribute
 * @return string
 */
function html_classes( $classes, $show_class_attribute = false ) {

	$html = '';

	if ( is_array($classes) && $classes ) {
		$html = esc_attr( implode( ' ', $classes ) );
		$html = trim( $html );
	}
	elseif ( is_string($classes) && $classes ) {
		$html = esc_attr( $classes );
	}

	return ($show_class_attribute) ? "class=\"$html\"": $html;
}

/**
 * Add class based on check
 */
function maybe_render( $text, $check = false ) {
	return ($check) ? $text : '';
}

/**
 * Add class based on check
 */
function maybe_add_class( $class, $check = false ) {
	return maybe_render( $class, $check );
}



