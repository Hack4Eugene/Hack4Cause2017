<?php

add_theme_support( 'woocommerce' );

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

//Remove prettyPhoto lightbox
add_action( 'wp_enqueue_scripts', 'uncode_remove_woo_scripts', 99 );
function uncode_remove_woo_scripts() {
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    wp_dequeue_style( 'select2');
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
    wp_dequeue_script( 'wc-chosen');
}

function uncode_no_product_description_heading() {
    return '';
}

function uncode_price_html( $price, $product ){
	$price = str_replace( '<span class="amount">', '', $price );
	$price = str_replace( '</span>', '', $price );
	$price = '<ins class="h2">'.$price.'</ins>';
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'uncode_price_html', 10, 2 );

function uncode_price_html_from_to($price, $from, $to, $instance) {
	$price = '<ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins> <del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del>';
	return $price;
}

add_filter( 'woocommerce_get_price_html_from_to', 'uncode_price_html_from_to', 10, 4 );

function uncode_woocommerce_order_button_html( $button ) {
	$button = str_replace('button', 'btn btn-default', $button);
	return $button;
}

add_filter( 'woocommerce_order_button_html', 'uncode_woocommerce_order_button_html', 10, 1 );

function uncode_woocommerce_thankyou_order_received_text( $text ) {
	return '<span class="thank-you">' . $text . '</span>';
}

add_filter( 'woocommerce_thankyou_order_received_text', 'uncode_woocommerce_thankyou_order_received_text', 10, 1 );


// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function uncode_add_uncode_cart() {

	$production_mode = ot_get_option('_uncode_production');
	$resources_version = ($production_mode === 'on') ? null : rand();

	wp_enqueue_style( 'uncode-woocommerce', get_template_directory_uri() . '/library/css/woocommerce.css', array() , $resources_version, 'all');
	if ($production_mode === 'on') wp_register_script( 'uncode-menucart', get_template_directory_uri() . '/library/js/min/woocommerce-uncode.min.js', array() , $resources_version, 'all');
	else wp_register_script( 'uncode-menucart', get_template_directory_uri() . '/library/js/woocommerce-uncode.js', array() , $resources_version, 'all');

	wp_enqueue_script( 'uncode-menucart' );

}

add_action('wp_enqueue_scripts', 'uncode_add_uncode_cart');

function uncode_get_cart_items() {
	global $woocommerce;

	$articles = sizeof( $woocommerce->cart->get_cart() );


	$cart = $tot_articles = '';

	if (  $articles > 0 ) {
		$tot_articles = $woocommerce->cart->cart_contents_count;
		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

				$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
				$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price = apply_filters( 'woocommerce_cart_item_price', $woocommerce->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

				$cart .= '<li class="cart-item-list clearfix">';
				if ( ! $_product->is_visible() ) {
					$cart .= str_replace( array( 'http:', 'https:' ), '', $thumbnail );
				} else {
					$cart .= '<a class="cart-thumb" href="'.esc_url(get_permalink( $product_id )).'">
								'.str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '
							</a>';
				}

				$cart .= '<div class="cart-desc"><span class="cart-item">' . $product_name . '</span>';

				$cart .= '<span class="product-quantity">'. apply_filters( 'woocommerce_widget_cart_item_quantity',  '<span class="quantity-container">' . sprintf( '%s &times; %s',$cart_item['quantity'] , '</span>' . $product_price ) , $cart_item, $cart_item_key ) . '</span>';
				$cart .= '</div>';
				$cart .= '</li>';
			}
		}

		$cart .= '<li class="subtotal"><span><strong>' . esc_html__('Subtotal:', 'woocommerce') . '</strong> ' . $woocommerce->cart->get_cart_total() . '</span></li>';

		$cart .= '<li class="buttons clearfix">
								<a href="'.$woocommerce->cart->get_cart_url().'" class="wc-forward btn btn-link"><i class="fa fa-bag"></i>'.esc_html__( 'View Cart', 'woocommerce' ).'</a>
								<a href="'.$woocommerce->cart->get_checkout_url().'" class="checkout wc-forward btn btn-link"><i class="fa fa-square-check"></i>'.esc_html__( 'Checkout', 'woocommerce' ).'</a>
							</li>';

	} else {
		$cart .= '<li><span>' . esc_html__('Your cart is currently empty','uncode') . '</span></li>';
	}

	return array('cart' => $cart, 'articles' => $tot_articles);
}

function uncode_woomenucart_ajax() {

	$cart = uncode_get_cart_items();

	echo json_encode($cart);

	die();
}

add_action( 'wp_ajax_woomenucart_ajax', 'uncode_woomenucart_ajax');
add_action( 'wp_ajax_nopriv_woomenucart_ajax', 'uncode_woomenucart_ajax' );


