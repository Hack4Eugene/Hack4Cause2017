<?php
$media_before = $media_after = $el_class = '';
extract(shortcode_atts(array(
	'media_before' => '',
	'media_after' => '',
	'el_class' => '',
) , $atts));

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-twentytwenty ' . $el_class, $this->settings['base'], $atts);

if ($media_before === '' || $media_after === '') return;

$media_attributes_before = uncode_get_media_info($media_before);
$media_before_metavalue = unserialize($media_attributes_before->metadata);
if (empty($media_before_metavalue)) {
	$media_before_metavalue['width'] = $media_before_metavalue['height'] = 1;
}
$resized_image_before = uncode_resize_image($media_attributes_before->guid, $media_attributes_before->path, $media_before_metavalue['width'], $media_before_metavalue['height'], 12, null, false);

$media_attributes_after = uncode_get_media_info($media_after);
$media_after_metavalue = unserialize($media_attributes_after->metadata);
if (empty($media_after_metavalue)) {
	$media_after_metavalue['width'] = $media_after_metavalue['height'] = 1;
}
$resized_image_after = uncode_resize_image($media_attributes_after->guid, $media_attributes_after->path, $media_after_metavalue['width'], $media_after_metavalue['height'], 12, null, false);

?>

<div class="<?php echo $css_class; ?>">
	<div class="twentytwenty-container">
		<img src="<?php echo $resized_image_before['url']; ?>" width="<?php echo $resized_image_before['width']; ?>" height="<?php echo $resized_image_before['height']; ?>">
		<img src="<?php echo $resized_image_after['url']; ?>" width="<?php echo $resized_image_after['width']; ?>" height="<?php echo $resized_image_after['height']; ?>">
	</div>
</div>