<?php

global $front_background_colors, $menutype;

/****
/   Load theme options
*****/

if ( is_multisite() ) {
  $uncode_option = get_blog_option( get_current_blog_id(), uncode_id() );
} else {
	$uncode_option = get_option(uncode_id());
}

if (empty($uncode_option)) {
	echo 'exit';
	return;
}

$cs_logo_color_light = $uncode_option['_uncode_logo_color_light'];
$cs_menu_color_light = $uncode_option['_uncode_menu_color_light'];
$cs_menu_bg_color_light = $uncode_option['_uncode_menu_bg_color_light'];
$cs_submenu_bg_color_light = $uncode_option['_uncode_submenu_bg_color_light'];
$cs_menu_bg_alpha_light = $uncode_option['_uncode_menu_bg_alpha_light'];
$cs_menu_border_color_light = $uncode_option['_uncode_menu_border_color_light'];
$cs_menu_border_alpha_light = $uncode_option['_uncode_menu_border_alpha_light'];
$cs_heading_color_light = $uncode_option['_uncode_heading_color_light'];
$cs_text_color_light = $uncode_option['_uncode_text_color_light'];
$cs_bg_color_light = $uncode_option['_uncode_background_color_light'];

$cs_logo_color_dark = $uncode_option['_uncode_logo_color_dark'];
$cs_menu_color_dark = $uncode_option['_uncode_menu_color_dark'];
$cs_menu_bg_color_dark = $uncode_option['_uncode_menu_bg_color_dark'];
$cs_submenu_bg_color_dark = $uncode_option['_uncode_submenu_bg_color_dark'];
$cs_menu_bg_alpha_dark = $uncode_option['_uncode_menu_bg_alpha_dark'];
$cs_menu_border_color_dark = $uncode_option['_uncode_menu_border_color_dark'];
$cs_menu_border_alpha_dark = $uncode_option['_uncode_menu_border_alpha_dark'];
$cs_heading_color_dark = $uncode_option['_uncode_heading_color_dark'];
$cs_text_color_dark = $uncode_option['_uncode_text_color_dark'];
$cs_bg_color_dark = $uncode_option['_uncode_background_color_dark'];

$cs_accent_color = $uncode_option['_uncode_accent_color'];

$cs_body_font_family = $uncode_option['_uncode_body_font_family'];
$cs_ui_font_family = $uncode_option['_uncode_ui_font_family'];
$cs_menu_font_family = $uncode_option['_uncode_menu_font_family'];
$cs_heading_font_family = $uncode_option['_uncode_heading_font_family'];
$cs_buttons_font_family = $uncode_option['_uncode_buttons_font_family'];

