<?php
/**
 * Theme cleanup functions.
 */

namespace WBL\Theme;

# ------------------------------------------------------------------------------
# Hooking
# ------------------------------------------------------------------------------

add_action( 'after_setup_theme', function() {

	// Register the required plugins for this theme.
	add_action( 'tgmpa_register', 'WBL\Theme\register_dependencies' );
	
}, 5 );

# ------------------------------------------------------------------------------
# Functions
# ------------------------------------------------------------------------------

/**
 * Register the required plugins for this theme.
 * 
 * Note: if the plugin is locally installed through symbolic link then
 * the plugin is not shown in the list. Which is fine :)
 *
 * @link https://github.com/TGMPA/TGM-Plugin-Activation/
 * @link https://github.com/TGMPA/TGM-Plugin-Activation/blob/develop/example.php
 */
function register_dependencies() {

	$plugins = apply_filters( 'wbl/theme/dependencies', [] );

	// Don't register dependencies if none is present
	if ( ! $plugins ) {
		return;
	}

	$config = [
		'id'           => App::handle('tgmpa'),  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'tools.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	];

	tgmpa( $plugins, $config );
}
