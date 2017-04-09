<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php

	global $limit_content_width, $style, $show_body_title;

	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	ob_start();
		get_the_password_form();
		$the_content = ob_get_clean();
	 	echo uncode_get_row_template($the_content, $limit_width, $limit_content_width, $style, '', true, true);
	 	return;
	 }

?>


<div class="row-container product">
	<div class="row row-parent col-std-gutter double-top-padding double-bottom-padding <?php echo esc_attr($limit_content_width); ?>">
		<div class="row-inner">
			<div class="col-lg-6">
				<div class="uncol">
					<div class="uncoltable">
						<div class="uncell">
							<div class="uncont">
								<?php
								do_action( 'woocommerce_before_single_product_summary' );
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="uncol">
					<div class="uncoltable">
						<div class="uncell">
							<div class="uncont">
								<?php
								if ($show_body_title === false) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
								do_action( 'woocommerce_single_product_summary' );
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	global $limit_content_width;
	ob_start();
	woocommerce_output_product_data_tabs();
	woocommerce_upsell_display();
	$the_content = ob_get_clean();
	echo uncode_get_row_template($the_content, '', '', '', ' product', false, false, false);

	ob_start();
	woocommerce_output_related_products();
	$the_content = ob_get_clean();
	echo uncode_get_row_template($the_content, '', $limit_content_width, '', ' row-related', false, true, false);

?>
