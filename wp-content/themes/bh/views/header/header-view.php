<?php
/**
 * Header view
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
$menu			= $globals[ 'menu' ];

?>

<header>

	<div class="header-top <?php echo $current_site; ?>">
		<div class="container">

			<div class="sites">
				<?php if ( $bh_sites ) { ?>

					<ul>
						<?php foreach ( $bh_sites as $site_name => $site_info ) { ?>

							<li class="site-item <?php echo $site_name . ( $site_name == $current_site ? ' active' : '' ); ?>">
								<a href="<?php echo $site_info[ 'link' ]; ?>">
									<div class="title"><?php echo $site_info[ 'header_title' ]; ?></div>
									<div class="icon"></div>
								</a>
							</li>

						<?php } ?>
					</ul>

				<?php } ?>
			</div><!-- .sites -->

			<div class="logo-wrapper">

				<div class="mobile-menu-btn hidden-lg hidden-md">
					<a></a>
				</div>

				<div class="logo">
					<a href="<?php echo HOME; ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
				</div>

				<div class="header-elements header-top-elements visible-lg visible-md">

					<?php if ( $elements[ 'languages_switcher' ] ) { ?>
						<div class="header-element languages-switcher">
							<?php echo $elements[ 'languages_switcher' ]; ?>
						</div>
					<?php } ?>

					<?php if ( $elements[ 'links_n_icons' ] ) {
						echo $elements[ 'links_n_icons' ];
					} ?>

					<?php if ( $current_site == 'shop' && $elements[ 'shop_cart_header_top_popup' ] ) { ?>
						<div class="header-element shop-cart-popup shop-cart-header-top-popup">
							<?php echo $elements[ 'shop_cart_header_top_popup' ]; ?>
						</div>
					<?php } ?>

					<?php if ( $elements[ 'newsletter_header_top_popup' ] ) { ?>
						<div class="header-element newsletter-popup">
							<?php echo $elements[ 'newsletter_header_top_popup' ]; ?>
						</div>
					<?php } ?>

				</div><!-- .header-elements -->

			</div><!-- .logo-wrapper -->

		</div>
	</div><!-- .header-top -->

	<div class="header-mid <?php echo $current_site; ?> hidden-lg hidden-md">
		<div class="container">

			<?php if ( $elements[ 'featured_page' ] ) { ?>
				<div class="featured-page">
					<a href="<?php echo get_permalink( $elements[ 'featured_page' ]->ID ); ?>"><?php echo $elements[ 'featured_page' ]->post_title; ?></a>
				</div>
			<?php } ?>

			<div class="header-elements header-mid-elements hidden-lg hidden-md">

				<?php if ( $elements[ 'languages_switcher' ] ) { ?>
					<div class="header-element languages-switcher">
						<?php echo $elements[ 'languages_switcher' ]; ?>
					</div>
				<?php } ?>

				<?php if ( $elements[ 'links_n_icons' ] ) {
					echo $elements[ 'links_n_icons' ];
				} ?>

				<?php if ( $current_site == 'shop' && $elements[ 'shop_cart_header_mid_popup' ] ) { ?>
					<div class="header-element shop-cart-popup shop-cart-header-mid-popup">
						<?php echo $elements[ 'shop_cart_header_mid_popup' ]; ?>
					</div>
				<?php } ?>

				<?php if ( $elements[ 'newsletter_header_mid_popup' ] ) { ?>
					<div class="header-element newsletter-popup">
						<?php echo $elements[ 'newsletter_header_mid_popup' ]; ?>
					</div>
				<?php } ?>

			</div><!-- .header-elements -->

		</div>
	</div><!-- .header-mid -->

	<div class="header-bottom <?php echo $current_site; ?> visible-lg visible-md">
		<div class="container">

			<?php if ( $menu ) { ?>

				<nav class="menu">
					<ul class="nav">
						<?php echo $menu; ?>
					</ul>
				</nav><!-- .menu -->

			<?php } ?>

			<?php if ( $elements[ 'featured_page' ] ) { ?>
				<div class="featured-page">
					<a href="<?php echo get_permalink( $elements[ 'featured_page' ]->ID ); ?>"><?php echo $elements[ 'featured_page' ]->post_title; ?></a>
				</div>
			<?php } ?>

		</div>
	</div><!-- .header-bottom -->

</header>