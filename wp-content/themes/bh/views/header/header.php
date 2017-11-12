<?php
/**
 * The template for displaying the header
 *
 * @author		Beit Hatfutsot
 * @package		bh/views/header
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
$elements = array();

?>

<?php
	/**
	 * Set header global variables
	 */
	BH_set_header_globals();
?>

<?php
	/**
	 * Set header elements
	 */
	$elements = BH_set_header_elements();
?>

<?php
	/**
	 * Display the header
	 */
	include( locate_template( 'views/header/header-view.php' ) );
?>