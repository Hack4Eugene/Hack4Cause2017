<?php

global $uncode_colors, $uncode_colors_w_transp;

$flat_uncode_colors = array();
if (!empty($uncode_colors)) {
	foreach ($uncode_colors as $key => $value) {
		$flat_uncode_colors[$value[1]] = $value[0];
	}
}

$units = array(
	'1/12' => '1',
	'2/12' => '2',
	'3/12' => '3',
	'4/12' => '4',
	'5/12' => '5',
	'6/12' => '6',
	'7/12' => '7',
	'8/12' => '8',
	'9/12' => '9',
	'10/12' => '10',
	'11/12' => '11',
	'12/12' => '12',
);

$size_arr = array(
	esc_html__('Standard', 'uncode') => '',
	esc_html__('Small', 'uncode') => 'btn-sm',
	esc_html__('Large', 'uncode') => 'btn-lg',
	esc_html__('Extra-Large', 'uncode') => 'btn-xl',
	esc_html__('Button link', 'uncode') => 'btn-link',
	esc_html__('Standard link', 'uncode') => 'link',
);

$icon_sizes = array(
	esc_html__('Standard', 'uncode') => '',
	esc_html__('2x', 'uncode') => 'fa-2x',
	esc_html__('3x', 'uncode') => 'fa-3x',
	esc_html__('4x', 'uncode') => 'fa-4x',
	esc_html__('5x', 'uncode') => 'fa-5x',
);

$heading_semantic = array(
	esc_html__('h1', 'uncode') => 'h1',
	esc_html__('h2', 'uncode') => 'h2',
	esc_html__('h3', 'uncode') => 'h3',
	esc_html__('h4', 'uncode') => 'h4',
	esc_html__('h5', 'uncode') => 'h5',
	esc_html__('h6', 'uncode') => 'h6',
	esc_html__('p', 'uncode') => 'p',
	esc_html__('div', 'uncode') => 'div'
);

$heading_size = array(
	esc_html__('Default CSS', 'uncode') => '',
	esc_html__('h1', 'uncode') => 'h1',
	esc_html__('h2', 'uncode') => 'h2',
	esc_html__('h3', 'uncode') => 'h3',
	esc_html__('h4', 'uncode') => 'h4',
	esc_html__('h5', 'uncode') => 'h5',
	esc_html__('h6', 'uncode') => 'h6',
);

$font_sizes = (function_exists('ot_get_option')) ? ot_get_option('_uncode_heading_font_sizes') : array();
if (!empty($font_sizes)) {
	foreach ($font_sizes as $key => $value) {
		$heading_size[$value['title']] = $value['_uncode_heading_font_size_unique_id'];
	}
}

$heading_size[esc_html__('BigText', 'uncode')] = 'bigtext';

$font_heights = (function_exists('ot_get_option')) ? ot_get_option('_uncode_heading_font_heights') : array();
$heading_height = array(
	esc_html__('Default CSS', 'uncode') => '',
);
if (!empty($font_heights)) {
	foreach ($font_heights as $key => $value) {
		$heading_height[$value['title']] = $value['_uncode_heading_font_height_unique_id'];
	}
}

$font_spacings = (function_exists('ot_get_option')) ? ot_get_option('_uncode_heading_font_spacings') : array();
$heading_space = array(
	esc_html__('Default CSS', 'uncode') => '',
);
if (!empty($font_spacings)) {
	foreach ($font_spacings as $key => $value) {
		$heading_space[$value['title']] = $value['_uncode_heading_font_spacing_unique_id'];
	}
}

if (isset($fonts) && is_array($fonts)) {
	foreach ($fonts as $key => $value) {
		$heading_font[$value['title']] = $value['_uncode_font_group_unique_id'];
	}
}

$fonts = (function_exists('ot_get_option')) ? ot_get_option('_uncode_font_groups') : array();
$heading_font = array(
	esc_html__('Default CSS', 'uncode') => '',
);

if (isset($fonts) && is_array($fonts)) {
	foreach ($fonts as $key => $value) {
		$heading_font[$value['title']] = $value['_uncode_font_group_unique_id'];
	}
}

$heading_weight = array(
	esc_html__('Default CSS', 'uncode') => '',
	esc_html__('100', 'uncode') => 100,
	esc_html__('200', 'uncode') => 200,
	esc_html__('300', 'uncode') => 300,
	esc_html__('400', 'uncode') => 400,
	esc_html__('500', 'uncode') => 500,
	esc_html__('600', 'uncode') => 600,
	esc_html__('700', 'uncode') => 700,
	esc_html__('800', 'uncode') => 800,
	esc_html__('900', 'uncode') => 900,
);

$target_arr = array(
	esc_html__('Same window', 'uncode') => '_self',
	esc_html__('New window', 'uncode') => "_blank"
);

$border_style = array(
	esc_html__('None', 'uncode') => '',
	esc_html__('Solid', 'uncode') => 'solid',
	esc_html__('Dotted', 'uncode') => 'dotted',
	esc_html__('Dashed', 'uncode') => 'dashed',
	esc_html__('Double', 'uncode') => 'double',
	esc_html__('Groove', 'uncode') => 'groove',
	esc_html__('Ridge', 'uncode') => 'ridge',
	esc_html__('Inset', 'uncode') => 'inset',
	esc_html__('Outset', 'uncode') => 'outset',
	esc_html__('Initial', 'uncode') => 'initial',
	esc_html__('Inherit', 'uncode') => 'inherit',
);

$add_css_animation = array(
	'type' => 'dropdown',
	'heading' => esc_html__('Animation', 'uncode') ,
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		esc_html__('No', 'uncode') => '',
		esc_html__('Opacity', 'uncode') => 'alpha-anim',
		esc_html__('Zoom in', 'uncode') => 'zoom-in',
		esc_html__('Zoom out', 'uncode') => 'zoom-out',
		esc_html__('Top to bottom', 'uncode') => 'top-t-bottom',
		esc_html__('Bottom to top', 'uncode') => 'bottom-t-top',
		esc_html__('Left to right', 'uncode') => 'left-t-right',
		esc_html__('Right to left', 'uncode') => 'right-t-left',
	) ,
	'group' => esc_html__('Animation', 'uncode') ,
	'description' => esc_html__('Specify the entrance animation.', 'uncode')
);

$add_animation_delay = array(
	'type' => 'dropdown',
	'heading' => esc_html__('Animation delay', 'uncode') ,
	'param_name' => 'animation_delay',
	'value' => array(
		esc_html__('None', 'uncode') => '',
		esc_html__('ms 100', 'uncode') => 100,
		esc_html__('ms 200', 'uncode') => 200,
		esc_html__('ms 300', 'uncode') => 300,
		esc_html__('ms 400', 'uncode') => 400,
		esc_html__('ms 500', 'uncode') => 500,
		esc_html__('ms 600', 'uncode') => 600,
		esc_html__('ms 700', 'uncode') => 700,
		esc_html__('ms 800', 'uncode') => 800,
		esc_html__('ms 900', 'uncode') => 900,
		esc_html__('ms 1000', 'uncode') => 1000,
		esc_html__('ms 1100', 'uncode') => 1100,
		esc_html__('ms 1200', 'uncode') => 1200,
		esc_html__('ms 1300', 'uncode') => 1300,
		esc_html__('ms 1400', 'uncode') => 1400,
		esc_html__('ms 1500', 'uncode') => 1500,
		esc_html__('ms 1600', 'uncode') => 1600,
		esc_html__('ms 1700', 'uncode') => 1700,
		esc_html__('ms 1800', 'uncode') => 1800,
		esc_html__('ms 1900', 'uncode') => 1900,
		esc_html__('ms 2000', 'uncode') => 2000,
	) ,
	'group' => esc_html__('Animation', 'uncode') ,
	'description' => esc_html__('Specify the entrance animation delay in milliseconds.', 'uncode') ,
	'admin_label' => true,
	'dependency' => array(
		'element' => 'css_animation',
		'not_empty' => true
	)
);

$add_animation_speed = array(
	'type' => 'dropdown',
	'heading' => esc_html__('Animation speed', 'uncode') ,
	'param_name' => 'animation_speed',
	'admin_label' => true,
	'value' => array(
		esc_html__('Default (400)', 'uncode') => '',
		esc_html__('ms 100', 'uncode') => 100,
		esc_html__('ms 200', 'uncode') => 200,
		esc_html__('ms 300', 'uncode') => 300,
		esc_html__('ms 400', 'uncode') => 400,
		esc_html__('ms 500', 'uncode') => 500,
		esc_html__('ms 600', 'uncode') => 600,
		esc_html__('ms 700', 'uncode') => 700,
		esc_html__('ms 800', 'uncode') => 800,
		esc_html__('ms 900', 'uncode') => 900,
		esc_html__('ms 1000', 'uncode') => 1000,
	) ,
	'group' => esc_html__('Animation', 'uncode') ,
	'description' => esc_html__('Specify the entrance animation speed in milliseconds.', 'uncode') ,
	'dependency' => array(
		'element' => 'css_animation',
		'not_empty' => true
	)
);

$add_background_repeat = array(
	'type' => 'dropdown',
	'heading' => '',
	'description' => wp_kses(__('Define the background repeat. <a href=\'http://www.w3schools.com/cssref/pr_background-repeat.asp\' target=\'_blank\'>Check this for reference</a>', 'uncode') , array( 'a' => array( 'href' => array(),'target' => array() ) ) ),
	'param_name' => 'back_repeat',
	'param_holder_class' => 'background-image-settings',
	'value' => array(
		esc_html__('background-repeat', 'uncode') => '',
		esc_html__('No Repeat', 'uncode') => 'no-repeat',
		esc_html__('Repeat All', 'uncode') => 'repeat',
		esc_html__('Repeat Horizontally', 'uncode') => 'repeat-x',
		esc_html__('Repeat Vertically', 'uncode') => 'repeat-y',
		esc_html__('Inherit', 'uncode') => 'inherit'
	) ,
	'dependency' => array(
		'element' => 'back_image',
		'not_empty' => true,
	) ,
	"group" => esc_html__("Style", 'uncode')
);

