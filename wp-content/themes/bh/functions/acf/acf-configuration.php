<?php
/**
 * ACF configuration
 *
 * @author		Beit Hatfutsot
 * @package		bh/functions/acf
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Create options sub pages
 */
if ( function_exists( 'acf_add_options_sub_page' ) ) {

	acf_add_options_sub_page( 'Header/Footer' );
	acf_add_options_sub_page( 'Contact Details' );
	acf_add_options_sub_page( 'Main Banner' );
	acf_add_options_sub_page( 'Exhibitions and Events' );
	acf_add_options_sub_page( 'General' );
	acf_add_options_sub_page( 'Shop' );
    acf_add_options_sub_page( 'Donations' );

}

/**
 * Transient support action hooks
 */
if ( function_exists( 'BH_acf_save_options' ) ) {

	add_action( 'acf/save_post', 'BH_acf_save_options', 20 );

}

/**
 * BH_acf_save_options_headerfooter
 *
 * This function generates sites.css style file after saving the Header/Footer sub options page
 *
 * @param	N/A
 * @return	N/A
 */
function BH_acf_save_options_headerfooter() {

	$screen = get_current_screen();

	if ( strpos( $screen->id, 'acf-options-headerfooter' ) == true ) {

		$bh_sites	= get_field( 'acf-options_sites', 'option' );
		$wpml_lang	= function_exists( 'icl_object_id' ) ? ICL_LANGUAGE_CODE : '';

		if ( ! $bh_sites )
			return;

		// Open file for writing
		$file = fopen( THEME_ROOT . '/css/sites' . ( $wpml_lang == 'he' ? '-rtl' : '' ) . '.css', 'w' );

		if ( ! $file )
			return;

		// Generate file content
		$style = '';

		foreach ( $bh_sites as $key => $s ) {

$style .=
"/**
 * Site $key
 */
.site-$key .header-top {
	border-bottom-color: $s[dark_color];
}
.header-top .site-item-$key {
	background-color: $s[dark_color];
}
.site-$key .header-bottom .menu .nav > li.featured > a {
	color: $s[dark_color];
}
.site-$key header .featured-page a,
.site-$key header .featured-page a:hover {
	background-color: $s[light_color];
}
.site-$key header .newsletter-popup .newsletter-popup-content .widgetcontent form .newsletter-groups label:hover,
.site-$key header .newsletter-popup .newsletter-popup-content .widgetcontent form .newsletter-groups input[type=checkbox]:checked + label,
.site-$key header .newsletter-popup .newsletter-popup-content .widgetcontent form .newsletter-submit {
	background-color: $s[dark_color] !important;
}
.site-$key footer .sites-links {
	border-color: $s[dark_color];
}
footer .sites-links .site-item-$key a {
	background-color: $s[dark_color];
}
";

		}

		fwrite( $file, $style . PHP_EOL );

	}

}
add_action( 'acf/save_post', 'BH_acf_save_options_headerfooter', 20 );