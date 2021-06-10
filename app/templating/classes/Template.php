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
	 * Relative path to templates folder of the Foundation
	 *
	 * @var string
	 */
	private static $templates_dir = 'app/templating/templates';

	/**
     * Constructor method.
     *
     * @return void
     */
    private function __construct() {}


	/**
	 * Render template file
	 */
	private static function render( $slug, $hierarchy = null, $args = [] ) {

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

			if ( substr( $slug, 0, 10 ) === "components" || substr( $slug, 0, 4 ) === "loop" ) {
				$hierarchy = null;
			}
			elseif ( substr( $slug, 0, 5 ) === "entry" ) {
				$hierarchy = static::entry_hierarchy();
			}
			else {
				$hierarchy = static::page_hierarchy();
			}
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

		// Add foundation path to templates as fallback
		foreach ($templates as $template) {
			$template_locations[] = trim( App::get_foundation_dir() . '/' . static::$templates_dir . '/' . $template, '/' );
		}

		// App::log($template_locations);

		// Try to locatie in theme folder
		$locate_template = locate_template( $template_locations, true, false, $args );

		if ( $locate_template ) {
			App::log($locate_template);
			// App::log($template_data);
    	}
    	else {
			// App::log($templates);
    		App::log( "Template not found: `$slug`");
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
	 * Get hierarchy for main templates
	 *
	 * @link https://github.com/themehybrid/hybrid-core/blob/master/src/Template/Hierarchy.php
	 * @return array
	 */
	public static function page_hierarchy() {

		// Initialize
		$template_hierarchy = array();

		// Try `Page not found` template_type
		if (is_404()) {
			$template_hierarchy[] = '404';
		}
		
		// Try singular template hierarchy
		elseif (\is_singular()) {

			// Display custom page-template
			if ( $page_template = get_page_template_slug() ) {

				// Strip potential .php extension from template name
				$template_hierarchy[] = rtrim($page_template, '.php');
			}

			$template_hierarchy[] = get_post_type();
		}

		// Try archive template hierarchy
		elseif (is_archive() || is_home() || is_search()) {

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

			$template_hierarchy[] = 'archive';
		}

		$template_hierarchy[] = 'index';

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

		$template_hierarchy[] = 'index';

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
		App::log( '   foundation_template_dir:        ' . static::get_foundation_templates_dir() );
		App::log( '   theme_template_dir:      ' . App::get_relative_template_dir() );
		App::log( '' );
		App::log( '' );
		App::log( '======= END: TEMPLATE STATUS LOG =======' );
		App::log( '' );
	}
}

