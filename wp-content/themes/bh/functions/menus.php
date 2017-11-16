<?php
/**
 * Menus
 *
 * @author		Beit Hatfutsot
 * @package		bh/functions
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
global $globals;

$globals[ 'menus' ] = array(
	'main-menu'			=> __( 'Main Menu' ),
	'education-menu'	=> __( 'Education Menu' ),
	'shop-menu'			=> __( 'Shop Menu' )
);

/**
 * BH_register_menus
 *
 * This function registers theme menus
 *
 * @param	N/A
 * @return	N/A
 */
function BH_register_menus() {

	/**
	 * Variables
	 */
	global $globals;

	register_nav_menus( $globals[ 'menus' ] );

}
add_action( 'init', 'BH_register_menus' );

/***********************/
/* side menu functions */
/***********************/

/**
 * BH_get_top_menu_item
 *
 * This function gets top menu item
 * Used for displaying top menu item in side menu
 *
 * @param	$id (int) Current object ID
 * @param	$menu_name (string)	Menu theme location
 * @return	(mixed) Array of top menu item arguments (ID, object ID, title, url) or FALSE in case of any failure
 */
function BH_get_top_menu_item( $id, $menu_name ) {

	if ( ! isset( $id ) || ! isset( $menu_name ) )
		// return
		return false;

	/**
	 * Variables
	 */
	$parent		= false;
	$locations	= get_nav_menu_locations();
	
	if ( isset( $locations[ $menu_name ] ) ) {

		$current_item_key = '';

		if ( function_exists( 'BH_get_cached_nav_menu_items' ) )
			$menu_items = BH_get_cached_nav_menu_items( $menu_name );
		else
			$menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );

		// Find current item key
		if ( $menu_items ) {

			foreach ( $menu_items as $key => $item ) {

				if ( $item->object_id == $id ) {
					$current_item_key = $key;

					// Check backwards in order to find the top level parent
					while ( $menu_items[ $current_item_key ]->menu_item_parent )
						if ( $menu_items[--$key]->ID == $menu_items[ $current_item_key ]->menu_item_parent )
							$current_item_key = $key;

					// $current_item_key now should point to top level parent item
					$parent = array(
						'ID'		=> $menu_items[ $current_item_key ]->ID,
						'object_id'	=> $menu_items[ $current_item_key ]->object_id,
						'title'		=> $menu_items[ $current_item_key ]->title,
						'url'		=> $menu_items[ $current_item_key ]->url
					);

					break;
				}

			}

		}

	}

	// return
	return $parent;

}

/**
 * BH_submenu_limit
 *
 * This function extends wp_nav_menu() to enable showing children menu only
 *
 * @param	$items (array) The menu items, sorted by each menu item's menu order
 * @param	$args (array) Object containing wp_nav_menu() arguments
 * @return	(array) Subset of $items according to parent item ID (defined as $args->children_of)
 */
function BH_submenu_limit( $items, $args ) {

	if ( empty( $args->children_of ) )
		// return
		return $items;

	/**
	 * Variables
	 */
	$parents	= array();
	$parents[]	= $args->children_of;

	foreach ( $items as $key => $item ) {

		if ( in_array( $item->menu_item_parent, $parents ) )
			$parents[] = $item->ID;
		else
			unset( $items[ $key ] );

	}

	// return
	return $items;

}
add_filter( 'wp_nav_menu_objects', 'BH_submenu_limit', 10, 2 );

/**
 * BH_get_event_categories_menu
 *
 * This function gets list of event categories, optionally get also event items for each category
 * Used for displaying event categories in side menu in case of parent page (top menu item) is based on event.php page template
 *
 * @param	$current_object_id (int) Current object ID. if set the current menu item will be marked
 * @param	$show_events (bool) If TRUE get child events for each event category
 * @return	(string) HTML LIs structure
 */
