<?php
$title = $el_class = $value = $font = $weight = $height = $transform = $size = $prefix = $suffix = $separator = $text = $icon = $output = $css_animation = $animation_delay = $animation_speed = $counter_color = '';
extract(shortcode_atts(array(
	'title' => '',
	'el_class' => '',
	'value' => '1000',
	'font' => '',
	'weight' => '',
	'height' => '',
	'transform' => '',
	'size' => 'h2',
	'counter_color' => '',
	'prefix' => '',
	'suffix' => '',
	'separator' => '',
	'text' => '',
	'icon' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
) , $atts));

$counter_class = array();
if ($font !== '') $counter_class[] = $font;
if ($size !== '') $counter_class[] = $size;
if ($weight !== '') $counter_class[] = 'font-weight-' . $weight;
if ($height !== '') $counter_class[] = $height;
if ($transform !== '') $counter_class[] = 'text-' . $transform;
if ($counter_color !== '') $counter_color = ' text-' . $counter_color . '-color';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-counter ', $this->settings['base'], $atts );

$div_data = array();
if ($css_animation !== '') {
	$css_class .= ' ' . $css_animation . ' animate_when_almost_visible';
	if ($animation_delay !== '') $div_data['data-delay'] = $animation_delay;
	if ($animation_speed !== '') $div_data['data-speed'] = $animation_speed;
}

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

$output .= '<div class="uncode-wrapper '.$css_class.'" '.implode(' ', $div_data_attributes).'>';
$output .= '<p class="' . esc_attr(trim(implode(' ', $counter_class))) . '">';
if ($prefix !== '') $output .= '<span class="counter-prefix'.$counter_color.'">'.$prefix.'</span>';
$output .= '<span class="counter'.$counter_color.'">'.$value.'</span>';
if ($suffix !== '') $output .= '<span class="counter-suffix'.$counter_color.'">'.$suffix.'</span>';
$output .= '</p>';
if ($separator === 'yes') $output .= '<hr class="separator-break separator-accent" />';
if ($text !== '') $output .= '<div class="counter-text"><p>'.$text.'</p></div>';
$output .= '</div>';

echo uncode_remove_wpautop($output);