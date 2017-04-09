<?php
$title = $el_class = $separator = $output = $layout = $bigger = $no_back = $icon = $align = $css_animation = $animation_delay = $animation_speed = '';
extract(shortcode_atts(array(
	'title' => '',
	'layout' => '',
	'el_class' => '',
	'separator' => '',
	'bigger' => '',
	'no_back' => '',
	'icon' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
) , $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-share', $this->settings['base'], $atts );

$div_data = array();
if ($css_animation !== '') {
	$css_class .= ' ' . $css_animation . ' animate_when_almost_visible';
	if ($animation_delay !== '') $div_data['data-delay'] = $animation_delay;
	if ($animation_speed !== '') $div_data['data-speed'] = $animation_speed;
}

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

$output .= '<div class="uncode-wrapper '.esc_attr(trim($css_class)).'" '.implode(' ', $div_data_attributes).'>';
if ($title !== '' && $layout === 'multiple') $output .= '<h6>'.$title.'</h6>';
if ($title !== '' && $layout !== 'multiple') $output .= '<p class="share-title">'.$title.'</p>';
if ($separator === 'yes' && $layout === 'multiple') $output .= '<hr class="separator-break separator-accent" />';
$output .= '<div class="share-button share-buttons'.(($layout === 'multiple') ? ' share-inline' : ' share-vertical').(($bigger === 'yes') ? ' share-bigger' : '') . (($no_back === 'yes') ? ' only-icon' : '') . $align . '"></div>';
$output .= '</div>';

echo uncode_remove_wpautop($output);