function BH_get_event_categories_menu( $current_object_id, $show_events ) {

	/**
	 * Variables
	 */
	$output	= '';

	$args	= array(
		'orderby' => 'term_order'
	);

	if ( function_exists( 'BH_get_cached_terms' ) )
		$categories = BH_get_cached_terms( 'event_category', $args );
	else
		$categories = get_terms( 'event_category', $args );

	foreach ( $categories as $cat ) {
		
		if ( function_exists( 'BH_get_cached_event_category_events' ) )
			$events = BH_get_cached_event_category_events( $cat );
		else
			$events = BH_get_event_category_events( $cat->term_id );

		if ( $show_events && $events ) {

			$events_list		= '';		// Events LIs
			$current_category	= false;	// Indicates whether the current category is a parent menu item

			foreach ( $events as $event ) {

				if ( $event->ID == $current_object_id ) $current_category = true;
				$events_list .= '<li class="menu-item menu-item-type-post_type menu-item-object-event menu-item-999' . $event->ID . ' ' . ( ( $event->ID == $current_object_id ) ? 'current-menu-item current_page_item' : '' ) . '"><a href="' . get_permalink( $event->ID ) . '" item="999' . $event->ID . '">' . $event->post_title . '</a></li>';

			}

			$output .=
				'<li class="menu-item menu-item-type-taxonomy menu-item-object-event_category menu-item-has-children menu-item-999' . $cat->term_id . ' ' . ( ($cat->term_id == $current_object_id || $current_category) ? 'current-menu-item current_page_item' : '' ) . '"><a href="' . get_term_link( $cat ) . '" item="999' . $cat->term_id . '">' . $cat->name . '</a>' .
					'<ul class="sub-menu">' . $events_list . '</ul>' .
				'</li>';
			
		} elseif ( $events ) {

			$output .= '<li class="menu-item menu-item-type-taxonomy menu-item-object-event_category menu-item-999' . $cat->term_id . ' ' . ( ($cat->term_id == $current_object_id) ? 'current-menu-item current_page_item' : '' ) . '"><a href="' . get_term_link( $cat ) . '" item="999' . $cat->term_id . '">' . $cat->name . '</a></li>';

		}

	}

	// return
	return $output;

}

/***********************/
/* main menu functions */
/***********************/

/**
 * Walker_Top_Menu_Walker class
 *
 * This walker adds data-title tag to menu anchor
 * Used for CSS manipulation
 *
 * @extends Walker_Nav_Menu
 */
class Walker_Top_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Passed by reference. Used to append additional content.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']		= ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['data-title']	= ! empty( $item->title )      ? $item->title : '';
		$atts['target']		= ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']		= ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']		= ! empty( $item->url )        ? $item->url        : '';

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

}

/**
 * BH_add_event_categories_submenu
 *
 * This function extends wp_nav_menu() to enable showing list of event categories under a given parent item object ID
 * Used for displaying event categories in main menu under an event.php page template
 *
 * @param	$items (array) The menu items, sorted by each menu item's menu order
 * @param	$args (array) Object containing wp_nav_menu() arguments
 * @return	(array) Extended $items with additional items list containing event categories
 */
function BH_add_event_categories_submenu( $items, $args ) {

	if ( empty( $args->add_events_list_under ) )
		// return
		return $items;

	/**
	 * Variables
	 */
	$parent_item		= '';
	$parent_item_key	= '';
	$categories_list	= array();

	// Get parent item and parent item key
	foreach ( $items as $key => $item ) {

		if ( $item->object_id == $args->add_events_list_under ) {
			$parent_item = $item;
			$parent_item_key = $key;

			break;
		}

	}

	if ( ! $parent_item_key )
		// return
		return $items;

	// Add menu-item-has-children indicator
	if ( ! in_array( 'menu-item-has-children', $items[ $parent_item_key ]->classes ) )
		$items[ $parent_item_key ]->classes[] = 'menu-item-has-children';

	// Get event categories
	$category_args = array(
		'orderby' => 'term_order'
	);

	if ( function_exists( 'BH_get_cached_terms' ) )
		$categories = BH_get_cached_terms( 'event_category', $category_args );
	else
		$categories = get_terms( 'event_category', $category_args );

	// Build categories list
	$index = 0;

	foreach ( $categories as $cat ) {

		if ( function_exists( 'BH_get_cached_event_category_events' ) )
			$events_exist = BH_get_cached_event_category_events( $cat );
		else
			$events_exist = BH_get_event_category_events( $cat->term_id );

		if ( $events_exist ) {

			$menu_item = new stdClass();

			$menu_item->ID					= '999' . $cat->term_id;
			$menu_item->post_status			= 'publish';
			$menu_item->post_parent			= $parent_item->object_id;
			$menu_item->post_type			= 'nav_menu_item';
			$menu_item->menu_item_parent	= $parent_item->ID;
			$menu_item->object_id			= $cat->term_id;
			$menu_item->object				= 'event_category';
			$menu_item->type				= 'taxonomy';
			$menu_item->type_label			= 'Event Category';
			$menu_item->url					= get_term_link( $cat );
			$menu_item->title				= $cat->name;
			$menu_item->classes				= array( 'menu-item', 'menu-item-type-taxonomy', 'menu-item-object-event_category' );

			// Check current ancestor menu item
			if ( is_tax( 'event_category', $cat->term_id ) ) {

				// Modify parent item classes
				$items[ $parent_item_key ]->classes[]	= 'current-menu-ancestor';
				$items[ $parent_item_key ]->classes[]	= 'current-menu-parent';
				
				// Add classes to current item
				$menu_item->classes[]					= 'current-menu-item';

			} elseif ( is_singular( 'event' ) ) {

				// Modify parent item classes
				if ( ! in_array( 'current-menu-ancestor', $items[ $parent_item_key ]->classes ) )
					$items[ $parent_item_key ]->classes[]	= 'current-menu-ancestor';

				if ( has_term( $cat->term_id, 'event_category' ) ) {

					// Add classes to current item
					$menu_item->classes[]				= 'current-menu-ancestor';
					$menu_item->classes[]				= 'current-menu-parent';

				}

			}

			$categories_list[ $index++ ] = new WP_Post( $menu_item );

		}

	}

	// Merge categories list into $items
	if ( $parent_item_key && $categories_list )
		array_splice( $items, $parent_item_key, 0, $categories_list );

	// return
	return $items;

}
add_filter( 'wp_nav_menu_objects', 'BH_add_event_categories_submenu', 10, 2 );

