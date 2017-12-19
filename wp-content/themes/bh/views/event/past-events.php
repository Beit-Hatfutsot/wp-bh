<?php
/**
 * The template for displaying the past events
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
$globals[ 'events' ] = array();

if ( function_exists( 'get_field' ) ) {

	$event_categories = get_field( 'acf-options_event_categories', 'option' );

}

// Get future events
$args = array(
	'post_type'			=> 'event',
	'posts_per_page'	=> -1,
	'no_found_rows'		=> true,
	'meta_key'			=> 'acf-event_end_date',
	'orderby'			=> 'meta_value',
	'order'				=> 'DESC',
	'meta_query'		=> array(
		array(
			'key'		=> 'acf-event_end_date',
			'value'		=> date_i18n('Ymd'),
			'type'		=> 'DATE',
			'compare'	=> '<'
		)
	)
);

if ( $event_categories ) {

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'event_category',
			'field' => 'term_id',
			'terms' => $event_categories
		)
	);

}

$events_query = new WP_Query( $args );

if ( $events_query->have_posts() ) : while ( $events_query->have_posts() ) : $events_query->the_post();
	$globals[ 'events' ][] = $post;
endwhile; endif; wp_reset_postdata();

/**
 * Build event elements
 */
get_template_part( 'views/event/set-event-elements' );

/**
 * Display events list
 */
echo '<div class="events-list-container">';

	if ( $globals[ 'events' ] ) {
		get_template_part( 'views/event/events', 'list' );
	} else {
		get_template_part( 'views/components/not-found' );
	}

echo '</div>';