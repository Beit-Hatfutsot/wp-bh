<?php
/**
 * The template for displaying the events filters
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/event
 * @version     2.7.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
global $globals;
$categories_type = '';

/**
 * Get event categories, according to the following steps:
 * 1. Check whether is an event page template or a category template
 * 2. Get the categories type
 * 3. Get all categories belong to this particular type
 */
if ( function_exists( 'get_field' ) ) {

	if ( 'event.php' == basename( get_page_template() ) ) {

		/**
		 * Variables
		 */
		global $post;

		$exhibitions_page	= get_field( 'acf-options_exhibitions_page', 'option' );
		$events_page		= get_field( 'acf-options_events_page', 'option' );

		// Get categories type should be displayed (exhibition / event)
		if ( $exhibitions_page && $events_page ) {
			switch ( $post->ID ) :
				case $exhibitions_page->ID :
					// Exhibitions
					$categories_type = 'exhibition';
					break;

				case $events_page->ID :
					// Events
					$categories_type = 'event';
					break;

			endswitch;
		}

	}
	elseif ( $globals[ 'category_id' ] ) {

		// Get current category type
		$categories_type = get_field( 'acf-event_category_type', 'event_category_' . $globals[ 'category_id' ] );

	}

}

// Get event categories
$args = array(
	'taxonomy'	=> 'event_category',
	'orderby'	=> 'term_order'
);

if ( $categories_type ) {
	$args[ 'meta_query' ] = array(
		array(
			'key'		=> 'acf-event_category_type',
			'value'		=> $categories_type,
			'compare'	=> '='
		)
	);
}
$categories = get_terms( $args );

// Build categories filter default option text
switch ( $categories_type ) :
	case 'exhibition' :
		// All Exhibitions
		$categories_filter_all_text = __( 'All Exhibitions', 'BH' );
		break;

	case 'event' :
		// All Events
		$categories_filter_all_text = __( 'All Events', 'BH' );
		break;

	default :
		// All Categories
		$categories_filter_all_text = __( 'All Categories', 'BH' );

endswitch;

?>

<div class="event-filters-outer-wrapper">
	<div class="event-filters-inner-wrapper">

		<div class="event-filters">
			<div class="event-filter-by-category">
				<select>

					<option value="<?php echo $categories_type ? $categories_type : ''; ?>"><?php echo $categories_filter_all_text; ?></option>

					<?php foreach ( $categories as $cat ) {

						if ( function_exists( 'BH_get_cached_event_category_events' ) ) {
							$events_exist = BH_get_cached_event_category_events( $cat );
						}
						else {
							$events_exist = BH_get_event_category_events( $cat->term_id );
						}

						echo ( $events_exist ) ? '<option value="' . $cat->term_id . '"' .( ( $globals[ 'category_id' ] == $cat->term_id ) ? ' selected=selected' : '' ) . '>' . $cat->name . '</option>' : '';
					
					} ?>

				</select>
			</div>

			<div class="event-filter-by-date">
				<input class="datepicker" value="<?php _e( 'Start from', 'BH' ); ?>" />
			</div>

			<div class="event-filter-lang hide"><?php echo ICL_LANGUAGE_CODE; ?></div>

			<div class="loader">

				<?php
					/**
					 * Display the loader
					 */
					get_template_part( 'views/components/loader' );
				?>

			</div>
		</div>

	</div>
</div>