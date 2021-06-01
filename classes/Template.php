<?php
/**
 * Het Weblokaal Templating Class
 *
 * This class offers an API for WordPress themes to implement a standardized template organization
 */

namespace WBL\Theme;

/**
 * Template Class
 */
final class Template {

	/**
	 * Arguments to customize
	 *
	 * @var array
	 */
	private static $args = [
		'main_template_dir' => 'vendor/het-weblokaal/wbl-theme-foundation/template/views'
	];

	/**
	 * Template folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $main_template_dir;

	/**
	 * Template folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $custom_template_dir;

	/**
     * Constructor method.
     *
     * @return void
     */
    private function __construct() {}


	/*=============================================================*/
	/**                        Getters                             */
	/*=============================================================*/


	/**
	 * Gets the main template directory
	 *
	 * @return string
	 */
	private static function get_main_template_dir() {

		// Initialize if it's not set yet
		if ( is_null(static::$main_template_dir) ) {
			static::set_main_template_dir();
		}

		return static::$main_template_dir;
	}

	/**
	 * Gets the custom template directory
	 *
	 * @return string
	 */
	private static function get_custom_template_dir() {

		// Initialize if it's not set yet
		if ( is_null(static::$custom_template_dir) ) {
			static::set_custom_template_dir();
		}

		return static::$custom_template_dir;
	}


	/*=============================================================*/
	/**                        Setters                             */
	/*=============================================================*/


	/**
	 * Sets the main template directory
	 *
	 * @return void
	 */
	private static function set_main_template_dir() {

		// Set the template dir based on class $args
		$main_template_dir = static::$args['main_template_dir'];

		// Not leading and trailing slashes
		$main_template_dir = trim($main_template_dir, '/');

		static::$main_template_dir = $main_template_dir;
	}

	/**
	 * Sets the custom template directory
	 *
	 * @return void
	 */
	private static function set_custom_template_dir() {

		// Set the template dir based on class $args
		$custom_template_dir = Theme::get_template_dir();

		// Not leading and trailing slashes
		$custom_template_dir = trim($custom_template_dir, '/');

		static::$custom_template_dir = $custom_template_dir;
	}


	/*=============================================================*/
	/**                        General                             */
	/*=============================================================*/

	/**
	 * Render template file
	 */
	public static function render( $slug, $name = null, $args = null ) {

		ob_start();

		static::display( $slug, $name, $args);

		return ob_get_clean();
	}


	/**
	 * Display template file
	 *
	 * This is a wrapper around the default WordPress template functionality
	 * though it also changes some functionality. All expected hooks are present.
	 *
	 * @link /wp-includes/general-template.php
	 */
	public static function display( $slug, $hierarchy = [], $args = [] ) {

		// Default args
		$args = wp_parse_args( $args, [
			'extra_classes' => [],
			'attr' => [],
		] );

		// Add query_args to loops
		if( strpos( $slug, 'loop' ) !== false) {
			$args['query_args'] = $args['query_args'] ?? [];
		}
		
		// Setup template data
		$template_data = [
			'slug' => $slug,
			'hierarchy' => $hierarchy,
			'args' => $args,
			'custom_template' => null,
		];

		// Allow to change the template data
		$template_data = apply_filters( "wbl/theme/template/data/{$slug}", $template_data);

		// Set slug, hierarchy and args based on filtered template_data
		$slug = $template_data['slug'];
		$hierarchy = $template_data['hierarchy'];
		$args = $template_data['args'];
		$custom_template = $template_data['custom_template'];

		// WordPress Core Action
		do_action( "get_template_part_{$slug}", $slug, $hierarchy, $args );

		// Setup templates
		$templates = static::setup_templates($slug, $hierarchy);

		// Add custom template to top of priority if it is set
		if ( $custom_template ) {			
			array_unshift($templates, $custom_template);
		}
		
		// WordPress Core Action
		do_action( 'get_template_part', $slug, $hierarchy, $templates, $args );
		
		// Theme::log($templates);

		$locate_template = locate_template( $templates, true, false, $args );

		if ( $locate_template ) {
			// Theme::log($locate_template);
			// Theme::log($template_data);
    	}
    	else {
			Theme::log($templates);
    		Theme::log('Template not found');
		    return false;
    	}
	}

