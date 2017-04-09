<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

?>
<div class="column_parent col-lg-12 no-h-padding no-top-padding no-bottom-padding">
	<div class="uncol">
		<div class="uncoltable">
			<div class="uncell">
				<div class="uncont">
				<?php
				global $woo_title;
					add_filter( 'the_title', 'wc_page_endpoint_title' );
					$woo_title = get_the_title( ); ?>
					<div class="row-internal row-container">
						<div class="row row-child col-double-gutter">
							<div class="row-inner">
								<div class="column_child col-lg-4">
								<?php
									/**
									 * My Account navigation.
									 * @since 2.6.0
									 */
									do_action( 'woocommerce_account_navigation' ); ?>

								</div>
								<div class="column_child col-lg-12">
									<div class="uncol">
										<div class="uncoltable">
											<div class="uncont">
												<?php
													/**
													 * My Account content.
													 * @since 2.6.0
													 */
													do_action( 'woocommerce_account_content' );
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>