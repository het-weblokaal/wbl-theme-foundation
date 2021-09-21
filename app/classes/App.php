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
final class App {

	/**
	 * The id of the app. i.e. the handle
	 *
	 * @var string
	 */
	private static $id;

	/**
	 * The name of the app to show to endusers
	 *
	 * @var string
	 */
	private static $name;

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
	 * Config folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $config_dir;

	/**
	 * Template folder (relative to plugin/theme)
	 *
	 * @var string
	 */
	private static $templates_dir;

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
	 * The directory of this library relative to the theme
	 *
	 * @var string
	 */
	private static $foundation_dir;

	/**
	 * Laravel mix manifest
	 *
	 * @var string
	 */
	private static $mix_manifest = null;

	/**
     * Constructor method.
     *
     * @return void
     */
    private function __construct() {}

    /**
	 * Statically boot
	 *
	 * @return void
	 */
	public static function boot( $args = [] ) {

		$args = wp_parse_args( $args, [
			'id'             => '',
			'app_dir'        => 'app',
			'assets_dir'     => 'assets',
			'config_dir'     => 'config',
			'templates_dir'  => 'templates',
			'blocks_dir'     => 'app/blocks',
			'lang_dir'       => 'assets/lang',
			'vendor_dir'     => 'vendor',
		] );

		/**
		 * The order of these setters is important because some 
		 * depend on the other
		 */
		static::set_id( $args['id'] );
		static::set_name();
		static::set_path();
		static::set_uri();
		static::set_meta_file();
		static::set_version();
		static::set_app_dir( $args['app_dir'] );
		static::set_assets_dir( $args['assets_dir'] );
		static::set_config_dir( $args['config_dir'] );
		static::set_templates_dir( $args['templates_dir'] );
		static::set_blocks_dir( $args['blocks_dir'] );
		static::set_lang_dir( $args['lang_dir'] );
		static::set_vendor_dir( $args['vendor_dir'] );
		static::set_mix_manifest();

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

		return static::$id;
	}

	/**
	 * Gets the app name
	 *
	 * @return string $name
	 */
	public static function get_name() {

		return static::$name;
	}

	/**
	 * Gets the app directory path with trailing slash.
	 *
	 * @return string
	 */
	public static function get_path() {

		return static::$path;
	}

	/**
	 * Gets the app uri path with trailing slash.
	 *
	 * @return string
	 */
	public static function get_uri() {

		return static::$uri;
	}

	/**
	 * Gets the app directory path with trailing slash.
	 *
	 * @return string
	 */
	public static function get_meta_file() {

		return static::$meta_file;
	}

	/**
	 * Gets the app version
	 *
	 * @return string
	 */
	public static function get_version() {

		return static::$version;
	}

	/**
	 * Gets the includes directory
	 *
	 * @return string
	 */
	public static function get_app_dir() {

		return static::$app_dir;
	}

	/**
	 * Gets the app asset directory
	 *
	 * @return string
	 */
	public static function get_assets_dir() {

		return static::$assets_dir;
	}

	/**
	 * Gets the config directory of the theme
	 *
	 * @return string
	 */
	public static function get_config_dir() {

		return static::$config_dir;
	}

	/**
	 * Gets the app template directory
	 *
	 * @return string
	 */
	public static function get_templates_dir() {

		return static::$templates_dir;
	}

	/**
	 * Gets the app blocks directory
	 *
	 * @return string
	 */
	public static function get_blocks_dir() {

		return static::$blocks_dir;
	}

	/**
	 * Gets the app language directory
	 *
	 * @return string
	 */
	public static function get_lang_dir() {

		return static::$lang_dir;
	}

	/**
	 * Gets the app vendor directory
	 *
	 * @return string
	 */
	public static function get_vendor_dir() {

		return static::$vendor_dir;
	}

	/**
	 * Gets the mix manifest content
	 *
	 * @return array | false
	 */
	private static function get_mix_manifest() {

		return static::$mix_manifest;
	}

	/*=============================================================*/
	/**                        Setters                             */
	/*=============================================================*/


	/**
	 * Sets the app id
	 *
	 * @return void
	 */
	private static function set_id( $id = '') {

		static::$id = ($id) ? $id : basename( get_theme_file_path() );
	}

	/**
	 * Sets the app name
	 *
	 * @return void
	 */
	private static function set_name() {

		static::$name = wp_get_theme()->get('Name');
	}

	/**
	 * Sets the app file (root file)
	 *
	 * @return void
	 */
	private static function set_meta_file() {

		static::$meta_file = get_theme_file_path('style.css');
	}

	/**
	 * Sets the app directory (with trailing slash)
	 *
	 * @return void
	 */
	private static function set_path() {

		static::$path = trailingslashit( get_theme_file_path() );
	}

	/**
	 * Sets the app URI (with trailing slash)
	 *
	 * @return void
	 */
	private static function set_uri() {

		static::$uri = trailingslashit( get_theme_file_uri() );
	}

	/**
	 * Sets the app version
	 *
	 * @return void
	 */
	private static function set_version() {

		static::$version = wp_get_theme()->get('Version');
	}

	/**
	 * Sets the app directory (without outer slashes)
	 *
	 * @return void
	 */
	private static function set_app_dir( $app_dir ) {

		static::$app_dir = trim($app_dir, '/');
	}

	/**
	 * Sets the assets directory (without outer slashes)
	 *
	 * @return void
	 */
	private static function set_assets_dir( $assets_dir ) {

		static::$assets_dir = trim($assets_dir, '/');
	}

	/**
	 * Sets the config directory (without outer slashes)
	 *
	 * @return void
	 */
	private static function set_config_dir( $config_dir ) {

		static::$config_dir = trim($config_dir, '/');
	}