/** Loop colors **/
foreach ($front_background_colors as $key => $value)
{
	if (!isset($value) || $value === '') continue;
	$value = str_replace(';nb',';b',$value);
	$value = str_replace(';n}',';}',$value);
	echo "\n\n" . '/*----------------------------------------------------------';
	echo "\n" . '#'.$key;
	echo "\n" . '----------------------------------------------------------*/';
	if (strpos($value, 'background') !== false) {
		echo "\n" . '.style-' . $key . '-bg { ' . $value . ' }';
		echo "\n" . '.btn-' . $key . ' { color: #ffffff !important; ' . $value . str_replace('background','border-image',$value) . '}';
		echo "\n" . '.btn-' . $key . ':not(.btn-hover-nobg):hover, .btn-' . $key . ':not(.btn-hover-nobg):focus,btn-' . $key . ':active { ' . $value . str_replace('background','border-image',$value) . '}';
		echo "\n" . '.btn-' . $key . ':not(.btn-hover-nobg):not(.btn-text-skin):hover, .btn-' . $key . ':not(.btn-hover-nobg):not(.btn-text-skin):focus,btn-' . $key . ':active { ' . $value . '-webkit-background-clip: text;-webkit-text-fill-color: transparent; }';
		echo "\n" . '.btn-' . $key . '.btn-outline { background-color: transparent !important; ' . str_replace('background','border-image',$value) . '}';
		echo "\n" . '.btn-' . $key . '.btn-outline:not(.btn-text-skin) { ' . $value . '-webkit-background-clip: text;-webkit-text-fill-color: transparent; }';
		echo "\n" . '.btn-' . $key . '.btn-outline:not(.btn-hover-nobg):hover, .btn-' . $key . '.btn-outline:not(.btn-hover-nobg):focus, btn-' . $key . '.btn-outline:active { ' . $value . str_replace('background','border-image',$value) . '}';
		echo "\n" . '.btn-' . $key . '.btn-outline:not(.btn-hover-nobg):not(.btn-text-skin):hover, .btn-' . $key . '.btn-outline:not(.btn-hover-nobg):not(.btn-text-skin):focus, btn-' . $key . '.btn-outline:active { color: #ffffff !important; }';
		echo "\n" . '.style-light .btn-' . $key . '.btn-text-skin.btn-outline, .style-light .btn-' . $key . '.btn-text-skin:not(.btn-outline):hover { color: ' . $cs_heading_color_light . ' !important; }';
		echo "\n" . '.style-light .btn-' . $key . '.btn-text-skin.btn-outline:hover { color: #ffffff !important; }';
		echo "\n" . '.style-light .text-' . $key . '-color { color: #000 !important; background-color: #fff; position: relative; mix-blend-mode: multiply; }';
		echo "\n" . '.style-dark .text-' . $key . '-color { color: #fff !important; background-color: #000; position: relative; mix-blend-mode: lighten; }';
		echo "\n" . '.text-' . $key . '-color::before { ' . $value . ' content: ""; display: block; position: absolute; top: 0; right: 0; bottom: 0; left: 0; pointer-events: none; }';
		echo "\n" . '.text-' . $key . '-color > * { padding: 0px 1px; }';
		echo "\n" . '.style-light .text-' . $key . '-color::before { mix-blend-mode: screen; }';
		echo "\n" . '.style-dark .text-' . $key . '-color::before { mix-blend-mode: multiply; }';
		echo "\n" . '.border-' . $key . '-color {'.str_replace('background','border-image',$value).'}';
	} else {
		echo "\n" . '.style-' . $key . '-bg { background-color: ' . $value . '; }';
		if ($key !== 'white') {
			echo "\n" . '.btn-' . $key . ' { color: #ffffff !important; background-color: ' . $value . ' !important; border-color: ' . $value . ' !important; }';
		} else echo "\n" . '.btn-' . $key . ' { color: #1a1b1c !important; background-color: ' . $value . ' !important; border-color: ' . $value . ' !important; }';
		echo "\n" . '.btn-' . $key . ':not(.btn-hover-nobg):hover, .btn-' . $key . ':not(.btn-hover-nobg):focus,btn-' . $key . ':active { background-color: transparent !important; border-color: ' . $value . ' !important;}';
		echo "\n" . '.btn-' . $key . ':not(.btn-hover-nobg):not(.btn-text-skin):hover, .btn-' . $key . ':not(.btn-hover-nobg):not(.btn-text-skin):focus,btn-' . $key . ':active { color: ' . $value . ' !important; }';
		echo "\n" . '.btn-' . $key . '.btn-outline { background-color: transparent !important; border-color: ' . $value . ' !important; }';
		echo "\n" . '.btn-' . $key . '.btn-outline:not(.btn-text-skin) { color: ' . $value . ' !important; }';
		echo "\n" . '.btn-' . $key . '.btn-outline:not(.btn-hover-nobg):hover, .btn-' . $key . '.btn-outline:not(.btn-hover-nobg):focus, btn-' . $key . '.btn-outline:active { background-color: ' . $value . ' !important; border-color: ' . $value . ' !important; }';
		echo "\n" . '.btn-' . $key . '.btn-outline:not(.btn-hover-nobg):not(.btn-text-skin):hover, .btn-' . $key . '.btn-outline:not(.btn-hover-nobg):not(.btn-text-skin):focus, btn-' . $key . '.btn-outline:active { color: #ffffff !important; }';
		echo "\n" . '.style-light .btn-' . $key . '.btn-text-skin.btn-outline, .style-light .btn-' . $key . '.btn-text-skin:not(.btn-outline):hover { color: ' . $cs_heading_color_light . ' !important; }';
		echo "\n" . '.style-light .btn-' . $key . '.btn-text-skin.btn-outline:hover { color: #ffffff !important; }';
		echo "\n" . '.text-' . $key . '-color { color: ' . $value . ' !important; fill: ' . $value . ' !important; }';
		echo "\n" . '.border-' . $key . '-color { border-color: ' . $value . ' !important; }';
		echo "\n" . '.tmb-overlay-gradient-top .style-' . $key . '-bg { background-color: transparent !important; background-image: -webkit-linear-gradient(top, ' . $value . ' 0%, transparent 50%) !important; background-image: -moz-linear-gradient(top, ' . $value . ' 0%, transparent 50%) !important; background-image: -o-linear-gradient(top, ' . $value . ' 0%, transparent 50%) !important; background-image: linear-gradient(to bottom, ' . $value . ' 0%, transparent 50%) !important;}';
		echo "\n" . '.tmb-overlay-gradient-bottom .style-' . $key . '-bg { background-color: transparent !important; background-image: -webkit-linear-gradient(bottom, ' . $value . ' 0%, transparent 50%) !important; background-image: -moz-linear-gradient(bottom, ' . $value . ' 0%, transparent 50%) !important; background-image: -o-linear-gradient(bottom, ' . $value . ' 0%, transparent 50%) !important; background-image: linear-gradient(to top, ' . $value . ' 0%, transparent 50%) !important;}';
	}

	if ($key === $cs_logo_color_light) $cs_logo_color_light = $value;
	if ($key === $cs_menu_color_light) $cs_menu_color_light = $value;
	if ($key === $cs_menu_bg_color_light) $cs_menu_bg_color_light = $value;
	if ($key === $cs_submenu_bg_color_light) $cs_submenu_bg_color_light = $value;
	if ($key === $cs_menu_border_color_light) $cs_menu_border_color_light = $value;
	if ($key === $cs_menu_border_alpha_light) $cs_menu_border_alpha_light = $value;
	if ($key === $cs_heading_color_light) $cs_heading_color_light = $value;
	if ($key === $cs_text_color_light) $cs_text_color_light = $value;
	if ($key === $cs_bg_color_light) $cs_bg_color_light = $value;

	if ($key === $cs_logo_color_dark) $cs_logo_color_dark = $value;
	if ($key === $cs_menu_color_dark) $cs_menu_color_dark = $value;
	if ($key === $cs_menu_bg_color_dark) $cs_menu_bg_color_dark = $value;
	if ($key === $cs_submenu_bg_color_dark) $cs_submenu_bg_color_dark = $value;
	if ($key === $cs_menu_border_color_dark) $cs_menu_border_color_dark = $value;
	if ($key === $cs_menu_border_color_dark) $cs_menu_border_color_dark = $value;
	if ($key === $cs_heading_color_dark) $cs_heading_color_dark = $value;
	if ($key === $cs_text_color_dark) $cs_text_color_dark = $value;
	if ($key === $cs_bg_color_dark) $cs_bg_color_dark = $value;

	if ($key === $cs_accent_color) $cs_accent_color = $value;
}

