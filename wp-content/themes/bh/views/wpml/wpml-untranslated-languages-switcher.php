<?php
/**
 * WPML untranslated languages switcher
 *
 * Display specific translated pages
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/wpml
 * @since		2.6.0
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

/**
 * Variables
 */
$languages			= get_field( 'acf-options_untranslated_languages', 'option' );
$current_object_id	= get_queried_object_id();

if ( ! $languages )
	return;

?>

<ul class="wpml-untranslated-languages-switcher">

	<?php foreach ( $languages as $l ) {

		$language_code	= $l[ 'language_code' ];
		$page			= $l[ 'page' ];

		if ( ! $language_code || ! $page )
			continue;

		?>

		<li <?php echo $current_object_id == $page->ID ? 'class="active"' : ''; ?>>
			<a <?php echo $current_object_id != $page->ID ? 'href="' . get_permalink( $page->ID ) . '"' : ''; ?>>
				<div class="flag">

					<?php
						/**
						 * Display the language flag
						 */
						get_template_part( 'views/svgs/shape', 'flag-' . $language_code );
					?>

				</div>

				<div class="page-title"><?php echo $page->post_title; ?></div>
			</a>
		</li>

	<?php } ?>

</ul>