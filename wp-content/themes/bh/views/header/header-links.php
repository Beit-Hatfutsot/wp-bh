<?php
/**
 * Header links
 *
 * Display header links as part of header elements
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/header
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
global $globals;

$bh_sites		= $globals[ 'bh_sites' ];
$current_site	= $globals[ 'current_site' ];

if ( ! $bh_sites || $current_site === false )
	return;

$links			= $bh_sites[ $current_site ][ 'header_links' ];

if ( $links ) {

	foreach ( $links as $l ) {

		/**
		 * Get link data
		 */
		$btn_text	= $l[ 'button_text' ];
		$link		= $l[ 'link' ];

		if ( ! $btn_text || ! $link )
			continue;

		/**
		 * Display link html
		 */
		echo
			'<div class="header-element">' .
				'<a class="label" href="' . $link . '">' . $btn_text . '</a>' .
			'</div>';

	}

}