if ($cs_bg_color_light !== '') {
	echo "\n\n" . '/*----------------------------------------------------------';
	echo "\n" . '#Style light';
	echo "\n" . '----------------------------------------------------------*/';
	if (strpos($cs_bg_color_light, 'background') !== false) {
		echo "\n" . '.style-light-bg { ' . $cs_bg_color_light . ' }';
	} else {
		echo "\n" . '.style-light-bg { background-color: ' . $cs_bg_color_light . '; }';
		echo "\n" . '.border-light-bg { border-color: ' . $cs_bg_color_light . '; }';
	}
}
if ($cs_bg_color_dark !== '') {
	echo "\n\n" . '/*----------------------------------------------------------';
	echo "\n" . '#Style dark';
	echo "\n" . '----------------------------------------------------------*/';
	if (strpos($cs_bg_color_dark, 'background') !== false) {
		echo "\n" . '.style-dark-bg { ' . $cs_bg_color_dark . ' }';
	} else {
		echo "\n" . '.style-dark-bg { background-color: ' . $cs_bg_color_dark . '; }';
		echo "\n" . '.border-dark-bg { border-color: ' . $cs_bg_color_dark . '; }';
	}
}

echo "\n\n" . '/*----------------------------------------------------------';
echo "\n" . '#Color fix';
echo "\n" . '----------------------------------------------------------*/';
echo "\n" . '.btn-white.btn-outline:hover, .btn-white.btn-outline:focus { color: #333333 !important; }';

