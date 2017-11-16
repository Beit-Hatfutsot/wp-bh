<?php
/**
 * Header view elements
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
global $globals;

$bh_sites		= $globals[ 'bh_sites' ];
$current_site	= $globals[ 'current_site' ];
$elements		= $globals[ 'header_elements' ];

if ( ! $bh_sites )
	return;

?>

<?php
	/**
	 * Display the language switcher
	 */
	if ( $elements[ 'languages_switcher' ] ) { ?>

		<div class="header-element languages-switcher">
			<?php echo $elements[ 'languages_switcher' ]; ?>
		</div>

	<?php }
?>

<?php
	/**
	 * Display the shop mini cart
	 */
	if ( $current_site !== false && $bh_sites[ $current_site ][ 'type' ] == 'shop' && $elements[ 'shop_cart_header_' . $header_position . '_popup' ] ) { ?>

		<div class="header-element shop-cart-popup shop-cart-header-<?php echo $header_position; ?>-popup">
			<?php echo $elements[ 'shop_cart_header_' . $header_position . '_popup' ]; ?>
		</div>

	<?php }
?>

<?php
	/**
	 * Display the header links
	 */
	if ( $elements[ 'header_links' ] ) {
		echo $elements[ 'header_links' ];
	}
?>

<?php
	/**
	 * Display the newsletter popup
	 */
	if ( $elements[ 'newsletter_header_' . $header_position . '_popup' ] ) { ?>

		<div class="header-element newsletter-popup">
			<?php echo $elements[ 'newsletter_header_' . $header_position . '_popup' ]; ?>
		</div>

	<?php }
?>