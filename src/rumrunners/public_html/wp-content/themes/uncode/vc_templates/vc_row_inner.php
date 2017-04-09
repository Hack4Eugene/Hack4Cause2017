<?php

$el_class = $row_name = $back_image = $back_repeat = $back_attachment = $back_position = $back_size = $back_color = $overlay_color = $overlay_alpha = $unlock_row = $unlock_row_content = $limit_content = $row_inner_height_percent = $row_height_pixel = $inner_height = $parallax = $equal_height = $top_padding = $bottom_padding = $h_padding = $gutter_size = $override_padding = $force_width_grid = $shift_y = $shift_y_fixed = $css = $border_color = $border_style = $output = $row_style = $background_div = $row_inline_style = $desktop_visibility = $medium_visibility = $mobile_visibility = $sticky = '';

extract(shortcode_atts(array(
	'el_class' => '',
	'row_name' => '',
	'back_image' => '',
	'back_repeat' => '',
	'back_attachment' => 'scroll',
	'back_position' => 'center center',
	'back_size' => '',
	'back_color' => '',
	'overlay_color' => '',
	'overlay_alpha' => '',
	'unlock_row' => 'yes',
	'unlock_row_content' => '',
	'limit_content' => '',
	'row_inner_height_percent' => '',
	'row_height_pixel' => '',
	'inner_height' => '',
	'parallax' => '',
	'equal_height' => '',
	'top_padding' => '3',
	'bottom_padding' => '3',
	'h_padding' => '2',
	'gutter_size' => '',
	'override_padding' => '',
	'force_width_grid' => '',
	'desktop_visibility' => '',
  'medium_visibility' => '',
  'mobile_visibility' => '',
	'shift_y' => '',
	'shift_y_fixed' => '',
	'sticky' => '',
	'css' => '',
	'border_color' => '',
	'border_style' => '',
	'has_slider' => 'no'
) , $atts));

$row_classes = array(
	'row'
);
$row_cont_classes = array();
$row_inner_classes = array();

if (strpos($content,'[uncode_slider') !== false || $has_slider === 'yes') $with_slider = true;
else $with_slider = false;

$row_cont_classes[] = $this->getExtraClass($el_class);
if ($sticky === 'yes') $row_cont_classes[] = 'sticky-element';

$el_id = '';
if ($row_name !== '') $row_name = ' data-name="' . esc_attr(trim($row_name)) . '"';

if (!empty($back_color))
{
	$row_cont_classes[] = 'style-' . $back_color . '-bg';
}

/** BEGIN - background construction **/
if (!empty($back_image) || $overlay_color !== '')
{

	if ($parallax === 'yes') {
		$back_attachment = '';
		$back_size = 'cover';
	} else {
		if ($back_size === '') $back_size = 'cover';
	}

	if ($back_repeat === '') $back_repeat = 'no-repeat';

	$back_array = array (
		'background-image' => $back_image,
		'background-color' => $back_color,
		'background-repeat' => $back_repeat,
		'background-position' => $back_position,
		'background-size' => $back_size,
		'background-attachment' => $back_attachment,
	);

	$back_result_array = uncode_get_back_html($back_array, $overlay_color, $overlay_alpha, '', 'row');
	$background_div = $back_result_array['back_html'];
}

/** END - background construction **/

/** BEGIN - shift construction **/
if ($shift_y != '0' && $shift_y != '') {
    switch ($shift_y) {
        case 1:
            $row_inner_classes[] = 'shift_y_half';
        break;
        case 2:
            $row_inner_classes[] = 'shift_y_single';
        break;
        case 3:
            $row_inner_classes[] = 'shift_y_double';
        break;
        case 4:
            $row_inner_classes[] = 'shift_y_triple';
        break;
        case 5:
            $row_inner_classes[] = 'shift_y_quad';
        break;
        case -1:
            $row_inner_classes[] = 'shift_y_neg_half';
        break;
        case -2:
            $row_inner_classes[] = 'shift_y_neg_single';
        break;
        case -3:
            $row_inner_classes[] = 'shift_y_neg_double';
        break;
        case -4:
            $row_inner_classes[] = 'shift_y_neg_triple';
        break;
        case -5:
            $row_inner_classes[] = 'shift_y_neg_quad';
        break;
    }
    if ($shift_y_fixed === 'yes') $uncol_classes[] = 'shift_y_fixed';
}
/** END - shift construction **/

if ($row_height_pixel !== '') {
	$min_height = esc_attr(preg_replace("/[^0-9,.]/", "", $row_height_pixel));
	$row_inline_style = ' data-minheight="' . esc_attr($min_height) . '"';
}