/** Loop fonts **/
if (isset($uncode_option['_uncode_font_groups'])) {
	$fonts = $uncode_option['_uncode_font_groups'];
	if (!empty($fonts) && is_array($fonts)) {
		foreach ($fonts as $key => $value) {
			$font_class = $value['_uncode_font_group_unique_id'];
			$font_name = urldecode($value['_uncode_font_group']);
			if ($font_name === 'manual') $font_name = $value['_uncode_font_manual'];
			if ($font_name !== '') {
				echo "\n\n" . '/*----------------------------------------------------------';
				echo "\n" . '#'.$font_name;
				echo "\n" . '----------------------------------------------------------*/';
				echo "\n" . '.' . $font_class . ' { font-family: ' . $font_name . ' !important; }';
			}

			if ($font_class === $cs_body_font_family) $cs_body_font_family = $font_name;
			if ($font_class === $cs_ui_font_family) $cs_ui_font_family = $font_name;
			if ($font_class === $cs_menu_font_family) $cs_menu_font_family = $font_name;
			if ($font_class === $cs_heading_font_family) $cs_heading_font_family = $font_name;
			if ($font_class === $cs_buttons_font_family) $cs_buttons_font_family = $font_name;

		}
	}
}

/** Loop font sizes **/
if (isset($uncode_option['_uncode_heading_font_sizes'])) {
	$font_sizes = $uncode_option['_uncode_heading_font_sizes'];
	if (!empty($font_sizes) && is_array($font_sizes)) {
		foreach ($font_sizes as $key => $value) {
			echo "\n\n" . '/*----------------------------------------------------------';
			echo "\n" . '#Font-size: '.$value['_uncode_heading_font_size'].'px';
			echo "\n" . '----------------------------------------------------------*/';
			echo "\n" . '.' . $value['_uncode_heading_font_size_unique_id'] . ' { font-size: ' . $value['_uncode_heading_font_size'] . 'px; }';
			$first_mquery = $value['_uncode_heading_font_size'] / 1.5;
			if ($value['_uncode_heading_font_size'] > 35) {
				echo "\n" . '@media (max-width: 959px) { .' . $value['_uncode_heading_font_size_unique_id'] . ' { font-size: ' . $first_mquery . 'px; }}';
				if ($first_mquery > 35) echo "\n" . '@media (max-width: 569px) { .' . $value['_uncode_heading_font_size_unique_id'] . ' { font-size: 35px; }}';
			}
			if ($first_mquery > 28) {
				echo "\n" . '@media (max-width: 320px) { .' . $value['_uncode_heading_font_size_unique_id'] . ' { font-size: 28px; }}';
			}
		}
	}
}

/** Loop font height **/
if (isset($uncode_option['_uncode_heading_font_heights'])) {
	$font_heights = $uncode_option['_uncode_heading_font_heights'];
	if (!empty($font_heights) && is_array($font_heights)) {
		foreach ($font_heights as $key => $value) {
			echo "\n\n" . '/*----------------------------------------------------------';
			echo "\n" . '#Line-height: '.$value['_uncode_heading_font_height'];
			echo "\n" . '----------------------------------------------------------*/';
			echo "\n" . '.' . $value['_uncode_heading_font_height_unique_id'] . ' { line-height: ' . $value['_uncode_heading_font_height'] . '; }';
		}
	}
}