	/**
	 * Sets the app templates directory (without outer slashes)
	 *
	 * @return void
	 */
	private static function set_templates_dir( $templates_dir ) {

		static::$templates_dir = trim($templates_dir, '/');
	}

	/**
	 * Sets the blocks directory (without outer slashes)
	 *
	 * @return void
	 */
	private static function set_blocks_dir( $blocks_dir ) {

		static::$blocks_dir = trim($blocks_dir, '/');
	}

	/**
	 * Sets the language directory (without outer slashes)
	 *
	 * @return void
	 */
	private static function set_lang_dir( $lang_dir ) {

		static::$lang_dir = trim($lang_dir, '/');
	}

	/**
	 * Sets the vendor directory (without outer slashes)
	 *
	 * @return void
	 */
	private static function set_vendor_dir( $vendor_dir ) {

		static::$vendor_dir = trim($vendor_dir, '/');
	}

	/**
	 * Sets the mix manifest content
	 *
	 * @return void
	 */
	private static function set_mix_manifest() {

		// Get mix manifest file
		$manifest = static::assets_path( 'mix-manifest.json' );

		// Get the contents of the manifest
		$manifest = file_exists( $manifest ) ? json_decode( file_get_contents( $manifest ), true ) : false;

		// Set manifest
		static::$mix_manifest = $manifest;
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
	 * Render uri within this app
	 *
	 * @param string $relative_file to this app root
	 * @return string uri
	 */
	public static function uri( $relative_file = '' ) {

		return static::get_uri() . trim($relative_file, '/');
	}

	/**
	 * Get the file-path within this app
	 *
	 * @param string $relative_file relative to this app root
	 * @return string filepath
	 */
	public static function path( $relative_file = '' ) {

		return static::get_path() . trim($relative_file, '/');
	}

	/**
	 * Get the app path
	 *
	 * @param string $relative_file relative to the includes directory
	 * @return string filepath
	 */
	public static function app_path( $relative_file = '' ) {

		return static::path( static::get_app_dir() . '/' . trim( $relative_file, '/' ) );
	}

	/**
	 * Get the asset uri
	 *
	 * @param string $relative_file relative to the asset directory
	 * @return string filepath
	 */
	public static function assets_uri( $relative_file = '' ) {

		return static::uri( static::get_assets_dir() . '/' . $relative_file );
	}

	/**
	 * Get the asset path
	 *
	 * @param string $relative_file relative to the asset directory
	 * @return string filepath
	 */
	public static function assets_path( $relative_file = '' ) {

		return static::path( static::get_assets_dir() . '/' . $relative_file );
	}

	/**
	 * Get the blocks path
	 *
	 * @param string $relative_file relative to the blocks directory
	 * @return string filepath
	 */
	public static function blocks_path( $relative_file = '' ) {

		return static::path( static::get_blocks_dir() . '/' . $relative_file );
	}

	/**
	 * Get the language path
	 *
	 * @param string $relative_file relative to the language directory
	 * @return string filepath
	 */
	public static function lang_path( $relative_file = '' ) {

		return static::path( static::get_lang_dir() . '/' . $relative_file );
	}

	/**
	 * Get the vendor path
	 *
	 * @param string $relative_file relative to the vendor directory
	 * @return string filepath
	 */
	public static function vendor_path( $relative_file = '' ) {

		return static::path( static::get_vendor_dir() . '/' . $relative_file );
	}

	/**
	 * Get asset with cachebusting if it's enabled by laravel mix
	 *
	 * @param string $file relative to the asset folder
	 * @return string filepath
	 */
	public static function asset( $relative_file ) {

		// Get manifest
		$manifest = static::get_mix_manifest();

		// Setup manifest key. (relative file with leading slash)
		$manifest_key = '/' . ltrim($relative_file, '/');

		// If a file is in the manifest, add the cache-busting path
		if ( $manifest && isset( $manifest[ $manifest_key ] ) ) {

			// Get file with cache busting and remove leading slash
			$relative_file = ltrim($manifest[ $manifest_key ], '/');
		}

		return static::assets_uri( $relative_file );
	}


	/**
	 * Includes and returns a given PHP config file. The file must return
	 * an array.
	 *
	 * @param  string  $name (points to file)
	 * @return array
	 */
	public static function config( $name ) {

		// Get config file
		$file = static::path( static::get_config_dir() . '/' . "{$name}.php" );

		// Get config data (fallback to empty array)
		$config = file_exists( $file ) ? include( $file ) : [];

		// Return config data (array)
		return $config;
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
		static::log( '   slug:      ' . static::get_slug() );
		static::log( '   name:      ' . static::get_name() );
		static::log( '   meta_file: ' . static::get_meta_file() );
		static::log( '   version:   ' . static::get_version() );
		static::log( '' );
		static::log( '' );
		static::log( 'PATHS & URLS' );
		static::log( '' );
		static::log( '   path:         ' . static::path() );
		static::log( '   uri:          ' . static::uri() );
		static::log( '   app_dir:      ' . static::get_app_dir() );
		static::log( '   assets_dir:   ' . static::get_assets_dir() );
		static::log( '   vendor_dir:   ' . static::get_vendor_dir() );
		static::log( '   templates_dir: ' . static::get_templates_dir() );
		static::log( '   lang_dir:     ' . static::get_lang_dir() );
		static::log( '   blocks_dir:   ' . static::get_blocks_dir() );
		static::log( '' );
		static::log( '' );
		static::log( 'APP CLASS' );
		static::log( '' );
		static::log( '   namespace: ' . __NAMESPACE__ );
		static::log( '   file:      ' . __FILE__ );
		static::log( '' );
		static::log( '' );
		static::log( '======= END: APP STATUS LOG =======' );
		static::log( '' );
	}
}
