<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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

do_action( 'woocommerce_before_account_navigation' );
global $woo_title;
?>
<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) :
			switch ($endpoint) {
				case 'orders':
					$icon = 'shopping-cart';
					break;
				case 'downloads':
					$icon = 'download';
					break;
				case 'edit-address':
					$icon = 'home';
					break;
				case 'edit-account':
					$icon = 'user';
					break;
				case 'customer-logout':
					$icon = 'sign-out';
					break;
				default:
					$icon = $endpoint;
					break;
			} ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?><i class="fa fa-fw pull-right fa-<?php echo $icon; if ($label === $woo_title) echo ' active'; ?>"></i></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>
