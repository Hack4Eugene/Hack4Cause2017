<?php

$title = $heading_semantic = $text_font = $text_size = $text_weight = $text_height = $text_space = $text_lead = $icon = $icon_image = $position = $icon_color = $background_style = $size = $outline = $display = $shadow = $add_margin = $text_reduced = $el_class = $link = $link_text = $media_lightbox = $css_animation = $animation_delay = $animation_speed = $background_color = $a_title = $a_target = $lightbox_data = '';

$defaults = array(
	'title' => '',
	'heading_semantic' => 'h3',
	'text_font' => '',
	'text_size' => 'h3',
	'text_weight' => '',
	'text_height' => '',
	'text_space' => '',
	'icon' => 'fa fa-adjust',
	'icon_image' => '',
	'position' => 'top',
	'icon_color' => 'default',
	'background_style' => '',
	'size' => 'fa-1x',
	'outline' => '',
	'display' => '',
	'shadow' => '',
	'add_margin' => '',
	'text_lead' => '',
	'text_reduced' => '',
	'el_class' => '',
	'link' => '',
	'link_text' => '',
	'media_lightbox' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
);
/** @var array $atts - shortcode attributes */
$atts = vc_shortcode_attribute_parse( $defaults, $atts );
extract( $atts );

// Prepare icon classes
$container_class = array();
$icon_container_class = array();
$title_class = array();
$wrapper_class = array();
$classes = array();
$div_data = array();

if ($icon_color === '') $icon_color = 'default';
if ($position === '') $position = 'top';

$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

if ($css_animation !== '') {
	$container_class[] = 'animate_when_almost_visible ' . $css_animation;
	if ($animation_delay !== '') $div_data['data-delay'] = $animation_delay;
	if ($animation_speed !== '') $div_data['data-speed'] = $animation_speed;
}

$container_class[] = 'icon-box';
$container_class[] = 'icon-box-' . $position;
$icon_container_class[] = 'icon-box-icon fa-container';
$icon_container_class[] = $css_class;

if ($display === 'inline') {
	$container_class[] = 'icon-inline';
}

$classes[] = $icon;

if ( strlen( $background_style ) > 0 ) {
	$has_style = true;
	$wrapper_class[] = 'fa fa-stack';
	$wrapper_class[] = $background_style;
	$wrapper_class[] = 'btn-' . $icon_color;
	$wrapper_class[] = $size;
	if ($outline === 'yes') $wrapper_class[] = 'btn-outline';
	if ($shadow === 'yes') $wrapper_class[] = 'btn-shadow';
} else {
	$wrapper_class[] = 'text-' . $icon_color . '-color';
	$classes[] = $size;
	$classes[] = 'fa-fw';
}

$title_class[] = $text_font;
$title_class[] = $text_size;
if ($text_weight !== '') $title_class[] = 'font-weight-' . $text_weight;
if ($text_height !== '') $title_class[] = $text_height;
if ($text_space !== '') $title_class[] = $text_space;


$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
if ($link['title'] !== '') $a_title = ' title="' . $link['title'] . '"';
if ($link['target'] !== '') $a_target = ' target="' . trim($link['target']) . '"';

