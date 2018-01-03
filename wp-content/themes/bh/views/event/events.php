<?php
/**
 * The template for displaying the event page template and category content
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
$globals[ 'sticky_events_ids' ] = array();

if ( function_exists( 'get_field' ) ) {

	// Get sticky events
	$sticky_events = get_field( 'acf-options_exhibitions_and_events_sticky_events', 'option' );

	/**
	 * Check if is Events page template
	 * If it is, do the following steps:
	 * 1. Get categories type should be displayed ( exhibition / event )
	 * 2. Get all categories belong to this particular type
	 */
	if ( 'event.php' == basename( get_page_template() ) ) {

		/**
		 * Variables
		 */
		global $post;
		$categories_type = '';

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

				default :
					$categories_type = 'exhibition';

			endswitch;
		}

		// Get all categories belong to this particular type
		if ( $categories_type ) {

			$include_categories = get_terms( array(
				'taxonomy'		=> 'event_category',
				'fields'		=> 'ids',
				'meta_query'	=> array(
					array(
						'key'		=> 'acf-event_category_type',
						'value'		=> $categories_type,
						'compare'	=> '='
					)
				)
			) );

		}

	}

}

if ( $sticky_events ) {

	/**
	 * Exclude sticky events not belong to the
	 * current category (in case of event category template) or to
	 * none of included categories (in case of event page template)
	 */
	if ( $globals[ 'category_id' ] || isset( $include_categories ) ) {
		foreach ( $sticky_events as $key => $s ) {
			$event_categories = wp_get_post_terms( $s[ 'event' ]->ID, 'event_category', array( 'fields' => 'ids' ) );

			if ( $globals[ 'category_id' ] ) {
				if ( ! in_array( $globals[ 'category_id' ], $event_categories ) )
					unset( $sticky_events[ $key ] );
			}
			else {
				if ( count( array_intersect( $include_categories, $event_categories ) ) === 0 )
					unset( $sticky_events[ $key ] );
			}
		}
	}

	// Initiate $globals[ 'sticky_events_ids' ]
	// Initiate $globals[ 'events' ] with $sticky_events if exists any
	if ( $sticky_events ) {
		foreach ( $sticky_events as $s ) {
			$globals[ 'sticky_events_ids' ][] = $s[ 'event' ]->ID;
			$globals[ 'events' ][] = $s[ 'event' ];
		}
	}

}

// Get future events
$args = array(
	'post_type'			=> 'event',
	'posts_per_page'	=> -1,
	'no_found_rows'		=> true,
	'meta_key'			=> 'acf-event_end_date',
	'orderby'			=> 'meta_value',
	'order'				=> 'ASC',
	'meta_query'		=> array(
		array(
			'key'		=> 'acf-event_end_date',
			'value'		=> date_i18n( 'Ymd' ),
			'type'		=> 'DATE',
			'compare'	=> '>='
		)
	)
);

if ( $globals[ 'category_id' ] || isset( $include_categories ) ) {

	$args['tax_query'] = array(
		array(
			'taxonomy'	=> 'event_category',
			'field'		=> 'term_id',
			'terms'		=> $globals[ 'category_id' ] ? $globals[ 'category_id' ] : $include_categories
		)
	);

}

if ( $globals[ 'sticky_events_ids' ] ) {
	$args['post__not_in'] = $globals[ 'sticky_events_ids' ];
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
 * Display events filters
 */
get_template_part( 'views/event/events', 'filters' );

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