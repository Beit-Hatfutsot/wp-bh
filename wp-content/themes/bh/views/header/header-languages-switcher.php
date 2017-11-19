<?php
/**
 * Header languages switcher
 *
 * Display header languages switcher as part of header elements
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/header
 * @since		2.6.0
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="header-element languages-switcher">

	<?php
		/**
		 * Display the current langauge flag as the switcher button
		 */
		get_template_part( 'views/wpml/wpml', 'current-language' );
	?>

	<div class="languages-switcher-content">

		<?php
			/**
			 * Display the WPML languages switcher
			 */
			get_template_part( 'views/wpml/wpml', 'languages-switcher' );
		?>

		<?php
			/**
			 * Display specific translated pages
			 */
			get_template_part( 'views/wpml/wpml', 'untranslated-languages-switcher' );
		?>

	</div>

</div>