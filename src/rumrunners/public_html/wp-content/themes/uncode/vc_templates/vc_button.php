<?php
$url = $link = $target = $button_color = $size = $width = $text_skin = $outline = $wide = $icon = $icon_position = $icon_animation = $border_animation = $radius = $shadow = $italic = $display = $top_margin = $onclick = $rel = $media_lightbox = $lbox_skin = $lbox_dir = $lbox_title = $lbox_caption = $lbox_social = $lbox_deep = $lbox_no_tmb = $lbox_no_arrows = $lbox_connected = $css_animation = $animation_delay = $animation_speed = $el_class = $lightbox_data = '';
extract(shortcode_atts(array(
	'url' => '',
	'link' => '',
	'target' => 'self',
	'button_color' => 'default',
	'size' => '',
	'width' => '',
	'text_skin' => '',
	'outline' => '',
	'wide' => 'no',
	'icon' => '',
	'icon_position' => 'left',
	'icon_animation' => '',
	'border_animation' => '',
	'radius' => '',
	'shadow' => '',
	'italic' => '',
	'display' => '',
	'top_margin' => '',
	'onclick' => '',
	'rel' => '',
	'media_lightbox' => '',
	'lbox_skin' => '',
	'lbox_dir' => '',
	'lbox_title' => '',
	'lbox_caption' => '',
	'lbox_social' => '',
	'lbox_deep' => '',
	'lbox_no_tmb' => '',
	'lbox_no_arrows' => '',
	'lbox_connected' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'el_class' => ''
) , $atts));

global $lightbox_id, $adaptive_images;

//parse link
$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
$a_title = $link['title'];
$a_target = $link['target'];

if ($media_lightbox !== '') {
	$lightbox_classes = array();
	$media_attributes = uncode_get_media_info($media_lightbox);
	if (isset($media_attributes)) {
		$media_metavalues = unserialize($media_attributes->metadata);
		$media_mime = $media_attributes->post_mime_type;
		$media_dimensions = '';
		$video_src = '';
		if (strpos($media_mime, 'image/') !== false && $media_mime !== 'image/url' && isset($media_metavalues['width']) && isset($media_metavalues['height'])) {
			$image_orig_w = $media_metavalues['width'];
			$image_orig_h = $media_metavalues['height'];
			if ($adaptive_images === 'on') {
				$adaptive_images = 'off';
				$big_image = uncode_resize_image($media_attributes->guid, $media_attributes->path, $image_orig_w, $image_orig_h, 12, null, false);
				$adaptive_images = 'on';
			} else {
				$big_image = uncode_resize_image($media_attributes->guid, $media_attributes->path, $image_orig_w, $image_orig_h, 12, null, false);
			}

			$a_href = $big_image['url'];
		} else if ($media_mime === 'oembed/iframe') {
			$lightbox_classes['data-type'] = 'inline';
			$a_href = '#inline-' . $media_lightbox;
			echo '<div id="inline-'.$media_lightbox.'" class="ilightbox-html" style="display: none;">' . $media_attributes->post_content . '</div>';
		} else {
			if ($media_mime === 'image/url') {
				$a_href = $media_attributes->guid;
			} else {
				$media_oembed = uncode_get_oembed($media_lightbox, $media_attributes->guid, $media_attributes->post_mime_type, false, $media_attributes->post_excerpt, $media_attributes->post_content, true);
				if ($media_mime === 'oembed/html' || $media_mime === 'oembed/iframe') {
					$frame_id = 'frame-' . big_rand();
					$a_href = '#' . $frame_id;
					echo '<div id="'.$frame_id.'" style="display: none;">' . $media_attributes->post_content . '</div>';
				} else $a_href = $media_oembed['code'];
			}
		}
		if (isset($media_metavalues['width']) && isset($media_metavalues['height'])) {
			$media_dimensions = 'width:' . $media_metavalues['width'] . ',';
			$media_dimensions .= 'height:' . $media_metavalues['height'] . ',';
		}

		if (isset($media_attributes->post_mime_type) && strpos($media_attributes->post_mime_type, 'video/') !== false) {
			$video_src .= 'html5video:{preload:\'true\',';
			$alt_videos = get_post_meta($media_lightbox, "_uncode_video_alternative", true);
			if (!empty($alt_videos)) {
				foreach ($alt_videos as $key => $value) {
					$exloded_url = explode(".", strtolower($value));
					$ext = end($exloded_url);
					if ($ext !== '') $video_src .= $ext . ":'" . $value."',";
				}
			}
			$video_src .= '},';
		}

		if ($lbox_skin !== '') $lightbox_classes['data-skin'] = $lbox_skin;
		if ($lbox_title !== '' && isset($media_attributes->post_title) && $media_attributes->post_title !== '') $lightbox_classes['data-title'] = $media_attributes->post_title;
		if ($lbox_caption !== '' && isset($media_attributes->post_excerpt) && $media_attributes->post_excerpt !== '') $lightbox_classes['data-caption'] = $media_attributes->post_excerpt;
		if ($lbox_dir !== '') $lightbox_classes['data-dir'] = $lbox_dir;
		if ($lbox_social !== '') $lightbox_classes['data-social'] = true;
		if ($lbox_deep !== '') $lightbox_classes['data-deep'] = $media_lightbox;
		if ($lbox_no_tmb !== '') $lightbox_classes['data-notmb'] = true;
		if ($lbox_no_arrows !== '') $lightbox_classes['data-noarr'] = true;
		if (count($lightbox_classes) === 0) $lightbox_classes['data-active'] = true;
		if ($lbox_connected === 'yes') {
			if (!isset($lightbox_id) || $lightbox_id === '') $lightbox_id = big_rand();
			$lbox_id = $lightbox_id;
		} else $lbox_id = $media_lightbox;

		$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $lightbox_classes, array_keys($lightbox_classes));

		$lightbox_data = ' ' . implode(' ', $div_data_attributes);
		$lightbox_data .= ' data-lbox="ilightbox_single-' . $lbox_id . '"';
		$lightbox_data .= ' data-options="'.$media_dimensions.$video_src.'"';
	}
} else $lightbox_data = '';