/** Loop letter spacings **/
if (isset($uncode_option['_uncode_heading_font_spacings'])) {
	$font_spacings = $uncode_option['_uncode_heading_font_spacings'];
	if (!empty($font_spacings) && is_array($font_spacings)) {
		foreach ($font_spacings as $key => $value) {
			echo "\n\n" . '/*----------------------------------------------------------';
			echo "\n" . '#Letter-spacing: '.$value['_uncode_heading_font_spacing'];
			echo "\n" . '----------------------------------------------------------*/';
			echo "\n" . '.' . $value['_uncode_heading_font_spacing_unique_id'] . ' { letter-spacing: ' . $value['_uncode_heading_font_spacing'] . '; }';
		}
	}
}

/** Collect style for admin **/
$admin_css = ob_get_contents();

echo "\n\n" . '/*----------------------------------------------------------';
echo "\n" . '#Standard font size';
echo "\n" . '----------------------------------------------------------*/';
$default_font_size = isset($uncode_option['_uncode_font_size']) ? $uncode_option['_uncode_font_size'] : '';
$h1 = isset($uncode_option['_uncode_heading_h1']) ? $uncode_option['_uncode_heading_h1'] : '';
$h2 = isset($uncode_option['_uncode_heading_h2']) ? $uncode_option['_uncode_heading_h2'] : '';
$h3 = isset($uncode_option['_uncode_heading_h3']) ? $uncode_option['_uncode_heading_h3'] : '';
$h4 = isset($uncode_option['_uncode_heading_h4']) ? $uncode_option['_uncode_heading_h4'] : '';
$h5 = isset($uncode_option['_uncode_heading_h5']) ? $uncode_option['_uncode_heading_h5'] : '';
$h6 = isset($uncode_option['_uncode_heading_h6']) ? $uncode_option['_uncode_heading_h6'] : '';
if ($default_font_size !== '') {
	echo "\n" . 'p,li,dt,dd,dl,address,label,small,pre,code { font-size: ' . $default_font_size . 'px; }';
}
if ($h1 !== '') {
	echo "\n" . 'h1:not([class*="fontsize-"]),.h1:not([class*="fontsize-"]) { font-size: ' . $h1 . 'px; }';
	$first_mquery = $h1 / 1.5;
	if ($h1 > 35) {
		echo "\n" . '@media (max-width: 959px) { h1:not([class*="fontsize-"]),.h1:not([class*="fontsize-"]) { font-size: ' . $first_mquery . 'px; }}';
		if ($first_mquery > 35) echo "\n" . '@media (max-width: 569px) { h1:not([class*="fontsize-"]),.h1:not([class*="fontsize-"]) { font-size: 35px; }}';
	}
	if ($first_mquery > 28) {
		echo "\n" . '@media (max-width: 320px) { h1:not([class*="fontsize-"]),.h1:not([class*="fontsize-"]) { font-size: 28px; }}';
	}
}
if ($h2 !== '') {
	echo "\n" . 'h2:not([class*="fontsize-"]),.h2:not([class*="fontsize-"]) { font-size: ' . $h2 . 'px; }';
	$first_mquery = $h2 / 1.5;
	if ($h2 > 35) {
		echo "\n" . '@media (max-width: 959px) { h2:not([class*="fontsize-"]),.h2:not([class*="fontsize-"]) { font-size: ' . $first_mquery . 'px; }}';
		if ($first_mquery > 35) echo "\n" . '@media (max-width: 569px) { h2:not([class*="fontsize-"]),.h2:not([class*="fontsize-"]) { font-size: 35px; }}';
	}
	if ($first_mquery > 28) {
		echo "\n" . '@media (max-width: 320px) { h2:not([class*="fontsize-"]),.h2:not([class*="fontsize-"]) { font-size: 28px; }}';
	}
}
if ($h3 !== '') {
	echo "\n" . 'h3:not([class*="fontsize-"]),.h3:not([class*="fontsize-"]) { font-size: ' . $h3 . 'px; }';
	$first_mquery = $h3 / 1.5;
	if ($h3 > 35) {
		echo "\n" . '@media (max-width: 959px) { h3:not([class*="fontsize-"]),.h3:not([class*="fontsize-"]) { font-size: ' . $first_mquery . 'px; }}';
		if ($first_mquery > 35) echo "\n" . '@media (max-width: 569px) { h3:not([class*="fontsize-"]),.h3:not([class*="fontsize-"]) { font-size: 35px; }}';
	}
	if ($first_mquery > 28) {
		echo "\n" . '@media (max-width: 320px) { h3:not([class*="fontsize-"]),.h3:not([class*="fontsize-"]) { font-size: 28px; }}';
	}
}
if ($h4 !== '') {
	echo "\n" . 'h4:not([class*="fontsize-"]),.h4:not([class*="fontsize-"]) { font-size: ' . $h4 . 'px; }';
	$first_mquery = $h4 / 1.5;
	if ($h4 > 35) {
		echo "\n" . '@media (max-width: 959px) { h4:not([class*="fontsize-"]),.h4:not([class*="fontsize-"]) { font-size: ' . $first_mquery . 'px; }}';
		if ($first_mquery > 35) echo "\n" . '@media (max-width: 569px) { h4:not([class*="fontsize-"]),.h4:not([class*="fontsize-"]) { font-size: 35px; }}';
	}
	if ($first_mquery > 28) {
		echo "\n" . '@media (max-width: 320px) { h4:not([class*="fontsize-"]),.h4:not([class*="fontsize-"]) { font-size: 28px; }}';
	}
}
if ($h5 !== '') {
	echo "\n" . 'h5:not([class*="fontsize-"]),.h5:not([class*="fontsize-"]) { font-size: ' . $h5 . 'px; }';
	$first_mquery = $h5 / 1.5;
	if ($h5 > 35) {
		echo "\n" . '@media (max-width: 959px) { h5:not([class*="fontsize-"]),.h5:not([class*="fontsize-"]) { font-size: ' . $first_mquery . 'px; }}';
		if ($first_mquery > 35) echo "\n" . '@media (max-width: 569px) { h5:not([class*="fontsize-"]),.h5:not([class*="fontsize-"]) { font-size: 35px; }}';
	}
	if ($first_mquery > 28) {
		echo "\n" . '@media (max-width: 320px) { h5:not([class*="fontsize-"]),.h5:not([class*="fontsize-"]) { font-size: 28px; }}';
	}
}
if ($h6 !== '') {
	echo "\n" . 'h6:not([class*="fontsize-"]),.h6:not([class*="fontsize-"]) { font-size: ' . $h6 . 'px; }';
	$first_mquery = $h6 / 1.5;
	if ($h6 > 35) {
		echo "\n" . '@media (max-width: 959px) { h6:not([class*="fontsize-"]),.h6:not([class*="fontsize-"]) { font-size: ' . $first_mquery . 'px; }}';
		if ($first_mquery > 35) echo "\n" . '@media (max-width: 569px) { h6:not([class*="fontsize-"]),.h6:not([class*="fontsize-"]) { font-size: 35px; }}';
	}
	if ($first_mquery > 28) {
		echo "\n" . '@media (max-width: 320px) { h6:not([class*="fontsize-"]),.h6:not([class*="fontsize-"]) { font-size: 28px; }}';
	}
}

