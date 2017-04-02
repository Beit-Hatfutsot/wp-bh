<?php
/**
 * Event - event element markup
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/event
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$event_element =
	"<div class='row'>" .
		// first column - event name and date
		"<div class='col-1 col-xs-12 visible-xs'>" .
			"<h2 class='event-name'><a href='" . get_permalink($event->ID) . "'>" . get_the_title($event->ID) . "</a></h2>" .
			$event_date .
		"</div>" .
		
		// second column - event image
		"<div class='col-2 col-xs-6 col-sm-4 col-md-3'>" .
			( ($image) ? "<a href='" . get_permalink($event->ID) . "'><img src='" . $image['sizes']['thumbnail'] . "' alt='" . ( ($image['alt']) ? $image['alt'] : '' ) . "' /></a>" : "" ) .
		"</div>" .
		
		// third column - event description and buttons
		"<div class='col-3 col-xs-6 col-sm-8 col-md-9'>" .
			"<div class='event-excerpt'>" .
				// event name and date only for small screen size
				"<div class='event-name-wrap'>" .
					"<h2 class='event-name'><a href='" . get_permalink($event->ID) . "'>" . get_the_title($event->ID) . "</a></h2>" .
					// "<div class='event-meta'>" . BH_get_event_type($event->ID) . $event_date . "</div>" .
				"</div>" .
				
				// event description
				"<div class='event-desc'>" . "<div class='event-meta'>" . BH_get_event_type($event->ID) . $event_date . "</div>" .$description . "</div>" .
			"</div>" .

			// event buttons
			"<div class='event-btn'>" .
				// display purchase button only for current/future events
				( ($when != 'past') ? BH_get_event_purchase_btn($event->ID) : '' ) .
				"<a class='btn orange-btn event-more' href='" . get_permalink($event->ID) . "'>" . $read_more_btn . "</a>" .
			"</div>" .
		"</div>" .
		
		// event type
		BH_get_event_type($event->ID) .
	"</div>";