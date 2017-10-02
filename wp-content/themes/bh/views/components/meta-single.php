<?php
/**
 * The Template for displaying single post meta
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

// WPML translations
if ( function_exists( 'icl_translate' ) && $author_id ) {
	$author_name	= icl_translate( 'WPML Custom', 'wpml_custom_author_name_' . $author_id, $author_name );
}

?>

<div class="post-author">
	<?php echo __('By ', 'BH') . '<a href="' . get_author_posts_url( $author_id ) . '">' . $author_name . '</a>'; ?>
</div>

<div class="post-meta-wrapper">
	<div class="post-meta post-date">
		<?php echo get_the_date(); ?>
	</div>
	
	<div class="post-meta post-comments-count" data-href="<?php the_permalink(); ?>"></div><span class="comments-count">&nbsp;<?php _e('Comments', 'BH'); ?></span>
</div>