if ($media_lightbox !== '') {
	$media_attributes = uncode_get_media_info($media_lightbox);
	if (!isset($media_attributes)) $media_attributes = new stdClass();
	$media_metavalues = unserialize($media_attributes->metadata);
	$media_mime = $media_attributes->post_mime_type;
	$media_dimensions = '';
	$video_src = '';
	if (strpos($media_mime, 'image/') !== false && $media_mime !== 'image/url' && isset($media_metavalues['width']) && isset($media_metavalues['height'])) {
		$image_orig_w = $media_metavalues['width'];
		$image_orig_h = $media_metavalues['height'];
		$big_image = uncode_resize_image($media_attributes->guid, $media_attributes->path, $image_orig_w, $image_orig_h, 12, null, false);
		$a_href = $big_image['url'];
	} else {
		if ($media_mime === 'image/url') {
			$a_href = $media_attributes->guid;
		} else {
			$media_oembed = uncode_get_oembed($media_lightbox, $media_attributes->guid, $media_attributes->post_mime_type, false, $media_attributes->post_excerpt, $media_attributes->post_content, true);
			$a_href = $media_oembed['code'];
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
	$lightbox_data = ' data-lbox="ilightbox_single-'.big_rand().'"';
	$lightbox_data .= ' data-options="'.$media_dimensions.$video_src.'"';
}

if ($a_href === '') $wrapper_class[] = 'btn-disable-hover';

// Prepare text area
$output_text = '';
if ($title !== '') $output_text .= '<div class="icon-box-heading icon-box-'.$size.((strlen( $background_style ) > 0) ? '-back' : '').'"><'.$heading_semantic.' class="' . esc_attr(trim(implode(' ', $title_class))) . '">' . $title . '</'.$heading_semantic.'></div>';

if (trim($content) !== '') {
	$content = trim(nl2br($content));
	if ($add_margin === 'yes') $add_margin = ' add-margin';
	else $add_margin = '';

	$text_classes = ($text_reduced === 'yes') ? 'text-top-reduced ' : '';
	$text_classes .= ($text_lead === 'yes') ? 'text-lead ' : '';

	if (strpos($content,'<p') !== false)	{
		if ($text_classes !== '') $content = preg_replace('/<p/', '<p class="'.trim($text_classes).'"', $content, 1);
		$output_text .= $content;
	}
	else $output_text .= '<p class="'.trim($text_classes).'">' . $content . '</p>' ;
}

if ($link_text !== '' && $a_href !== '') $output_text .= '<p class="text-bold"><a class="btn btn-link" href="'. esc_url($a_href).'"'.$a_title.$a_target.'>' . $link_text . '</a></p>' ;

if ($output_text !== '') $output_text = '<div class="icon-box-content'.$add_margin.'">' . $output_text . '</div>';

// Prepare icon area
$tag_start = ($a_href !== '') ? 'a href="'. esc_url($a_href) .'"'.$a_title.$a_target.$lightbox_data : 'span';
$tag_end = ($a_href !== '') ? 'a' : 'span';
$output_icon = '';
$output_icon =	'<div class="'.esc_attr(trim(implode(' ', $icon_container_class))).'"'.(($content === '' && $title === '') ? ' style="margin-bottom: 0px;"' : '').'>';
if ($a_href !== '') $wrapper_class[] = 'custom-link';
$output_icon .=	'<'.$tag_start.' class="' . esc_attr(implode(' ', $wrapper_class)) . '">';
if ($icon_image === '') $output_icon .=	'<i class="' . esc_attr(trim(implode(' ', $classes))) . '"></i>';
else {
	$block_data = array();
	$lightbox_classes = array();
	$block_data['media_id'] = $icon_image;
	$block_data['single_width'] = 12;
	if (isset($div_data['data-delay']) && $div_data['data-delay'] !== '') $block_data['delay'] = $animation_delay;
	$media_code = uncode_create_single_block($block_data, rand(), 'masonry', '', $lightbox_classes, false, false);
	if ($media_code['type'] === 'image') $output_icon .= '<img'. (($position === 'right' || $position === 'left') ? ' style="max-width:none;"' : '').' src="' . $media_code['code'] .'" width="' . $media_code['width'] .'" height="' . $media_code['height'] .'" alt="" />';
	else {
		$output_icon .= $media_code['code'];
		if ($position === 'right' || $position === 'left') {
			if (strpos($media_code['code'], 'style="width:100%"') !== false) {
				$container_class[] = 'icon-expand';
			}
		}
	}
}
$output_icon .=	'</'.$tag_end.'>';
$output_icon .='</div>';

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

$output ='<div class="'.esc_attr(trim(implode(' ', $container_class))).'" '.implode(' ', $div_data_attributes).'>';
switch ($position) {
	case 'bottom':
	case 'right':
		$output .= $output_text . $output_icon;
		break;
	default:
		$output .= $output_icon . $output_text;
		break;
}
$output .='</div>';

echo $output;

