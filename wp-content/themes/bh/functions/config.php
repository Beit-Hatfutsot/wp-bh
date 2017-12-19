<?php
/**
 * Theme configuration
 *
 * @author		Beit Hatfutsot
 * @package		bh/functions
 * @version		2.7.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * theme prefix => BH
 */

/**
 * Theme version
 * Used to register styles and scripts
 */
if ( function_exists( 'wp_get_theme' ) ) {

	$theme_data		= wp_get_theme();
	$theme_version	= $theme_data->get( 'Version' );

}
else {

	$theme_data		= get_theme_data( trailingslashit( get_stylesheet_directory() ) . 'style.css' );
	$theme_version	= $theme_data[ 'Version' ];

}
define( 'VERSION', $theme_version );

/**
 * Other constants
 */
$stylesheet	= get_stylesheet();
$theme_root	= get_theme_root( $stylesheet );

define( 'TEMPLATE',		get_bloginfo( 'template_directory' ) );
define( 'HOME',			home_url( '/' ) );
define( 'THEME_ROOT',	"$theme_root/$stylesheet" );
define( 'CSS_DIR',		TEMPLATE . '/css' );
define( 'JS_DIR',		TEMPLATE . '/js' );
define( 'EXR_API_KEY',	'8173E30F944972AB110F61D13501D61B' );	// Exchange Rate API key

/**
 * Globals
 */
global $globals;
$globals = array(
	// General
	'google_fonts'		=> array(),		// Google Fonts
	'wpml_lang'			=> '',			// Current language code

	// Header
	'bh_sites'			=> array(),		// BH sites
	'current_site'		=> '',			// Current site index in $globals[ 'bh_sites' ]
	'header_elements'	=> array(),		// Header elements

	// Menus
	'menus'				=> array(),		// Theme menu locations
	'menu'				=> '',			// Current site menu HTML structure

	// Events
	'events'			=> array(),		// Array of event post objects
	'category_id'		=> '',			// Current event category ID
	'sticky_events_ids'	=> array(),		// Array of sticky event IDs

	// Shop
	'shop_page'			=> '',			// True / False	- Is shop page (set in woocommerce-functions.php)

	// Galleries
	'_galleries'		=> array()		// Array of arrays of galleries images
);

/**
 * Google Fonts
 */
$globals[ 'google_fonts' ] = array(
	'Open Sans'			=> '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,700',
	'Open Sans Hebrew'	=> TEMPLATE . '/fonts/opensanshebrew/stylesheet.css'
);