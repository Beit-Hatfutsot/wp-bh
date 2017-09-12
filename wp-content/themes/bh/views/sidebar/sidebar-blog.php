<?php
/**
 * The Template for displaying the blog sidebar
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/sidebar
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Get blog page id
if ( function_exists( 'get_field' ) ) {

	$blog_page		= get_field( 'acf-options_blog_page', 'option' );
	$blog_page_id	= $blog_page ? $blog_page->ID : '';

}

// Get current object id
$object_id = get_queried_object_id();

// Get current post categories or the current category
if ( is_singular( 'post' ) ) {

	$post_categories	= wp_get_post_terms( $object_id, 'category' );
	$current_cat		= $post_categories[0];

}
elseif ( is_category() ) {
	$current_cat = get_category( get_query_var( 'cat' ) );
}

// Get recent posts
$args = array(

	'numberposts'		=> 15,
	'post_status'		=> 'publish',
	'suppress_filters'	=> 0

);
$recent_posts = wp_get_recent_posts( $args );

// Get archives
$args = array(

	'format'	=> 'custom',
	'after'		=> '|',
	'echo'		=> 0

);
$archives = wp_get_archives( $args );

// Build archive list
if ( $archives ) {

	$archives = explode( '|', $archives );
	array_pop( $archives );

	$archives_output = '<ul class="blog-menu">';

	if ( is_month() ) {

		// Set string pattern
		if ( get_option( 'permalink_structure' ) != '' )
			$pattern = '#/(\d\d\d\d)/(\d\d)#';
		else
			$pattern = '/m=(\d\d\d\d)(\d\d)/';

		// Get current archive
		preg_match( $pattern, $_SERVER['REQUEST_URI'], $matches );
		$current_year		= $matches[1];
		$current_month		= $matches[2];
		$current_archive	= '';

		foreach ( $archives as $link ) {

			if ( preg_match( $pattern, $link, $matches ) ) {
				$year	= $matches[1];
				$month	= $matches[2];

				// Check whether it's the current archive category
				if ( $current_year == $year && $current_month == $month ) {
					$current_archive = $link;
				}

				$archives_output .= '<li' . ( ( $current_year == $year && $current_month == $month ) ? ' class="current-menu-item"' : '' ) . '>' . $link . '</li>';


			}

		}

	}
	else {

		foreach ( $archives as $link )
			$archives_output .= '<li>' . $link . '</li>';

	}

	$archives_output .= '</ul>';

}

?>

<div class="side-menu-wrapper col-lg-2 visible-lg">

	<nav>

		<?php
			/**
			 * Current category
			 */
			if ( $current_cat || $current_archive || $blog_page_id  ) {

				echo '<ul>';
					echo '<li class="parent">';

						if ( $current_cat )
							echo '<a href="' . get_term_link( $current_cat ) . '">' . $current_cat->name . '</a>';
						elseif ( $current_archive )
							echo $current_archive;
						elseif ( $blog_page_id )
							echo '<a href="' . get_permalink( $blog_page_id ) . '">' . get_the_title( $blog_page_id ) . '</a>';

					echo '</li>';
				echo '</ul>';

			}
		?>

		<?php
			/**
			 * Recent posts
			 */
			if ( $recent_posts ) {

				echo '<h3>' . __('Recent Posts', 'BH') . '</h3>';

				echo '<ul class="blog-menu">';
					foreach ($recent_posts as $recent) {
						echo '<li' . ( ($object_id == $recent['ID']) ? ' class="current-menu-item"' : '' ) . '><a href="' . get_permalink($recent['ID']) . '">' . $recent['post_title'] . '</a></li>';
					}
				echo '</ul>';

			}
		?>

		<?php
			/**
			 * Archives
			 */
			if ( $archives_output ) {

				echo '<h3>' . __('Archives', 'BH') . '</h3>';
				echo $archives_output;

			}
		?>

	</nav>

	<?php
		/**
		 * Display newsletter widget
		 */
		get_template_part( 'views/sidebar/sidebar', 'newsletter' );
	?>

</div><!-- .side-menu-wrapper -->