if (!empty($row_inner_height_percent) && $row_inner_height_percent != '0')
{
	$row_inner_height_percent = ' data-height="' . $row_inner_height_percent . '"';
} else $row_inner_height_percent = '';

if ($equal_height == 'yes') $row_classes[] = 'unequal';

if ($gutter_size == '0') $row_classes[] = 'col-no-gutter';
else if ($gutter_size == '1') $row_classes[] = 'col-one-gutter';
else if ($gutter_size == '2') $row_classes[] = 'col-half-gutter';
else if ($gutter_size == '4') $row_classes[] = 'col-double-gutter';

if (!$with_slider) {
	if ($override_padding == 'yes') {
		if ($top_padding == '0') $row_classes[] = 'no-top-padding';
		else if ($top_padding == '1') $row_classes[] = 'one-top-padding';
		else if ($top_padding == '2') $row_classes[] = 'single-top-padding';
		else if ($top_padding == '3') $row_classes[] = 'double-top-padding';
		else if ($top_padding == '4') $row_classes[] = 'triple-top-padding';
		else if ($top_padding == '5') $row_classes[] = 'quad-top-padding';
		else if ($top_padding == '6') $row_classes[] = 'penta-top-padding';
		else if ($top_padding == '7') $row_classes[] = 'exa-top-padding';
		if ($bottom_padding == '0') $row_classes[] = 'no-bottom-padding';
		else if ($bottom_padding == '1') $row_classes[] = 'one-bottom-padding';
		else if ($bottom_padding == '2') $row_classes[] = 'single-bottom-padding';
		else if ($bottom_padding == '3') $row_classes[] = 'double-bottom-padding';
		else if ($bottom_padding == '4') $row_classes[] = 'triple-bottom-padding';
		else if ($bottom_padding == '5') $row_classes[] = 'quad-bottom-padding';
		else if ($bottom_padding == '6') $row_classes[] = 'penta-bottom-padding';
		else if ($bottom_padding == '7') $row_classes[] = 'exa-bottom-padding';
		if ($h_padding == '0') $row_classes[] = 'no-h-padding';
		else if ($h_padding == '1') $row_classes[] = 'one-h-padding';
		else if ($h_padding == '2') $row_classes[] = 'single-h-padding';
		else if ($h_padding == '3') $row_classes[] = 'double-h-padding';
		else if ($h_padding == '4') $row_classes[] = 'triple-h-padding';
		else if ($h_padding == '5') $row_classes[] = 'quad-h-padding';
		else if ($h_padding == '6') $row_classes[] = 'penta-h-padding';
		else if ($h_padding == '7') $row_classes[] = 'exa-h-padding';
	}
} else {
	$row_classes[] = 'no-top-padding';
	$row_classes[] = 'no-bottom-padding';
	$row_classes[] = 'no-h-padding';
	$unlock_row = 'yes';
}

if ($css !== '') $row_cont_classes[] = trim(vc_shortcode_custom_css_class($css));
if ($border_color !== '') {
	$row_cont_classes[] = 'border-' . $border_color . '-color';
	if ($border_style !== '') $row_style = ' style="border-style: '.$border_style.';"';
}

$row_cont_classes[] = 'row-internal';
$row_classes[] = 'row-child';
if ($limit_content === 'yes') {
	$row_classes[] = 'limit-width';
	$unlock_row = 'yes';
}

$row_cont_classes[] = 'row-container';
if ($parallax === 'yes') $row_cont_classes[] = 'with-parallax';
if ($row_name !== '') $row_cont_classes[] = 'onepage-section';

$row_inner_classes[] = 'row-inner';
if ($force_width_grid === 'yes') $row_inner_classes[] = 'row-inner-force';

if ($desktop_visibility === 'yes') $row_cont_classes[] = 'desktop-hidden';
if ($medium_visibility === 'yes') $row_cont_classes[] = 'tablet-hidden';
if ($mobile_visibility === 'yes') $row_cont_classes[] = 'mobile-hidden';

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $row_cont_classes ) ), $this->settings['base'], $atts ) );
$output.= '<div class="' . esc_attr(trim($css_class)) . '"' . $row_name . $row_style . '>';
if ($unlock_row === 'yes') $output.= $background_div;
$output.= '<div class="' . esc_attr(trim(implode(' ', $row_classes))) . '"' . $row_inner_height_percent . $row_inline_style . '>';
if ($unlock_row !== 'yes')$output.= $background_div;
if (!$with_slider) $output.= '<div class="' . esc_attr(trim(implode(' ', $row_inner_classes))) . '">';
$output.= $content;
if (!$with_slider) $output.= '</div>';
$output.= '</div>';
$output.= '</div>';
echo uncode_remove_wpautop($output);