$add_background_attachment = array(
	'type' => 'dropdown',
	'heading' => '',
	"description" => wp_kses(__("Define the background attachment. <a href='http://www.w3schools.com/cssref/pr_background-attachment.asp' target='_blank'>Check this for reference</a>", 'uncode'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
	'param_name' => 'back_attachment',
	'value' => array(
		esc_html__('background-attachement', 'uncode') => '',
		esc_html__('Fixed', 'uncode') => 'fixed',
		esc_html__('Scroll', 'uncode') => 'scroll',
		esc_html__('Inherit', 'uncode') => 'inherit'
	) ,
	'dependency' => array(
		'element' => 'back_image',
		'not_empty' => true,
	) ,
	"group" => esc_html__("Style", 'uncode')
);

$add_background_position = array(
	'type' => 'dropdown',
	'heading' => '',
	"description" => wp_kses(__("Define the background position. <a href='http://www.w3schools.com/cssref/pr_background-position.asp' target='_blank'>Check this for reference</a>", 'uncode'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
	'param_name' => 'back_position',
	'value' => array(
		esc_html__('background-position', 'uncode') => '',
		esc_html__('Left Top', 'uncode') => 'left top',
		esc_html__('Left Center', 'uncode') => 'left center',
		esc_html__('Left Bottom', 'uncode') => 'left bottom',
		esc_html__('Center Top', 'uncode') => 'center top',
		esc_html__('Center Center', 'uncode') => 'center center',
		esc_html__('Center Bottom', 'uncode') => 'center bottom',
		esc_html__('Right Top', 'uncode') => 'right top',
		esc_html__('Right Center', 'uncode') => 'right center',
		esc_html__('Right Bottom', 'uncode') => 'right bottom'
	) ,
	'dependency' => array(
		'element' => 'back_image',
		'not_empty' => true,
	) ,
	"group" => esc_html__("Style", 'uncode')
);

$add_background_size = array(
	'type' => 'textfield',
	'heading' => '',
	"description" => wp_kses(__("Define the background size (Default value is 'cover'). <a href='http://www.w3schools.com/cssref/css3_pr_background-size.asp' target='_blank'>Check this for reference</a>", 'uncode'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
	'param_name' => 'back_size',
	'dependency' => array(
		'element' => 'back_image',
		'not_empty' => true,
	) ,
	"group" => esc_html__("Style", 'uncode')
);

vc_map(array(
	'name' => esc_html__('Row', 'uncode') ,
	'base' => 'vc_row',
	'weight' => 1000,
	'php_class_name' => 'uncode_row',
	'is_container' => true,
	'icon' => 'fa fa-align-justify',
	'show_settings_on_create' => false,
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Row container element', 'uncode') ,
	'params' => array(
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Container width", 'uncode') ,
			"param_name" => "unlock_row",
			"description" => esc_html__("Define the width of the container.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
			"std" => 'yes',
			"group" => esc_html__("Aspect", 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Content width", 'uncode') ,
			"param_name" => "unlock_row_content",
			"description" => esc_html__("Define the width of the content area.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
			"group" => esc_html__("Aspect", 'uncode') ,
			'dependency' => array(
				'element' => 'unlock_row',
				'value' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Height", 'uncode') ,
			"param_name" => "row_height_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 0,
			"description" => wp_kses(__("Set the row height with a percent value.<br>N.B. This value is including the top and bottom padding.", 'uncode'), array( 'br' => array( ) ) ) ,
			"group" => esc_html__("Aspect", 'uncode') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__("Min height", 'uncode') ,
			'param_name' => 'row_height_pixel',
			'description' => esc_html__("Insert the row minimum height in pixel.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Custom padding", 'uncode') ,
			"param_name" => "override_padding",
			"description" => esc_html__('Activate this to define custom paddings.', 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Left and right padding", 'uncode') ,
			"param_name" => "h_padding",
			"min" => 0,
			"max" => 7,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the left and right padding.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			"dependency" => Array(
				'element' => "override_padding",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Top padding", 'uncode') ,
			"param_name" => "top_padding",
			"min" => 0,
			"max" => 7,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the top padding.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			"dependency" => Array(
				'element' => "override_padding",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Bottom padding", 'uncode') ,
			"param_name" => "bottom_padding",
			"min" => 0,
			"max" => 7,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the bottom padding.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			"dependency" => Array(
				'element' => "override_padding",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Background color", 'uncode') ,
			"param_name" => "back_color",
			"description" => esc_html__("Specify a background color for the row.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Automatic background", 'uncode') ,
			"param_name" => "back_image_auto",
			"description" => esc_html__("Activate to pickup the background media from the category.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
			"group" => esc_html__("Style", 'uncode') ,
		),
		array(
			"type" => "media_element",
			"heading" => esc_html__("Background media", 'uncode') ,
			"param_name" => "back_image",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode')
		) ,
		$add_background_repeat,
		$add_background_attachment,
		$add_background_position,
		$add_background_size,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Parallax", 'uncode') ,
			"param_name" => "parallax",
			"description" => esc_html__("Activate this to have the background parallax effect.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Style", 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay color", 'uncode') ,
			"param_name" => "overlay_color",
			"description" => esc_html__("Specify an overlay color for the background.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => '',
			"param_name" => "overlay_alpha",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 50,
			"description" => esc_html__("Set the transparency for the overlay.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Columns with equal height", 'uncode') ,
			"param_name" => "equal_height",
			"description" => esc_html__("Activate this to have columns that are all equally tall, matching the height of the tallest.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Inner columns", 'uncode')
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Columns gap", 'uncode') ,
			"param_name" => "gutter_size",
			"min" => 0,
			"max" => 4,
			"step" => 1,
			"value" => 3,
			"description" => esc_html__("Set the columns gap.", 'uncode') ,
			"group" => esc_html__("Inner columns", 'uncode') ,
		) ,
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('Css', 'uncode') ,
			'param_name' => 'css',
			'group' => esc_html__('Custom', 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border color", 'uncode') ,
			"param_name" => "border_color",
			"description" => esc_html__("Specify a border color.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $uncode_colors_w_transp,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border style", 'uncode') ,
			"param_name" => "border_style",
			"description" => esc_html__("Specify a border style.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $border_style,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift y-axis", 'uncode') ,
			"param_name" => "shift_y",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the Y axis.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift y-axis fixed", 'uncode') ,
			"param_name" => "shift_y_fixed",
			"description" => esc_html__("Deactive shift-y responsiveness.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Sticky", 'uncode') ,
			"param_name" => "sticky",
			"description" => esc_html__("Activate this to stick the element when scrolling.", 'uncode') ,
			'group' => esc_html__('Extra', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode') ,
			"group" => esc_html__("Extra", 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Section name', 'uncode') ,
			'param_name' => 'row_name',
			'description' => esc_html__('Required for the onepage scroll, this gives the name to the section.', 'uncode') ,
			"group" => esc_html__("Extra", 'uncode')
		) ,
	) ,
	'js_view' => 'UncodeRowView'
));

vc_map(array(
	'name' => esc_html__('Row', 'uncode') ,
	'base' => 'vc_row_inner',
	'php_class_name' => 'uncode_row_inner',
	'content_element' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'weight' => 1000,
	'show_settings_on_create' => false,
	'params' => array(
		array(
			"type" => "type_numeric_slider",
			'heading' => esc_html__("Height", 'uncode') ,
			"param_name" => "row_inner_height_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 0,
			"description" => wp_kses(__("Set the row height with a percent value.<br>N.B. This value is relative to the row parent.", 'uncode'), array( 'br' => array( ) ) ) ,
			"group" => esc_html__("Aspect", 'uncode') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__("Min height", 'uncode') ,
			'param_name' => 'row_height_pixel',
			'description' => esc_html__("Insert the row minimum height in pixel.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Force width 100%", 'uncode') ,
			"param_name" => "force_width_grid",
			"description" => wp_kses(__('Set this value if you need to force the width to 100%.<br>N.B. This is needed only when all the columns are OFF-GRID.','uncode') , array( 'br' => array( ),'b' => array( ) ) ),
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Background color", 'uncode') ,
			"param_name" => "back_color",
			"description" => esc_html__("Specify a background color for the row.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Background media", 'uncode') ,
			"param_name" => "back_image",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode')
		) ,
		$add_background_repeat,
		$add_background_attachment,
		$add_background_position,
		$add_background_size,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Parallax", 'uncode') ,
			"param_name" => "parallax",
			"description" => esc_html__("Activate this to have the background parallax effect.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"dependency" => Array(
				'element' => "back_image",
				'not_empty' => true
			) ,
			"group" => esc_html__("Style", 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay color", 'uncode') ,
			"param_name" => "overlay_color",
			"description" => esc_html__("Specify an overlay color for the background.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => '',
			"param_name" => "overlay_alpha",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 50,
			"description" => esc_html__("Set the transparency for the overlay.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Columns with equal height", 'uncode') ,
			"param_name" => "equal_height",
			"description" => esc_html__("Activate this to have columns that are all equally tall, matching the height of the tallest.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Inner columns", 'uncode')
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Columns gap", 'uncode') ,
			"param_name" => "gutter_size",
			"min" => 0,
			"max" => 4,
			"step" => 1,
			"value" => 3,
			"description" => esc_html__("Set the columns gap.", 'uncode') ,
			"group" => esc_html__("Inner columns", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift y-axis", 'uncode') ,
			"param_name" => "shift_y",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the Y axis.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift y-axis fixed", 'uncode') ,
			"param_name" => "shift_y_fixed",
			"description" => esc_html__("Deactive shift-y responsiveness.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('Css', 'uncode') ,
			'param_name' => 'css',
			'group' => esc_html__('Custom', 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border color", 'uncode') ,
			"param_name" => "border_color",
			"description" => esc_html__("Specify a border color.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $uncode_colors_w_transp,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border style", 'uncode') ,
			"param_name" => "border_style",
			"description" => esc_html__("Specify a border style.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $border_style,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Sticky", 'uncode') ,
			"param_name" => "sticky",
			"description" => esc_html__("Activate this to stick the element when scrolling.", 'uncode') ,
			'group' => esc_html__('Extra', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode') ,
			"group" => esc_html__("Extra", 'uncode')
		) ,
	) ,
	'js_view' => 'UncodeRowView'
));

vc_map(array(
	"name" => esc_html__("Column", 'uncode') ,
	"base" => "vc_column",
	"is_container" => true,
	"content_element" => false,
	"params" => array(
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Content width", 'uncode') ,
			"param_name" => "column_width_use_pixel",
			"edit_field_class" => 'vc_col-sm-12 vc_column row_height',
			"description" => 'Set this value if you want to constrain the column width.',
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => '',
			"param_name" => "column_width_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 100,
			"description" => esc_html__("Set the column width with a percent value.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			'dependency' => array(
				'element' => 'column_width_use_pixel',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => '',
			'param_name' => 'column_width_pixel',
			'description' => esc_html__("Insert the column width in pixel.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			'dependency' => array(
				'element' => 'column_width_use_pixel',
				'value' => 'yes'
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Horizontal position", 'uncode') ,
			"param_name" => "position_horizontal",
			"description" => esc_html__("Specify the horizontal position of the content if you have decreased the width value.", 'uncode') ,
			"std" => 'center',
			"value" => array(
				'Left' => 'left',
				'Center' => 'center',
				'Right' => 'right'
			) ,
			'group' => esc_html__('Aspect', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Vertical position", 'uncode') ,
			"param_name" => "position_vertical",
			"description" => esc_html__("Specify the vertical position of the content.", 'uncode') ,
			"value" => array(
				'Top' => 'top',
				'Middle' => 'middle',
				'Bottom' => 'bottom'
			) ,
			'group' => esc_html__('Aspect', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text alignment", 'uncode') ,
			"param_name" => "align_horizontal",
			"description" => esc_html__("Specify the alignment inside the content box.", 'uncode') ,
			"value" => array(
				'Left' => 'align_left',
				'Center' => 'align_center',
				'Right' => 'align_right',
			) ,
			'group' => esc_html__('Aspect', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Expand height to 100%", 'uncode') ,
			"param_name" => "expand_height",
			"description" => esc_html__("Activate this to expand the height of the column to 100%, if you haven't activate the equal height row setting.", 'uncode') ,
			'group' => esc_html__('Aspect', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Custom padding", 'uncode') ,
			"param_name" => "override_padding",
			"description" => esc_html__('Activate this to define custom paddings.', 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Custom padding", 'uncode') ,
			"param_name" => "column_padding",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the column padding", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			"dependency" => Array(
				'element' => "override_padding",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Column text skin", 'uncode') ,
			"param_name" => "style",
			"value" => array(
				esc_html__('Inherit', 'uncode') => '',
				esc_html__('Light', 'uncode') => 'light',
				esc_html__('Dark', 'uncode') => 'dark'
			) ,
			'group' => esc_html__('Style', 'uncode') ,
			"description" => esc_html__("Specify the text/skin color of the column.", 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Column font family", 'uncode') ,
			"param_name" => "font_family",
			"description" => esc_html__("Specify the column font family.", 'uncode') ,
			"value" => $heading_font,
			'std' => '',
			'group' => esc_html__('Style', 'uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Column custom background color", 'uncode') ,
			"param_name" => "back_color",
			"description" => esc_html__("Specify a background color for the column.", 'uncode') ,
			"value" => $uncode_colors,
			'group' => esc_html__('Style', 'uncode')
		) ,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Media", 'uncode') ,
			"param_name" => "back_image",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode') ,
			'group' => esc_html__('Style', 'uncode')
		) ,
		$add_background_repeat,
		$add_background_attachment,
		$add_background_position,
		$add_background_size,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Parallax", 'uncode') ,
			"param_name" => "parallax",
			"description" => esc_html__("Activate this to have the background parallax effect.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"dependency" => Array(
				'element' => "back_image",
				'not_empty' => true
			) ,
			"group" => esc_html__("Style", 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay color", 'uncode') ,
			"param_name" => "overlay_color",
			"description" => esc_html__("Specify an overlay color for the background.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => '',
			"param_name" => "overlay_alpha",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 50,
			"description" => esc_html__("Set the transparency for the overlay.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Vertical gap", 'uncode') ,
			"param_name" => "gutter_size",
			"min" => 0,
			"max" => 6,
			"step" => 1,
			"value" => 3,
			"description" => esc_html__("Set the vertical space between elements.", 'uncode') ,
			"group" => esc_html__("Inner elements", 'uncode') ,
		) ,
		array(
			"type" => "css_editor",
			"heading" => esc_html__('Css', 'uncode') ,
			"param_name" => "css",
			"group" => esc_html__('Custom', 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border color", 'uncode') ,
			"param_name" => "border_color",
			"description" => esc_html__("Specify a border color.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $uncode_colors_w_transp,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border style", 'uncode') ,
			"param_name" => "border_style",
			"description" => esc_html__("Specify a border style.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $border_style,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"param_name" => "align_medium",
			"description" => esc_html__("Specify the text alignment inside the content box in tablet layout mode.", 'uncode') ,
			"value" => array(
				'Text align (Inherit)' => '',
				'Left' => 'align_left_tablet',
				'Center' => 'align_center_tablet',
				'Right' => 'align_right_tablet',
			) ,
			'group' => esc_html__('Responsive', 'uncode')
		) ,
		array(
			"type" => "type_numeric_slider",
			"param_name" => "medium_width",
			"min" => 0,
			"max" => 7,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("COLUMN WIDTH. N.B. If you change this value for one column you must specify a value for every column of the row.", 'uncode') ,
			"group" => esc_html__("Responsive", 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"param_name" => "align_mobile",
			"description" => esc_html__("Specify the text alignment inside the content box in mobile layout mode.", 'uncode') ,
			"value" => array(
				'Text align (Inherit)' => '',
				'Left' => 'align_left_mobile',
				'Center' => 'align_center_mobile',
				'Right' => 'align_right_mobile',
			) ,
			'group' => esc_html__('Responsive', 'uncode')
		) ,
		array(
			"type" => "textfield",
			"param_name" => "mobile_height",
			"description" => esc_html__("MINIMUM HEIGHT. Insert the value in pixel.", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode')
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift x-axis", 'uncode') ,
			"param_name" => "shift_x",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the X axis.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift x-axis fixed", 'uncode') ,
			"param_name" => "shift_x_fixed",
			"description" => esc_html__("Deactive shift-x responsiveness.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift y-axis", 'uncode') ,
			"param_name" => "shift_y",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the Y axis.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift y-axis fixed", 'uncode') ,
			"param_name" => "shift_y_fixed",
			"description" => esc_html__("Deactive shift-y responsiveness.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Custom z-index", 'uncode') ,
			"param_name" => "z_index",
			"min" => 0,
			"max" => 10,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set a custom z-index to ensure the visibility of the element.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode')
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Custom link', 'uncode') ,
			'param_name' => 'link_to',
			'description' => esc_html__('Enter a custom link for the column.', 'uncode') ,
			'group' => esc_html__('Extra', 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Sticky", 'uncode') ,
			"param_name" => "sticky",
			"description" => esc_html__("Activate this to stick the element when scrolling.", 'uncode') ,
			'group' => esc_html__('Extra', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "textfield",
			"heading" => esc_html__("Extra class", 'uncode') ,
			"param_name" => "el_class",
			"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'uncode') ,
			'group' => esc_html__('Extra', 'uncode')
		) ,
	) ,
	"js_view" => 'UncodeColumnView'
));

vc_map(array(
	"name" => esc_html__("Column", 'uncode') ,
	"base" => "vc_column_inner",
	"class" => "",
	"icon" => "",
	"wrapper_class" => "",
	"controls" => "full",
	"allowed_container_element" => false,
	"content_element" => false,
	"is_container" => true,
	"params" => array(
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Content width", 'uncode') ,
			"param_name" => "column_width_use_pixel",
			"edit_field_class" => 'vc_col-sm-12 vc_column row_height',
			"description" => 'Set this value if you want to constrain the column width.',
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => '',
			"param_name" => "column_width_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 100,
			"description" => esc_html__("Set the column width with a percent value.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			'dependency' => array(
				'element' => 'column_width_use_pixel',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => '',
			'param_name' => 'column_width_pixel',
			'description' => esc_html__("Insert the column width in pixel.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			'dependency' => array(
				'element' => 'column_width_use_pixel',
				'value' => 'yes'
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Horizontal position", 'uncode') ,
			"param_name" => "position_horizontal",
			"description" => esc_html__("Specify the horizontal position of the content if you have decreased the width value.", 'uncode') ,
			"std" => 'center',
			"value" => array(
				'Left' => 'left',
				'Center' => 'center',
				'Right' => 'right'
			) ,
			'group' => esc_html__('Aspect', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Vertical position", 'uncode') ,
			"param_name" => "position_vertical",
			"description" => esc_html__("Specify the vertical position of the content.", 'uncode') ,
			"value" => array(
				'Top' => 'top',
				'Middle' => 'middle',
				'Bottom' => 'bottom'
			) ,
			'group' => esc_html__('Aspect', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text alignment", 'uncode') ,
			"param_name" => "align_horizontal",
			"description" => esc_html__("Specify the alignment inside the content box.", 'uncode') ,
			"value" => array(
				'Left' => 'align_left',
				'Center' => 'align_center',
				'Right' => 'align_right',
			) ,
			'group' => esc_html__('Aspect', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Expand height to 100%", 'uncode') ,
			"param_name" => "expand_height",
			"description" => esc_html__("Activate this to expand the height of the column to 100%, if you haven't activate the equal height row setting.", 'uncode') ,
			'group' => esc_html__('Aspect', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Custom padding", 'uncode') ,
			"param_name" => "override_padding",
			"description" => esc_html__('Activate this to define custom paddings.', 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Custom padding", 'uncode') ,
			"param_name" => "column_padding",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the column padding", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			"dependency" => Array(
				'element' => "override_padding",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Column text skin", 'uncode') ,
			"param_name" => "style",
			"value" => array(
				esc_html__('Inherit', 'uncode') => '',
				esc_html__('Light', 'uncode') => 'light',
				esc_html__('Dark', 'uncode') => 'dark'
			) ,
			'group' => esc_html__('Style', 'uncode') ,
			"description" => esc_html__("Specify the text/skin color of the column.", 'uncode')
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Vertical gap", 'uncode') ,
			"param_name" => "gutter_size",
			"min" => 0,
			"max" => 6,
			"step" => 1,
			"value" => 3,
			"description" => esc_html__("Set the vertical space between elements.", 'uncode') ,
			"group" => esc_html__("Inner elements", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Column font family", 'uncode') ,
			"param_name" => "font_family",
			"description" => esc_html__("Specify the column font family.", 'uncode') ,
			"value" => $heading_font,
			'std' => '',
			'group' => esc_html__('Style', 'uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Column custom background color", 'uncode') ,
			"param_name" => "back_color",
			"description" => esc_html__("Specify a background color for the column.", 'uncode') ,
			"value" => $uncode_colors,
			'group' => esc_html__('Style', 'uncode')
		) ,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Media", 'uncode') ,
			"param_name" => "back_image",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode') ,
			'group' => esc_html__('Style', 'uncode')
		) ,
		$add_background_repeat,
		$add_background_attachment,
		$add_background_position,
		$add_background_size,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Parallax", 'uncode') ,
			"param_name" => "parallax",
			"description" => esc_html__("Activate this to have the background parallax effect.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"dependency" => Array(
				'element' => "back_image",
				'not_empty' => true
			) ,
			"group" => esc_html__("Style", 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay color", 'uncode') ,
			"param_name" => "overlay_color",
			"description" => esc_html__("Specify an overlay color for the background.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => '',
			"param_name" => "overlay_alpha",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 50,
			"description" => esc_html__("Set the transparency for the overlay.", 'uncode') ,
			"group" => esc_html__("Style", 'uncode') ,
		) ,
		array(
			"type" => "css_editor",
			"heading" => esc_html__('Css', 'uncode') ,
			"param_name" => "css",
			"group" => esc_html__('Custom', 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border color", 'uncode') ,
			"param_name" => "border_color",
			"description" => esc_html__("Specify a border color.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $uncode_colors_w_transp,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border style", 'uncode') ,
			"param_name" => "border_style",
			"description" => esc_html__("Specify a border style.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $border_style,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"param_name" => "align_medium",
			"description" => esc_html__("Specify the text alignment inside the content box in tablet layout mode.", 'uncode') ,
			"value" => array(
				'Text align (Inherit)' => '',
				'Left' => 'align_left_tablet',
				'Center' => 'align_center_tablet',
				'Right' => 'align_right_tablet',
			) ,
			'group' => esc_html__('Responsive', 'uncode')
		) ,
		array(
			"type" => "type_numeric_slider",
			"param_name" => "medium_width",
			"min" => 0,
			"max" => 7,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("COLUMN WIDTH. N.B. If you change this value for one column you must specify a value for every column of the row.", 'uncode') ,
			"group" => esc_html__("Responsive", 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"param_name" => "align_mobile",
			"description" => esc_html__("Specify the text alignment inside the content box in mobile layout mode.", 'uncode') ,
			"value" => array(
				'Text align (Inherit)' => '',
				'Left' => 'align_left_mobile',
				'Center' => 'align_center_mobile',
				'Right' => 'align_right_mobile',
			) ,
			'group' => esc_html__('Responsive', 'uncode')
		) ,
		array(
			"type" => "textfield",
			"param_name" => "mobile_height",
			"description" => esc_html__("MINIMUM HEIGHT. Insert the value in pixel.", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode')
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift x-axis", 'uncode') ,
			"param_name" => "shift_x",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the X axis.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift x-axis fixed", 'uncode') ,
			"param_name" => "shift_x_fixed",
			"description" => esc_html__("Deactive shift-x responsiveness.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift y-axis", 'uncode') ,
			"param_name" => "shift_y",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the Y axis.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shift y-axis fixed", 'uncode') ,
			"param_name" => "shift_y_fixed",
			"description" => esc_html__("Deactive shift-y responsiveness.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Custom z-index", 'uncode') ,
			"param_name" => "z_index",
			"min" => 0,
			"max" => 10,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set a custom z-index to ensure the visibility of the element.", 'uncode') ,
			'group' => esc_html__('Off-grid', 'uncode')
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Custom link', 'uncode') ,
			'param_name' => 'link_to',
			'description' => esc_html__('Enter a custom link for the column.', 'uncode') ,
			'group' => esc_html__('Extra', 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Sticky", 'uncode') ,
			"param_name" => "sticky",
			"description" => esc_html__("Activate this to stick the element when scrolling.", 'uncode') ,
			'group' => esc_html__('Extra', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => "textfield",
			"heading" => esc_html__("Extra class", 'uncode') ,
			"param_name" => "el_class",
			"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'uncode') ,
			'group' => esc_html__('Extra', 'uncode')
		) ,
	) ,
	"js_view" => 'UncodeColumnView'
));

/* Gallery/Slideshow
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Media Gallery', 'uncode') ,
	'base' => 'vc_gallery',
	'php_class_name' => 'uncode_generic_admin',
	'weight' => 102,
	'icon' => 'fa fa-th-large',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Isotope grid or carousel layout', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode') ,
			'group' => esc_html__('General', 'uncode') ,
			'admin_label' => true,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget ID', 'uncode') ,
			'param_name' => 'el_id',
			'value' => (function_exists('big_rand')) ? big_rand() : rand() ,
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode') ,
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Gallery module', 'uncode') ,
			'param_name' => 'type',
			'value' => array(
				esc_html__('Isotope', 'uncode') => 'isotope',
				esc_html__('Carousel', 'uncode') => 'carousel',
			) ,
			'admin_label' => true,
			'description' => esc_html__('Specify gallery module type.', 'uncode') ,
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout modes', 'uncode') ,
			'param_name' => 'isotope_mode',
			'admin_label' => true,
			"description" => wp_kses(__("Specify the isotpe layout mode. <a href='http://isotope.metafizzy.co/layout-modes.html' target='_blank'>Check this for reference</a>", 'uncode'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
			"value" => array(
				esc_html__('Masonry', 'uncode') => 'masonry',
				esc_html__('Fit rows', 'uncode') => 'fitRows',
				esc_html__('Cells by row', 'uncode') => 'cellsByRow',
				esc_html__('Vertical', 'uncode') => 'vertical',
				esc_html__('Packery', 'uncode') => 'packery',
			) ,
			'group' => esc_html__('General', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Random order", 'uncode') ,
			"param_name" => "random",
			"description" => esc_html__("Activate this to have a media random order.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("General", 'uncode') ,
		) ,
		array(
			'type' => 'media_element',
			'heading' => esc_html__('Medias', 'uncode') ,
			'param_name' => 'medias',
			"edit_field_class" => 'vc_col-sm-12 vc_column uncode_gallery',
			'value' => '',
			'description' => esc_html__('Specify images from media library.', 'uncode') ,
			'group' => esc_html__('General', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Style", 'uncode') ,
			"param_name" => "style_preset",
			"description" => esc_html__("Select the visualization mode.", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'isotope',
				) ,
			) ,
			"value" => array(
				esc_html__('Masonry', 'uncode') => 'masonry',
				esc_html__('Metro', 'uncode') => 'metro',
			) ,
			'group' => esc_html__('Module', 'uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Gallery background color", 'uncode') ,
			"param_name" => "gallery_back_color",
			"description" => esc_html__("Specify a background color for the module.", 'uncode') ,
			"class" => 'uncode_colors',
			"value" => $uncode_colors,
			'group' => esc_html__('Module', 'uncode') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number columns ( > 960px )', 'uncode') ,
			'param_name' => 'carousel_lg',
			'value' => 3,
			'description' => esc_html__('Insert the numbers of columns for the viewport from 960px.', 'uncode') ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number columns ( > 570px and < 960px )', 'uncode') ,
			'param_name' => 'carousel_md',
			'value' => 3,
			'description' => esc_html__('Insert the numbers of columns for the viewport from 570px to 960px.', 'uncode') ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number columns ( > 0px and < 570px )', 'uncode') ,
			'param_name' => 'carousel_sm',
			'value' => 1,
			'description' => esc_html__('Insert the numbers of columns for the viewport from 0 to 570px.', 'uncode') ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel'
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Thumbnail size', 'uncode') ,
			'param_name' => 'thumb_size',
			'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode') ,
			"value" => array(
				esc_html__('Regular', 'uncode') => '',
				'1:1' => 'one-one',
				'2:1' => 'two-one',
				'3:2' => 'three-two',
				'4:3' => 'four-three',
				'10:3' => 'ten-three',
				'16:9' => 'sixteen-nine',
				'21:9' => 'twentyone-nine',
				'1:2' => 'one-two',
				'2:3' => 'two-three',
				'3:4' => 'three-four',
				'3:10' => 'three-ten',
				'9:16' => 'nine-sixteen',
			) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Filtering", 'uncode') ,
			"param_name" => "filtering",
			"description" => esc_html__("Activate this to add the isotope filtering.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Filter skin", 'uncode') ,
			"param_name" => "filter_style",
			"description" => esc_html__("Specify the filter skin color.", 'uncode') ,
			"value" => array(
				esc_html__('Light', 'uncode') => 'light',
				esc_html__('Dark', 'uncode') => 'dark'
			) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Filter menu color", 'uncode') ,
			"param_name" => "filter_back_color",
			"description" => esc_html__("Specify a background color for the filter menu.", 'uncode') ,
			"class" => 'uncode_colors',
			"value" => $uncode_colors,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Filter menu full width", 'uncode') ,
			"param_name" => "filtering_full_width",
			"description" => esc_html__("Activate this to force the full width of the filter.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Filter menu position", 'uncode') ,
			"param_name" => "filtering_position",
			"description" => esc_html__("Specify the filter menu positioning.", 'uncode') ,
			"value" => array(
				esc_html__('Left', 'uncode') => 'left',
				esc_html__('Center', 'uncode') => 'center',
				esc_html__('Right', 'uncode') => 'right',
			) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("'Show all' opposite", 'uncode') ,
			"param_name" => "filter_all_opposite",
			"description" => esc_html__("Activate this to position the 'Show all' button opposite to the rest.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			) ,
			'dependency' => array(
				'element' => 'filtering_position',
				'value' => array(
					'left',
					'right'
				)
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Filter menu uppercase", 'uncode') ,
			"param_name" => "filtering_uppercase",
			"description" => esc_html__("Activate this to have the filter menu in uppercase.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Filter menu mobile hidden", 'uncode') ,
			"param_name" => "filter_mobile",
			"description" => esc_html__("Activate this to hide the filter menu in mobile mode.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Filter scroll", 'uncode') ,
			"param_name" => "filter_scroll",
			"description" => esc_html__("Activate this to scroll to the  module when filtering.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Filter sticky", 'uncode') ,
			"param_name" => "filter_sticky",
			"description" => esc_html__("Activate this to have a sticky filter menu when scrolling.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'isotope',
			) ,
			'dependency' => array(
				'element' => 'filtering',
				'value' => 'yes',
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Items gap", 'uncode') ,
			"param_name" => "gutter_size",
			"min" => 0,
			"max" => 4,
			"step" => 1,
			"value" => 3,
			"description" => esc_html__("Set the items gap.", 'uncode') ,
			"group" => esc_html__("Module", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Inner module padding", 'uncode') ,
			"param_name" => "inner_padding",
			"description" => esc_html__("Activate this to have an inner padding with the same size as the items gap.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'isotope',
					'carousel',
				) ,
			) ,
		) ,
		array(
			'type' => 'sorted_list',
			'heading' => esc_html__('Media', 'uncode') ,
			'param_name' => 'media_items',
			'description' => esc_html__('Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overridden on post to post basis.', 'uncode') ,
			'value' => 'media|lightbox|original,icon',
			"group" => esc_html__("Module", 'uncode') ,
			'options' => array(
				array(
					'media',
					esc_html__('Media', 'uncode') ,
					array(
						array(
							'lightbox',
							esc_html__('Lightbox', 'uncode')
						) ,
						array(
							'custom_link',
							esc_html__('Custom link', 'uncode')
						) ,
						array(
							'nolink',
							esc_html__('No link', 'uncode')
						)
					) ,
					array(
						array(
							'original',
							esc_html__('Original', 'uncode')
						) ,
						array(
							'poster',
							esc_html__('Poster', 'uncode')
						)
					)
				) ,
				array(
					'icon',
					esc_html__('Icon', 'uncode') ,
				) ,
				array(
					'title',
					esc_html__('Title', 'uncode') ,
				) ,
				array(
					'caption',
					esc_html__('Caption', 'uncode') ,
				) ,
				array(
					'description',
					esc_html__('Description', 'uncode') ,
				) ,
				array(
					'category',
					esc_html__('Category', 'uncode') ,
				) ,
				array(
					'spacer',
					esc_html__('Spacer', 'uncode') ,
					array(
						array(
							'half',
							esc_html__('0.5x', 'uncode')
						) ,
						array(
							'one',
							esc_html__('1x', 'uncode')
						) ,
						array(
							'two',
							esc_html__('2x', 'uncode')
						)
					)
				) ,
				array(
					'sep-one',
					esc_html__('Separator One', 'uncode') ,
					array(
						array(
							'full',
							esc_html__('Full width', 'uncode')
						) ,
						array(
							'reduced',
							esc_html__('Reduced width', 'uncode')
						)
					)
				) ,
				array(
					'sep-two',
					esc_html__('Separator Two', 'uncode') ,
					array(
						array(
							'full',
							esc_html__('Full width', 'uncode')
						) ,
						array(
							'reduced',
							esc_html__('Reduced width', 'uncode')
						)
					)
				) ,
				array(
					'team-social',
					esc_html__('Team socials', 'uncode') ,
				) ,
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Carousel items height", 'uncode') ,
			"param_name" => "carousel_height",
			"description" => esc_html__("Specify the carousel items height.", 'uncode') ,
			"value" => array(
				esc_html__('Auto', 'uncode') => '',
				esc_html__('Equal height', 'uncode') => 'equal',
			) ,
			'group' => esc_html__('Module', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Items vertical alignment", 'uncode') ,
			"param_name" => "carousel_v_align",
			"description" => esc_html__("Specify the items vertical alignment.", 'uncode') ,
			"value" => array(
				esc_html__('Top', 'uncode') => '',
				esc_html__('Middle', 'uncode') => 'middle',
				esc_html__('Bottom', 'uncode') => 'bottom'
			) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
			'dependency' => array(
				'element' => 'carousel_height',
				'is_empty' => true,
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Transition type', 'uncode') ,
			'param_name' => 'carousel_type',
			"value" => array(
				esc_html__('Slide', 'uncode') => '',
				esc_html__('Fade', 'uncode') => 'fade'
			) ,
			'description' => esc_html__('Specify the transition type.', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
			'group' => esc_html__('Module', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Auto rotate slides', 'uncode') ,
			'param_name' => 'carousel_interval',
			'value' => array(
				3000,
				5000,
				10000,
				15000,
				esc_html__('Disable', 'uncode') => 0
			) ,
			'description' => esc_html__('Specify the automatic timeout between slides in milliseconds.', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
			'group' => esc_html__('Module', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Navigation speed', 'uncode') ,
			'param_name' => 'carousel_navspeed',
			'value' => array(
				200,
				400,
				700,
				1000,
				esc_html__('Disable', 'uncode') => 0
			) ,
			'std' => 400,
			'description' => esc_html__('Specify the navigation speed between slides in milliseconds.', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
			'group' => esc_html__('Module', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Loop", 'uncode') ,
			"param_name" => "carousel_loop",
			"description" => esc_html__("Activate the loop option to make the carousel infinite.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Navigation", 'uncode') ,
			"param_name" => "carousel_nav",
			"description" => esc_html__("Activate the navigation to show navigational arrows.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile navigation", 'uncode') ,
			"param_name" => "carousel_nav_mobile",
			"description" => esc_html__("Activate the navigation to show navigational arrows for mobile devices.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Navigation skin", 'uncode') ,
			"param_name" => "carousel_nav_skin",
			"description" => esc_html__("Specify the navigation arrows skin.", 'uncode') ,
			"value" => array(
				esc_html__('Light', 'uncode') => 'light',
				esc_html__('Dark', 'uncode') => 'dark'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Dots navigation", 'uncode') ,
			"param_name" => "carousel_dots",
			"description" => esc_html__("Activate the dots navigation to show navigational dots in the bottom.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile dots navigation", 'uncode') ,
			"param_name" => "carousel_dots_mobile",
			"description" => esc_html__("Activate the dots navigation to show navigational dots in the bottom for mobile devices.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Dots navigation inside", 'uncode') ,
			"param_name" => "carousel_dots_inside",
			"description" => esc_html__("Activate to have the dots navigation inside the carousel.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Autoheight", 'uncode') ,
			"param_name" => "carousel_autoh",
			"description" => esc_html__("Activate to adjust the height automatically when possible.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Textual carousel ", 'uncode') ,
			"param_name" => "carousel_textual",
			"description" => esc_html__("Activate this to have a carousel with only text.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Module", 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Breakpoint - First step', 'uncode') ,
			'param_name' => 'screen_lg',
			'value' => 1000,
			'description' => wp_kses(__('Insert the isotope large layout breakpoint in pixel.<br />N.B. This is referring to the width of the isotope container, not to the window width.', 'uncode'), array( 'br' => array( ) ) ) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'isotope',
				) ,
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Breakpoint - Second step', 'uncode') ,
			'param_name' => 'screen_md',
			'value' => 600,
			'description' => wp_kses(__('Insert the isotope medium layout breakpoint in pixel.<br />N.B. This is referring to the width of the isotope container, not to the window width.', 'uncode'), array( 'br' => array( ) ) ) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'isotope',
				) ,
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Breakpoint - Third step', 'uncode') ,
			'param_name' => 'screen_sm',
			'value' => 480,
			'description' => wp_kses(__('Insert the isotope small layout breakpoint in pixel.<br />N.B. This is referring to the width of the isotope container, not to the window width.', 'uncode'), array( 'br' => array( ) ) ) ,
			'group' => esc_html__('Module', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'isotope',
				) ,
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Block layout", 'uncode') ,
			"param_name" => "single_text",
			"description" => esc_html__("Specify the text positioning inside the box.", 'uncode') ,
			"value" => array(
				esc_html__('Content overlay', 'uncode') => 'overlay',
				esc_html__('Content under image', 'uncode') => 'under'
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Width", 'uncode') ,
			"param_name" => "single_width",
			"description" => esc_html__("Specify the box width.", 'uncode') ,
			"value" => $units,
			"std" => "4",
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'isotope',
				) ,
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Height", 'uncode') ,
			"param_name" => "single_height",
			"description" => esc_html__("Specify the box height.", 'uncode') ,
			"value" => array(
				esc_html__("Default", 'uncode') => ""
			) + $units,
			"std" => "",
			'group' => esc_html__('Blocks', 'uncode') ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'isotope',
				) ,
			) ,
			'dependency' => array(
				'element' => 'style_preset',
				'value' => 'metro',
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Media ratio', 'uncode') ,
			'param_name' => 'images_size',
			'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode') ,
			"value" => array(
				esc_html__('Regular', 'uncode') => '',
				'1:1' => 'one-one',
				'2:1' => 'two-one',
				'3:2' => 'three-two',
				'4:3' => 'four-three',
				'10:3' => 'ten-three',
				'16:9' => 'sixteen-nine',
				'21:9' => 'twentyone-nine',
				'1:2' => 'one-two',
				'2:3' => 'two-three',
				'3:4' => 'three-four',
				'3:10' => 'three-ten',
				'9:16' => 'nine-sixteen',
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
			'dependency' => array(
				'element' => 'style_preset',
				'value' => 'masonry',
			) ,
			'admin_label' => true,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Background color", 'uncode') ,
			"param_name" => "single_back_color",
			"description" => esc_html__("Specify a background color for the box.", 'uncode') ,
			"value" => $uncode_colors,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Shape', 'uncode') ,
			'param_name' => 'single_shape',
			'value' => array(
				esc_html__('Select…', 'uncode') => '',
				esc_html__('Rounded', 'uncode') => 'round',
				esc_html__('Circular', 'uncode') => 'circle'
			) ,
			'description' => esc_html__('Specify one if you want to shape the block.', 'uncode') ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Skin", 'uncode') ,
			"param_name" => "single_style",
			"description" => esc_html__("Specify the skin inside the content box.", 'uncode') ,
			"value" => array(
				esc_html__('Light', 'uncode') => 'light',
				esc_html__('Dark', 'uncode') => 'dark'
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay color", 'uncode') ,
			"param_name" => "single_overlay_color",
			"description" => esc_html__("Specify a background color for the box.", 'uncode') ,
			"value" => $uncode_colors,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay coloration", 'uncode') ,
			"param_name" => "single_overlay_coloration",
			"description" => wp_kses(__("Specify the coloration style for the overlay.<br />N.B. For the gradient you can't customize the overlay color.", 'uncode'), array( 'br' => array( ) ) ) ,
			"value" => array(
				esc_html__('Fully colored', 'uncode') => '',
				esc_html__('Gradient top', 'uncode') => 'top_gradient',
				esc_html__('Gradient bottom', 'uncode') => 'bottom_gradient',
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Overlay opacity", 'uncode') ,
			"param_name" => "single_overlay_opacity",
			"min" => 1,
			"max" => 100,
			"step" => 1,
			"value" => 50,
			"description" => esc_html__("Set the overlay opacity.", 'uncode') ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay text visibility", 'uncode') ,
			"param_name" => "single_text_visible",
			"description" => esc_html__("Activate this to show the text as starting point.", 'uncode') ,
			"value" => array(
				esc_html__('Hidden', 'uncode') => 'no',
				esc_html__('Visible', 'uncode') => 'yes',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay text animation", 'uncode') ,
			"param_name" => "single_text_anim",
			"description" => esc_html__("Activate this to animate the text on mouse over.", 'uncode') ,
			"value" => array(
				esc_html__('Animated', 'uncode') => 'yes',
				esc_html__('Static', 'uncode') => 'no',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay text animation type", 'uncode') ,
			"param_name" => "single_text_anim_type",
			"description" => esc_html__("Specify the animation type.", 'uncode') ,
			"value" => array(
				esc_html__('Opacity', 'uncode') => '',
				esc_html__('Bottom to top', 'uncode') => 'btt',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
			'dependency' => array(
				'element' => 'single_text_anim',
				'value' => 'yes',
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay visibility", 'uncode') ,
			"param_name" => "single_overlay_visible",
			"description" => esc_html__("Activate this to show the overlay as starting point.", 'uncode') ,
			"value" => array(
				esc_html__('Hidden', 'uncode') => 'no',
				esc_html__('Visible', 'uncode') => 'yes',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay animation", 'uncode') ,
			"param_name" => "single_overlay_anim",
			"description" => esc_html__("Activate this to animate the overlay on mouse over.", 'uncode') ,
			"value" => array(
				esc_html__('Animated', 'uncode') => 'yes',
				esc_html__('Static', 'uncode') => 'no',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Image coloration", 'uncode') ,
			"param_name" => "single_image_coloration",
			"description" => esc_html__("Specify the image coloration mode.", 'uncode') ,
			"value" => array(
				esc_html__('Standard', 'uncode') => '',
				esc_html__('Desaturated', 'uncode') => 'desaturated',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Image coloration animation", 'uncode') ,
			"param_name" => "single_image_color_anim",
			"description" => esc_html__("Activate this to animate the image coloration on mouse over.", 'uncode') ,
			"value" => array(
				esc_html__('Static', 'uncode') => '',
				esc_html__('Animated', 'uncode') => 'yes',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Image animation", 'uncode') ,
			"param_name" => "single_image_anim",
			"description" => esc_html__("Activate this to animate the image on mouse over.", 'uncode') ,
			"value" => array(
				esc_html__('Animated', 'uncode') => 'yes',
				esc_html__('Static', 'uncode') => 'no',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text horizontal alignment", 'uncode') ,
			"param_name" => "single_h_align",
			"description" => esc_html__("Specify the horizontal alignment.", 'uncode') ,
			"value" => array(
				esc_html__('Left', 'uncode') => 'left',
				esc_html__('Center', 'uncode') => 'center',
				esc_html__('Right', 'uncode') => 'right',
				esc_html__('Justify', 'uncode') => 'justify'
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Content vertical position", 'uncode') ,
			"param_name" => "single_v_position",
			"description" => esc_html__("Specify the text vertical position.", 'uncode') ,
			"value" => array(
				esc_html__('Middle', 'uncode') => '',
				esc_html__('Top', 'uncode') => 'top',
				esc_html__('Bottom', 'uncode') => 'bottom'
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Content dimension reduced", 'uncode') ,
			"param_name" => "single_reduced",
			"description" => esc_html__("Specify the text reduction amount to shrink the overlay content dimension.", 'uncode') ,
			"value" => array(
				esc_html__('100%', 'uncode') => '',
				esc_html__('75%', 'uncode') => 'three_quarter',
				esc_html__('50%', 'uncode') => 'half',
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Content horizontal position", 'uncode') ,
			"param_name" => "single_h_position",
			"description" => esc_html__("Specify the text horizontal position.", 'uncode') ,
			"value" => array(
				esc_html__('Left', 'uncode') => 'left',
				esc_html__('Center', 'uncode') => 'center',
				esc_html__('Right', 'uncode') => 'right'
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
			'dependency' => array(
				'element' => 'single_reduced',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Padding around text", 'uncode') ,
			"param_name" => "single_padding",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the text padding", 'uncode') ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Reduce space between elements", 'uncode') ,
			"param_name" => "single_text_reduced",
			"description" => esc_html__("Activate this to have less space between all the text elements inside the box.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Multiple click areas", 'uncode') ,
			"param_name" => "single_elements_click",
			"description" => esc_html__("Activate this to make every single elements clickable instead of the whole block (when available).", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
			'dependency' => array(
				'element' => 'single_text',
				'value' => 'overlay',
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title text trasnform", 'uncode') ,
			"param_name" => "single_title_transform",
			"description" => esc_html__("Specify the title text transformation.", 'uncode') ,
			"value" => array(
				esc_html__('Default CSS', 'uncode') => '',
				esc_html__('Uppercase', 'uncode') => 'uppercase',
				esc_html__('Lowercase', 'uncode') => 'lowercase',
				esc_html__('Capitalize', 'uncode') => 'capitalize'
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title dimension", 'uncode') ,
			"param_name" => "single_title_dimension",
			"description" => esc_html__("Specify the title dimension.", 'uncode') ,
			"value" => $heading_size,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title font family", 'uncode') ,
			"param_name" => "single_title_family",
			"description" => esc_html__("Specify the title font family.", 'uncode') ,
			"value" => $heading_font,
			'std' => '',
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title font weight", 'uncode') ,
			"param_name" => "single_title_weight",
			"description" => esc_html__("Specify the title font weight.", 'uncode') ,
			"value" => $heading_weight,
			'std' => '',
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title line height", 'uncode') ,
			"param_name" => "single_title_height",
			"description" => esc_html__("Specify the title line height.", 'uncode') ,
			"value" => $heading_height,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title letter spacing", 'uncode') ,
			"param_name" => "single_title_space",
			"description" => esc_html__("Specify the title letter spacing.", 'uncode') ,
			"value" => $heading_space,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode') ,
			'param_name' => 'single_icon',
			'description' => esc_html__('Specify icon from library.', 'uncode') ,
			'value' => '',
			'settings' => array(
				'emptyIcon' => true,
				 // default true, display an "EMPTY" icon?
				'iconsPerPage' => 1100,
				 // default 100, how many icons per/page to display
				'type' => 'uncode'
			) ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Custom link', 'uncode') ,
			'param_name' => 'single_link',
			'description' => esc_html__('Enter the custom link for the item.', 'uncode') ,
			'group' => esc_html__('Blocks', 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shadow", 'uncode') ,
			"param_name" => "single_shadow",
			"description" => esc_html__("Activate this to have the shadow behind the block.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No border", 'uncode') ,
			"param_name" => "single_border",
			"description" => esc_html__("Activate this to remove the border around the block.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Blocks", 'uncode') ,
		) ,
		array_merge($add_css_animation, array(
			"group" => esc_html__("Blocks", 'uncode') ,
			"param_name" => 'single_css_animation'
		)) ,
		array_merge($add_animation_speed, array(
			"group" => esc_html__("Blocks", 'uncode') ,
			"param_name" => 'single_animation_speed',
			'dependency' => array(
				'element' => 'single_css_animation',
				'not_empty' => true
			)
		)) ,
		array_merge($add_animation_delay, array(
			"group" => esc_html__("Blocks", 'uncode') ,
			"param_name" => 'single_animation_delay',
			'dependency' => array(
				'element' => 'single_css_animation',
				'not_empty' => true
			)
		)) ,
		array(
			'type' => 'uncode_items',
			'heading' => '',
			'param_name' => 'items',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode') ,
			'group' => esc_html__('Single block', 'uncode') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => 'Skin',
			'param_name' => 'lbox_skin',
			'value' => array(
				esc_html__('Dark', 'uncode') => '',
				esc_html__('Light', 'uncode') => 'white',
			) ,
			'description' => esc_html__('Specify the lightbox skin color.', 'uncode') ,
			'group' => esc_html__('Lightbox', 'uncode') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => 'Direction',
			'param_name' => 'lbox_dir',
			'value' => array(
				esc_html__('Horizontal', 'uncode') => '',
				esc_html__('Vertical', 'uncode') => 'vertical',
			) ,
			'description' => esc_html__('Specify the lightbox sliding direction.', 'uncode') ,
			'group' => esc_html__('Lightbox', 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Title", 'uncode') ,
			"param_name" => "lbox_title",
			"description" => esc_html__("Activate this to add the media title.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Caption", 'uncode') ,
			"param_name" => "lbox_caption",
			"description" => esc_html__("Activate this to add the media caption.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Social", 'uncode') ,
			"param_name" => "lbox_social",
			"description" => esc_html__("Activate this for the social sharing buttons.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Deeplinking", 'uncode') ,
			"param_name" => "lbox_deep",
			"description" => esc_html__("Activate this for the deeplinking of every slide.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No thumbnails", 'uncode') ,
			"param_name" => "lbox_no_tmb",
			"description" => esc_html__("Activate this for not showing the thumbnails.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No arrows", 'uncode') ,
			"param_name" => "lbox_no_arrows",
			"description" => esc_html__("Activate this for not showing the navigation arrows.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Remove double tap", 'uncode') ,
			"param_name" => "no_double_tap",
			"description" => esc_html__("Remove the double tap action on mobile.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Mobile", 'uncode') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode') ,
			'group' => esc_html__('Extra', 'uncode')
		)
	)
));

/* Text Block
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Text Block', 'uncode') ,
	'base' => 'vc_column_text',
	'weight' => 98,
	'icon' => 'fa fa-font',
	'wrapper_class' => 'clearfix',
	'php_class_name' => 'uncode_generic_admin',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Basic block of text', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__('Text', 'uncode') ,
			'param_name' => 'content',
			'value' => wp_kses(__('<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'uncode'), array( 'p' => array()))
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Text lead", 'uncode') ,
			"param_name" => "text_lead",
			"description" => esc_html__("Transform the text to leading.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		) ,
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('Css', 'uncode') ,
			'param_name' => 'css',
			'group' => esc_html__('Custom', 'uncode')
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border color", 'uncode') ,
			"param_name" => "border_color",
			"description" => esc_html__("Specify a border color.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $uncode_colors_w_transp,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Border style", 'uncode') ,
			"param_name" => "border_style",
			"description" => esc_html__("Specify a border style.", 'uncode') ,
			"group" => esc_html__("Custom", 'uncode') ,
			"value" => $border_style,
		) ,
	) ,
	'js_view' => 'UncodeTextView'
));

/* Separator (Divider)
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Divider', 'uncode') ,
	'base' => 'vc_separator',
	'weight' => 82,
	'icon' => 'fa fa-arrows-h',
	'show_settings_on_create' => true,
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Horizontal divider', 'uncode') ,
	'params' => array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Color", 'uncode') ,
			"param_name" => "sep_color",
			"description" => esc_html__("Separator color.", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode') ,
			'value' => '',
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon position', 'uncode') ,
			'param_name' => 'icon_position',
			'value' => array(
				esc_html__('Center', 'uncode') => '',
				esc_html__('Left', 'uncode') => 'left',
				esc_html__('Right', 'uncode') => "right"
			) ,
			'description' => esc_html__('Specify title location.', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'uncode') ,
			'param_name' => 'type',
			'value' => getVcShared('separator styles') ,
			'description' => esc_html__('Separator style.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom width', 'uncode') ,
			'param_name' => 'el_width',
			'description' => esc_html__('Insert the custom value in % or px.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom thickness', 'uncode') ,
			'param_name' => 'el_height',
			'description' => esc_html__('Insert the custom value in em or px. This option can\'t be used with the separator with the icon.', 'uncode') ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Activate scroll to top', 'uncode') ,
			'param_name' => 'scroll_top',
			'description' => esc_html__('Activate if you want the scroll top function with the icon.', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true
			) ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'uncode') ,
			'param_name' => 'link',
			'description' => esc_html__('Separator link.', 'uncode') ,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true
			) ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

/* Message box
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Message Box', 'uncode') ,
	'base' => 'vc_message',
	'php_class_name' => 'uncode_message',
	'icon' => 'fa fa-info',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Notification element', 'uncode') ,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Message box type', 'uncode') ,
			'param_name' => 'message_color',
			'admin_label' => true,
			'value' => $uncode_colors,
			'description' => esc_html__('Specify message type.', 'uncode') ,
			'param_holder_class' => 'vc_message-type'
		) ,
		array(
			'type' => 'textarea_html',
			'class' => 'messagebox_text',
			'param_name' => 'content',
			'heading' => esc_html__('Message text', 'uncode') ,
			'value' => wp_kses(__('<p>I am message box. Click edit button to change this text.</p>', 'uncode'), array( 'p' => array()))
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	) ,
));

/* Single image */
vc_map(array(
	'name' => esc_html__('Single Media', 'uncode') ,
	'base' => 'vc_single_image',
	'icon' => 'fa fa-image',
	'weight' => 101,
	'php_class_name' => 'uncode_generic_admin',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Simple media item', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode')
		) ,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Media", 'uncode') ,
			"param_name" => "media",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode') ,
			"admin_label" => true
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Caption", 'uncode') ,
			"param_name" => "caption",
			"description" => 'Activate to have the caption under the image.',
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Lightbox', 'uncode') ,
			'param_name' => 'media_lightbox',
			'description' => esc_html__('Activate if you want to open the media in the lightbox.', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Poster', 'uncode') ,
			'param_name' => 'media_poster',
			'description' => esc_html__('Activate if you want to view the poster image instead (this is usefull for other media than images with the use of the lightbox).', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			)
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'uncode') ,
			'param_name' => 'media_link',
			'description' => esc_html__('Enter URL if you want this image to have a link.', 'uncode') ,
			'dependency' => array(
				'element' => 'media_link_large',
				'is_empty' => true,
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Width", 'uncode') ,
			"param_name" => "media_width_use_pixel",
			"description" => 'Set this value if you want to constrain the media width.',
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => '',
			"param_name" => "media_width_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 100,
			"description" => esc_html__("Set the media width with a percent value.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			'dependency' => array(
				'element' => 'media_width_use_pixel',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => '',
			'param_name' => 'media_width_pixel',
			'description' => esc_html__("Insert the media width in pixel.", 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
			'dependency' => array(
				'element' => 'media_width_use_pixel',
				'value' => 'yes'
			)
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Aspect ratio', 'uncode') ,
			'param_name' => 'media_ratio',
			'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode') ,
			"value" => array(
				esc_html__('Regular', 'uncode') => '',
				esc_html__('1:1', 'uncode') => 'one-one',
				esc_html__('4:3', 'uncode') => 'four-three',
				esc_html__('3:2', 'uncode') => 'three-two',
				esc_html__('16:9', 'uncode') => 'sixteen-nine',
				esc_html__('21:9', 'uncode') => 'twentyone-nine',
				esc_html__('3:4', 'uncode') => 'three-four',
				esc_html__('2:3', 'uncode') => 'two-three',
				esc_html__('9:16', 'uncode') => 'nine-sixteen',
			) ,
			'group' => esc_html__('Aspect', 'uncode') ,
			'admin_label' => true,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Alignment', 'uncode') ,
			'param_name' => 'alignment',
			'value' => array(
				esc_html__('Align left', 'uncode') => '',
				esc_html__('Align right', 'uncode') => 'right',
				esc_html__('Align center', 'uncode') => 'center'
			) ,
			'description' => esc_html__('Specify image alignment.', 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Shape', 'uncode') ,
			'param_name' => 'shape',
			'value' => array(
				esc_html__('Select…', 'uncode') => '',
				esc_html__('Rounded', 'uncode') => 'img-round',
				esc_html__('Circular', 'uncode') => 'img-circle'
			) ,
			'description' => esc_html__('Specify media shape.', 'uncode') ,
			"group" => esc_html__("Aspect", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Thumbnail border", 'uncode') ,
			"param_name" => "border",
			"description" => 'Activate to have a border around like a thumbnail.',
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shadow", 'uncode') ,
			"param_name" => "shadow",
			"description" => 'Activate to have a shadow.',
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Activate advanced preset", 'uncode') ,
			"param_name" => "advanced",
			"description" => 'Activate if you want to have advanced options.',
			"group" => esc_html__("Aspect", 'uncode') ,
			"value" => array(
				'' => 'yes'
			)
		) ,
		array(
			'type' => 'sorted_list',
			'heading' => esc_html__('Media', 'uncode') ,
			'param_name' => 'media_items',
			'description' => esc_html__('Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overridden on post to post basis.', 'uncode') ,
			'value' => 'media',
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			'options' => array(
				array(
					'media',
					esc_html__('Media', 'uncode') ,
					array(
						array(
							'original',
							esc_html__('Original', 'uncode')
						) ,
						array(
							'poster',
							esc_html__('Poster', 'uncode')
						)
					)
				) ,
				array(
					'icon',
					esc_html__('Icon', 'uncode') ,
				) ,
				array(
					'title',
					esc_html__('Title', 'uncode') ,
				) ,
				array(
					'caption',
					esc_html__('Caption', 'uncode') ,
				) ,
				array(
					'description',
					esc_html__('Description', 'uncode') ,
				) ,
				array(
					'spacer',
					esc_html__('Spacer', 'uncode') ,
					array(
						array(
							'half',
							esc_html__('0.5x', 'uncode')
						) ,
						array(
							'one',
							esc_html__('1x', 'uncode')
						) ,
						array(
							'two',
							esc_html__('2x', 'uncode')
						)
					)
				) ,
				array(
					'sep-one',
					esc_html__('Separator One', 'uncode') ,
					array(
						array(
							'full',
							esc_html__('Full width', 'uncode')
						) ,
						array(
							'reduced',
							esc_html__('Reduced width', 'uncode')
						)
					)
				) ,
				array(
					'sep-two',
					esc_html__('Separator Two', 'uncode') ,
					array(
						array(
							'full',
							esc_html__('Full width', 'uncode')
						) ,
						array(
							'reduced',
							esc_html__('Reduced width', 'uncode')
						)
					)
				) ,
				array(
					'team-social',
					esc_html__('Team socials', 'uncode') ,
				) ,
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Block layout", 'uncode') ,
			"param_name" => "media_text",
			"description" => esc_html__("Specify the text positioning inside the box.", 'uncode') ,
			"value" => array(
				esc_html__('Content overlay', 'uncode') => 'overlay',
				esc_html__('Content under image', 'uncode') => 'under'
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			'group' => esc_html__('Advanced', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Skin", 'uncode') ,
			"param_name" => "media_style",
			"description" => esc_html__("Specify the skin inside the content box.", 'uncode') ,
			"value" => array(
				esc_html__('Light', 'uncode') => 'light',
				esc_html__('Dark', 'uncode') => 'dark'
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			'group' => esc_html__('Advanced', 'uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Background color", 'uncode') ,
			"param_name" => "media_back_color",
			"description" => esc_html__("Specify a background color for the box.", 'uncode') ,
			"value" => $uncode_colors,
			'group' => esc_html__('Advanced', 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Overlay color", 'uncode') ,
			"param_name" => "media_overlay_color",
			"description" => esc_html__("Specify a background color for the box.", 'uncode') ,
			"value" => $uncode_colors,
			'group' => esc_html__('Advanced', 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay coloration", 'uncode') ,
			"param_name" => "media_overlay_coloration",
			"description" => wp_kses(__("Specify the coloration style for the overlay.<br />N.B. For the gradient you can't customize the overlay color.", 'uncode'), array( 'br' => array( ) ) ) ,
			"value" => array(
				esc_html__('Fully colored', 'uncode') => '',
				esc_html__('Gradient top', 'uncode') => 'top_gradient',
				esc_html__('Gradient bottom', 'uncode') => 'bottom_gradient',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			'group' => esc_html__('Advanced', 'uncode') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Overlay opacity", 'uncode') ,
			"param_name" => "media_overlay_opacity",
			"min" => 1,
			"max" => 100,
			"step" => 1,
			"value" => 50,
			"description" => esc_html__("Set the overlay opacity.", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			'group' => esc_html__('Advanced', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay text visibility", 'uncode') ,
			"param_name" => "media_text_visible",
			"description" => esc_html__("Activate this to show the text as starting point.", 'uncode') ,
			"value" => array(
				esc_html__('Hidden', 'uncode') => 'no',
				esc_html__('Visible', 'uncode') => 'yes',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay text animation", 'uncode') ,
			"param_name" => "media_text_anim",
			"description" => esc_html__("Activate this to animate the text on mouse over.", 'uncode') ,
			"value" => array(
				esc_html__('Animated', 'uncode') => 'yes',
				esc_html__('Static', 'uncode') => 'no',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay text animation type", 'uncode') ,
			"param_name" => "media_text_anim_type",
			"description" => esc_html__("Specify the animation type.", 'uncode') ,
			"value" => array(
				esc_html__('Opacity', 'uncode') => '',
				esc_html__('Bottom to top', 'uncode') => 'btt',
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'media_text_anim',
				'value' => 'yes',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay visibility", 'uncode') ,
			"param_name" => "media_overlay_visible",
			"description" => esc_html__("Activate this to show the overlay as starting point.", 'uncode') ,
			"value" => array(
				esc_html__('Hidden', 'uncode') => 'no',
				esc_html__('Visible', 'uncode') => 'yes',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Overlay animation", 'uncode') ,
			"param_name" => "media_overlay_anim",
			"description" => esc_html__("Activate this to animate the overlay on mouse over.", 'uncode') ,
			"value" => array(
				esc_html__('Animated', 'uncode') => 'yes',
				esc_html__('Static', 'uncode') => 'no',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Image coloration", 'uncode') ,
			"param_name" => "media_image_coloration",
			"description" => esc_html__("Specify the image coloration mode.", 'uncode') ,
			"value" => array(
				esc_html__('Standard', 'uncode') => '',
				esc_html__('Desaturated', 'uncode') => 'desaturated',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Image coloration animation", 'uncode') ,
			"param_name" => "media_image_color_anim",
			"description" => esc_html__("Activate this to animate the image coloration on mouse over.", 'uncode') ,
			"value" => array(
				esc_html__('Static', 'uncode') => '',
				esc_html__('Animated', 'uncode') => 'yes',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Image animation", 'uncode') ,
			"param_name" => "media_image_anim",
			"description" => esc_html__("Activate this to animate the image on mouse over.", 'uncode') ,
			"value" => array(
				esc_html__('Animated', 'uncode') => 'yes',
				esc_html__('Static', 'uncode') => 'no',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text horizontal alignment", 'uncode') ,
			"param_name" => "media_h_align",
			"description" => esc_html__("Specify the horizontal alignment.", 'uncode') ,
			"value" => array(
				esc_html__('Left', 'uncode') => 'left',
				esc_html__('Center', 'uncode') => 'center',
				esc_html__('Right', 'uncode') => 'right',
				esc_html__('Justify', 'uncode') => 'justify'
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			'group' => esc_html__('Advanced', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Content vertical position", 'uncode') ,
			"param_name" => "media_v_position",
			"description" => esc_html__("Specify the text vertical position.", 'uncode') ,
			"value" => array(
				esc_html__('Middle', 'uncode') => '',
				esc_html__('Top', 'uncode') => 'top',
				esc_html__('Bottom', 'uncode') => 'bottom'
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			'group' => esc_html__('Advanced', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Content dimension reduced", 'uncode') ,
			"param_name" => "media_reduced",
			"description" => esc_html__("Specify the text reduction amount to shrink the overlay content dimension.", 'uncode') ,
			"value" => array(
				esc_html__('100%', 'uncode') => '',
				esc_html__('75%', 'uncode') => 'three_quarter',
				esc_html__('50%', 'uncode') => 'half',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Content horizontal position", 'uncode') ,
			"param_name" => "media_h_position",
			"description" => esc_html__("Specify the text horizontal position.", 'uncode') ,
			"value" => array(
				esc_html__('Left', 'uncode') => 'left',
				esc_html__('Center', 'uncode') => 'center',
				esc_html__('Right', 'uncode') => 'right'
			) ,
			'group' => esc_html__('Advanced', 'uncode') ,
			'dependency' => array(
				'element' => 'media_reduced',
				'not_empty' => true,
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Padding around text", 'uncode') ,
			"param_name" => "media_padding",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the text padding", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Reduce space between elements", 'uncode') ,
			"param_name" => "media_text_reduced",
			"description" => esc_html__("Activate this to have less space between all the text elements inside the box.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Multiple click areas", 'uncode') ,
			"param_name" => "media_elements_click",
			"description" => esc_html__("Activate this to make every single elements clickable instead of the whole block (when available).", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'media_text',
				'value' => 'overlay',
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title text transform", 'uncode') ,
			"param_name" => "media_title_transform",
			"description" => esc_html__("Specify the title text transformation.", 'uncode') ,
			"value" => array(
				esc_html__('Default CSS', 'uncode') => '',
				esc_html__('Uppercase', 'uncode') => 'uppercase',
				esc_html__('Lowercase', 'uncode') => 'lowercase',
				esc_html__('Capitalize', 'uncode') => 'capitalize'
			) ,
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title dimension", 'uncode') ,
			"param_name" => "media_title_dimension",
			"description" => esc_html__("Specify the title dimension.", 'uncode') ,
			"value" => $heading_size,
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title font family", 'uncode') ,
			"param_name" => "media_title_family",
			"description" => esc_html__("Specify the title font family.", 'uncode') ,
			"value" => $heading_font,
			'std' => '',
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title font weight", 'uncode') ,
			"param_name" => "media_title_weight",
			"description" => esc_html__("Specify the title font weight.", 'uncode') ,
			"value" =>$heading_weight,
			'std' => '',
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title line height", 'uncode') ,
			"param_name" => "media_title_height",
			"description" => esc_html__("Specify the title line height.", 'uncode') ,
			"value" => $heading_height,
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title letter spacing", 'uncode') ,
			"param_name" => "media_title_space",
			"description" => esc_html__("Specify the title letter spacing.", 'uncode') ,
			"value" => $heading_space,
			"group" => esc_html__("Advanced", 'uncode') ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode') ,
			'param_name' => 'media_icon',
			'description' => esc_html__('Specify icon from library.', 'uncode') ,
			'value' => '',
			'settings' => array(
				'emptyIcon' => true,
				 // default true, display an "EMPTY" icon?
				'iconsPerPage' => 1100,
				 // default 100, how many icons per/page to display
				'type' => 'uncode'
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes'
			) ,
			'group' => esc_html__('Advanced', 'uncode') ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'dropdown',
			'heading' => 'Skin',
			'param_name' => 'lbox_skin',
			'value' => array(
				esc_html__('Dark', 'uncode') => '',
				esc_html__('Light', 'uncode') => 'white',
			) ,
			'description' => esc_html__('Specify the lightbox skin color.', 'uncode') ,
			'group' => esc_html__('Lightbox', 'uncode') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => 'Direction',
			'param_name' => 'lbox_dir',
			'value' => array(
				esc_html__('Horizontal', 'uncode') => '',
				esc_html__('Vertical', 'uncode') => 'vertical',
			) ,
			'description' => esc_html__('Specify the lightbox sliding direction.', 'uncode') ,
			'group' => esc_html__('Lightbox', 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Title", 'uncode') ,
			"param_name" => "lbox_title",
			"description" => esc_html__("Activate this to add the media title.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Caption", 'uncode') ,
			"param_name" => "lbox_caption",
			"description" => esc_html__("Activate this to add the media caption.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Social", 'uncode') ,
			"param_name" => "lbox_social",
			"description" => esc_html__("Activate this for the social sharing buttons.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Deeplinking", 'uncode') ,
			"param_name" => "lbox_deep",
			"description" => esc_html__("Activate this for the deeplinking of every slide.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No thumbnails", 'uncode') ,
			"param_name" => "lbox_no_tmb",
			"description" => esc_html__("Activate this for not showing the thumbnails.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No arrows", 'uncode') ,
			"param_name" => "lbox_no_arrows",
			"description" => esc_html__("Activate this for not showing the navigation arrows.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Connect to other media in page", 'uncode') ,
			"param_name" => "lbox_connected",
			"description" => esc_html__("Activate this to connect the lightbox with other medias in the same page with this option active.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Remove double tap", 'uncode') ,
			"param_name" => "no_double_tap",
			"description" => esc_html__("Remove the double tap action on mobile.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'advanced',
				'value' => 'yes',
			) ,
			"group" => esc_html__("Mobile", 'uncode') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			"group" => esc_html__("Extra", 'uncode') ,
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		) ,
	)
));

/* Tabs
 ---------------------------------------------------------- */
$tab_id_1 = time() . '-1-' . rand(0, 100);
$tab_id_2 = time() . '-2-' . rand(0, 100);
vc_map(array(
	"name" => esc_html__('Tabs', 'uncode') ,
	'base' => 'vc_tabs',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'fa fa-folder',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Tabbed contents', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode')
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Vertical tabs', 'uncode') ,
			'param_name' => 'vertical',
			'description' => esc_html__('Specify checkbox to allow all sections to be collapsible.', 'uncode') ,
			'value' => array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	) ,
	'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>',
	'default_content' => '
[vc_tab title="' . esc_html__('Tab 1', 'uncode') . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . esc_html__('Tab 2', 'uncode') . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
	'js_view' => 'VcTabsView'
));

vc_map(array(
	'name' => esc_html__('Tab', 'uncode') ,
	'base' => 'vc_tab',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Tab title.', 'uncode')
		) ,
		array(
			'type' => 'tab_id',
			'heading' => esc_html__('Tab ID', 'uncode') ,
			'param_name' => "tab_id"
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Remove top margin', 'uncode') ,
			'param_name' => 'no_margin',
			'description' => esc_html__('Activate this to remove the top margin.', 'uncode') ,
			'value' => array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			)
		) ,
	) ,
	'js_view' => 'VcTabView'
));

/* Accordion block
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Accordion', 'uncode') ,
	'base' => 'vc_accordion',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'fa fa-indent',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Collapsible panels', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Active section', 'uncode') ,
			'param_name' => 'active_tab',
			'description' => esc_html__('Enter section number to be active on load.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	) ,
	'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . esc_html__('Add section', 'uncode') . '"><span class="vc_icon"></span> <span class="tab-label">' . esc_html__('Add section', 'uncode') . '</span></a>
</div>
',
	'default_content' => '
    [vc_accordion_tab title="' . esc_html__('Section 1', 'uncode') . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . esc_html__('Section 2', 'uncode') . '"][/vc_accordion_tab]
',
	'js_view' => 'VcAccordionView'
));
vc_map(array(
	'name' => esc_html__('Section', 'uncode') ,
	'base' => 'vc_accordion_tab',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Accordion section title.', 'uncode')
		) ,
	) ,
	'js_view' => 'VcAccordionTabView'
));

/* Widgetised sidebar
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Widgetised Sidebar', 'uncode') ,
	'base' => 'vc_widget_sidebar',
	'weight' => 70,
	'class' => 'wpb_widget_sidebar_widget',
	'icon' => 'fa fa-tags',
	'category' => esc_html__('Structure', 'uncode') ,
	'description' => esc_html__('Place widgetised sidebar', 'uncode') ,
	'params' => array(
		array(
			'type' => 'widgetised_sidebars',
			'heading' => esc_html__('Sidebar', 'uncode') ,
			'param_name' => 'sidebar_id',
			'description' => esc_html__('Specify which widget area output.', 'uncode'),
			'admin_label' => true,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

/* Button
 ---------------------------------------------------------- */
$icons_arr = array(
	esc_html__('None', 'uncode') => 'none',
	esc_html__('Address book icon', 'uncode') => 'wpb_address_book',
	esc_html__('Alarm clock icon', 'uncode') => 'wpb_alarm_clock',
	esc_html__('Anchor icon', 'uncode') => 'wpb_anchor',
	esc_html__('Application Image icon', 'uncode') => 'wpb_application_image',
	esc_html__('Arrow icon', 'uncode') => 'wpb_arrow',
	esc_html__('Asterisk icon', 'uncode') => 'wpb_asterisk',
	esc_html__('Hammer icon', 'uncode') => 'wpb_hammer',
	esc_html__('Balloon icon', 'uncode') => 'wpb_balloon',
	esc_html__('Balloon Buzz icon', 'uncode') => 'wpb_balloon_buzz',
	esc_html__('Balloon Facebook icon', 'uncode') => 'wpb_balloon_facebook',
	esc_html__('Balloon Twitter icon', 'uncode') => 'wpb_balloon_twitter',
	esc_html__('Battery icon', 'uncode') => 'wpb_battery',
	esc_html__('Binocular icon', 'uncode') => 'wpb_binocular',
	esc_html__('Document Excel icon', 'uncode') => 'wpb_document_excel',
	esc_html__('Document Image icon', 'uncode') => 'wpb_document_image',
	esc_html__('Document Music icon', 'uncode') => 'wpb_document_music',
	esc_html__('Document Office icon', 'uncode') => 'wpb_document_office',
	esc_html__('Document PDF icon', 'uncode') => 'wpb_document_pdf',
	esc_html__('Document Powerpoint icon', 'uncode') => 'wpb_document_powerpoint',
	esc_html__('Document Word icon', 'uncode') => 'wpb_document_word',
	esc_html__('Bookmark icon', 'uncode') => 'wpb_bookmark',
	esc_html__('Camcorder icon', 'uncode') => 'wpb_camcorder',
	esc_html__('Camera icon', 'uncode') => 'wpb_camera',
	esc_html__('Chart icon', 'uncode') => 'wpb_chart',
	esc_html__('Chart pie icon', 'uncode') => 'wpb_chart_pie',
	esc_html__('Clock icon', 'uncode') => 'wpb_clock',
	esc_html__('Fire icon', 'uncode') => 'wpb_fire',
	esc_html__('Heart icon', 'uncode') => 'wpb_heart',
	esc_html__('Mail icon', 'uncode') => 'wpb_mail',
	esc_html__('Play icon', 'uncode') => 'wpb_play',
	esc_html__('Shield icon', 'uncode') => 'wpb_shield',
	esc_html__('Video icon', 'uncode') => "wpb_video"
);

vc_map(array(
	'name' => esc_html__('Button', 'uncode') ,
	'base' => 'vc_button',
	'weight' => 97,
	'icon' => 'fa fa-external-link',
	'php_class_name' => 'uncode_generic_admin',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Button element', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text', 'uncode') ,
			'admin_label' => true,
			'param_name' => 'content',
			'value' => esc_html__('Text on the button', 'uncode') ,
			'description' => esc_html__('Text on the button.', 'uncode')
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'uncode') ,
			'param_name' => 'link',
			'description' => esc_html__('Button link.', 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Button color", 'uncode') ,
			"param_name" => "button_color",
			"description" => esc_html__("Specify button color.", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Size', 'uncode') ,
			'param_name' => 'size',
			'value' => $size_arr,
			'admin_label' => true,
			'description' => esc_html__('Button size.', 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Shape", 'uncode') ,
			"param_name" => "radius",
			"description" => esc_html__("You can shape the button with the corners round, squared or circle.", 'uncode') ,
			"value" => array(
				esc_html__('Default', 'uncode') => '',
				esc_html__('Round', 'uncode') => 'btn-round',
				esc_html__('Circle', 'uncode') => 'btn-circle',
				esc_html__('Square', 'uncode') => 'btn-square'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Border animation", 'uncode') ,
			"param_name" => "border_animation",
			"description" => esc_html__("Specify a button border animation.", 'uncode') ,
			"value" => array(
				esc_html__('None', 'uncode') => '',
				esc_html__('Ripple Out', 'uncode') => 'btn-ripple-out',
				esc_html__('Ripple In', 'uncode') => 'btn-ripple-in',
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Fluid', 'uncode') ,
			'param_name' => 'wide',
			'description' => esc_html__('Fluid buttons has 100% width.', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			)
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Fixed width", 'uncode') ,
			"param_name" => "width",
			"description" => esc_html__("Add a fixed width in pixel.", 'uncode') ,
			'dependency' => array(
				'element' => 'wide',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Use skin text color', 'uncode') ,
			'param_name' => 'text_skin',
			'description' => esc_html__("Keep the text color as the skin. NB. This option is only available when the button color is chosen.", 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			),
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Outlined', 'uncode') ,
			'param_name' => 'outline',
			'description' => esc_html__("Outlined buttons doesn't have a full background color.", 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Shadow', 'uncode') ,
			'param_name' => 'shadow',
			'description' => esc_html__('Button shadow.', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Italic text', 'uncode') ,
			'param_name' => 'Italic',
			'description' => esc_html__('Button with italic text style.', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			)
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode') ,
			'settings' => array(
				'emptyIcon' => true,
				 // default true, display an "EMPTY" icon?
				'iconsPerPage' => 1100,
				 // default 100, how many icons per/page to display
				'type' => 'uncode'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Icon position", 'uncode') ,
			"param_name" => "icon_position",
			"description" => esc_html__("Choose the position of the icon.", 'uncode') ,
			"value" => array(
				esc_html__('Left', 'uncode') => 'left',
				esc_html__('Right', 'uncode') => 'right',
			) ,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout display', 'uncode') ,
			'param_name' => 'display',
			'description' => esc_html__('Specify the display mode.', 'uncode') ,
			"value" => array(
				esc_html__('Block', 'uncode') => '',
				esc_html__('Inline', 'uncode') => 'inline',
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Margin top', 'uncode') ,
			'param_name' => 'top_margin',
			'description' => esc_html__('Activate to add the top margin.', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'display',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Rel attribute', 'uncode') ,
			'param_name' => 'rel',
			'description' => wp_kses(__('Here you can add value for the rel attribute.<br>Example values: <b%value>nofollow</b>, <b%value>lightbox</b>.', 'uncode'), array( 'br' => array( ),'b' => array( ) ) )
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('onClick', 'uncode') ,
			'param_name' => 'onclick',
			'description' => esc_html__('Advanced JavaScript code for onClick action.', 'uncode')
		) ,
		array(
			'type' => 'media_element',
			'heading' => esc_html__('Media lightbox', 'uncode') ,
			'param_name' => 'media_lightbox',
			'description' => esc_html__('Specify a media from the lightbox.', 'uncode') ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'dropdown',
			'heading' => 'Skin',
			'param_name' => 'lbox_skin',
			'value' => array(
				esc_html__('Dark', 'uncode') => '',
				esc_html__('Light', 'uncode') => 'white',
			) ,
			'description' => esc_html__('Specify the lightbox skin color.', 'uncode') ,
			'group' => esc_html__('Lightbox', 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'dropdown',
			'heading' => 'Direction',
			'param_name' => 'lbox_dir',
			'value' => array(
				esc_html__('Horizontal', 'uncode') => '',
				esc_html__('Vertical', 'uncode') => 'vertical',
			) ,
			'description' => esc_html__('Specify the lightbox sliding direction.', 'uncode') ,
			'group' => esc_html__('Lightbox', 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Title", 'uncode') ,
			"param_name" => "lbox_title",
			"description" => esc_html__("Activate this to add the media title.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Caption", 'uncode') ,
			"param_name" => "lbox_caption",
			"description" => esc_html__("Activate this to add the media caption.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Social", 'uncode') ,
			"param_name" => "lbox_social",
			"description" => esc_html__("Activate this for the social sharing buttons.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Deeplinking", 'uncode') ,
			"param_name" => "lbox_deep",
			"description" => esc_html__("Activate this for the deeplinking of every slide.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No thumbnails", 'uncode') ,
			"param_name" => "lbox_no_tmb",
			"description" => esc_html__("Activate this for not showing the thumbnails.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No arrows", 'uncode') ,
			"param_name" => "lbox_no_arrows",
			"description" => esc_html__("Activate this for not showing the navigation arrows.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Connect to other media in page", 'uncode') ,
			"param_name" => "lbox_connected",
			"description" => esc_html__("Activate this to connect the lightbox with other medias in the same page with this option active.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode') ,
			'dependency' => array(
				'element' => 'media_lightbox',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'group' => esc_html__('Extra', 'uncode') ,
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	) ,
	'js_view' => 'VcButtonView'
));

/* Google maps element
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Google Maps', 'uncode') ,
	'base' => 'vc_gmaps',
	'weight' => 85,
	'icon' => 'fa fa-map-marker',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Map block', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Latitude, Longitude', 'uncode') ,
			'param_name' => 'latlon',
			'description' => sprintf(wp_kses(__('To extract the Latitude and Longitude of your address, follow the instructions %s. 1) Use the directions under the section "Get the coordinates of a place" 2) Copy the coordinates 3) Paste the coordinates in the field with the "comma" sign.', 'uncode'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) , '<a href="https://support.google.com/maps/answer/18539?source=gsearch&hl=en" target="_blank">here</a>')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Map height', 'uncode') ,
			'param_name' => 'size',
			'admin_label' => true,
			'description' => esc_html__('Enter map height in pixels. Example: 200 or leave it empty to make map responsive (in this case you need to declare a minimun height for the row and the column equal height or expanded).', 'uncode')
		) ,
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__('Address', 'uncode') ,
			'param_name' => 'address',
			'description' => esc_html__('Insert here the address in case you want it to be display on the bottom of the map.', 'uncode') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Map color', 'uncode') ,
			'param_name' => 'map_color',
			'value' => $uncode_colors,
			'description' => esc_html__('Specify the map base color.', 'uncode') ,
			//'admin_label' => true,
			'param_holder_class' => 'vc_colored-dropdown'
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('UI color', 'uncode') ,
			'param_name' => 'ui_color',
			'value' => $uncode_colors,
			'description' => esc_html__('Specify the UI color.', 'uncode') ,
			//'admin_label' => true,
			'param_holder_class' => 'vc_colored-dropdown'
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Zoom", 'uncode') ,
			"param_name" => "zoom",
			"min" => 0,
			"max" => 19,
			"step" => 1,
			"value" => 14,
			"description" => esc_html__("Set map zoom level.", 'uncode') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Saturation", 'uncode') ,
			"param_name" => "map_saturation",
			"min" => - 100,
			"max" => 100,
			"step" => 1,
			"value" => - 20,
			"description" => esc_html__("Set map color saturation.", 'uncode') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Brightness", 'uncode') ,
			"param_name" => "map_brightness",
			"min" => - 100,
			"max" => 100,
			"step" => 1,
			"value" => 5,
			"description" => esc_html__("Set map color brightness.", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile no draggable", 'uncode') ,
			"param_name" => "mobile_no_drag",
			"description" => esc_html__("Deactivate the drag function on mobile devices.", 'uncode') ,
			'group' => esc_html__('Mobile', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'group' => esc_html__('Extra', 'uncode') ,
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

/* Raw HTML
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Raw HTML', 'uncode') ,
	'base' => 'vc_raw_html',
	'icon' => 'fa fa-code',
	'category' => esc_html__('Structure', 'uncode') ,
	'wrapper_class' => 'clearfix',
	'description' => esc_html__('Output raw html code', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textarea_raw_html',
			'holder' => 'div',
			'heading' => esc_html__('Raw HTML', 'uncode') ,
			'param_name' => 'content',
			'value' => base64_encode('<p>I am raw html block.<br/>Click edit button to change this html</p>') ,
			'description' => esc_html__('Enter your HTML content.', 'uncode')
		) ,
	)
));

/* Raw JS
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Raw JS', 'uncode') ,
	'base' => 'vc_raw_js',
	'icon' => 'fa fa-code',
	'category' => esc_html__('Structure', 'uncode') ,
	'wrapper_class' => 'clearfix',
	'description' => esc_html__('Output raw JavaScript code', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textarea_raw_html',
			'holder' => 'div',
			'heading' => esc_html__('Raw js', 'uncode') ,
			'param_name' => 'content',
			'value' => esc_html__(base64_encode('<script type="text/javascript"> alert("Enter your js here!" ); </script>') , 'uncode') ,
			'description' => esc_html__('Enter your JS code.', 'uncode')
		) ,
	)
));

/* Flickr
 ---------------------------------------------------------- */
vc_map(array(
	'base' => 'vc_flickr',
	'name' => esc_html__('Flickr Widget', 'uncode') ,
	'icon' => 'fa fa-flickr',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Image feed from Flickr', 'uncode') ,
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Flickr ID', 'uncode') ,
			'param_name' => 'flickr_id',
			'admin_label' => true,
			'description' => sprintf(wp_kses(__('To find your flickID visit %s.', 'uncode'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) , '<a href="http://idgettr.com/" target="_blank">idGettr</a>')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Number of photos', 'uncode') ,
			'param_name' => 'count',
			'value' => array(
				9,
				8,
				7,
				6,
				5,
				4,
				3,
				2,
				1
			) ,
			'description' => esc_html__('Number of photos.', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Type', 'uncode') ,
			'param_name' => 'type',
			'value' => array(
				esc_html__('User', 'uncode') => 'user',
				esc_html__('Group', 'uncode') => 'group'
			) ,
			'description' => esc_html__('Photo stream type.', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Display', 'uncode') ,
			'param_name' => 'display',
			'value' => array(
				esc_html__('Latest', 'uncode') => 'latest',
				esc_html__('Random', 'uncode') => 'random'
			) ,
			'description' => esc_html__('Photo order.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

/**
 * Pie chart
 */
vc_map(array(
	'name' => esc_html__('Pie chart', 'vc_extend') ,
	'base' => 'vc_pie',
	'class' => '',
	'icon' => 'fa fa-pie-chart',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Animated pie chart', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode') ,
			'admin_label' => true
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Pie value', 'uncode') ,
			'param_name' => 'value',
			'description' => esc_html__('Input graph value here. Choose range between 0 and 100.', 'uncode') ,
			'value' => '50',
			'admin_label' => true
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Pie label value', 'uncode') ,
			'param_name' => 'label_value',
			'description' => esc_html__('Input integer value for label. If empty "Pie value" will be used.', 'uncode') ,
			'value' => ''
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Units', 'uncode') ,
			'param_name' => 'units',
			'description' => esc_html__('Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'uncode')
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Circle thickness", 'uncode') ,
			"param_name" => "arc_width",
			"min" => 1,
			"max" => 30,
			"step" => 1,
			"value" => 5,
			"description" => esc_html__("Set the circle thickness.", 'uncode') ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode') ,
			'value' => '',
			'admin_label' => true,
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Bar color', 'uncode') ,
			'param_name' => 'bar_color',
			'value' => $uncode_colors,
			'description' => esc_html__('Specify pie chart color.', 'uncode') ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Coloring icon', 'uncode') ,
			'param_name' => 'col_icon',
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			)
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		) ,
	)
));

/* Graph
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Progress Bar', 'uncode') ,
	'base' => 'vc_progress_bar',
	'icon' => 'fa fa-tasks',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Animated progress bar', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode')
		) ,
		array(
			'type' => 'param_group',
			'heading' => esc_html__('Graphic values', 'uncode') ,
			'param_name' => 'values',
			'description' => esc_html__( 'Enter values for graph - value, title and color.', 'uncode' ),
			'value' => urlencode( json_encode( array(
				array(
					'label' => esc_html__( 'Development', 'uncode' ),
					'value' => '90',
				),
				array(
					'label' => esc_html__( 'Design', 'uncode' ),
					'value' => '80',
				),
				array(
					'label' => esc_html__( 'Marketing', 'uncode' ),
					'value' => '70',
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label', 'uncode' ),
					'param_name' => 'label',
					'description' => esc_html__( 'Enter text used as title of bar.', 'uncode' ),
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Value', 'uncode' ),
					'param_name' => 'value',
					'description' => esc_html__( 'Enter value of bar.', 'uncode' ),
					'admin_label' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Bar color', 'uncode') ,
					'param_name' => 'bar_color',
					'value' => $flat_uncode_colors,
					'admin_label' => true,
					'description' => esc_html__('Specify bar color.', 'uncode') ,
				) ,
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Background color', 'uncode') ,
					'param_name' => 'back_color',
					'value' => $flat_uncode_colors,
					'admin_label' => true,
					'description' => esc_html__('Specify bar background color.', 'uncode') ,
				) ,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Units', 'uncode') ,
			'param_name' => 'units',
			'description' => esc_html__('Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'uncode')
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

/* Support for 3rd Party plugins
 ---------------------------------------------------------- */

// Contact form 7 plugin
include_once (ABSPATH . 'wp-admin/includes/plugin.php');

// Require plugin.php to use is_plugin_active() below
if (is_plugin_active('contact-form-7/wp-contact-form-7.php'))
{
	global $wpdb;
	$cf7 = $wpdb->get_results("
  SELECT ID, post_title
  FROM $wpdb->posts
  WHERE post_type = 'wpcf7_contact_form'
  ");
	$contact_forms = array(esc_html__('Select a form…','uncode') => 0);
	if ($cf7)
	{
		foreach ($cf7 as $cform)
		{
			$contact_forms[$cform->post_title] = $cform->ID;
		}
	}
	else
	{
		$contact_forms[esc_html__('No contact forms found', 'uncode') ] = 0;
	}
	vc_map(array(
		'base' => 'contact-form-7',
		'name' => esc_html__('Contact Form 7', 'uncode') ,
		'icon' => 'fa fa-envelope',
		'category' => esc_html__('Content', 'uncode') ,
		'description' => esc_html__('Place Contact Form7', 'uncode') ,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Form title', 'uncode') ,
				'param_name' => 'title',
				'admin_label' => true,
				'description' => esc_html__('What text use as form title. Leave blank if no title is needed.', 'uncode')
			) ,
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Specify contact form', 'uncode') ,
				'param_name' => 'id',
				'value' => $contact_forms,
				'description' => esc_html__('Choose previously created contact form from the drop down list.', 'uncode')
			),
			$add_css_animation,
			$add_animation_speed,
			$add_animation_delay,
		)
	));
}

// if contact form7 plugin active

/* WordPress default Widgets (Appearance->Widgets)
 ---------------------------------------------------------- */
vc_map(array(
	'name' => 'WP ' . esc_html__("Search", 'uncode') ,
	'base' => 'vc_wp_search',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('A search form for your site', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Live search', 'uncode') ,
			'param_name' => 'live_search',
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('Meta', 'uncode') ,
	'base' => 'vc_wp_meta',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('Log in/out, admin, feed and WordPress links', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('Recent Comments', 'uncode') ,
	'base' => 'vc_wp_recentcomments',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('The most recent comments', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of comments to show', 'uncode') ,
			'param_name' => 'number',
			'admin_label' => true
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('Calendar', 'uncode') ,
	'base' => 'vc_wp_calendar',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('A calendar of your sites posts', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('Pages', 'uncode') ,
	'base' => 'vc_wp_pages',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('Your sites WordPress Pages', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sort by', 'uncode') ,
			'param_name' => 'sortby',
			'value' => array(
				esc_html__('Page title', 'uncode') => 'post_title',
				esc_html__('Page order', 'uncode') => 'menu_order',
				esc_html__('Page ID', 'uncode') => 'ID'
			) ,
			'admin_label' => true
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Exclude', 'uncode') ,
			'param_name' => 'exclude',
			'description' => esc_html__('Page IDs, separated by commas.', 'uncode') ,
			'admin_label' => true
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

$tag_taxonomies = array();
foreach (get_taxonomies() as $taxonomy)
{
	$tax = get_taxonomy($taxonomy);
	if (!$tax->show_tagcloud || empty($tax->labels->name))
	{
		continue;
	}
	$tag_taxonomies[$tax->labels->name] = esc_attr($taxonomy);
}
vc_map(array(
	'name' => 'WP ' . esc_html__('Tag Cloud', 'uncode') ,
	'base' => 'vc_wp_tagcloud',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('Your most used tags in cloud format', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Taxonomy', 'uncode') ,
			'param_name' => 'taxonomy',
			'value' => $tag_taxonomies,
			'admin_label' => true
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

$custom_menus = array(esc_html__('Select…','uncode') => '');
$menus = get_terms('nav_menu', array(
	'hide_empty' => false
));
if (is_array($menus))
{
	foreach ($menus as $single_menu)
	{
		$custom_menus[$single_menu->name] = $single_menu->term_id;
	}
}
vc_map(array(
	'name' => 'WP ' . esc_html__("Custom Menu", 'uncode') ,
	'base' => 'vc_wp_custommenu',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('Use this widget to add one of your custom menus as a widget', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Menu', 'uncode') ,
			'param_name' => 'nav_menu',
			'value' => $custom_menus,
			'description' => empty($custom_menus) ? esc_html__('Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'uncode') : esc_html__('Specify menu', 'uncode') ,
			'admin_label' => true
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Horizontal menu', 'uncode') ,
			'param_name' => 'nav_menu_horizontal',
			'value' => array(
				esc_html__('Yes, please', 'uncode') => true
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('Text', 'uncode') ,
	'base' => 'vc_wp_text',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('Arbitrary text or HTML', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Text', 'uncode') ,
			'param_name' => 'content',
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('Recent Posts', 'uncode') ,
	'base' => 'vc_wp_posts',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('The most recent posts on your site', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of posts to show', 'uncode') ,
			'param_name' => 'number',
			'admin_label' => true
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Display post date?', 'uncode') ,
			'param_name' => 'show_date',
			'value' => array(
				esc_html__('Yes, please', 'uncode') => true
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

$link_category = array(
	esc_html__('All Links', 'uncode') => ''
);
$link_cats = get_terms('link_category');
if (is_array($link_cats))
{
	foreach ($link_cats as $link_cat)
	{
		$link_category[$link_cat->name] = $link_cat->term_id;
	}
}
vc_map(array(
	'name' => 'WP ' . esc_html__('Links', 'uncode') ,
	'base' => 'vc_wp_links',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => -50,
	'description' => esc_html__('Your blogroll', 'uncode') ,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Link Category', 'uncode') ,
			'param_name' => 'category',
			'value' => $link_category,
			'admin_label' => true
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sort by', 'uncode') ,
			'param_name' => 'orderby',
			'value' => array(
				esc_html__('Link title', 'uncode') => 'name',
				esc_html__('Link rating', 'uncode') => 'rating',
				esc_html__('Link ID', 'uncode') => 'id',
				esc_html__('Random', 'uncode') => 'rand'
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Options', 'uncode') ,
			'param_name' => 'options',
			'value' => array(
				esc_html__('Show Link Image', 'uncode') => 'images',
				esc_html__('Show Link Name', 'uncode') => 'name',
				esc_html__('Show Link Description', 'uncode') => 'description',
				esc_html__('Show Link Rating', 'uncode') => 'rating'
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number of links to show', 'uncode') ,
			'param_name' => 'limit'
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('Categories', 'uncode') ,
	'base' => 'vc_wp_categories',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('A list or dropdown of categories', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Options', 'uncode') ,
			'param_name' => 'options',
			'value' => array(
				esc_html__('Display as dropdown', 'uncode') => 'dropdown',
				esc_html__('Show post counts', 'uncode') => 'count',
				esc_html__('Show hierarchy', 'uncode') => 'hierarchical'
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('Archives', 'uncode') ,
	'base' => 'vc_wp_archives',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('A monthly archive of your sites posts', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Options', 'uncode') ,
			'param_name' => 'options',
			'value' => array(
				esc_html__('Display as dropdown', 'uncode') => 'dropdown',
				esc_html__('Show post counts', 'uncode') => 'count'
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

vc_map(array(
	'name' => 'WP ' . esc_html__('RSS', 'uncode') ,
	'base' => 'vc_wp_rss',
	'icon' => 'fa fa-wordpress',
	'category' => esc_html__('WordPress Widgets', 'uncode') ,
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__('Entries from any RSS or Atom feed', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Widget title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('RSS feed URL', 'uncode') ,
			'param_name' => 'url',
			'description' => esc_html__('Enter the RSS feed URL.', 'uncode') ,
			'admin_label' => true
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Items', 'uncode') ,
			'param_name' => 'items',
			'value' => array(
				esc_html__('10 - Default', 'uncode') => '',
				1,
				2,
				3,
				4,
				5,
				6,
				7,
				8,
				9,
				10,
				11,
				12,
				13,
				14,
				15,
				16,
				17,
				18,
				19,
				20
			) ,
			'description' => esc_html__('How many items would you like to display?', 'uncode') ,
			'admin_label' => true
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Options', 'uncode') ,
			'param_name' => 'options',
			'value' => array(
				esc_html__('Display item content?', 'uncode') => 'show_summary',
				esc_html__('Display item author if available?', 'uncode') => 'show_author',
				esc_html__('Display item date?', 'uncode') => 'show_date'
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		)
	)
));

/* Empty Space Element
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Empty Space', 'uncode') ,
	'base' => 'vc_empty_space',
	'icon' => 'fa fa-arrows-v',
	'weight' => 83,
	'show_settings_on_create' => true,
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Vertical spacer', 'uncode') ,
	'params' => array(
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Height", 'uncode') ,
			"param_name" => "empty_h",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the empty space height.", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode') ,
			'group' => esc_html__('Extra', 'uncode') ,
		) ,
	) ,
));

/* Custom Heading element
 ----------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Heading', 'uncode') ,
	'base' => 'vc_custom_heading',
	'icon' => 'fa fa-header',
	'php_class_name' => 'uncode_generic_admin',
	'weight' => 100,
	'show_settings_on_create' => true,
	'category' => esc_html__('Content', 'uncode') ,
	'shortcode' => true,
	'description' => esc_html__('Text heading', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__('Heading text', 'uncode') ,
			'param_name' => 'content',
			'admin_label' => true,
			'value' => esc_html__('This is a custom heading element.', 'uncode') ,
			//'description' => esc_html__('Enter your content. If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'uncode') ,
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Automatic heading text", 'uncode') ,
			"param_name" => "auto_text",
			"description" => esc_html__("Activate this to pull automatic text content when used as heading for categories.", 'uncode') ,
			'group' => esc_html__('General', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Element semantic", 'uncode') ,
			"param_name" => "heading_semantic",
			"description" => esc_html__("Specify element tag.", 'uncode') ,
			"value" => $heading_semantic,
			'std' => 'h2',
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text size", 'uncode') ,
			"param_name" => "text_size",
			"description" => esc_html__("Specify text size.", 'uncode') ,
			'std' => 'h2',
			"value" => $heading_size,
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text line height", 'uncode') ,
			"param_name" => "text_height",
			"description" => esc_html__("Specify text line height.", 'uncode') ,
			"value" => $heading_height,
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text letter spacing", 'uncode') ,
			"param_name" => "text_space",
			"description" => esc_html__("Specify letter spacing.", 'uncode') ,
			"value" => $heading_space,
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text font family", 'uncode') ,
			"param_name" => "text_font",
			"description" => esc_html__("Specify text font family.", 'uncode') ,
			"value" => $heading_font,
			'std' => '',
			"group" => esc_html__("General", 'uncode') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text weight", 'uncode') ,
			"param_name" => "text_weight",
			"description" => esc_html__("Specify text weight.", 'uncode') ,
			"value" => $heading_weight,
			'std' => '',
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text transform", 'uncode') ,
			"param_name" => "text_transform",
			"description" => esc_html__("Specify the heading text transformation.", 'uncode') ,
			"value" => array(
				esc_html__('Default CSS', 'uncode') => '',
				esc_html__('Uppercase', 'uncode') => 'uppercase',
				esc_html__('Lowercase', 'uncode') => 'lowercase',
				esc_html__('Capitalize', 'uncode') => 'capitalize'
			) ,
			"group" => esc_html__("General", 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Text italic", 'uncode') ,
			"param_name" => "text_italic",
			"description" => esc_html__("Transform the text to italic.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
			"group" => esc_html__("General", 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Text color", 'uncode') ,
			"param_name" => "text_color",
			"description" => esc_html__("Specify text color.", 'uncode') ,
			"value" => $uncode_colors,
			'group' => esc_html__('General', 'uncode')
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Separator", 'uncode') ,
			"param_name" => "separator",
			"description" => esc_html__("Activate the separator. This will appear under the text.", 'uncode') ,
			"value" => array(
				esc_html__('None', 'uncode') => '',
				esc_html__('Under heading', 'uncode') => 'yes',
				esc_html__('Under subheading', 'uncode') => 'under',
				esc_html__('Over heading', 'uncode') => 'over'
			) ,
			"group" => esc_html__("General", 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator colored", 'uncode') ,
			"param_name" => "separator_color",
			"description" => esc_html__("Color the separator with the accent color.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'separator',
				'not_empty' => true,
			) ,
			"group" => esc_html__("General", 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator double space", 'uncode') ,
			"param_name" => "separator_double",
			"description" => esc_html__("Activate to increase the separator space.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
			'dependency' => array(
				'element' => 'separator',
				'not_empty' => true,
			) ,
			"group" => esc_html__("General", 'uncode')
		) ,
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Subheading', 'uncode') ,
			"param_name" => "subheading",
			"description" => esc_html__("Add a subheading text.", 'uncode') ,
			"group" => esc_html__("General", 'uncode') ,
			'admin_label' => true,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Text lead", 'uncode') ,
			"param_name" => "sub_lead",
			"description" => esc_html__("Transform the text to leading.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
			"group" => esc_html__("General", 'uncode')
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Reduce subheading top space", 'uncode') ,
			"param_name" => "sub_reduced",
			"description" => esc_html__("Activate this to reduce the subheading top margin.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			"group" => esc_html__("General", 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode') ,
			'group' => esc_html__('Responsive', 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode') ,
			'group' => esc_html__('Extra', 'uncode')
		) ,
	) ,
));

/* Icon element
 ----------------------------------------------------------- */

vc_map(array(
	'name' => esc_html__('Icon Box', 'uncode') ,
	'base' => 'vc_icon',
	'icon' => 'fa fa-star',
	'weight' => 97,
	'php_class_name' => 'uncode_generic_admin',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Icon box from icon library', 'uncode') ,
	'params' => array(
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Module position", 'uncode') ,
			"param_name" => "position",
			'admin_label' => true,
			"value" => array(
				esc_html__('Icon top', 'uncode') => '',
				esc_html__('Icon bottom', 'uncode') => 'bottom',
				esc_html__('Icon left', 'uncode') => 'left',
				esc_html__('Icon right', 'uncode') => 'right'
			) ,
			'description' => esc_html__('Specify where the icon is positioned inside the module.', 'uncode') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout display', 'uncode') ,
			'param_name' => 'display',
			'description' => esc_html__('Specify the display mode.', 'uncode') ,
			"value" => array(
				esc_html__('Block', 'uncode') => '',
				esc_html__('Inline', 'uncode') => 'inline',
			) ,
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode') ,
			'value' => '',
			'admin_label' => true,
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
		) ,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Media icon", 'uncode') ,
			"param_name" => "icon_image",
			"value" => "",
			"description" => esc_html__("Specify a media icon from the media library.", 'uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Icon color", 'uncode') ,
			"param_name" => "icon_color",
			"description" => esc_html__("Specify icon color. NB. This doesn't work for media icons.", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon background style', 'uncode') ,
			'param_name' => 'background_style',
			'value' => array(
				esc_html__('None', 'uncode') => '',
				esc_html__('Circle', 'uncode') => 'fa-rounded',
				esc_html__('Square', 'uncode') => 'fa-squared',
			) ,
			'description' => esc_html__("Background style for icon. NB. This doesn't work for media icons.", 'uncode')
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon size', 'uncode') ,
			'param_name' => 'size',
			'value' => $icon_sizes,
			'std' => '',
			'description' => esc_html__("Icon size. NB. This doesn't work for media icons.", 'uncode')
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Icon outlined', 'uncode') ,
			'param_name' => 'outline',
			'description' => esc_html__("Outlined icon doesn't have a full background color.", 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'background_style',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Icon shadow', 'uncode') ,
			'param_name' => 'shadow',
			'description' => esc_html__('Icon shadow.', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'background_style',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode') ,
			'param_name' => 'title',
			'admin_label' => true,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title semantic", 'uncode') ,
			"param_name" => "heading_semantic",
			"description" => esc_html__("Specify element tag.", 'uncode') ,
			"value" => $heading_semantic,
			'std' => 'h3',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title size", 'uncode') ,
			"param_name" => "text_size",
			"description" => esc_html__("Specify title size.", 'uncode') ,
			'std' => 'h3',
			"value" => $heading_size,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title font family", 'uncode') ,
			"param_name" => "text_font",
			"description" => esc_html__("Specify title font family.", 'uncode') ,
			"value" => $heading_font,
			'std' => '',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title weight", 'uncode') ,
			"param_name" => "text_weight",
			"description" => esc_html__("Specify title weight.", 'uncode') ,
			"value" => $heading_weight,
			'std' => '',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title line height", 'uncode') ,
			"param_name" => "text_height",
			"description" => esc_html__("Specify text line height.", 'uncode') ,
			"value" => $heading_height,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Title letter spacing", 'uncode') ,
			"param_name" => "text_space",
			"description" => esc_html__("Specify letter spacing.", 'uncode') ,
			"value" => $heading_space,
		) ,
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__('Text', 'uncode') ,
			'param_name' => 'content',
			'admin_label' => true,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Text lead", 'uncode') ,
			"param_name" => "text_lead",
			"description" => esc_html__("Transform the text to leading.", 'uncode') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Reduce text top space", 'uncode') ,
			"param_name" => "text_reduced",
			"description" => esc_html__("Activate this to reduce the text top margin.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'position',
				'value' => array(
					'',
					'bottom'
				)
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Add top margin', 'uncode') ,
			'param_name' => 'add_margin',
			'description' => esc_html__('Add text top margin.', 'uncode') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'position',
				'value' => array(
					'left',
					'right'
				)
			) ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'uncode') ,
			'param_name' => 'link',
			'description' => esc_html__('Add link to icon.', 'uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Link text', 'uncode') ,
			'param_name' => 'link_text',
			'description' => esc_html__('Add a text link if you wish, this will be added under the text.', 'uncode')
		) ,
		array(
			'type' => 'media_element',
			'heading' => esc_html__('Media lightbox', 'uncode') ,
			'param_name' => 'media_lightbox',
			'description' => esc_html__('Specify a media from the lightbox.', 'uncode') ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode') ,
			'param_name' => 'el_class',
			'group' => esc_html__('Extra', 'uncode') ,
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
		) ,
	) ,
));

vc_remove_element( "add_to_cart" );
vc_remove_element( "add_to_cart_url" );