<?php
/**
 * The template for displaying the SVG sprite
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/header
 * @since		2.6.0
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
$svg_sprite = THEME_ROOT . '/images/general/svg-defs.svg';

/**
 * Display SVG sprite
 */
include_once( $svg_sprite );