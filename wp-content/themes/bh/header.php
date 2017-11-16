<?php
/**
 * Theme header
 *
 * @author		Beit Hatfutsot
 * @package		bh
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php
	/**
	 * Variables
	 */
	global $globals;
?>

<?php
	/**
	 * Display header meta
	 */
	get_template_part( 'views/header/header', 'meta' );
?>

<?php
	/**
	 * Set header global variables
	 */
	BH_set_header_globals();
?>

<?php
	/**
	 * Set header elements
	 */
	$globals[ 'header_elements' ] = BH_set_header_elements();
?>

<?php
	/**
	 * Manipulate BODY classes
	 */
	$current_site	= $globals[ 'current_site' ];
	$shop_page		= $globals[ 'shop_page' ];

	$classes = array();

	if ( $current_site !== false )
		$classes[] = 'site-' . $current_site;

	if ( $shop_page )
		$classes[] = 'woocommerce';
?>

<body <?php body_class( implode( ' ', $classes ) ); ?>>

	<?php
		/**
		 * Facebook API
		 */
		if ( is_archive() || is_singular( 'post' ) ) {
			get_template_part( 'views/header/scripts/facebook-api' );
		}
	?>

	<?php
		/**
		 * Google Tag Manager
		 */
		get_template_part( 'views/header/scripts/google-tag-manager' );
	?>

	<?php
		/**
		 * Zoom Analytics
		 */
		get_template_part( 'views/header/scripts/zoom-analytics' );
	?>

	<?php
		/**
		 * Display SVG sprite
		 */
		get_template_part( 'views/header/header', 'svg' );
	?>

	<?php
		/**
		 * Display the header
		 */
		get_template_part( 'views/header/header' );
	?>