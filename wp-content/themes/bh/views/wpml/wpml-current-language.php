<?php
/**
 * WPML current language
 *
 * Display current language as the button for the languages switcher
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/wpml
 * @since		2.6.0
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE ) )
	return;

?>

<div class="languages-switcher-btn">

	<a>

		<?php
			/**
			 * Display the current language flag
			 */
			get_template_part( 'views/svgs/shape', 'flag-' . ICL_LANGUAGE_CODE );
		?>

	</a>

</div>