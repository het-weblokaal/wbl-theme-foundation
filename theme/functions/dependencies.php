<?php
/**
 * Theme cleanup functions.
 */

namespace WBL\Theme;

/**
 * Register the required plugins for this theme.
 *
 * @link https://github.com/TGMPA/TGM-Plugin-Activation/blob/develop/example.php
 */
function register_dependencies() {

	$tgmpa_plugins = array(
		[
			'name'     => 'Slim SEO',
			'slug'     => 'slim-seo',
			'required' => false,
		],
		[
			'name'     => 'WP Comment Humility',
			'slug'     => 'wp-comment-humility',
			'required' => false,
		],
		[
			'name'     => 'Disable Emojis',
			'slug'     => 'disable-emojis',
			'required' => false,
		],
		[
			'name'     => 'Regenerate Thumbnails',
			'slug'     => 'regenerate-thumbnails',
			'required' => false,
		],
		[
			'name'     => 'Contextual Adminbar Color',
			'slug'     => 'contextual-adminbar-color',
			'required' => false,
		],
		[
			'name'     => 'Redirection',
			'slug'     => 'redirection',
			'required' => false,
		],
		[
			'name'     => 'Kirki Customizer Framework',
			'slug'     => 'kirki',
			'required' => true,
		],
	);

	$tgmpa_config = [
		'id'           => Theme::handle('tgmpa'),  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	];

	$tgmpa_plugins = apply_filters( 'wbl/theme/plugins', $tgmpa_plugins );

	tgmpa( $tgmpa_plugins, $tgmpa_config );
}
