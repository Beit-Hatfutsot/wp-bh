<?php
/**
 * WPML languages switcher
 *
 * Display dynamic WPML languages switcher
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/wpml
 * @since		2.6.0
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'icl_get_languages' ) )
	return;

/**
 * Variables
 */
$languages = icl_get_languages( 'skip_missing=0&orderby=code' );

if ( empty( $languages ) )
	return;

?>

<ul class="wpml-languages-switcher">

	<?php foreach ( $languages as $l ) { ?>

		<li <?php echo $l[ 'active' ] ? 'class="active"' : ''; ?>>
			<a <?php echo ! $l[ 'active' ] ? 'href="' . $l[ 'url' ] . '"' : ''; ?>>
				<div class="flag">

					<?php
						/**
						 * Display the language flag
						 */
						get_template_part( 'views/svgs/shape', 'flag-' . $l[ 'language_code' ] );
					?>
					
				</div>

				<div class="language-name"><?php echo $l[ 'native_name' ]; ?></div>
			</a>
		</li>

	<?php } ?>

</ul>