// Prepare button classes
$wrapper_class = array('btn-container');
$classes = array('btn');
$div_data = array();

// Size class
if ($size) {
	if ($size === 'link') unset($classes[0]);
	else $classes[] = $size;
}

// Additional classes
if ($el_class) $classes[] = $el_class;

// Color class
if ($button_color === '') $button_color = 'default';
if ($button_color !== 'default') {
	if ($text_skin === 'yes') $classes[] = 'btn-text-skin';
}
if ($size !== 'btn-link' && $size !== 'link') $classes[] = 'btn-' . $button_color;
else $classes[] = 'text-' . $button_color . '-color';

// Radius class
if ($radius) $classes[] = $radius;

// Outlined class
if ($outline === 'yes') $classes[] = 'btn-outline';

// Shadow class
if ($shadow === 'yes') $classes[] = 'btn-shadow';

// Italic class
if ($italic === 'yes') $classes[] = 'btn-italic';

// Wide class
if ($wide === 'yes') {
	$wrapper_class[] = 'btn-block';
	$classes[] = 'btn-block';
}

if ($display === 'inline') {
	// Add margin class
	if ($top_margin === 'yes') $classes[] = 'btn-top-margin';
	$wrapper_class[] = 'btn-inline';
}


// Prepare icon
if ($icon !== '') {
	$icon = '<i class="' . esc_attr($icon) . '"></i>';
	if ($icon_animation === 'yes') $classes[] = 'btn-icon-fx';
}
else $icon = '';

$content = trim($content);

if ($icon_position === 'right')
{
	$content = $content . $icon;
	$classes[] = 'btn-icon-right';
} else {
	$content = $icon . $content;
	$classes[] = 'btn-icon-left';
}

if ($border_animation !== '') {
	$classes[] = $border_animation;
	$classes[] = 'btn-border-animated';
}
$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . implode($classes, ' ') . $el_class, $this->settings['base'], $atts );

// Prepare onclick action
$onclick = ($onclick !== '') ? ' onClick="' . $onclick . '"' : '';

// Prepare rel attribute
$rel = ($rel) ? ' rel="' . esc_attr($rel) . '"' : '';

if ($css_animation !== '') {
	$wrapper_class[] = 'animate_when_almost_visible ' . $css_animation;
	if ($animation_delay !== '') $div_data['data-delay'] = $animation_delay;
	if ($animation_speed !== '') $div_data['data-speed'] = $animation_speed;
}

if ($width !== '') $width = ' style="min-width:' . $width . 'px"';

$title = ($a_title !== '') ? ' title="' . $a_title . '"' : '';
$target = (trim($a_target) !== '') ? ' target="' . trim($a_target) . '"' : '';

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

echo '<span class="' . esc_attr(trim(implode($wrapper_class, ' '))) . '" '.implode(' ', $div_data_attributes).'><a href="' . esc_url($a_href) . '" class="custom-link ' . esc_attr(trim(implode($classes, ' '))) . '"' . $title . $target . $onclick . $rel . $lightbox_data . $width . '>' . do_shortcode($content) . '</a></span>';
