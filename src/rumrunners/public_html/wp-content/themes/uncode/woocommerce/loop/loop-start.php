<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $woocommerce_loop;

?>
<div class="owl-carousel-wrapper">
	<div class="owl-carousel-container owl-carousel-loading half-gutter">
		<div id="index-<?php echo big_rand(); ?>" class="owl-carousel owl-element owl-theme owl-dots-outside owl-height-auto" data-loop="false" data-dots="true" data-nav="false" data-navspeed="400" data-autoplay="false" data-lg="<?php echo esc_attr($woocommerce_loop['columns']); ?>" data-md="2" data-sm="1">