<?php

global $UNCODE_COLORS, $front_background_colors;

$UNCODE_COLORS = array(

	array(
		'value' => 'accent',
		'label' => esc_html__('Accent', 'uncode')
	) ,

);

$retrieve_options = get_option('uncode');
$custom_colors_list = (isset($retrieve_options['_uncode_custom_colors_list'])) ? $retrieve_options['_uncode_custom_colors_list'] : '';

if (isset($custom_colors_list) && is_array($custom_colors_list))
{
	$single_array = array();
	foreach ($custom_colors_list as $key => $value)
	{
		$single_array['value'] = $value['_uncode_custom_color_unique_id'];
		$single_array['label'] = $value['title'];
		$UNCODE_COLORS[] = $single_array;
	}
}

/**
 * Build arrays for the backend
 */

$uncode_colors = array();

foreach ((array)$UNCODE_COLORS as $key => $value)
{
	if (isset($value['disabled']) && $value['disabled'])
	{
		$uncode_color = array(
			'" disabled="disabled',
			$value['label']
		);
	}
	else
	{
		$uncode_color = array(
			$value['value'],
			$value['label']
		);
	}
	array_push($uncode_colors, $uncode_color);
}

$uncode_colors_w_transp = array_merge(array(
	array(
		'transparent',
		'Transparent'
	)
) , $uncode_colors);

array_unshift($uncode_colors, array(
	'',
	'Select…'
));

array_unshift($uncode_colors_w_transp, array(
	'',
	'Select…'
));

/**
 * Build array for the frontend
 */

$front_background_colors = array(
	'transparent' => 'transparent',
);

if (isset($custom_colors_list) && is_array($custom_colors_list))
{
	foreach ($custom_colors_list as $key => $value)
	{
		if (isset($value['_uncode_custom_color_regular']) && $value['_uncode_custom_color_regular'] === 'off') {
			$value_gradient = json_decode($value['_uncode_custom_color_gradient']);
			if (isset($value_gradient->css)) $front_background_colors[$value['_uncode_custom_color_unique_id']] = $value_gradient->css;
			else $front_background_colors[$value['_uncode_custom_color_unique_id']] = '';
		} else $front_background_colors[$value['_uncode_custom_color_unique_id']] = $value['_uncode_custom_color'];
	}
}

if (isset($retrieve_options['_uncode_accent_color']) && $retrieve_options['_uncode_accent_color'] !== '')
{
	$front_background_colors['accent'] = $front_background_colors[$retrieve_options['_uncode_accent_color']];
}

?>
