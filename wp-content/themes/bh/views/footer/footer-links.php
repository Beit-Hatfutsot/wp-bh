<?php
/**
 * Footer links
 *
 * Display link boxes as part of footer
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

if ( ! $bh_sites || $current_site === false )
	return;

$links			= $bh_sites[ $current_site ][ 'footer_links' ];

if ( ! $links )
	return;

?>

<div class="container">
	<div class="footer-links row">

		<?php foreach ( $links as $l ) {

			/**
			 * Get link data
			 */
			$title		= $l[ 'title' ];
			$big_icon	= $l[ 'big_icon' ];
			$small_icon	= $l[ 'small_icon' ];
			$link		= $l[ 'link' ];

			if ( ! $title || ! $link )
				continue;

			?>

			<div class="link-box-wrapper col-xs-4">
				<div class="link-box">
					<a href="<?php echo $link; ?>">

						<div class="before-link"></div>

						<div class="link">

							<div class="small-icon visible-xs"><?php echo $small_icon ? '<span class="' . $small_icon . '"></span>' : ''; ?></div>
							<div class="title"><?php echo ( $big_icon ? '<span class="' . $big_icon . ' hidden-xs"></span>' : '' ) . $title; ?></div>
							<div class="more"><?php _e( 'Learn more', 'BH' ); ?></div>

						</div>

					</a>
				</div>
			</div>

		<?php } ?>

	</div><!-- .footer-links -->
</div>