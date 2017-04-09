<?php
$el_class = $larger = $icon = $icon_color = $css_animation = $animation_delay = $animation_speed = $ul_class = $output = '';
extract(shortcode_atts(array(
	'el_class' => '',
	'larger' => '',
	'icon' => '',
	'icon_color' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
) , $atts));

if ($icon !== '') {
	$icon = '<i class="'.esc_attr($icon).(($icon_color !== '') ? ' text-' . $icon_color .'-color' : '').'"></i>';
	$content = preg_replace('/<li>/', '<li>' . $icon, $content);
	$ul_class .= 'icons';
}
if ($larger === 'yes') $ul_class = 'text-large ' . $ul_class;
if ($ul_class !== '') $content = preg_replace('/<ul>/', '<ul class="'.$ul_class.'">', $content, 1);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-list', $this->settings['base'], $atts );

$div_data = array();
if ($css_animation !== '') {
	$css_class .= ' ' . $css_animation . ' animate_when_almost_visible';
	if ($animation_delay !== '') $div_data['data-delay'] = $animation_delay;
	if ($animation_speed !== '') $div_data['data-speed'] = $animation_speed;
}

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

$output .= '<div class="uncode-wrapper '.$css_class.'" '.implode(' ', $div_data_attributes).'>';
$output .= $content;
$output .= '</div>';

echo uncode_remove_wpautop($output);