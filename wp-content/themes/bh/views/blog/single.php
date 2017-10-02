<?php
/**
 * The Template for displaying single post
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/blog
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<section class="page-content">

	<div class="container">
		<div class="row">

			<?php
				/**
				 * Sidebar blog
				 */
				get_template_part( 'views/sidebar/sidebar', 'blog' );
			?>

			<div class="content-wrapper-wide col-lg-10">

				<?php
					/**
					 * Post featured image
					 */
					get_template_part( 'views/components/featured-image' );
				?>

				<article class="post single-post" id="post-<?php the_ID(); ?>">

					<?php
					/**
					 * Post categories
					 */
					?>
					<div class="post-categories">
						<?php the_category( ', ', '', $post->ID ); ?>
					</div>

					<?php
					/**
					 * Post title
					 */
					?>
					<h2 class="post-title"><?php echo get_the_title(); ?></h2>

					<?php
						/**
						 * Post meta data
						 */
						get_template_part( 'views/components/meta', 'single' );
					?>

					<?php
					/**
					 * Post content
					 */
					?>
					<div class="post-content">
						<?php the_content(); ?>
					</div>

				</article><!-- #post-## -->

				<?php
					/**
					 * Author details
					 */
					get_template_part( 'views/components/meta', 'author' );
				?>

				<div class="fb-comments-wrapper">
					<div class="fb-comments" data-width="100%" data-href="<?php the_permalink(); ?>" data-numposts="5" data-colorscheme="light"></div>
				</div>

			</div><!-- .content-wrapper-wide -->

		</div>	
	</div><!-- .container -->

</section><!-- .page-content -->