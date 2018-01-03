<?php
/**
 * Event - event elements builder
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
global $sorted_events, $lang;

$locale			= $wpdb->get_var( "SELECT default_locale FROM {$wpdb->prefix}icl_languages WHERE code='{$lang}'" );
$today			= date_i18n( 'Ymd' );
$filtered_date	= ( isset( $_POST[ 'event_date' ] ) && $_POST[ 'event_date' ] ) ? date_create_from_format( 'd/m/Y', $_POST[ 'event_date' ] )->format( 'Ymd' ) : '';

// Set $sorted_events - array of event elements seperated into sticky, current, future and past events
$sorted_events = array(
	'sticky'	=> array(),
	'current'	=> array(),
	'future'	=> array(),
	'past'		=> array()
);

// Check if ACF exists
if ( ! function_exists( 'get_field' ) )
	// return
	return;

if ( $globals[ 'events' ] ) {

	// Fill in $sorted_events array
	foreach ( $globals[ 'events' ] as $event ) {

		$start_date	= get_field( 'acf-event_start_date',	$event->ID );
		$end_date	= get_field( 'acf-event_end_date',		$event->ID );

		if ( $globals[ 'sticky_events_ids' ] && in_array( $event->ID, $globals[ 'sticky_events_ids' ] ) ) {
			// Sticky event
			$when = 'sticky';
		}
		elseif ( $end_date < $today ) {
			// Past event
			$when = 'past';
		}
		else {
			// Current/future event
			if ( $filtered_date ) {
				// Filtered date
				$when = ( $start_date <= $filtered_date ) ? 'current' : 'future';
			}
			else {
				// As of today
				$when = ( $start_date <= $today ) ? 'current' : 'future';
			}
		}

		// Prepare event element data
		$event_data = array(
			'ID'			=>  $event->ID,
			'description'	=>  get_field( 'acf-event_description',		$event->ID ),
			'image'			=>  get_field( 'acf-event_slider_image',	$event->ID ),
			'date'			=>  BH_get_event_date( $event->ID, $locale ),
			'title'			=>  get_the_title( $event->ID ),
			'permalink'		=>  get_permalink( $event->ID ),
			'type'			=>  BH_get_event_type( $event->ID ),
			'show_purchase'	=>  ( $when != 'past' ) ? true : false,
		);

		// Insert event into $sorted_events arrays accordingly
		$sorted_events[ $when ][] = BH_set_event_element( $event_data );

	}

}