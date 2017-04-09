<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
	exit;
}

global $post, $woocommerce, $product;

$shop_single = wc_get_image_size( 'shop_single' );
$crop = false;
if (isset($shop_single['crop']) && $shop_single['crop'] === 1) {
	$crop = true;
	$thumb_ratio = $shop_single['width'] / $shop_single['height'];
}

?>
<div class="woocommerce-images images">

	<?php
		if ( has_post_thumbnail() ) {
			$media_id = get_post_thumbnail_id();
			$image_title = esc_attr( get_the_title( $media_id ) );
			$image_attributes = uncode_get_media_info($media_id);
			$image_metavalues = unserialize($image_attributes->metadata);
			if ($image_attributes->post_mime_type === 'image/gif') $crop = false;
			$image_resized = uncode_resize_image($image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], 5, ($crop ? 5 / $thumb_ratio : null), $crop);
			global $adaptive_images, $adaptive_images_async, $adaptive_images_async_blur;
			$media_class = '';
			$media_data = '';
			if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
				$media_class = ' class="adaptive-async'.(($adaptive_images_async_blur === 'on') ? ' async-blurred' : '').'"';
				$media_data = ' data-uniqueid="'.$media_id.'-'.big_rand().'" data-guid="'.$image_attributes->guid.'" data-path="'.$image_attributes->path.'" data-width="'.$image_metavalues['width'].'" data-height="'.$image_metavalues['height'].'" data-singlew="5" data-singleh="'.($crop ? 5 / $thumb_ratio : null).'" data-crop="'.$crop.'"';
			}
			$image_link = $image_attributes->guid;
			$image = '<img'.$media_class.' src="'.$image_resized['url'].'" width="'.$image_resized['width'].'" height="'.$image_resized['height'].'" alt=""'.$media_data.' />';

			global $gallery_id;
			$gallery_id = big_rand();

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-options="thumbnail: \''.$image_resized['url'].'\'" data-lbox="ilightbox_gallery-' . $gallery_id . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
