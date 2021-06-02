<?php
/**
 * WordPress App Class for themes
 *
 * Version: 1.0-alpha-13
 * Author: Erik Joling | Het Weblokaal <erik.info@hetweblokaal.nl>
 * Author URI: https://www.hetweblokaal.nl/
 *
 * This class offers an API for WordPress themes to standardize code organization.
 */

namespace WBL\Theme;

/**
 * Theme Class
 *
 * This is the base class which a WP Theme will use
 */
final class Theme {

	/**
	 * Arguments with which the app can be influenced
	 *
	 * @var array
	 */
	private static $args = [
		'id'           => '',
		'app_dir'      => 'app',
		'assets_dir'   => 'assets',
		'template_dir' => 'app/views',
		'blocks_dir'   => 'blocks',
		'lang_dir'     => 'assets/lang',
		'vendor_dir'   => 'vendor',
	];

	/**
	 * The id of the app. i.e. the handle
	 *
	 * @var string
	 */
	private static $id;

	/**
	 * The slug of the app
	 *
	 * @var string
	 */
	private static $slug;

	/**
	 * The name of the app to show to endusers
	 *
	 * @var string
	 */
	private static $name;

	/**
	 * The Type of app. i.e. theme or plugin
	 *
	 * @var string
	 */
	private static $type;

	/**
	 * Directory path with trailing slash.
	 *
	 * @var string
	 */
	private static $path;

	/**
	 * Directory URI with trailing slash.
	 *
	 * @var string
	 */
	private static $uri;

	/**
	 * Sets the app file. The file which holds the metadata of this app (plugin or theme)
	 *
	 * @var string
	 */
	private static $meta_file;

	/**
	 * Version
	 *
	 * @var string
	 */
	private static $version;

	/**
	 * Includes folder (relative to plugin/theme) for app setup and includes
	 *
	 * @var string
	 */
	private static $app_dir;

	/**
	 * Public folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $assets_dir;

	/**
	 * Template folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $template_dir;

	/**
	 * Blocks folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $blocks_dir;

	/**
	 * Language folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $lang_dir;

	/**
	 * Vendor folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $vendor_dir;

	/**
	 * Laravel mix manifest
	 *
	 * @var string
	 */
	private static $mix_manifest = null;

	/**
	 * WBL App version
	 *
	 * @var string
	 */
	private static $wbl_app_version = null;

	/**
     * Constructor method.
     *
     * @return void
     */
    private function __construct() {}

	/**
	 * Customize some App properties
	 *
	 * @return void
	 */
	public static function customize( $args ) {
		$args = wp_parse_args( $args, static::$args );

		static::$args = $args;
	}


	/*=============================================================*/
	/**                        Getters                             */
	/*=============================================================*/

	/**
	 * Gets the app id
	 *
	 * @return string $id
	 */
	public static function get_id() {

		if ( is_null(static::$id) ) {
			static::set_id();
		}

		return static::$id;
	}

	/**
	 * Gets the app slug
	 *
	 * @return string $slug
	 */
	public static function get_slug() {

		if ( is_null(static::$slug) ) {
			static::set_slug();
		}

		return static::$slug;
	}

	/**
	 * Gets the app name
	 *
	 * @return string $name
	 */
	public static function get_name() {

		if ( is_null(static::$name) ) {
			static::set_name();
		}

		return static::$name;
	}

	/**
	 * Gets the app directory path with trailing slash.
	 *
	 * @return string
	 */
	public static function get_path() {

		if ( is_null(static::$path) ) {
			static::set_path();
		}

		return static::$path;
	}

	/**
	 * Gets the app uri path with trailing slash.
	 *
	 * @return string
	 */
	public static function get_uri() {

		if ( is_null(static::$uri) ) {
			static::set_uri();
		}

		return static::$uri;
	}

	/**
	 * Gets the app directory path with trailing slash.
	 *
	 * @return string
	 */
	public static function get_meta_file() {

		if ( is_null(static::$meta_file) ) {
			static::set_meta_file();
		}

		return static::$meta_file;
	}

	/**
	 * Gets the app version
	 *
	 * @return string
	 */
	public static function get_version() {

		if ( is_null(static::$version) ) {
			static::set_version();
		}

		return static::$version;
	}

	/**
	 * Gets the includes directory
	 *
	 * @return string
	 */
	public static function get_app_dir() {

		if ( is_null(static::$app_dir) ) {
			static::set_app_dir();
		}

		return static::$app_dir;
	}

