<?php
/**
 * The Template for displaying post author details
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/components
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
$author_id		= get_the_author_meta( 'ID' );
$author_name	= get_the_author_meta( 'display_name' );
$author_bio		= get_the_author_meta( 'description' );
$avatar			= get_avatar_url( $author_id, 96 );

// WPML translations
if ( function_exists( 'icl_translate' ) && $author_id ) {

	$author_name	= icl_translate( 'WPML Custom', 'wpml_custom_author_name_' . $author_id, $author_name );
	$author_bio		= icl_translate( 'WPML Custom', 'wpml_custom_author_description_' . $author_id, $author_bio );

}

?>

<section class="author-meta">

	<?php if ( $avatar ) { ?>

		<div class="avatar">
			<img src="<?php echo $avatar; ?>" alt="<?php echo $author_name; ?>" width="96" height="96" />
		</div>

	<?php } ?>

	<div class="info">

		<div class="name">
			<?php echo __('By ', 'BH'); ?><a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo $author_name; ?></a>
		</div>

		<div class="bio">
			<?php echo apply_filters( 'the_content', $author_bio ); ?>
		</div>

	</div>

	<div class="clearfix">

</section><!-- .author-meta -->