echo "\n\n";

$color_primary = $cs_accent_color;

/** Light skin **/
$color_logo = $cs_logo_color_light;
$color_menu_text = $cs_menu_color_light;
$color_menu_background_alpha_light = uncode_hex2rgb($cs_menu_bg_color_light);
$color_menu_background_alpha_light = 'rgba('.$color_menu_background_alpha_light[0].','.$color_menu_background_alpha_light[1].','.$color_menu_background_alpha_light[2].','.($cs_menu_bg_alpha_light / 100).')';
$color_menu_background_light = $cs_menu_bg_color_light;
$color_submenu_background_light = $cs_submenu_bg_color_light;
$color_menu_border_light_transparent = uncode_hex2rgb($cs_menu_border_color_light);
$color_menu_border_light = $color_submenu_border_light = $color_menu_border_light_transparent = 'rgba('.$color_menu_border_light_transparent[0].','.$color_menu_border_light_transparent[1].','.$color_menu_border_light_transparent[2].','.($cs_menu_border_alpha_light / 100).')';
$get_menu_hover_color = $uncode_option['_uncode_menu_color_hover'];
if ($get_menu_hover_color === '') {
	$color_menu_text_hover = uncode_hex2rgb($cs_menu_color_light);
	$color_menu_text_hover = 'rgba('.$color_menu_text_hover[0].','.$color_menu_text_hover[1].','.$color_menu_text_hover[2].',.5)';
} else {
	$color_menu_text_hover = $front_background_colors[$get_menu_hover_color];
}
$color_menu_text_hover_static = uncode_hex2rgb($cs_menu_color_light);
	$color_menu_text_hover_static = 'rgba('.$color_menu_text_hover_static[0].','.$color_menu_text_hover_static[1].','.$color_menu_text_hover_static[2].',.5)';

