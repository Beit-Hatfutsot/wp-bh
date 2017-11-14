<?php
/**
 * The template for displaying the head
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/header
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Facebook Open Graph API -->
	<meta property="fb:app_id" content="666465286777871"/>

	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php
		/**
		 * Google fonts
		 */
		global $globals;

		if ( $globals[ 'google_fonts' ] ) {
			foreach ( $globals[ 'google_fonts' ] as $font ) {
				printf ( "<link href='%s' rel='stylesheet'>", $font );
			}
		}
	?>

	<?php
		/**
		 * Google Analytics tracking code
		 */
		if ( function_exists( 'the_field' ) ) { ?>

			<script>
				_BH_GA_tid	= '<?php the_field( 'acf-options_tracking_code', 'option' ); ?>';
			</script>

		<?php }
	?>

	<?php wp_head(); ?>

	<?php
		/**
		 * Pingdom
		 */
		get_template_part( 'views/header/scripts/pingdom' );
	?>

	<?php
		/**
		 * Facebook remarketing
		 */
		get_template_part( 'views/header/scripts/facebook-remarketing' );
	?>

	<?php
		/**
		 * Facebook conversion
		 */
		if ( is_wc_endpoint_url( 'order-received' ) ) {
			get_template_part( 'views/header/scripts/facebook-conversion' );
		}
	?>

</head>