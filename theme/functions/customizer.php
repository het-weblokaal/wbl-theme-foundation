<?php
/**
 * Theme customizer functions.
 */

namespace WBL\Theme;

use Kirki;

/**
 * Manage the panels and sections of the customizer
 *
 * Note: Removing customizer stuff should be done through filter which is fired
 *       before theme.
 *
 * @link https://developer.wordpress.org/reference/hooks/customize_loaded_components/
 */
function manage_customizer( $wp_customize ) {

  // $wp_customize->remove_panel( 'nav_menus');
  // $wp_customize->remove_section( 'static_front_page');

  // $wp_customize->remove_section( 'title_tagline');
  // $wp_customize->remove_section( 'colors');
  // $wp_customize->remove_section( 'header_image');
  // $wp_customize->remove_section( 'background_image');
  // $wp_customize->remove_section( 'custom_css');

}
