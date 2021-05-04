<?php
/**
 * Asset-related functions and filters.
 *
 * This file holds some setup actions for scripts and styles as well as a helper
 * functions for work with assets.
 */

namespace WBL\Theme;


/**
 * Make theme data (like version) available to scripts
 */
function add_theme_data_script() {

	$theme = [
		'id' => Theme::get_id(),
		'version' => Theme::get_version(),
		'assetUri' => Theme::get_asset_uri(),
	];

	echo "<script>var theme = ", json_encode( $theme, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ), "</script>";
}
