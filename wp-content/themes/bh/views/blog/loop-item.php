<?php
/**
 * The Template for displaying post within loop
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/blog
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<article class="post loop-post" id="post-<?php the_ID(); ?>" onclick="location.href='<?php echo get_permalink(); ?>';">

	<?php
	/**
	 * Post categories
	 */
	?>
	<div class="post-categories">
		<?php the_category(', ', '', $post->ID); ?>
	</div>

	<?php
	/**
	 * Post title
	 */
	?>
	<h2 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

	<?php
		/**
		 * Post meta data
		 */
		get_template_part( 'views/components/meta', 'single' );
	?>

	<?php
		/**
		 * Post featured image
		 */
		get_template_part( 'views/components/featured-image' );
	?>

	<?php
	/**
	 * Post excerpt
	 */
	?>
	<div class="post-excerpt">
		<?php the_excerpt(); ?>
	</div>

</article><!-- #post-## -->