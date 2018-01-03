<?php
/**
 * Template Name: Events
 */?>
<?php get_header(); ?>

<?php

	/**
	 * Variables
	 */
	global $globals;

	// Set $globals[ 'category_id' ] to null in order to display all event categories
	$globals[ 'category_id' ] = '';

?>

<section class="page-content">

	<div class="container">
		<div class="row">

			<?php
				/**
				 * Display the side menu
				 */
				get_template_part( 'views/components/side-menu' );
			?>

			<div class="col-lg-10 content-wrapper-wide">

				<?php
					/**
					 * Display the event page template content
					 */
					get_template_part( 'views/event/events' );
				?>

			</div>

		</div>
	</div>

</section>

<?php get_footer(); ?>