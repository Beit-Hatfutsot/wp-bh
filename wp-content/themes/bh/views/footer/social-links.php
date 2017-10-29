<?php
/**
 * Social links
 *
 * Display social links as part of footer
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/footer
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
$links			= get_field( 'acf-options_social_icons_links', 'option' );

if ( $links ) { ?>

	<div class="container">
		<div class="social-links <?php echo $current_site; ?>-social-links row">

			<ul>
				<?php foreach ( $links as $l ) { ?>
					<li>
						<a href="<?php echo $l[ 'link' ]; ?>" target="_blank"><i class="fa <?php echo $l[ 'icon' ]; ?>"></i></a>
					</li>
				<?php } ?>
			</ul>

		</div><!-- .social-links -->
	</div>

<?php }