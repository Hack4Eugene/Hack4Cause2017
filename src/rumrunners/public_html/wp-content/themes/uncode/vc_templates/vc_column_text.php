<?php

$output = $el_class = $css = $border_color = $border_style = $text_lead = $el_style = $css_animation = $animation_delay = $animation_speed = '';

extract(shortcode_atts(array(
	'el_class' => '',
	'text_lead' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'css' => '',
	'border_color' => '',
  'border_style' => '',
) , $atts));

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode_text_column' . $el_class . vc_shortcode_custom_css_class($css, ' ') , $this->settings['base'], $atts);
if ($border_color !== '') {
    $css_class .= ' border-' . $border_color . '-color';
    if ($border_style !== '') $el_style = ' style="border-style: '.$border_style.';"';
}

if ($text_lead === 'yes') $css_class .= ' text-lead';

$div_data = array();
if ($css_animation !== '') {
	$css_class .= ' ' . $css_animation . ' animate_when_almost_visible';
	if ($animation_delay !== '') $div_data['data-delay'] = $animation_delay;
	if ($animation_speed !== '') $div_data['data-speed'] = $animation_speed;
}

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

$output.= '<div class="' . esc_attr(trim($css_class)) . '" '.implode(' ', $div_data_attributes) . $el_style . '>';
$output.= uncode_the_content($content);
$output.= '</div>';

echo $output;
