<?php
/**
 * Header view
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
$menu			= $globals[ 'menu' ];
$wpml_lang		= $globals[ 'wpml_lang' ];

if ( ! $bh_sites )
	return;

?>

<header>

	<div class="header-top">
		<div class="container">

			<div class="sites">

				<ul>
					<?php foreach ( $bh_sites as $key => $s ) {

						// Get site data
						$type			= $s[ 'type' ];
						$title			= $s[ 'title' ];
						$title_hover	= $s[ 'title_hover' ];
						$link			= $type == 'shop' && function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : $s[ 'link' ];

						if ( ! $title || ! $title_hover || ! $link )
							continue;

						?>

						<li class="site-item site-item-<?php echo $key; ?> <?php echo $current_site !== false && $key == $current_site ? 'active' : ''; ?>">
							<a href="<?php echo $link; ?>">
								<div class="title">
									<span class="title-1"><?php echo $title; ?></span>
									<span class="title-2"><?php echo $title_hover; ?></span>
								</div>
							</a>
						</li>

					<?php } ?>
				</ul>

			</div><!-- .sites -->

			<div class="logo-wrapper">

				<?php
				/**
				 * Display the mobile menu button
				 */
				?>
				<div class="mobile-menu-btn hidden-md hidden-lg">
					<a>
						<?php get_template_part( 'views/svgs/shape', 'mobile-menu-' . $wpml_lang ); ?>
					</a>
				</div>

				<?php
					/**
					 * Display the logo
					 */
					get_template_part( 'views/components/logo' );
				?>

				<?php
				/**
				 * Display the header elements
				 */
				$header_position = 'top'; ?>

				<div class="header-elements header-top-elements visible-md visible-lg">

					<?php include( locate_template( 'views/header/header-elements.php' ) ); ?>

				</div><!-- .header-elements -->

			</div><!-- .logo-wrapper -->

		</div>
	</div><!-- .header-top -->

	<div class="header-mid hidden-md hidden-lg">
		<div class="container">

			<?php
				/**
				 * Display the featured page
				 */
				get_template_part( 'views/header/header-featured-page' );
			?>

			<?php
				/**
				 * Display the logo
				 */
				get_template_part( 'views/components/logo' );
			?>

			<?php
			/**
			 * Display the header elements
			 */
			$header_position = 'mid'; ?>

			<div class="header-elements header-mid-elements hidden-md hidden-lg">

				<?php include( locate_template( 'views/header/header-elements.php' ) ); ?>

			</div><!-- .header-elements -->

		</div>
	</div><!-- .header-mid -->

	<div class="header-bottom visible-md visible-lg">
		<div class="container">

			<?php
				/**
				 * Display the menu
				 */
				if ( $menu ) { ?>

					<nav class="menu">
						<ul class="nav">
							<?php echo $menu; ?>
						</ul>
					</nav><!-- .menu -->

				<?php }
			?>

			<?php
				/**
				 * Display the featured page
				 */
				get_template_part( 'views/header/header-featured-page' );
			?>

		</div>
	</div><!-- .header-bottom -->

</header>