/**
 * BH_add_blog_categories_submenu
 *
 * This function extends wp_nav_menu() to enable showing list of blog categories under a given parent item object ID
 * Used for displaying blog categories in top menu under a blog.php page template
 *
 * @param	$items (array) The menu items, sorted by each menu item's menu order
 * @param	$args (array) Object containing wp_nav_menu() arguments
 * @return	(array) Extended $items with additional items list containing blog categories
 */
function BH_add_blog_categories_submenu($items, $args) {

	if ( empty( $args->add_blog_list_under ) )
		// return
		return $items;

	/**
	 * Variables
	 */
	$parent_item		= '';
	$parent_item_key	= '';
	$categories_list	= array();

	// Get parent item and parent item key
	foreach ( $items as $key => $item ) {

		if ( $item->object_id == $args->add_blog_list_under ) {

			$parent_item = $item;
			$parent_item_key = $key;
			
			break;

		}

	}

	if ( ! $parent_item_key )
		// return
		return $items;

	// Add menu-item-has-children indicator
	if ( ! in_array( 'menu-item-has-children', $items[ $parent_item_key ]->classes ) )
		$items[ $parent_item_key ]->classes[] = 'menu-item-has-children';

	// Get blog categories
	$category_args = array(
		'orderby' => 'term_order'
	);

	if ( function_exists( 'BH_get_cached_terms' ) )
		$categories = BH_get_cached_terms( 'category', $category_args );
	else
		$categories = get_terms( 'category', $category_args );

	// Build categories list
	$index = 0;

	foreach ( $categories as $cat ) {

		$menu_item = new stdClass();

		$menu_item->ID					= '999' . $cat->term_id;
		$menu_item->post_status			= 'publish';
		$menu_item->post_parent			= $parent_item->object_id;
		$menu_item->post_type			= 'nav_menu_item';
		$menu_item->menu_item_parent	= $parent_item->ID;
		$menu_item->object_id			= $cat->term_id;
		$menu_item->object				= 'category';
		$menu_item->type				= 'taxonomy';
		$menu_item->type_label			= 'Category';
		$menu_item->url					= get_term_link( $cat );
		$menu_item->title				= $cat->name;
		$menu_item->classes				= array( 'menu-item', 'menu-item-type-taxonomy', 'menu-item-object-category' );

		// Check current ancestor menu item
		if ( is_category( $cat->term_id ) ) {

			// Modify parent item classes
			$items[ $parent_item_key ]->classes[]	= 'current-menu-ancestor';
			$items[ $parent_item_key ]->classes[]	= 'current-menu-parent';
			
			// Add classes to current item
			$menu_item->classes[]					= 'current-menu-item';

		} elseif ( is_singular( 'post' ) ) {

			// Modify parent item classes
			if ( ! in_array( 'current-menu-ancestor', $items[ $parent_item_key ]->classes ) )
				$items[ $parent_item_key ]->classes[]	= 'current-menu-ancestor';
				
			if ( has_term( $cat->term_id, 'category' ) ) {

				// Add classes to current item
				$menu_item->classes[]				= 'current-menu-ancestor';
				$menu_item->classes[]				= 'current-menu-parent';

			}

		}
		
		$categories_list[ $index++ ] = new WP_Post( $menu_item );

	}

	// Merge categories list into $items
	if ( $parent_item_key && $categories_list )
		array_splice( $items, $parent_item_key, 0, $categories_list );

	// return
	return $items;

}
add_filter( 'wp_nav_menu_objects', 'BH_add_blog_categories_submenu', 10, 2 );