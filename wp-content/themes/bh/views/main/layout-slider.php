<?php
/**
 * Main - Slider layout
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/main
 * @version     2.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check for ACF existence
if ( ! function_exists('get_field') )
	return;

// Layout parameters
$slider = get_field('acf-options_exhibitions_and_events_slider', 'option');

if ( ! $slider )
	return;

/**
 * Variables
 */
global $events;
$events		= array();
$wpml_lang	= function_exists('icl_object_id') ? ICL_LANGUAGE_CODE : '';

foreach ( $slider as $s ) {

	// Init $item
	$item = array();

	// Get slide parameters
	$type = $s['type'];

	switch ( $type ) {

		// Event
		case 'event' :

			$event = $s['event'];

			if ( $event ) {
				$item['type']	= 'event';
				$item['event']	= $event;
			}

			break;

		// Custom
		case 'custom' :

			// Get custom slide parameters
			$image		= $s['custom_image'];
			$title		= $s['custom_title'];
			$link		= $s['custom_link'];
			$target		= $s['custom_link_target'];

			$item['type']	= 'custom';
			$item['event']	= array(
				'image' 	=> $image		? $image		: '',
				'title' 	=> $title		? $title		: '',
				'link'		=> $link		? $link			: '',
				'target'	=> $target		? $target		: ''
			);

			break;

	}

	if ( $item['event'] ) {

		if ( $wpml_lang == 'he' ) {
			array_unshift($events, $item);
		}
		else {
			$events[] = $item;
		}

	}
}

if ( $events ) {

	// Build event elements
	get_template_part('views/main/slider/set-event-elements');

	// Display events slider
	get_template_part('views/main/slider/display-events-slider');
	
}