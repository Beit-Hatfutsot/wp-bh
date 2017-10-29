<?php
/**
 * Header links and icons
 *
 * Display links and icons as part of header elements
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/header
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

/**
 * Variables
 */
global $globals;

$current_site	= $globals[ 'current_site' ];
$elements		= get_field( 'acf-options_header_icons_links', 'option' );

if ( $elements ) {

	foreach ( $elements as $e ) {

		/**
		 * Collect element data
		 * Check whether this element should be displayed according to current site
		 */
		$main_header			= $e['main'];
		$shop_header			= $e['shop'];
		
		if ( ! ( $main_header && $current_site == 'main' || $shop_header && $current_site == 'shop' ) )
			continue;

		$type					= $e['type'];
		$link					= $e['link'];

		if ( $type == 'link' ) {
			$btn_text			= $e['button_text'];
			$btn_color			= $e['button_color'];
		} else {
			$icon_image			= $e['icon_image'];
			$icon_image_hover	= $e['icon_image_hover'];
		}

		/**
		 * Display element html
		 */
		echo '<div class="header-element ' . $type . '">';
			if ( $type == 'link' ) {
				echo '<a class="label" href="' . $link . '" style="background-color: ' . $btn_color . ';">' . $btn_text . '</a>';
			} else {
				echo '<a class="' . $icon_image . '" href="' . $link . '" onmouseover="this.className=\'' . $icon_image_hover . '\'" onmouseout="this.className=\'' . $icon_image . '\'"></a>';
			}
		echo '</div>';

	}

}