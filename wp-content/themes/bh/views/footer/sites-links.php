<?php
/**
 * Sites links
 *
 * Display sites links as part of footer
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/footer
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
global $globals;

$bh_sites		= $globals[ 'bh_sites' ];
$current_site	= $globals[ 'current_site' ];

if ( ! $bh_sites )
	return;

$total_sites	= count( $bh_sites );

?>

<div class="container">
	<div class="sites-links row">

		<?php foreach ( $bh_sites as $key => $s ) {

			// Get site data
			$type			= $s[ 'type' ];
			$title			= $s[ 'title' ];
			$title_hover	= $s[ 'title_hover' ];
			$link			= $type == 'shop' && function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : $s[ 'link' ];

			if ( ! $title || ! $title_hover || ! $link )
				continue;

			?>

			<div class="site-item site-item-<?php echo $key; ?> col-xs-<?php echo (int) 12/$total_sites; ?>">
				<a class="<?php echo $current_site !== false && $key == $current_site ? 'active' : ''; ?>" href="<?php echo $link; ?>" target="<?php echo $type == 'dbs' ? '_blank' : '_self'; ?>">
					<div class="title">
						<span class="title-1"><?php echo $title; ?></span>
						<span class="title-2"><?php echo $title_hover; ?></span>
					</div>
				</a>
			</div>
		<?php } ?>

	</div><!-- .sites-links -->
</div>