function uncode_add_cart_in_menu($woo_icon, $woo_cart_class) {
	global $woocommerce, $menutype;

	$horizontal_menu = (strpos($menutype ,'hmenu') !== false) ? true : false;
	$tot_articles = $woocommerce->cart->cart_contents_count;
	$get_cart_items = uncode_get_cart_items();

	$vertical = (strpos($menutype, 'vmenu') !== false || $menutype === 'menu-overlay' || $menutype === 'menu-overlay-center') ? true : false;

	$cart_container = '<ul role="menu" class="drop-menu sm-nowrap cart_list product_list_widget uncode-cart-dropdown">'.((isset($get_cart_items['cart']) && $get_cart_items['cart'] !=='') ? $get_cart_items['cart'] : '<li><span>' . esc_html__('Your cart is currently empty','uncode') . '</span></li>').'</ul>';
	$items =						'<li class="'.$woo_cart_class.'uncode-cart menu-item-link menu-item menu-item-has-children dropdown">
												<a href="#" data-toggle="dropdown" class="dropdown-toggle" data-type="title" title="cart">
													<span class="cart-icon-container">';
	$items .= $horizontal_menu ?
									'<i class="'.$woo_icon.'"></i><span class="desktop-hidden">'.esc_html__('Cart','uncode').'</span>'
									:
									'<i class="'.$woo_icon.'"></i><span>'. esc_html__('Cart','uncode') . '</span>';
	$items .= 			(( $tot_articles !== 0 ) ? '<span class="badge">'.$tot_articles.'</span>' : '<span class="badge" style="display: none;"></span>').'<i class="fa fa-angle-down fa-dropdown'.(!$vertical ? ' desktop-hidden' : '').'"></i>
								</span>
							</a>
							'.$cart_container.
							// (( $tot_articles == 0 ) ? '<script type="text/javascript">cart_hidden();</script>' : '').
							'</li>';

    return $items;
}

/**
* uncode_is_woocommerce_page - Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and which are also included)
*
* @access public
* @return bool
*/
function uncode_is_woocommerce_page () {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}

add_action( 'widgets_init', 'uncode_override_woocommerce_widgets', 15 );

function uncode_override_woocommerce_widgets() {
	// Ensure our parent class exists to avoid fatal error (thanks Wilgert!)
	if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
		unregister_widget( 'WC_Widget_Price_Filter' );
		include_once( get_template_directory() . '/woocommerce/widgets/widget-price_filter.php' );
		register_widget( 'Uncode_WC_Widget_Price_Filter' );
	}
}

function uncode_alter_woocommerce_comment_form_fields($fields){
    $fields['class_submit'] = 'submit btn btn-default';
    return $fields;
}

add_filter('woocommerce_product_review_comment_form_args','uncode_alter_woocommerce_comment_form_fields');

function woocommerce_button_proceed_to_checkout() {
	$checkout_url = WC()->cart->get_checkout_url();

	?>
	<a href="<?php echo esc_url($checkout_url); ?>" class="checkout-button btn btn-default alt wc-forward"><?php esc_html_e( 'Proceed to Checkout', 'woocommerce' ); ?></a>
	<?php
}

function uncode_output_related_products_args( $args ) {
	$args['columns'] = 4;
	$args['posts_per_page'] = 12;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'uncode_output_related_products_args');


function uncode_wc_loop_add_to_cart_scripts() {
    if ( is_shop() || is_product_category() || is_product_tag() || is_product() ) : ?>

		<script>
			window.addEventListener("load", function(){
				jQuery( document ).on( 'change', '.quantity .qty', function() {
					jQuery( this ).parent().parent().find('.add_to_cart_button').attr( 'data-quantity', jQuery( this ).val() );
				});
			}, false);
		</script>

    <?php endif;
}

add_action( 'wp_footer', 'uncode_wc_loop_add_to_cart_scripts' );

add_filter( 'woocommerce_available_variation', 'uncode_woocommerce_available_variation' );

function uncode_woocommerce_available_variation( $variations ) {
	global $wpdb;

	$shop_single = wc_get_image_size( 'shop_single' );
	$crop = false;
	if (isset($shop_single['crop']) && $shop_single['crop'] === 1) {
		$crop = true;
		$thumb_ratio = $shop_single['width'] / $shop_single['height'];
	}

	if (isset($variations['image_link'])) {
		$the_media = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE guid = %s", $variations['image_link'] ) );
		if (isset($the_media->ID)) {
			$image_attributes = uncode_get_media_info($the_media->ID);
			$image_metavalues = unserialize($image_attributes->metadata);
			if ($image_attributes->post_mime_type === 'image/gif') $crop = false;
			$image_resized = uncode_resize_image($image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], 5, ($crop ? 5 / $thumb_ratio : null), $crop);
			$variations['image_src'] = $image_resized['url'];
		}
	}
	$variations['image_srcset'] = $variations['image_sizes'] = '';
	return $variations;
}


?>