	/**
	 * Gets the app asset directory
	 *
	 * @return string
	 */
	public static function get_assets_dir() {

		if ( is_null(static::$assets_dir) ) {
			static::set_assets_dir();
		}

		return static::$assets_dir;
	}

	/**
	 * Gets the app template directory
	 *
	 * @return string
	 */
	public static function get_template_dir() {

		if ( is_null(static::$template_dir) ) {
			static::set_template_dir();
		}

		return static::$template_dir;
	}

	/**
	 * Gets the app blocks directory
	 *
	 * @return string
	 */
	public static function get_blocks_dir() {

		if ( is_null(static::$blocks_dir) ) {
			static::set_blocks_dir();
		}

		return static::$blocks_dir;
	}

	/**
	 * Gets the app language directory
	 *
	 * @return string
	 */
	public static function get_lang_dir() {

		if ( is_null(static::$lang_dir) ) {
			static::set_lang_dir();
		}

		return static::$lang_dir;
	}

	/**
	 * Gets the app vendor directory
	 *
	 * @return string
	 */
	public static function get_vendor_dir() {

		if ( is_null(static::$vendor_dir) ) {
			static::set_vendor_dir();
		}

		return static::$vendor_dir;
	}

	/**
	 * Gets the mix manifest content
	 *
	 * @return array | false
	 */
	private static function get_mix_manifest() {

		if ( is_null(static::$mix_manifest) ) {
			static::set_mix_manifest();
		}

		return static::$mix_manifest;
	}

	/**
	 * Gets the WBL App version
	 *
	 * @return string
	 */
	private static function get_wbl_app_version() {

		if ( is_null(static::$wbl_app_version) ) {
			static::set_wbl_app_version();
		}

		return static::$wbl_app_version;
	}

	
	/**
	 * Get the file-path within this app
	 *
	 * @param string $relative_file relative to this app root
	 * @return string filepath
	 */
	public static function get_file_uri( $relative_file = '' ) {
		return static::get_uri() . $relative_file;
	}

	/**
	 * Get the file-path within this app
	 *
	 * @param string $relative_file relative to this app root
	 * @return string filepath
	 */
	public static function get_file_path( $relative_file = '' ) {
		return static::get_path() . $relative_file;
	}

	/**
	 * Get the includes path
	 *
	 * @param string $relative_file relative to the includes directory
	 * @return string filepath
	 */
	public static function get_app_path( $relative_file = '' ) {

		// Make sure we have a slash at the front of the path.
		$relative_file = '/' . ltrim( $relative_file, '/' );

		return static::get_file_path( static::get_app_dir() . $relative_file );
	}

	/**
	 * Get the asset uri
	 *
	 * @param string $relative_file relative to the asset directory
	 * @return string filepath
	 */
	public static function get_asset_uri( $relative_file = '' ) {

		// Make sure we have a slash at the front of the path.
		$relative_file = '/' . ltrim( $relative_file, '/' );

		return static::get_file_uri( static::get_assets_dir() . $relative_file );
	}

	/**
	 * Get the asset path
	 *
	 * @param string $relative_file relative to the asset directory
	 * @return string filepath
	 */
	public static function get_asset_path( $relative_file = '' ) {

		// Make sure we have a slash at the front of the path.
		$relative_file = '/' . ltrim( $relative_file, '/' );

		return static::get_file_path( static::get_assets_dir() . $relative_file );
	}

	/**
	 * Get the blocks path
	 *
	 * @param string $relative_file relative to the blocks directory
	 * @return string filepath
	 */
	public static function get_blocks_path( $relative_file = '' ) {

		// Make sure we have a slash at the front of the path.
		$relative_file = '/' . ltrim( $relative_file, '/' );

		return static::get_file_path( static::get_blocks_dir() . $relative_file );
	}

	/**
	 * Get the language path
	 *
	 * @param string $relative_file relative to the language directory
	 * @return string filepath
	 */
	public static function get_lang_path( $relative_file = '' ) {

		// Make sure we have a slash at the front of the path.
		$relative_file = '/' . ltrim( $relative_file, '/' );

		return static::get_file_path( static::get_lang_dir() . $relative_file );
	}

	/**
	 * Get the vendor path
	 *
	 * @param string $relative_file relative to the vendor directory
	 * @return string filepath
	 */
	public static function get_vendor_path( $relative_file = '' ) {

		// Make sure we have a slash at the front of the path.
		$relative_file = '/' . ltrim( $relative_file, '/' );

		return static::get_file_path( static::get_vendor_dir() . $relative_file );
	}


