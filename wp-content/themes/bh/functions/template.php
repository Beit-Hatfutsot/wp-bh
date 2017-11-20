<?php
/**
 * Template functions
 *
 * @author		Beit Hatfutsot
 * @package		bh/functions
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_set_header_globals
 *
 * This function sets header global variables
 *
 * @param	N/A
 * @return	N/A
 */
function BH_set_header_globals() {

	if ( ! function_exists( 'get_field' ) )
		return;

	/**
	 * Variables
	 */
	global $globals;

	/**
	 * Set bh_sites
	 */
	$globals[ 'bh_sites' ] = get_field( 'acf-options_sites', 'option' );

	if ( ! $globals[ 'bh_sites' ] )
		return;

	/**
	 * Set current_site
	 */
	$globals[ 'current_site' ] = BH_set_current_site();

	if ( $globals[ 'current_site' ] === false || ! $globals[ 'bh_sites' ][ $globals[ 'current_site' ] ][ 'menu_theme_location' ] )
		return;

	/**
	 * Set menu - current site menu
	 */
	$args = array(

		'theme_location'	=> $globals[ 'bh_sites' ][ $globals[ 'current_site' ] ][ 'menu_theme_location' ],
		'container'			=> false,
		'items_wrap'		=> '%3$s',
		'before'			=> '<span class="item-before"></span>',
		'link_before'		=> '<span>',
		'link_after'		=> '</span>',
		'walker'			=> new Walker_Top_Menu_Walker(),
		'echo'				=> 0

	);

	/**
	 * Set specific page variables for menu manipulation
	 */
	if ( $args[ 'theme_location' ] == 'main-menu' ) {

		$blog_page		= get_field( 'acf-options_blog_page', 'option' );
		$blog_page_id	= $blog_page ? $blog_page->ID : '';
		$events_page	= get_field( 'acf-options_events_page', 'option' );
		$events_page_id	= $events_page ? $events_page->ID : '';

		$args[ 'add_blog_list_under' ]		= $blog_page_id;
		$args[ 'add_events_list_under' ]	= $events_page_id;

	}
	$globals[ 'menu' ] = wp_nav_menu( $args );

}

/**
 * BH_set_current_site
 *
 * This function predicts the current site
 *
 * @param	N/A
 * @return	(mixed) Site index in $globals[ 'bh_sites' ] or FALSE if no sites defined
 */
function BH_set_current_site() {

	/**
	 * Variables
	 */
	global $globals;

	$bh_sites = $globals[ 'bh_sites' ];

	if ( ! $bh_sites )
		return false;

	$index = 0;

	if ( ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) || $globals[ 'shop_page' ] ) {

		// Shop - locate first shop type site
		foreach ( $bh_sites as $s ) {
			if ( $s[ 'type' ] == 'shop' )
				// return
				return $index;

			$index++;
		}

	} else {

		// Main - predict current site according to current object relevance
		$current_object_id = get_queried_object_id();

		foreach ( $bh_sites as $s ) {
			if ( $s[ 'type' ] == 'main' && ( ( $s[ 'featured_page' ] && $s[ 'featured_page' ]->ID == $current_object_id ) || ( $s[ 'menu_theme_location' ] && BH_is_object_in_menu( $s[ 'menu_theme_location' ], $current_object_id ) ) ) )
				// return
				return $index;

			$index++;
		}

	}

	if ( $index == count( $bh_sites ) ) {

		// No site found for current object - set the first site defined as main
		$index = 0;

		foreach ( $bh_sites as $s ) {
			if ( $s[ 'type' ] == 'main' )
				// return
				return $index;

			$index++;
		}

	}

	// return
	return false;

}

/**
 * BH_is_object_in_menu
 *
 * This function checks whether an object exists in a menu
 *
 * @param	$theme_location (string) Menu theme location
 * @param	$object_id (int) Object ID
 * @return	(bool)
 */
