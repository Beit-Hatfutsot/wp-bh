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

if ( $bh_sites ) { ?>

	<div class="container">
		<div class="sites-links <?php echo $current_site; ?>-sites-links row">

			<?php foreach ( $bh_sites as $site_name => $site_info ) { ?>
				<div class="site-item col-xs-4">
					<a class="<?php echo $site_name . ( $site_name == $current_site ? ' active' : '' ); ?>" href="<?php echo $site_info[ 'link' ]; ?>" target="<?php echo $site_name == 'mjs' ? '_blank' : '_self'; ?>">
						<div class="title"><?php echo $site_info[ 'footer_title' ]; ?></div>
					</a>
				</div>
			<?php } ?>

		</div><!-- .sites-links -->
	</div>

<?php }