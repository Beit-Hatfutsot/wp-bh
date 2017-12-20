<?php
/**
 * The template for displaying the side menu
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/components
 * @version		2.7.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

/**
 * Variables
 */
$exhibitions_page		= get_field( 'acf-options_exhibitions_page', 'option' );
$exhibitions_page_id	= $exhibitions_page ? $exhibitions_page->ID : '';
$events_page			= get_field( 'acf-options_events_page', 'option' );
$events_page_id			= $events_page ? $events_page->ID : '';
$object_id				= get_queried_object_id();

/**
 * Check if is Event page template, event category or a single event
 * If it is, do the following steps:
 * 1. Get category type should be displayed ( exhibition / event )
 * 2. Set $object_id accordingly
 */
if ( 'event.php' == basename( get_page_template() ) ) {

	// Event page template
	$exhibitions_page	= get_field( 'acf-options_exhibitions_page', 'option' );
	$events_page		= get_field( 'acf-options_events_page', 'option' );

	if ( $exhibitions_page && $events_page ) {
		switch ( $post->ID ) :
			case $exhibitions_page->ID :
				// Exhibitions
				$category_type = 'exhibition';
				break;

			case $events_page->ID :
				// Events
				$category_type = 'event';
				break;

		endswitch;
	}

}
elseif ( is_tax( 'event_category' ) ) {

	// Event category
	$category = get_queried_object();
	$category_type = get_field( 'acf-event_category_type', $category );

}
elseif ( is_singular( 'event' ) ) {

	// Single event
	$event_categories = wp_get_post_terms( $object_id, 'event_category' );
	$category_type = get_field( 'acf-event_category_type', $event_categories[0] );

}

switch ( $category_type ) :
	case 'exhibition' :
		// Exhibitions
		if ( $exhibitions_page_id ) {
			$object_id = $exhibitions_page_id;
		}
		break;

	case 'event' :
		// Events
		if ( $events_page_id ) {
			$object_id = $events_page_id;
		}
		break;

endswitch;

// Get top menu parent
$parent = BH_get_top_menu_item( $object_id, 'main-menu' );

?>

<div class="col-lg-2 visible-lg side-menu-wrapper">
	<nav>
		<ul>

			<?php if ( $parent ) {

				// Top parent page item
				echo '<li class="parent">';
					echo ( $parent[ 'url' ] ) ? '<a href="' . $parent[ 'url' ] . '">' : '';
						echo $parent[ 'title' ];
					echo ( $parent[ 'url' ] ) ? '</a>' : '';
				echo '</li>';

				// Display event categories in case of parent page is based on event.php page template
				if ( get_page_template_slug( $parent[ 'object_id' ] ) == 'page-templates/event.php' ) {

					echo BH_get_event_categories_menu( $category_type, get_queried_object_id(), true );

				}

				// Display children pages
				$args = array(
					'theme_location'	=> 'main-menu',
					'container'			=> false,
					'items_wrap'		=> '%3$s',
					'children_of'		=> $parent['ID']
				);
				wp_nav_menu( $args );

			}
			else {

				echo '<li class="parent">' . get_the_title( $post->ID ) . '</li>';

			} ?>
	
		</ul>		
	</nav>

	<?php
		/**
		 * Display newsletter widget in case of parent page is based on event.php page template
		 */
		if ( $parent && get_page_template_slug($parent['object_id']) == 'page-templates/event.php' ) {

			get_template_part('views/sidebar/sidebar', 'newsletter');

		}
	?>
</div>