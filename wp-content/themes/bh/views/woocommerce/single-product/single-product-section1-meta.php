<?php
/**
 * Single Product meta
 *
 * @author 		Beit Hatfutsot
 * @package 	bh/views/woocommerce/single-product
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$weight		= ( $product->has_weight() ) ? $product->get_weight() : '';
$dimensions	= ( $product->has_dimensions() ) ? $product->get_dimensions() : '';

if ( ! $weight && ! $dimensions )
	return;

?>

<div class="single-product-meta-technical product-meta-section">

	<?php // title ?>
	<div class="product-meta-section-title"><?php _e('Technical Details', 'BH'); ?></div>

	<?php // weight ?>
	<?php if ($weight) { ?>

		<div class="tech-details weight clearfix">
			<div class="name"><?php _e('Weight', 'BH'); ?></div>
			<div class="value"><?php echo $weight . esc_attr( get_option('woocommerce_weight_unit') ); ?></div>
		</div>

		<?php
			echo $product->get_weight()	? '<meta itemprop="weight"	value="' . $product->get_weight() . '"	unitCode="GRM" />'	: '';
		?>

	<?php } ?>

	<?php // dimensions ?>
	<?php if ($dimensions) { ?>

		<div class="tech-details dimensions clearfix">
			<div class="name"><?php _e('Dimensions', 'BH'); ?> <span>(<?php echo _e('Length x Width x Height', 'BH'); ?>)</span></div>
			<div class="value"><?php echo $dimensions; ?></div>
		</div>

		<?php
			echo $product->get_length()	? '<meta itemprop="depth"	value="' . $product->get_length() . '" unitCode="CMT" />'	: '';
			echo $product->get_width()	? '<meta itemprop="width"	value="' . $product->get_width()  . '" unitCode="CMT" />'	: '';
			echo $product->get_height()	? '<meta itemprop="height"	value="' . $product->get_height() . '" unitCode="CMT" />'	: '';
		?>

	<?php } ?>

	<?php
		echo '<meta itemprop="sku"		content="' . $product->get_sku() . '" />';
		echo '<meta itemprop="mpn"		content="' . $product->get_sku() . '" />';
		echo '<meta itemprop="gtin12"	content="' . gtin_12($product->get_sku()) . '" />';
	?>

</div>