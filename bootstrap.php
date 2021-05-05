<?php

namespace WBL\Theme;


# ------------------------------------------------------------------------------
# Load classes
# ------------------------------------------------------------------------------

// Load Theme class
require_once( "classes/Theme.php" );

// Load Template class
require_once( "classes/Template.php" );


# ------------------------------------------------------------------------------
# Load template files.
# ------------------------------------------------------------------------------

array_map( function( $file ) {
	require_once( "template/functions/{$file}.php" );
}, [
	'comments',
	'entry',
	'helpers',
	'html-head',
	'page',
	'site',
] );

# ------------------------------------------------------------------------------
# Load theme files.
# ------------------------------------------------------------------------------

array_map( function( $file ) {
	require_once( "theme/{$file}.php" );
}, [
	'assets',
	'block-editor',
	'customizer',
	'custom-templates',
	'dependencies',
	'entry',
	'media',
	'menu',
	'misc',
	'password-protection',
	'polylang',
	'seo',
	'site',
] );
