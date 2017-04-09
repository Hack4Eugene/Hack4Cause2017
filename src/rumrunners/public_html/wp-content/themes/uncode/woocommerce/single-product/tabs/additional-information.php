<?php
/**
 * Additional Information tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', esc_html__( 'Additional Information', 'woocommerce' ) );

?>

<div class="product-tab">
<?php if ( $heading ): ?>
	<h5 class="product-tab-title"><?php echo esc_html($heading); ?></h5>
<?php endif; ?>

<?php $product->list_attributes(); ?>
</div>
