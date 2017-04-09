<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) :

	$index = 0;
	global $limit_content_width;
	?>

	<div class="tab-container wootabs">
		<ul class="nav nav-tabs<?php echo $limit_content_width; ?> single-h-padding">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php if ($index === 0) echo 'active'; ?>">
					<a href="#tab-<?php echo esc_attr($key); ?>" data-toggle="tab"><span><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html($tab['title']), $key ) ?></span></a>
				</li>

			<?php $index++;
			endforeach; ?>
		</ul>
		<div class="tab-content">
		<?php
			$index = 0;
			foreach ( $tabs as $key => $tab ) :

				ob_start();
				call_user_func( $tab['callback'], $key, $tab );
				$tab_content = ob_get_clean();

				if (substr_count($tab_content, 'row-container')) { ?>
				<div class="tab-vcomposer tab-pane fade<?php if ($index === 0) echo ' active in'; ?>" id="tab-<?php echo esc_attr( $key ) ?>">
					<?php add_filter('woocommerce_product_description_heading','uncode_no_product_description_heading'); call_user_func( $tab['callback'], $key, $tab ); ?>
				</div>
				<?php } else { ?>
				<div class="tab-pane fade<?php echo $limit_content_width; ?> single-h-padding<?php if ($index === 0) echo ' active in'; ?>" id="tab-<?php echo esc_attr( $key ) ?>">
					<?php echo uncode_remove_wpautop( $tab_content ); ?>
				</div>
			<?php } ?>

		<?php $index++;
		endforeach; ?>
		</div>
	</div>

<?php endif; ?>