function BH_is_object_in_menu( $theme_location, $object_id = null ) {

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {

		$menu = wp_get_nav_menu_object( $locations[ $theme_location ] );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );

		if ( ! $menu_items )
			return false;

		$menu_items_ids = wp_list_pluck( $menu_items, 'object_id' );

		if( ! $object_id ) {
			global $post;
			$object_id = get_queried_object_id();
		}

		// return
		return in_array( (int) $object_id, $menu_items_ids );

	}

	// return
	return false;

}

/**
 * BH_set_header_elements
 *
 * This function sets header elements
 *
 * @param	N/A
 * @return	(array) Array of elements
 */
function BH_set_header_elements() {

	/**
	 * Variables
	 */
	global $globals;

	$elements = array(
		'languages_switcher'			=> '',
		'header_links'					=> '',
		'shop_cart_header_top_popup'	=> '',
		'shop_cart_header_mid_popup'	=> '',
		'newsletter_header_top_popup'	=> '',
		'newsletter_header_mid_popup'	=> '',
		'featured_page'					=> ''
	);

	/**
	 * Get header global variables
	 */
	$bh_sites		= $globals[ 'bh_sites' ];
	$current_site	= $globals[ 'current_site' ];
	$site_type		= '';

	if ( $bh_sites && $current_site !== false )
		$site_type	= $bh_sites[ $current_site ][ 'type' ];

	/**
	 * Set header elements
	 */

	// Language switcher
	$elements[ 'languages_switcher' ] = BH_languages_switcher();

	// Header links
	$elements[ 'header_links' ] = BH_header_links();

	// Shop mini cart
	if ( $site_type == 'shop' && is_active_sidebar( 'shop-mini-cart' ) ) {

		$shop_cart_sidebar							= BH_get_dynamic_sidebar( 'shop-mini-cart' );
		$elements[ 'shop_cart_header_top_popup' ]	= BH_shop_cart_popup( 'top', $shop_cart_sidebar );
		$elements[ 'shop_cart_header_mid_popup' ]	= BH_shop_cart_popup( 'mid', $shop_cart_sidebar );

	}

	// Newsletter popup
	if ( is_active_sidebar( 'newsletter' ) ) {

		$newsletter_sidebar							= BH_get_dynamic_sidebar( 'newsletter' );
		$elements[ 'newsletter_header_top_popup' ]	= BH_newsletter_popup( 'top', $newsletter_sidebar );
		$elements[ 'newsletter_header_mid_popup' ]	= BH_newsletter_popup( 'mid', $newsletter_sidebar );

	}

	// Featured page
	if ( $bh_sites && $current_site !== false && $bh_sites[ $current_site ][ 'featured_page' ] ) {
		$elements[ 'featured_page' ] = $bh_sites[ $current_site ][ 'featured_page' ];
	}

	// return
	return $elements;

}

/**
 * BH_shop_cart_popup
 *
 * This function returns the Shop Mini Cart button and popup to be displayed as part of header elements
 *
 * @param	$header_position (string) Header position [top/mid]
 * @param	$sidebar (string) Sidebar HTML
 * @return	(string) Shop mini cart button and popup or empty string in case of input failure
 */
function BH_shop_cart_popup( $header_position, $sidebar ) {

	if ( ! $header_position || ! $sidebar )
		return '';

	ob_start();
	get_template_part( 'views/svgs/shape', 'cart' );
	$cart = ob_get_contents();
	ob_end_clean();

	$output = '<div class="shop-cart-popup-btn">';

	if ( $header_position == 'top' )
		$output .= '<a href="' . WC()->cart->get_cart_url() . '">' . $cart . '</a>';
	else
		$output .= '<button>' . $cart . '</button>';

	// Insert shopping cart indicator placeholder - code in woocommerce.js will update this on page load
	$output .= '<div class="widget_shopping_cart_indicator"></div>';

	if ( $header_position == 'mid' )
		$output .= '</div>';

	$output .= '<div class="shop-cart-popup-content">' . $sidebar . '</div>';

	if ( $header_position == 'top' )
		$output .= '</div>';

	// return
	return $output;

}

