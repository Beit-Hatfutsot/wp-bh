<?php
/**
 * BH theme support
 *
 * @author		Beit Hatfutsot
 * @package		bh/functions
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'BH_before_main_content',	'BH_theme_wrapper_start',	10 );
add_action( 'BH_after_main_content',	'BH_theme_wrapper_end',		10 );

/**
 * BH_theme_wrapper_start
 *
 * @param	N/A
 * @return	N/A
 */
function BH_theme_wrapper_start() {

	echo '<section class="page-content"><div class="container"><div class="row">';

}

/**
 * BH_theme_wrapper_end
 *
 * @param	N/A
 * @return	N/A
 */
function BH_theme_wrapper_end() {

	echo '</div></div></section>';

}

/**
 * Theme supports
 */
add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

/**
 * Remove WP defaults
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );