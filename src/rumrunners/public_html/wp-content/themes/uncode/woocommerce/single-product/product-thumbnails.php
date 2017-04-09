<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce, $gallery_id;

$attachment_ids = $product->get_gallery_attachment_ids();
$shop_thumbnail = wc_get_image_size( 'shop_thumbnail' );
$crop = false;
if (isset($shop_thumbnail['crop']) && $shop_thumbnail['crop'] === 1) {
	$crop = true;
	$thumb_ratio = $shop_thumbnail['width'] / $shop_thumbnail['height'];
}

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="thumbnails <?php echo 'columns-' . $columns; ?>"><?php

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image_attributes = uncode_get_media_info($attachment_id);
			$image_metavalues = unserialize($image_attributes->metadata);
			if ($image_attributes->post_mime_type === 'image/gif') $crop = false;
			$image_resized = uncode_resize_image($image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], 2, ($crop ? 2 / $thumb_ratio : null), $crop);
			global $adaptive_images, $adaptive_images_async, $adaptive_images_async_blur;
			$media_class = '';
			$media_data = '';
			if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
				$media_class = ' class="adaptive-async'.(($adaptive_images_async_blur === 'on') ? ' async-blurred' : '').'"';
				$media_data = ' data-uniqueid="'.$attachment_id.'-'.big_rand().'" data-guid="'.$image_attributes->guid.'" data-path="'.$image_attributes->path.'" data-width="'.$image_metavalues['width'].'" data-height="'.$image_metavalues['height'].'" data-singlew="2" data-singleh="'.($crop ? 2 / $thumb_ratio : null).'" data-crop="'.$crop.'"';
			}
			$image_link = $image_attributes->guid;
			$image = '<img'.$media_class.' src="'.$image_resized['url'].'" width="'.$image_resized['width'].'" height="'.$image_resized['height'].'" alt=""'.$media_data.' />';

			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-options="thumbnail: \''.$image_resized['url'].'\'" data-lbox="ilightbox_gallery-' . $gallery_id . '">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?></div>
	<?php
}