	/*=============================================================*/
	/**                        Setters                             */
	/*=============================================================*/


	/**
	 * Sets the app id
	 *
	 * @return void
	 */
	private static function set_id() {

		// Try to get value from arguments
		$id = static::$args['id'];

		if ( ! $id ) {

			// Automattically assign id based on the name of the folder
			$id = static::get_slug();
		}

		static::$id = $id;
	}

	/**
	 * Sets the app slug
	 *
	 * @return void
	 */
	private static function set_slug() {

		// Get slug from expected folder structure (<app-slug>/vendor/wbl-app.php)
		// $slug = basename(dirname(dirname(__FILE__)));
		$slug = basename( get_theme_file_path() );

		static::$slug = $slug;
	}

	/**
	 * Sets the app name
	 *
	 * @return void
	 */
	private static function set_name() {

		$name = wp_get_theme()->get('Name');

		static::$name = $name;
	}

	/**
	 * Sets the app file (root file)
	 *
	 * @return void
	 */
	private static function set_meta_file() {

		$meta_file = get_theme_file_path('style.css');

		static::$meta_file = $meta_file;
	}

	/**
	 * Sets the app directory (with trailing slash)
	 *
	 * @return void
	 */
	private static function set_path() {

		$path = trailingslashit( get_theme_file_path() );

		static::$path = $path;
	}

	/**
	 * Sets the app URI (with trailing slash)
	 *
	 * @return void
	 */
	private static function set_uri() {

		$uri = trailingslashit( get_theme_file_uri() );

		static::$uri = $uri;
	}

	/**
	 * Sets the app version
	 *
	 * @return void
	 */
	private static function set_version() {

		$version = wp_get_theme()->get('Version');

		static::$version = $version;
	}

	/**
	 * Sets the app includes directory
	 *
	 * @return void
	 */
	private static function set_app_dir() {

		// Try to get value from arguments
		$app_dir = static::$args['app_dir'];

		// Not leading and trailing slashes
		$app_dir = trim($app_dir, '/');

		static::$app_dir = $app_dir;
	}

	/**
	 * Sets the app asset directory
	 *
	 * @return void
	 */
	private static function set_assets_dir() {

		// Try to get value from arguments
		$assets_dir = static::$args['assets_dir'];

		// Not leading and trailing slashes
		$assets_dir = trim($assets_dir, '/');

		static::$assets_dir = $assets_dir;
	}

	/**
	 * Sets the template directory
	 *
	 * @return void
	 */
	private static function set_template_dir() {

		// Try to get value from arguments
		$template_dir = static::$args['template_dir'];

		// Not leading and trailing slashes
		$template_dir = trim($template_dir, '/');

		static::$template_dir = $template_dir;
	}

	/**
	 * Sets the app blocks directory
	 *
	 * @return void
	 */
	private static function set_blocks_dir() {

		// Try to get value from arguments
		$blocks_dir = static::$args['blocks_dir'];

		// Not leading and trailing slashes
		$blocks_dir = trim($blocks_dir, '/');

		static::$blocks_dir = $blocks_dir;
	}

	/**
	 * Sets the app language directory
	 *
	 * @return void
	 */
	private static function set_lang_dir() {

		// Try to get value from arguments
		$lang_dir = static::$args['lang_dir'];

		// Not leading and trailing slashes
		$lang_dir = trim($lang_dir, '/');

		static::$lang_dir = $lang_dir;
	}

	/**
	 * Sets the app vendor directory
	 *
	 * @return void
	 */
	private static function set_vendor_dir() {

		// Try to get value from arguments
		$vendor_dir = static::$args['vendor_dir'];

		// Not leading and trailing slashes
		$vendor_dir = trim($vendor_dir, '/');

		static::$vendor_dir = $vendor_dir;
	}

	/**
	 * Sets the mix manifest content
	 *
	 * @return void
	 */
	private static function set_mix_manifest() {

		// Get mix manifest file
		$manifest = static::get_asset_path( 'mix-manifest.json' );

		// Get the contents of the manifest
		$manifest = file_exists( $manifest ) ? json_decode( file_get_contents( $manifest ), true ) : false;

		// Set manifest
		static::$mix_manifest = $manifest;
	}

	/**
	 * Sets the WBL app version
	 *
	 * @return void
	 */
	private static function set_wbl_app_version() {

		$wbl_app_version = get_file_data( __FILE__, [ 'Version' => 'Version' ] )['Version'] ?? '';

		static::$wbl_app_version = $wbl_app_version;
	}


