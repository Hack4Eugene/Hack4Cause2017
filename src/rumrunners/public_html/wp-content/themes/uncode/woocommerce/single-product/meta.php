<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<hr />
<div class="product_meta">
	<p>
	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper detail-container"><span class="detail-label"><?php esc_html_e( 'SKU', 'woocommerce' ); ?></span> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php
		$product_categories = $product->get_categories( ', ', '<span class="posted_in detail-container">' . _n( '<span class="detail-label">' . esc_html__('Category','woocommerce') . '</span>', '<span class="detail-label">' . esc_html__('Categories','woocommerce') . '</span>', $cat_count, 'woocommerce' ) . ' ', '</span>' );
		echo wp_kses_post($product_categories);
	?>

	<?php
		$product_tags = $product->get_tags( ', ', '<span class="tagged_as detail-container">' . _n( '<span class="detail-label">' . esc_html__('Tag','woocommerce') . '</span>', '<span class="detail-label">' . esc_html__('Tags','woocommerce') . '</span>', $tag_count, 'woocommerce' ) . ' ', '</span>' );
		echo wp_kses_post($product_tags);
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
	</p>
</div>
