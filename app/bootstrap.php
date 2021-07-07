<?php

namespace WBL\Theme;

if ( class_exists( 'WBL\Theme\App' ) ) {
	return;
}


# ------------------------------------------------------------------------------
# Load the foundation
# ------------------------------------------------------------------------------

array_map( function( $file ) {
	require_once( "{$file}.php" );
}, [
	// Classes
	'classes/App',

	// Functions
	'setup/archive',
	'setup/assets',
	'setup/block-editor',
	'setup/customizer',
	'setup/custom-templates',
	'setup/dependencies',
	'setup/entry',
	'setup/media',
	'setup/menu',
	'setup/misc',
	'setup/password-protection',
	'setup/polylang',
	'setup/seo',
	'setup/site',
] );


# ------------------------------------------------------------------------------
# Load templating system.
# ------------------------------------------------------------------------------

array_map( function( $file ) {
	require_once( "templating/{$file}.php" );
}, [
	// Classes
	'classes/Template',

	// Functions
	'functions/comments',
	'functions/entry',
	'functions/helpers',
	'functions/html-head',
	'functions/page',
	'functions/archive-page',
	'functions/site',
] );
