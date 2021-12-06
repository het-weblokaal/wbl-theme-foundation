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
     * Constructor method.
     *
     * @return void
     */
    private function __construct() {}


	/**
	 * Render template file
	 */
	public static function render( $slug, $hierarchy = null, $args = [] ) {

		ob_start();

		static::display( $slug, $hierarchy, $args );

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
	public static function display( $slug = 'index', $hierarchy = null, $args = [] ) {

		// Opinionated hierarchy (override by `false` or array)
		if ( is_null($hierarchy) ) {
			
			// The index, site and page have page_hierarchy
			if ( substr( $slug, 0, 5 ) === "index" || substr( $slug, 0, 4 ) === "site" || substr( $slug, 0, 4 ) === "page" ) {
				$hierarchy = static::page_hierarchy();
			}

			// Loops have page hierarchy, loop entries have entry_hierarchy
			if ( substr( $slug, 0, 4 ) === "loop" ) {

				if (strpos( $slug, "entry" ) !== false ) {
					$hierarchy = static::entry_hierarchy();
				}
				else {
					$hierarchy = static::page_hierarchy();
				}
			}

			// The rest doesn't need template hierarchy. I.e. loops and components are unique templates
		}

		// Default args
		$args = wp_parse_args( $args, [
			'extra_classes' => [],
			'attr' => [],
		] );
		
		// Setup template data
		$template_data = [
			'slug' => $slug,
			'hierarchy' => $hierarchy,
			'args' => $args,
		];

		// App::log($template_data);
		// App::log($slug);

		// Allow to change the template data
		$template_data = apply_filters( "wbl/theme/template/data/{$slug}", $template_data);

		// Set slug, hierarchy and args based on filtered template_data
		$slug            = $template_data['slug'];
		$hierarchy       = $template_data['hierarchy'];
		$args            = $template_data['args'];

		// WordPress Core Action
		do_action( "get_template_part_{$slug}", "{$slug}", $hierarchy, $args );

		// Setup templates
		$templates = static::setup_templates($slug, $hierarchy);
		
		// WordPress Core Action
		do_action( 'get_template_part', $slug, $hierarchy, $templates, $args );
		
		// App::log($templates);

		// Setup template locations
		$template_locations = array();

		// Add theme path to templates
		foreach ($templates as $template) {
			$template_locations[] = trim( App::get_templates_dir() . '/' . $template, '/' );
		}

		// App::log($template_locations);

		// Try to locatie in theme folder
		$locate_template = locate_template( $template_locations, true, false, $args );

		if ( $locate_template ) {
			// App::log($locate_template);
			// App::log($template_data);
    	}
    	else {
			// App::log($templates);
    		// App::log( "Template not found: `$slug`");
		    return false;
    	}
	}

	/**
	 * Setup template priority list
	 *
	 * - A template with a specific name is higher in order than the basic template
	 * - The custom template is higher in order than main template
	 * 
	 * @return array
	 */
	private static function setup_templates($slug, $hierarchy) {

		// Initialize
		$templates = array();
		
		// Create templates based on give hierarchy
		if ( is_array($hierarchy) ) {

			if ($slug == 'index') {
				foreach ($hierarchy as $name) {
					$templates[] = "{$name}.php";
				}
			}
			else {
				foreach ($hierarchy as $name) {
					$templates[] = "{$slug}/{$name}.php";
				}
			}
		}

		// Fallback template
		$templates[] = "{$slug}.php";

		// Remove duplicates
		$templates = array_unique( $templates );

		return $templates;
	}

	/**
	 * Get template types
	 *
	 * This is used by hierarchy and to generate css classes for the site root
	 * 
	 * @return array
	 */
	public static function get_template_types() {

		// Initialize
		$template_types = array();

		// 404 template type
		if (is_404()) {
			$template_types[] = '404';
		}
		
		// Custom page template
		elseif ( $page_template = get_page_template_slug() ) {

			// Strip potential .php extension from template name
			$template_types[] = 'template--' . rtrim($page_template, '.php');
		}

		// Single template types
		elseif (\is_singular()) {
			
			if ( is_front_page() ) {
				$template_types[] = 'singular--front-page';
			}

			// Single post type
			$template_types[] = 'singular--' . get_queried_post_type();

			// Default single
			$template_types[] = 'singular';
		}

		// Archive template types
		elseif (is_archive() || is_home() || is_search()) {

			// We see `search` as an archive
			if (is_search()) {
				$template_types[] = 'archive--search';
			}
			// Author
			elseif (\is_author()) {
				$template_types[] = 'archive--author';
			}
			// Date
			elseif (\is_date()) {
				$template_types[] = 'archive--date';
			}
			// All other archives
			else {

				if ( is_home() || is_post_type_archive() ) {
					$template_types[] = 'post-type-archive';

					$template_types[] = 'post-type-archive--' . get_queried_post_type();
				}
				
				// Taxonomies
				elseif (\is_category() || \is_tag() || \is_tax()) {

					if (\is_category()) {
						$template_types[] = 'tax-archive--category';
					}
					elseif (\is_tag()) {
						$template_types[] = 'tax-archive--tag';
					}
					elseif (\is_tax()) {
						$template_types[] = 'tax-archive--' . get_query_var( 'taxonomy' );
					}

					$template_types[] = 'tax-archive';
				}

				$template_types[] = 'archive--' . get_queried_post_type();
			}

			// Default archive
			$template_types[] = 'archive';
		}

		return apply_filters( 'wbl/theme/template/types', $template_types );
	}

	/**
	 * Get hierarchy for main templates
	 *
	 * @link https://github.com/themehybrid/hybrid-core/blob/master/src/Template/Hierarchy.php
	 * @return array
	 */
	public static function page_hierarchy() {

		// Initialize
		$template_hierarchy = array();

		// Get template types
		$template_hierarchy = static::get_template_types();

		// Add default
		$template_hierarchy[] = 'default';

		return $template_hierarchy;
	}

	/**
	 * Get template hierarchy of loop entries
	 *
	 * @link https://github.com/themehybrid/hybrid-core/blob/master/src/Template/Hierarchy.php
	 * @return array
	 */
	public static function entry_hierarchy() {	

		// Initialize
		$template_hierarchy = array();

		if (is_404() && is_main_query()) {
			$template_hierarchy[] = '404';
		}		
		elseif (is_search() && is_main_query()) {
			$template_hierarchy[] = 'search';
		}
		else { 
			$template_hierarchy[] = get_post_type();
		}

		$template_hierarchy[] = 'default';

		return $template_hierarchy;
	}

	
	/*=============================================================*/
	/**                       Utilities                            */
	/*=============================================================*/


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
	public static function boot() {

		static::display();
	}

	/**
	 * Log data to wp-content/debug.log
	 *
	 * It doesn't matter if WP_DEBUG is true because I also want to be able
	 * to log on production environment (which has WP_DEBUG disabled)
	 */
	public static function status_log()  {

	    // Set properties
		App::log( '' );
		App::log( '====== START: TEMPLATE STATUS LOG ======' );
		App::log( '' );
		App::log( '' );
		App::log( '   args:      ' );
		App::log( static::$args );
		App::log( '   theme_template_dir:      ' . App::get_relative_template_dir() );
		App::log( '' );
		App::log( '' );
		App::log( '======= END: TEMPLATE STATUS LOG =======' );
		App::log( '' );
	}
}