	/*=============================================================*/
	/**                       Utilities                            */
	/*=============================================================*/

	/**
	 * Generate handle
	 *
	 * @return string $handle
	 */
	public static function handle( $append = '' ) {

		$handle = static::get_id();

		if ($append) {
			$handle .= "-{$append}";
		}

		return $handle;
	}

	/**
	 * Get asset with cachebusting if it's enabled by laravel mix
	 *
	 * @param string $file relative to the asset folder
	 * @return string filepath
	 */
	public static function asset( $file ) {

		// Make sure to trim any slashes from the front of the path.
		$file = '/' . ltrim( $file, '/' );

		// Get manifest
		$manifest = static::get_mix_manifest();

		// If a file is in the manifest, add the cache-busting path
		if ( $manifest && isset( $manifest[ $file ] ) ) {
			$file = $manifest[ $file ];
		}

		return static::get_asset_uri( $file );
	}

	/**
	 * Get SVG markup
	 *
	 * @param string name of the SVG icon
	 * @return string svg-markup
	 */
	public static function svg( $name = '' ) {

		$svg = '';

		if ($name) {
			$svg = file_get_contents( static::asset( "svg/{$name}.svg" ) );
			$svg = ($svg) ? $svg : '';
		}

		return $svg;
	}

	/**
	 * Check whether the site is in debug mode.
	 * 
	 * @idea: enable debug-mode independant on environment type, but based on the 
	 * logged-in user (check for Het Weblokaal email)
	 */
	public static function is_debug_mode() {

		return !(wp_get_environment_type() == 'production');
	}

	/**
	 * Log data to wp-content/debug.log
	 *
	 * It doesn't matter if WP_DEBUG is true because I also want to be able
	 * to log on production environment (which has WP_DEBUG disabled)
	 */
	public static function log( $data, $show_namespace = false )  {

	    if ( is_array( $data ) || is_object( $data ) ) {

			if ($show_namespace) {
				error_log( '[WBL\Theme] ...' );
			}

	        error_log( print_r( $data, true ) );
	    } else {

	    	if ($show_namespace) {
	    		$data = '[WBL\Theme] ' . $data;
	    	}

	        error_log( $data );
	    }
	}

	/**
	 * Dump (print) data somewhere on the website
	 */
	public static function dump( $data, $show_namespace = false )  {
	    if ( static::is_debug_mode() ) {
	        if ( is_array( $data ) || is_object( $data ) ) {
	            print_r( $data, true );
	        } else {
	            echo $data;
	        }
	    }
	}

	/**
	 * Log data to wp-content/debug.log
	 *
	 * It doesn't matter if WP_DEBUG is true because I also want to be able
	 * to log on production environment (which has WP_DEBUG disabled)
	 */
	public static function status_log()  {

	    // Set properties
		static::log( '' );
		static::log( '====== START: APP STATUS LOG ======' );
		static::log( '' );
		static::log( '' );
		static::log( 'MAIN INFO' );
		static::log( '' );
		static::log( '   id:        ' . static::get_id() );
		static::log( '   type:      ' . static::get_type() );
		static::log( '   name:      ' . static::get_name() );
		static::log( '   meta_file: ' . static::get_meta_file() );
		static::log( '   version:   ' . static::get_version() );
		static::log( '' );
		static::log( '' );
		static::log( 'PATHS & URLS' );
		static::log( '' );
		static::log( '   path:         ' . static::get_path() );
		static::log( '   uri:          ' . static::get_uri() );
		static::log( '   app_dir:      ' . static::get_app_dir() );
		static::log( '   assets_dir:   ' . static::get_assets_dir() );
		static::log( '   vendor_dir:   ' . static::get_vendor_dir() );
		static::log( '   template_dir: ' . static::get_template_dir() );
		static::log( '   lang_dir:     ' . static::get_lang_dir() );
		static::log( '   blocks_dir:   ' . static::get_blocks_dir() );
		static::log( '' );
		static::log( '' );
		static::log( 'APP CLASS' );
		static::log( '' );
		static::log( '   namespace: ' . __NAMESPACE__ );
		static::log( '   file:      ' . __FILE__ );
		static::log( '   version:   ' . static::get_wbl_app_version() );
		static::log( '' );
		static::log( '' );
		static::log( '======= END: APP STATUS LOG =======' );
		static::log( '' );
	}
}
