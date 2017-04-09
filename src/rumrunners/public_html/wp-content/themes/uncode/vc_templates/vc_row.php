<?php

$el_class = $row_name = $back_image = $back_repeat = $back_attachment = $back_position = $back_size = $back_color = $overlay_color = $overlay_alpha = $unlock_row = $unlock_row_content = $limit_content = $row_height_percent = $row_inner_height_percent = $row_height_pixel = $inner_height = $parallax = $equal_height = $top_padding = $bottom_padding = $h_padding = $gutter_size = $override_padding = $force_width_grid = $shift_y = $shift_y_fixed = $css = $border_color = $border_style = $output = $row_style = $background_div = $row_inline_style = $desktop_visibility = $medium_visibility = $mobile_visibility = $sticky = '';

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
	'row_height_percent' => '',
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
	'is_header' => '',
) , $atts));


$row_classes = array(
	'row'
);
$row_cont_classes = array();
$row_inner_classes = array();

if (strpos($content,'[uncode_slider') !== false) $with_slider = true;
else $with_slider = false;

$uncodeblock_found = false;
if (strpos($content,'[uncode_block') !== false) {
	$regex = '/\[uncode_block(.*?)\](.*?)/';
	$regex_attr = '/(.*?)=\"(.*?)\"/';
	preg_match_all($regex, $content, $matches, PREG_SET_ORDER);
	if (count($matches)) {
		$inside_column = false;
		foreach ($matches as $key => $value) {
			$uncodeblock_found = true;
			if (isset($value[1])) {
				$output .= $value[0];
				preg_match_all($regex_attr, trim($value[1]), $matches_attr, PREG_SET_ORDER);
				foreach ($matches_attr as $key_attr => $value_attr) {
					if (trim($value_attr[1]) === 'inside_column') {
						if ($value_attr[2] === 'yes') {
							$inside_column = true;
							continue;
						}
					}
				}
				if ($inside_column) {
					$uncodeblock_found = false;
					$output = '';
					continue;
				}
			}
		}
	}
}


$row_cont_classes[] = $this->getExtraClass($el_class);
if ($sticky === 'yes') $row_cont_classes[] = 'sticky-element';

$el_id = '';
if ($row_name !== '') {
	$row_name = esc_attr($row_name);
	$row_name = ' data-label="'. $row_name .'" data-name="' . sanitize_title($row_name) . '"';
}

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
	$min_height = preg_replace("/[^0-9,.]/", "", $row_height_pixel);
	$row_inline_style = ' data-minheight="' . esc_attr($min_height) . '"';
}

if (!empty($row_height_percent) && $row_height_percent != '0')
{
	if ($row_height_percent == '100') $row_height_percent = ' data-height-ratio="full"';
	else
	{
		$row_height_percent = ' data-height-ratio="' . $row_height_percent . '"';
	}
} else $row_height_percent = '';
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

$boxed = ot_get_option('_uncode_boxed');

if ($boxed !== 'on') {
	if ($unlock_row === 'yes') {
		if ($unlock_row_content === 'yes') $row_classes[] = 'full-width';
		else {
			$row_classes[] = 'limit-width';
		}
	} else {
		$row_cont_classes[] = 'limit-width';
		if ($back_color !== '' || $back_image !== '') $row_cont_classes[] = 'boxed-row';
	}
}

/** send variable to uncode slider **/
if ($with_slider) {
	if ($unlock_row === 'yes' && $unlock_row_content !== 'yes') {
		$limit_content_inner = ' limit_content="yes"';
		if(($key = array_search('limit-width', $row_classes)) !== false) {
			unset($row_classes[$key]);
		}
	} else $limit_content_inner = '';

	if ($override_padding === 'yes') {
		$content = str_replace('[uncode_slider','[uncode_slider'.$limit_content_inner.' slider_height="'.(($row_height_percent !== '' || $is_header === 'yes') ? 'forced' : 'auto' ).'"'.($is_header === 'yes' ? ' is_header="true"' : '').' top_padding="'.$top_padding.'" bottom_padding="'.$bottom_padding.'" h_padding="'.$h_padding.'" ', $content);
	} else {
		$content = str_replace('[uncode_slider','[uncode_slider'.$limit_content_inner.' slider_height="'.(($row_height_percent !== '' || $is_header === 'yes') ? 'forced' : 'auto' ).'"'.($is_header === 'yes' ? ' is_header="true"' : '').' top_padding="2" bottom_padding="2" h_padding="2" ', $content);
	}
	$row_classes[] = 'row-slider';
}

$row_classes[] = 'row-parent';
$row_cont_classes[] = 'row-container';
if ($parallax === 'yes') $row_cont_classes[] = 'with-parallax';
if ($row_name !== '') $row_cont_classes[] = 'onepage-section';
if ($is_header === 'yes') $row_classes[] = 'row-header';

$row_inner_classes[] = 'row-inner';
if ($force_width_grid === 'yes') $row_inner_classes[] = 'row-inner-force';

if ($desktop_visibility === 'yes') $row_cont_classes[] = 'desktop-hidden';
if ($medium_visibility === 'yes') $row_cont_classes[] = 'tablet-hidden';
if ($mobile_visibility === 'yes') $row_cont_classes[] = 'mobile-hidden';

if (!$uncodeblock_found) :
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $row_cont_classes ) ), $this->settings['base'], $atts ) );
	$output.= '<div data-parent="true" class="' . esc_attr(trim($css_class)) . '"' . $row_name . $row_style . '>';
	if ($unlock_row === 'yes') $output.= $background_div;
	$output.= '<div class="' . esc_attr(trim(implode(' ', $row_classes))) . '"' . $row_height_percent . $row_inline_style . '>';
	if ($unlock_row !== 'yes') $output.= $background_div;
	if (!$with_slider) $output.= '<div class="' . esc_attr(trim(implode(' ', $row_inner_classes))) . '">';
	$output.= $content;
	echo uncode_remove_wpautop($output);
	$script_id = 'script-'.big_rand();
	echo '<script id="'.esc_attr($script_id).'" type="text/javascript">UNCODE.initRow(document.getElementById("'.$script_id.'"));</script>';
	$output = '';
	if (!$with_slider) $output.= '</div>';
	$output.= '</div>';
	$output.= '</div>';
endif;

echo uncode_remove_wpautop($output);
