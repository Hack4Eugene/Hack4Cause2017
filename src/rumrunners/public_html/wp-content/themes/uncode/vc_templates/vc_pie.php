<?php
$title = $el_class = $value = $arc_width = $label_value = $units = $icon = $bar_color = $col_icon = $icon_color = $css_animation = $animation_delay = $animation_speed = '';
extract(shortcode_atts(array(
    'title' => '',
    'el_class' => '',
    'value' => '50',
    'arc_width' => '5',
    'units' => '',
    'icon' => '',
    'bar_color' => 'accent',
    'col_icon' => '',
    'label_value' => '',
    'css_animation' => '',
    'animation_delay' => '',
    'animation_speed' => '',
) , $atts));

global $front_background_colors;

if ($bar_color !== '' && $col_icon === 'yes') $icon_color = ' text-'.$bar_color.'-color';
if ($bar_color !== '') {
    $bar_color = (isset($front_background_colors[$bar_color])) ? $front_background_colors[$bar_color] : $front_background_colors['accent'];
}

$container_class = array('vc_progress_label');
$div_data = array();

if ($css_animation !== '') {
    $container_class[] = 'animate_when_almost_visible ' . $css_animation;
    if ($animation_delay !== '') $div_data['data-delay'] = $animation_delay;
    if ($animation_speed !== '') $div_data['data-speed'] = $animation_speed;
}

if ($icon !== '') $label_value = htmlentities('<i class="' . esc_attr($icon) . ' fa-3x'.esc_attr($icon_color).'" style="line-height: inherit;"></i>');
$el_class = $this->getExtraClass($el_class);
$container_class[] = $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_pie_chart wpb_content_element' . $el_class, $this->settings['base'], $atts);

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

$output = '<div class= "'.esc_attr(trim(implode(' ', $container_class))).'" '.implode(' ', $div_data_attributes).' data-pie-value="' . esc_attr($value) . '" data-pie-label-value="' . esc_attr($label_value) . '" data-pie-units="' . esc_attr($units) . '" data-pie-color="' . esc_attr($bar_color) . '" data-pie-width="' . esc_attr($arc_width) . '">';
$output.= '<div class="wpb_wrapper">';
$output.= '<div class="vc_pie_wrapper">';
$output.= '<span class="vc_pie_chart_back" style="border-width: ' . ($arc_width + 1) . 'px"></span>';
$output.= '<span class="vc_pie_chart_value"></span>';
$output.= '<canvas width="101" height="101"></canvas>';
$output.= '</div>';
if ($title != '')
{
    $output.= '<p class="wpb_heading wpb_pie_chart_heading">' . $title . '</p>';
}
$output.= '</div>';
$output.= '</div>';

echo uncode_remove_wpautop($output);