/**
 * BH_newsletter_popup
 *
 * This function returns the Newsletter button and popup to be displayed as part of header elements
 *
 * @param	$header_position (string) Header position [top/mid]
 * @param	$sidebar (string) Sidebar HTML
 * @return	(string) Newsletter button and popup or empty string in case of input failure
 */
function BH_newsletter_popup( $header_position, $sidebar ) {

	if ( ! $header_position || ! $sidebar )
		return '';

	// Manipulate $sidebar to contain $header_position info
	// Used to make a distinguish between group checkboxes of different widget instances
	$sidebar = preg_replace( "/\"mm_key\[([a-z\-]+)\]\"/", "\"mm_key[$1-" . $header_position . "]\"", $sidebar );

	$output = '<div class="newsletter-popup-btn">';
		$output .= '<a data-title="' . __( 'Newsletter', 'BH' ) . '">' . __( 'Newsletter', 'BH' ) . '</a>';
	$output .= '</div>';

	$output .= '<div class="newsletter-popup-content">' . $sidebar . '</div>';

	// return
	return $output;

}

/**
 * BH_languages_switcher
 *
 * This function returns the languages switcher to be displayed as part of header elements
 *
 * @param	N/A
 * @return	(string)
 */
function BH_languages_switcher() {

	ob_start();
	
	get_template_part( 'views/header/header-languages-switcher' );
	$output = ob_get_contents();
	
	ob_end_clean();
	
	// return
	return $output;

}

/**
 * BH_header_links
 *
 * This function returns the header links to be displayed as part of header elements
 *
 * @param	N/A
 * @return	(string)
 */
function BH_header_links() {

	ob_start();
	
	get_template_part( 'views/header/header-links' );
	$output = ob_get_contents();
	
	ob_end_clean();
	
	// return
	return $output;

}

/**
 * BH_get_contact_details
 * 
 * This function returns the homepage contact details section
 * 
 * @param	N/A
 * @return	(string)
 */
function BH_get_contact_details() {

	ob_start();
	
	get_template_part( 'views/main/contact-details/contact-details' );
	$output = ob_get_contents();
	
	ob_end_clean();
	
	// return
	return $output;

}

/**
 * set_opening_hours_msg
 * 
 * This function updates BH-opening-hours-msg transient according to opening hours settings
 * 
 * @param	$code (string) WPML language code
 * @return	N/A
 */
