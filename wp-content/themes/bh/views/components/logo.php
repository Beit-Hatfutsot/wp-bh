<?php
/**
 * The Template for displaying BH logo
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/components
 * @since		2.6.0
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
global $globals;

$wpml_lang = $globals[ 'wpml_lang' ];

if ( ! $wpml_lang )
	return;

// Reset $wpml_lang in case of russian
$wpml_lang = $wpml_lang == 'ru' ? 'en' : $wpml_lang;

?>

<div class="logo">
	<a href="<?php echo HOME; ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<?php get_template_part( 'views/svgs/shape', 'logo-' . $wpml_lang ); ?>
	</a>
</div>