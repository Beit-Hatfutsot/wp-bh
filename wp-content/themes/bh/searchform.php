<?php
/**
 * Search form
 *
 * @author		Beit Hatfutsot
 * @package		bh
 * @version		2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
global $globals;

$bh_sites		= $globals[ 'bh_sites' ];
$current_site	= $globals[ 'current_site' ];

if ( ! $bh_sites || $current_site === false )
	return;

$site_type		= $bh_sites[ $current_site ][ 'type' ];
$search_string	= $site_type == 'shop' ? __( 'Search in shop...', 'BH' ) : __( 'Search in site...', 'BH' );

?>

<form method="get" class="search-form" action="<?php echo HOME; ?>">

	<?php echo $site_type == 'shop' ? '<input type="hidden" name="post_type" value="product" />' : ''; ?>
	<input type="text" class="search-field <?php echo ( isset( $_GET['s'] ) && $_GET['s'] ) ? 'active' : ''; ?>" value="<?php echo ( isset( $_GET['s'] ) && $_GET['s'] ) ? $_GET['s'] : $search_string; ?>" name="s" onfocus="if (this.value == '<?php echo $search_string; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $search_string; ?>';}" />
	<div class="search-submit-wrapper">
		<div class="magnifying-glass"></div>
		<input type="submit" class="search-submit" value="" title="<?php echo $search_string; ?>" alt="<?php echo $search_string; ?>" />
	</div>

</form>