function set_opening_hours_msg( $code ) {

	if ( ! function_exists( 'get_field' ) )
		// return
		return;

	// Change acf current language
	if ( $code ) {

		add_filter('acf/settings/current_language', function() {
			global $code;
			return $code;
		});

		global $wpdb;
		$locale = $wpdb->get_var( "SELECT default_locale FROM {$wpdb->prefix}icl_languages WHERE code='{$code}'" );
		setlocale( LC_TIME, $locale . '.utf8' );

	}

	// Get opening hours data
	$hours				= get_field( 'acf-options_opening_hours',			'option' );

	// Get messages
	$open_msg			= get_field( 'acf-options_open_message',			'option' );
	$close_msg			= get_field( 'acf-options_close_message',			'option' );
	$opening_today_msg	= get_field( 'acf-options_opening_today_message',	'option' );

	// Get some strings related to above messages
	$tommorow_str		= get_field( 'acf-options_tomorrow_str',			'option' );
	$on_day_str			= get_field( 'acf-options_on_day_str',				'option' );

	if ( ! $hours || ! $open_msg || ! $close_msg || ! $opening_today_msg || ! $tommorow_str || ! $on_day_str )
		// return
		return;

	$status			= 'close';			// [open/close/opening-today]
	$msg			= '';				// message to be displayed

	$current_day	= date_i18n('w');	// w => numeric representation of the day of the week - 0 (for Sunday) through 6 (for Saturday)
	$current_time	= date_i18n('Hi');	// H => 24-hour format of an hour with leading zeros; i => Minutes with leading zeros

	// Locate the closest row in $hours
	$row			= '';

	foreach ( $hours as $hours_row ) {

		if ( $hours_row['day'] >= $current_day ) {

			if ( $hours_row['day'] == $current_day ) {

				if ( $current_time < $hours_row['open'] ) {

					// Before opening hour today
					$status = 'opening-today';
					$row = $hours_row;
					break;

				} elseif ( $current_time >= $hours_row['open'] && $current_time <= $hours_row['close'] ) {

					// Open now
					$status = 'open';
					$row = $hours_row;
					break;

				} else {

					// After closing hour today
					continue;

				}

			} else {

				// Open on a later day
				$row = $hours_row;
				break;

			}

		}

	}

	// No match found, first row will be considered
	if ( ! $row ) {
		$row = $hours[0];
	}

	// Build the message
	while ( has_sub_field( 'acf-options_opening_hours', 'option' ) ) {

		$open_select	= get_sub_field_object( 'open' );
		$close_select	= get_sub_field_object( 'close' );

		$day	= $row[ 'day' ];
		$open	= $open_select[ 'choices' ][ $row[ 'open' ] ];
		$close	= $close_select[ 'choices' ][ $row[ 'close' ] ];

		break;

	}

	if		( $status == 'open' )			{ $msg = sprintf( $open_msg, $close ); }
	elseif	( $status == 'opening-today' )	{ $msg = sprintf( $opening_today_msg, $open ); }
	else									{ $msg = sprintf( $close_msg, ( ( $current_day == $row[ 'day' ]-1 ) ? $tommorow_str : $on_day_str . ' ' . strftime( '%A', strtotime( 'next Sunday + ' . $day . ' days' ) ) ), $open ); }

	$transient_key = 'BH-opening-hours-msg' . ( $code ? '-' . $code : '' );

	if ( $msg ) {
		set_transient( $transient_key, '<div class="msg msg-' . $status . '">' . $msg . '</div>' );
	} else {
		delete_transient( $transient_key );
	}

}

/**
 * BH_get_gallery_html
 *
 * This function returns gallery HTML markup
 *
 * @param	$id (int) gallery Post Type ID
 * @param	$title (string) gallery Post Type title
 * @return	(string)
 */
function BH_get_gallery_html( $id, $title ) {

	if ( ! function_exists('get_field') )
		// return
		return '';

	/**
	 * variables
	 */
	$images	= get_field( 'images', $id );
	$output	= '';

	if ( ! $images )
		// return
		return $output;

	// Globals
	global $globals;

	$output .= '<!-- Gallery #' . $id . ' --><div class="gallery-layout-content">';
	$output .= $title ? '<h2 class="title">' . $title . '</h2><hr />' : '';
	$output .= '<div class="gallery gallery-' . $id . ' row" itemscope itemtype="http://schema.org/ImageGallery">';

	$gallery_images = array();

	foreach ( $images as $i ) {

		$image = array(
			'title'		=> esc_attr( BH_trim_str( $i[ 'title' ] ) ),
			'alt'		=> esc_attr( BH_trim_str( $i[ 'alt' ] ) ),
			'caption'	=> esc_attr( BH_trim_str( $i[ 'caption' ] ) ),
			'url'		=> esc_attr( BH_trim_str( $i[ 'url' ] ) )
		);

		$gallery_images[] = $image;

	}

	if ( $gallery_images ) {

		$i = 0;
		while ( $i <= 2 ) {
			$output .= '<div class="gallery-col col' . $i++ . ' col-xs-4"></div>';
		}

	}

	$output .= '</div>';

	if ( $gallery_images ) {

		$output .= '<button class="btn load-more inline-btn cyan-btn big">' . __('Load more', 'BH') . '</button>';
		$globals[ '_galleries' ][ 'gallery-'.$id ] = $gallery_images;

	}

	$output .= '</div><!-- End of Gallery #' . $id . ' -->';

	// return
	return $output;

}