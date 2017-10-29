<?php
/**
 * Footer menu
 *
 * Display menu as part of footer
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

$menu = $globals[ 'menu' ];

if ( $menu ) { ?>

	<div class="container">
		<nav class="footer-menu row">

			<ul>
				
				<?php
				/**
				 * Languages list
				 */
				?>
				<li class="menu-item-has-children"><span class="item-before"></span><a><span><?php _e( 'Language/שפה', 'BH' ); ?></span></a>
					<ul class="sub-menu">
						<?php echo BH_footer_menu_languages_list(); ?>
					</ul>
				</li>

				<?php echo $menu; ?>

			</ul>

		</nav><!-- .footer-menu -->
	</div>

<?php }