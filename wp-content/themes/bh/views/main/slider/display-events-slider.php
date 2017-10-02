<?php
/**
 * Main - Slider layout presentation
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/main/slider
 * @version     2.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Layout parameters
$layout_title	= get_sub_field('layout_title');
$sort_title		= get_sub_field('sort_title');

/**
 * Variables
 */
global $categories, $is_categories_empty, $is_events_empty;

if ( ! $is_events_empty ) { ?>

	<section class="main-layout main-layout-slider">
	
		<div class="container">

			<h1><?php echo get_bloginfo('description') . ' - ' . get_bloginfo('name'); ?></h1>
		
			<?php echo ( $layout_title ) ? '<h2>' . $layout_title . '</h2>' : ''; ?>

			<?php
				// Display categories filter
				if ( ! $is_categories_empty ) {

					echo '<div class="categories-filter">';
						echo ( $sort_title ) ? '<span class="sort-title">' . $sort_title . ' </span>' : '';
						echo '<ul>';
							echo '<li category="0" class="active">' . __('All events', 'BH') . '</li>';

							foreach ( $categories as $key => $val ) {
								if ( $key != '0' && count( $val ) > 0 ) {
									$category = get_term_by('id', $key, 'event_category');
									echo '<li class="delimiter">|</li>';
									echo '<li category="' . $key . '">' . $category->name . '</li>';
								}
							}
						echo '</ul>';
					echo '</div>';

				}

				$visible_events = ( count( $categories[0] ) < 6 ) ? count( $categories[0] ) : 6; ?>

				<?php // Display events ?>
				<div class="events-slider-placeholder">
					<div class="events-slider">
						<div class="cycle-slideshow"
							data-cycle-slides=".event-item"
							data-cycle-fx=carousel
							data-cycle-timeout=0
							data-cycle-carousel-visible=<?php echo $visible_events; ?>
							data-cycle-manual-trump=false
							data-cycle-swipe=true
							data-cycle-log=false
							data-cycle-next="#events-slider-next"
							data-cycle-prev="#events-slider-prev"
							<?php echo ( defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'he' ) ? 'data-cycle-starting-slide=' . ( count( $categories[0] )-6 ) : ''; ?>>

							<?php echo implode( '', $categories[0] ); ?>
							
						</div>
					</div>

					<div id="events-slider-next"><i class="fa fa-angle-left"></i></div>
					<div id="events-slider-prev"><i class="fa fa-angle-right"></i></div>
				</div>

		</div>
		
	</section>
	
	<?php // Save $categories in JSON format for filtering use ?>
	<script>
		var _BH_events = <?php echo json_encode( $categories ); ?>;
	</script>
	
<?php }