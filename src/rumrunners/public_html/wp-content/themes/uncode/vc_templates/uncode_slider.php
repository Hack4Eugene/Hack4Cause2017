<?php
$style = $is_header = $slider_type = $slider_interval = $slider_navspeed = $slider_loop = $el_class = $limit_content = $top_padding = $bottom_padding = $h_padding = $slider_height = $output = '';
extract(shortcode_atts(array(
	'style' => '',
	'is_header' => '',
	'slider_type' => '',
	'slider_interval' => 0,
	'slider_navspeed' => 400,
	'slider_loop' => '',
	'el_class' => '',
	'limit_content' => '',
	'top_padding' => '',
	'bottom_padding' => '',
	'h_padding' => '',
	'slider_height' => '',
) , $atts));

/** send variable to inner columns **/
if ($limit_content === 'yes') {
	$content = str_replace('[vc_row_inner','[vc_row_inner limit_content="yes" override_padding="yes" top_padding="'.$top_padding.'" bottom_padding="'.$bottom_padding.'" ', $content);
} else {
  $content = str_replace('[vc_row_inner','[vc_row_inner override_padding="yes" top_padding="'.$top_padding.'" bottom_padding="'.$bottom_padding.'" h_padding="'.$h_padding.'" ', $content);
}

if ($slider_type === 'fade') $slider_type = ' data-fade="true"';

if ((int)$slider_interval === 0 || $slider_interval === '') {
	$slider_autoplay = 'false';
	$slider_timeout = '';
} else {
	$slider_autoplay = 'true';
	$slider_timeout = ' data-timeout="'.$slider_interval.'"';
}

$el_id = 'uslider_' . rand();

$el_class = $this->getExtraClass($el_class);
if ($el_class !== '') $el_class = $el_class . ' ';
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class . 'uncode-slider ' , $this->settings['base'], $atts );

$style = $is_header !== 'yes' ? ' style-'.$style : '';

$output .= '<div class="owl-carousel-wrapper'.$style.'">';
$output .= '<div class="'.esc_attr($css_class).'owl-carousel-container">';
$output .= '<div id="'.esc_attr($el_id).'" class="owl-carousel owl-element owl-dots-inside owl-height-'.esc_attr($slider_height).'"'.$slider_type.' data-loop="'.($slider_loop === 'yes' ? "true" : "false").'" data-autoheight="'.($slider_height === 'auto' ? 'true' : 'false').'"'.($is_header === 'yes' ? ' data-nav="true"' : ' data-dotsmobile="true"').' data-dots="true" data-navspeed="'.$slider_navspeed.'" data-autoplay="'.$slider_autoplay.'"'.$slider_timeout.' data-lg="1" data-md="1" data-sm="1">';
$output .= $content;
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo uncode_remove_wpautop($output);