	/**
	 * Setup template intention list
	 *
	 * @return array
	 */
	private static function setup_templates($slug, $hierarchy) {

		$_templates = array();
		$templates = array();
		
		/**
		 * Set template priority
		 *
		 * - A template with a specific name is higher in order than the basic template
		 * - The custom template is higher in order than main template
		 */

		if ( is_array($hierarchy) ) {
			foreach ($hierarchy as $name) {
				$_templates[] = "{$slug}/{$name}.php";
			}
		}

		// Fallback template
		$_templates[] = "{$slug}.php";

		// Add custom path to templates
		foreach ($_templates as $template) {
			$templates[] = static::get_custom_template_path( $template );
		}

		// Add main path to templates as fallback
		foreach ($_templates as $template) {
			$templates[] = static::get_main_template_path( $template );
		}

		return $templates;
	}

	
	/*=============================================================*/
	/**                       Utilities                            */
	/*=============================================================*/


	/**
	 * Get the main template path
	 *
	 * @param string $relative_file relative to the template directory
	 * @return string relative filepath
	 */
	public static function get_main_template_path( $relative_file = '' ) {

		// Remove any leading and trailing slashes
		$relative_file = trim( $relative_file, '/' );

		return static::get_main_template_dir() . '/' . $relative_file;
	}

	/**
	 * Get the template relative path
	 *
	 * @param string $relative_file relative to the template directory
	 * @return string relative filepath
	 */
	public static function get_custom_template_path( $relative_file = '' ) {

		// Remove any leading and trailing slashes
		$relative_file = trim( $relative_file, '/' );

		return static::get_custom_template_dir() . '/' . $relative_file;
	}

	/**
	 * Get template hierarchy
	 *
	 * @link https://github.com/themehybrid/hybrid-core/blob/master/src/Template/Hierarchy.php
	 * @return array
	 */
	public static function hierarchy() {	

		$template_hierarchy = ['index'];

		// Try `Page not found` template_type
		if (is_404()) {
			$template_hierarchy[] = '404';
		}

		// Try singular template hierarchy
		elseif (\is_singular()) {
			$template_hierarchy[] = get_post_type();

			// Display custom page-template
			if ( $page_template = get_page_template_slug() ) {

				// Strip potential .php extension from template name
				$template_hierarchy[] = rtrim($page_template, '.php');
			}
		}

		// Try archive template hierarchy
		elseif (is_archive() || is_home() || is_search()) {
			$template_hierarchy[] = 'archive';

			// Display search page template
			if (is_search()) {
				$template_hierarchy[] = 'archive-search';
			}
			elseif (\is_home() || \is_post_type_archive()) {
				$template_hierarchy[] = 'archive-' . get_post_type_on_archive();
			}
			elseif (\is_category() || \is_tag() || \is_tax()) {
				$template_hierarchy[] = 'archive-tax';

				if (\is_category()) {
					$template_hierarchy[] = 'archive-tax-category';
				}
				elseif (\is_tag()) {
					$template_hierarchy[] = 'archive-tax-tag';
				}
				elseif (\is_tax()) {
					$template_hierarchy[] = 'archive-tax-' . get_query_var( 'taxonomy' );
				}
			}
			elseif (\is_author()) {
				$template_hierarchy[] = 'archive-author';
			}
			elseif (\is_date()) {
				$template_hierarchy[] = 'archive-date';
			}
		}

		return array_reverse( $template_hierarchy );
	}

	/**
	 * Get template hierarchy
	 *
	 * @link https://github.com/themehybrid/hybrid-core/blob/master/src/Template/Hierarchy.php
	 * @return array
	 */
	public static function entry_hierarchy() {	

		$template_hierarchy = ['index'];

		$template_hierarchy[] = get_post_type();

		if (is_search() && is_main_query()) {
			$template_hierarchy[] = 'search';
		}

		return array_reverse( $template_hierarchy );
	}


	/**
	 * Allow arguments to be customized
	 *
	 * @return void
	 */
	public static function customize( $custom_args ) {

		// Parse the custom arguments
		$custom_args = wp_parse_args( $custom_args, static::$args );

		// Set new args
		static::$args = $custom_args;
	}

	/**
	 * Kickstart templates
	 *
	 * @return void
	 */
	public static function kickstart() {

		static::display('index');
	}

	/**
	 * Log data to wp-content/debug.log
	 *
	 * It doesn't matter if WP_DEBUG is true because I also want to be able
	 * to log on production environment (which has WP_DEBUG disabled)
	 */
	public static function status_log()  {

	    // Set properties
		Theme::log( '' );
		Theme::log( '====== START: TEMPLATE STATUS LOG ======' );
		Theme::log( '' );
		Theme::log( '' );
		Theme::log( '   args:      ' );
		Theme::log( static::$args );
		Theme::log( '   main_template_dir:        ' . static::get_main_template_dir() );
		Theme::log( '   custom_template_dir:      ' . static::get_custom_template_dir() );
		Theme::log( '' );
		Theme::log( '' );
		Theme::log( '======= END: TEMPLATE STATUS LOG =======' );
		Theme::log( '' );
	}
}

