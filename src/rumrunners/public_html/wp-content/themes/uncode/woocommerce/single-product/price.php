<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="price-container" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>

	<meta itemprop="price" content="<?php echo esc_attr($product->get_price()); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr(get_woocommerce_currency()); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php if ($product->is_in_stock()) echo 'InStock'; else echo 'OutOfStock'; ?>" />

</div>
