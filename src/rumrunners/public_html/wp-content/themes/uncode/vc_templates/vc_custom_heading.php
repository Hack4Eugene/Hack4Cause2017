<?php
$subheading = $subtext_one = $subtext_two = $heading_semantic = $text_size = $text_height = $text_space = $text_font = $text_weight = $text_transform = $text_italic = $text_color = $separator = $separator_color = $separator_double = $sub_text = $sub_lead = $sub_reduced = $desktop_visibility = $medium_visibility = $mobile_visibility = $css_animation = $animation_delay = $animation_speed = $output = $el_class = $sub_class = '';
extract( shortcode_atts( array(
	'subheading' => '',
	'subtext_one' => '',
	'subtext_two' => '',
	'heading_semantic' => 'h2',
	'text_size' => 'h2',
	'text_height' => '',
	'text_space' => '',
	'text_font' => '',
	'text_weight' => '',
	'text_transform' => '',
	'text_italic' => '',
	'text_color' => '',
	'separator' => '',
	'separator_color' => '',
	'separator_double' => '',
	'sub_text' => '',
	'sub_lead' => '',
	'sub_reduced' => '',
	'desktop_visibility' => '',
	'medium_visibility' => '',
	'mobile_visibility' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'el_class' => '',
), $atts ) );

$cont_classes = array('heading-text el-text');
$classes = array();
$sub_classes = array();
$separator_classes = array();
$div_data = array();
$data_size = array();

if ($text_font !== '') $classes[] = $text_font;
if ($text_size !== '') {
	$classes[] = $text_size;
	if ($text_size === 'bigtext') $cont_classes[] = 'heading-bigtext';
}
if ($text_height !== '') $classes[] = $text_height;
if ($text_space !== '') $classes[] = $text_space;
if ($text_weight !== '') $classes[] = 'font-weight-' . $text_weight;
if ($text_color !== '') $classes[] = 'text-' . $text_color . '-color';
if ($text_transform !== '') $classes[] = 'text-' . $text_transform;

if ($separator !== '') {
	$separator_classes[] = 'separator-break';
	if ($separator_color === 'yes') $separator_classes[] = 'separator-accent';
	if ($separator_double === 'yes') $separator_classes[] = 'separator-double-padding';
}

if ($desktop_visibility === 'yes') $cont_classes[] = 'desktop-hidden';
if ($medium_visibility === 'yes') $cont_classes[] = 'tablet-hidden';
if ($mobile_visibility === 'yes') $cont_classes[] = 'mobile-hidden';


if ($css_animation !== '') {
	$cont_classes[] = $css_animation . ' animate_when_almost_visible';
	if ($animation_delay !== '') $div_data['data-delay'] = $animation_delay;
	if ($animation_speed !== '') $div_data['data-speed'] = $animation_speed;
}

$cont_classes[] = trim($this->getExtraClass( $el_class ));

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

$output .= '<div class="' . esc_attr(trim(implode( ' ', $cont_classes ))) . '" '.implode(' ', $div_data_attributes).'>';
if ($separator === 'over') $output .= '<hr class="' . esc_attr(trim(implode( ' ', $separator_classes ))) . '" />';
if ($content !== '') {

	$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $data_size, array_keys($data_size));

	$output .= '<' . $heading_semantic . ' class="' . esc_attr(trim(implode( ' ', $classes ))) . '" '.implode(' ', $div_data_attributes) .'>';
	if ($text_italic === 'yes') $output .= '<i>';
	$output .= '<span>';
	$content = trim($content);
	$title_lines = explode("\n", $content);
	$lines_counter = count($title_lines);
	if ($lines_counter > 1) {
		foreach ($title_lines as $key => $value) {
			$value = trim($value);
			$output .= $value;
			if ($value !== '' && ($lines_counter - 1 !== $key)) $output .= '</span><span>';
		}
	} else {
		$output .= $content;
	}
	$output .= '</span>';
	if ($text_italic === 'yes') $output .= '</i>';
	$output .= '</' . $heading_semantic . '>';
}
if ($separator === 'yes') $output .= '<hr class="' . esc_attr(trim(implode( ' ', $separator_classes ))) . '" />';
if ($subheading !== '') {
	if ($sub_lead === 'yes') $sub_lead = ' text-lead';
	if ($sub_reduced === 'yes') $sub_reduced = ' text-top-reduced';
	if ($sub_lead !== '' || $sub_reduced !== '') $sub_class = ' class="'.esc_attr(trim($sub_lead.$sub_reduced)).'"';
	$output .= '<div'.$sub_class.'>' . uncode_remove_wpautop($subheading, true) . '</div>';
}
if ($separator === 'under') $output .= '<hr class="' . esc_attr(trim(implode( ' ', $separator_classes ))) . '" />';
$output .= '</div>';
$output .= '<div class="clear"></div>';

echo uncode_remove_wpautop($output);