/** Dark skin **/
$color_logo_inverted = $cs_logo_color_dark;
$color_menu_text_inverted = $cs_menu_color_dark;
$color_menu_background_alpha_dark = uncode_hex2rgb($cs_menu_bg_color_dark);
$color_menu_background_alpha_dark = 'rgba('.$color_menu_background_alpha_dark[0].','.$color_menu_background_alpha_dark[1].','.$color_menu_background_alpha_dark[2].','.($cs_menu_bg_alpha_dark / 100).')';
$color_menu_background_dark = $cs_menu_bg_color_dark;
$color_submenu_background_dark = $cs_submenu_bg_color_dark;
$color_menu_border_dark_transparent = uncode_hex2rgb($cs_menu_border_color_dark);
$color_menu_border_dark = $color_submenu_border_dark = $color_menu_border_dark_transparent = 'rgba('.$color_menu_border_dark_transparent[0].','.$color_menu_border_dark_transparent[1].','.$color_menu_border_dark_transparent[2].','.($cs_menu_border_alpha_dark / 100).')';
if ($get_menu_hover_color === '') {
	$color_menu_text_inverted_hover = uncode_hex2rgb($cs_menu_color_dark);
	$color_menu_text_inverted_hover = 'rgba('.$color_menu_text_inverted_hover[0].','.$color_menu_text_inverted_hover[1].','.$color_menu_text_inverted_hover[2].',.5)';
} else {
	$color_menu_text_inverted_hover = $front_background_colors[$get_menu_hover_color];
}
$color_menu_text_inverted_hover_static = uncode_hex2rgb($cs_menu_color_dark);
$color_menu_text_inverted_hover_static = 'rgba('.$color_menu_text_inverted_hover_static[0].','.$color_menu_text_inverted_hover_static[1].','.$color_menu_text_inverted_hover_static[2].',.5)';


$color_heading = $cs_heading_color_light;
$color_heading_inverted = $cs_heading_color_dark;
$color_text = $cs_text_color_light;
$color_text_inverted = $cs_text_color_dark;

$font_family_menu = $cs_menu_font_family;
$font_family_base = $cs_body_font_family;
$font_family_headings = $cs_heading_font_family;
$font_family_btn = $cs_buttons_font_family;
$font_family_ui = $cs_ui_font_family;

$menu_font_weight = $uncode_option['_uncode_menu_font_weight'];
$menu_font_size = $uncode_option['_uncode_menu_font_size'];
if ($menu_font_size === '') $menu_font_size = 12;
$submenu_font_size = $uncode_option['_uncode_submenu_font_size'];
if ($submenu_font_size === '') $submenu_font_size = 12;
$menu_mobile_font_size = $uncode_option['_uncode_menu_mobile_font_size'];
if ($menu_mobile_font_size === '') $menu_mobile_font_size = 12;
$heading_font_weight = $uncode_option['_uncode_heading_font_weight'];
$btn_font_weight = $uncode_option['_uncode_buttons_font_weight'];
$ui_font_weight = $uncode_option['_uncode_ui_font_weight'];
$btn_text_transform = $uncode_option['_uncode_buttons_text_transform'];

include get_template_directory() . '/core/inc/style-skins.css.php';

?>