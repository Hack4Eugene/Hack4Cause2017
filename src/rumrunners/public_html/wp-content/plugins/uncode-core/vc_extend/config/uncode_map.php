<?php

global $uncode_colors, $uncode_colors_w_transp, $uncode_post_types;

if (!isset($uncode_post_types) && function_exists('uncode_get_post_types')) $uncode_post_types = uncode_get_post_types();
if (!function_exists('uncode_get_post_types')) $uncode_post_types = array();

$uncode_index_params_second = array();
foreach ($uncode_post_types as $key => $value) {
	if ($value === 'product') continue;
	$uncode_post_type_list = array(
		'type' => 'sorted_list',
		'heading' => ucfirst($value) . ' ' . esc_html__('element', 'uncode') ,
		'param_name' => $value . '_items',
		'description' => esc_html__('Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overridden on post to post basis.', 'uncode') ,
		'value' => 'title,type,media,text,category',
		"group" => esc_html__("Module", 'uncode') ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode') ,
				array(
					array(
						'featured',
						esc_html__('Featured image', 'uncode')
					) ,
					array(
						'media',
						esc_html__('Featured media', 'uncode')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode')
					)
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link on post', 'uncode')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode')
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
				'title',
				esc_html__('Title', 'uncode') ,
			) ,
			array(
				'type',
				esc_html__('Post type', 'uncode') ,
			) ,
			array(
				'author',
				esc_html__('Author', 'uncode') ,
			) ,
			array(
				'date',
				esc_html__('Date', 'uncode') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode') ,
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode')
					) ,
				)
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode') ,
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
		)
	);
	$get_custom_fields = (function_exists('ot_get_option')) ? ot_get_option('_uncode_'.$value.'_custom_fields') : array();
	if (isset($get_custom_fields) && !empty($get_custom_fields))
	{
		foreach ($get_custom_fields as $field_key => $field)
		{
			$uncode_post_type_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
		}
	}
	$uncode_index_params_second[] = $uncode_post_type_list;
}

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
	'admin_label' => true,
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
	'description' => esc_html__('Specify the entrance animation delay in milliseconds.', 'uncode') ,
	'group' => esc_html__('Animation', 'uncode') ,
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
	'description' => esc_html__('Specify the entrance animation speed in milliseconds.', 'uncode') ,
	'group' => esc_html__('Animation', 'uncode') ,
	'dependency' => array(
		'element' => 'css_animation',
		'not_empty' => true
	)
);

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

global $uncode_index_map;

$uncode_post_list = array(
	'type' => 'sorted_list',
	'heading' => esc_html__('Posts', 'uncode') . ' ' . esc_html__('element', 'uncode') ,
	'param_name' => 'post_items',
	'description' => esc_html__('Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overridden on post to post basis.', 'uncode') ,
	'value' => 'media|featured|onpost|original,title,category|nobg,date,text|excerpt,link|default,author,sep-one|full,extra',
	"group" => esc_html__("Module", 'uncode') ,
	'options' => array(
		array(
			'media',
			esc_html__('Media', 'uncode') ,
			array(
				array(
					'featured',
					esc_html__('Featured image', 'uncode')
				) ,
				array(
					'media',
					esc_html__('Featured media', 'uncode')
				) ,
				array(
					'custom',
					esc_html__('Custom', 'uncode')
				)
			) ,
			array(
				array(
					'onpost',
					esc_html__('Link on post', 'uncode')
				) ,
				array(
					'lightbox',
					esc_html__('Lightbox', 'uncode')
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
			'title',
			esc_html__('Title', 'uncode') ,
		) ,
		array(
			'type',
			esc_html__('Post type', 'uncode') ,
		) ,
		array(
			'author',
			esc_html__('Author', 'uncode') ,
		) ,
		array(
			'date',
			esc_html__('Date', 'uncode') ,
		) ,
		array(
			'category',
			esc_html__('Category', 'uncode') ,
			array(
				array(
					'nobg',
					esc_html__('No color', 'uncode')
				) ,
				array(
					'yesbg',
					esc_html__('Colored text', 'uncode')
				)
			)
		) ,
		array(
			'extra',
			esc_html__('Extra', 'uncode') ,
		) ,
		array(
			'meta',
			esc_html__('Default meta', 'uncode') ,
		) ,
		array(
			'text',
			esc_html__('Text', 'uncode') ,
			array(
				array(
					'excerpt',
					esc_html__('Excerpt', 'uncode')
				) ,
				array(
					'full',
					esc_html__('Full content', 'uncode')
				) ,
			)
		) ,
		array(
			'link',
			esc_html__('Read more link', 'uncode'),
			array(
				array(
					'default',
					esc_html__('Default', 'uncode')
				) ,
				array(
					'round',
					esc_html__('Round', 'uncode')
				) ,
				array(
					'circle',
					esc_html__('Circle', 'uncode')
				) ,
				array(
					'link',
					esc_html__('Standard link', 'uncode')
				)
			)
		) ,
		array(
			'icon',
			esc_html__('Icon', 'uncode') ,
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
	) ,
);

$uncode_page_list = array(
	'type' => 'sorted_list',
	'heading' => esc_html__('Pages', 'uncode') . ' ' . esc_html__('element', 'uncode') ,
	'param_name' => 'page_items',
	'description' => esc_html__('Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overridden on post to post basis.', 'uncode') ,
	'value' => 'title,type,media,text,category',
	"group" => esc_html__("Module", 'uncode') ,
	'options' => array(
		array(
			'media',
			esc_html__('Media', 'uncode') ,
			array(
				array(
					'featured',
					esc_html__('Featured image', 'uncode')
				) ,
				array(
					'media',
					esc_html__('Featured media', 'uncode')
				) ,
				array(
					'custom',
					esc_html__('Custom', 'uncode')
				)
			) ,
			array(
				array(
					'onpost',
					esc_html__('Link on post', 'uncode')
				) ,
				array(
					'lightbox',
					esc_html__('Lightbox', 'uncode')
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
			'title',
			esc_html__('Title', 'uncode') ,
		) ,
		array(
			'type',
			esc_html__('Post type', 'uncode') ,
		) ,
		array(
			'category',
			esc_html__('Category', 'uncode') ,
		) ,
		array(
			'text',
			esc_html__('Text', 'uncode') ,
			array(
				array(
					'excerpt',
					esc_html__('Excerpt', 'uncode')
				) ,
				array(
					'full',
					esc_html__('Full content', 'uncode')
				) ,
			)
		) ,
		array(
			'icon',
			esc_html__('Icon', 'uncode') ,
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
	)
);

$uncode_product_list = array(
	'type' => 'sorted_list',
	'heading' => esc_html__('Products', 'uncode') . ' ' . esc_html__('element', 'uncode') ,
	'param_name' => 'product_items',
	'description' => esc_html__('Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overridden on post to post basis.', 'uncode') ,
	'value' => 'title,type,media,text,category,price',
	"group" => esc_html__("Module", 'uncode') ,
	'options' => array(
		array(
			'media',
			esc_html__('Media', 'uncode') ,
			array(
				array(
					'featured',
					esc_html__('Featured image', 'uncode')
				) ,
				array(
					'media',
					esc_html__('Featured media', 'uncode')
				) ,
				array(
					'custom',
					esc_html__('Custom', 'uncode')
				) ,
			) ,
			array(
				array(
					'onpost',
					esc_html__('Link on post', 'uncode')
				) ,
				array(
					'lightbox',
					esc_html__('Lightbox', 'uncode')
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
			) ,
			array(
				array(
					'hide-sale',
					esc_html__('Hide on sale', 'uncode')
				) ,
				array(
					'show-sale',
					esc_html__('Show on sale', 'uncode')
				)
			)
		) ,
		array(
			'title',
			esc_html__('Title', 'uncode') ,
		) ,
		array(
			'type',
			esc_html__('Post type', 'uncode') ,
		) ,
		array(
			'category',
			esc_html__('Category', 'uncode') ,
		) ,
		array(
			'text',
			esc_html__('Text', 'uncode') ,
			array(
				array(
					'excerpt',
					esc_html__('Excerpt', 'uncode')
				) ,
				array(
					'full',
					esc_html__('Full content', 'uncode')
				) ,
			)
		) ,
		array(
			'price',
			esc_html__('Price', 'uncode') ,
		) ,
		array(
			'icon',
			esc_html__('Icon', 'uncode') ,
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
	)
);

$get_post_custom_fields = (function_exists('ot_get_option')) ? ot_get_option('_uncode_post_custom_fields') : array();
if (isset($get_post_custom_fields) && !empty($get_post_custom_fields))
{
	foreach ($get_post_custom_fields as $field_key => $field)
	{
		$uncode_post_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
	}
}

$get_page_custom_fields = (function_exists('ot_get_option')) ? ot_get_option('_uncode_page_custom_fields') : array();
if (isset($get_page_custom_fields) && !empty($get_page_custom_fields))
{
	foreach ($get_page_custom_fields as $field_key => $field)
	{
		$uncode_page_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
	}
}

$get_product_custom_fields = (function_exists('ot_get_option')) ? ot_get_option('_uncode_product_custom_fields') : array();
if (isset($get_product_custom_fields) && !empty($get_product_custom_fields))
{
	foreach ($get_product_custom_fields as $field_key => $field)
	{
		$uncode_product_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
	}
}

$uncode_index_params_first = array(
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Widget title', 'uncode') ,
		'param_name' => 'title',
		'admin_label' => true,
		'description' => esc_html__('Enter text which will be used as widget title. Leave blank if no title is needed.', 'uncode') ,
		'group' => esc_html__('General', 'uncode')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Widget ID', 'uncode') ,
		'param_name' => 'el_id',
		'value' => (function_exists('big_rand')) ? big_rand() : rand(),
		'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode') ,
		'group' => esc_html__('General', 'uncode')
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Module", 'uncode') ,
		"param_name" => "index_type",
		'admin_label' => true,
		"description" => esc_html__("Specify the alignment inside the content box.", 'uncode') ,
		"value" => array(
			esc_html__('Isotope', 'uncode') => 'isotope',
			esc_html__('Carousel', 'uncode') => 'carousel',
		) ,
		'group' => esc_html__('General', 'uncode')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Layout modes', 'uncode') ,
		'param_name' => 'isotope_mode',
		"description" => wp_kses(__("Specify the isotpe layout mode. <a href='http://isotope.metafizzy.co/layout-modes.html' target='_blank'>Check this for reference</a>", 'uncode'), array( 'a' => array( 'href' => array( ),'target' => array( ) ) ) ) ,
		"value" => array(
			esc_html__('Masonry', 'uncode') => 'masonry',
			esc_html__('Fit rows', 'uncode') => 'fitRows',
			esc_html__('Cells by row', 'uncode') => 'cellsByRow',
			esc_html__('Vertical', 'uncode') => 'vertical',
			esc_html__('Packery', 'uncode') => 'packery',
		) ,
		'group' => esc_html__('General', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
	) ,
	array(
		'type' => 'loop',
		'heading' => esc_html__('Index content', 'uncode') ,
		'param_name' => 'loop',
		'admin_label' => true,
		'settings' => array(
			'size' => array(
				'hidden' => false,
				'value' => 10
			) ,
			'order_by' => array(
				'value' => 'date'
			) ,
		) ,
		'value' => 'size:10|order_by:date|post_type:post',
		'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'uncode') ,
		'group' => esc_html__('General', 'uncode')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Post Offset', 'uncode') ,
		'param_name' => 'offset',
		'admin_label' => true,
		'description' => esc_html__('Enter the amount of posts that should be skipped in the beginning of the query.', 'uncode') ,
		'group' => esc_html__('General', 'uncode')
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Automatic query", 'uncode') ,
		"param_name" => "auto_query",
		"description" => esc_html__("Activate this to pull automatic query when used as Content Block for categories.", 'uncode') ,
		'group' => esc_html__('General', 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Style", 'uncode') ,
		"param_name" => "style_preset",
		"description" => esc_html__("Select the visualization mode.", 'uncode') ,
		"value" => array(
			esc_html__('Masonry', 'uncode') => 'masonry',
			esc_html__('Metro', 'uncode') => 'metro',
		) ,
		'group' => esc_html__('Module', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Index background color", 'uncode') ,
		"param_name" => "index_back_color",
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Pagination", 'uncode') ,
		"param_name" => "pagination",
		"description" => esc_html__("Activate this to add the pagination function.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Infinite load more", 'uncode') ,
		"param_name" => "infinite",
		"description" => wp_kses(__("Activate this to load more items with scrolling.<br>N.B. This option doesnt't work is combination with the 'Random' order or with multiple isotope in the same page.", 'uncode'), array( 'br' => array( ) ) ) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
		'dependency' => array(
			'element' => 'pagination',
			'is_empty' => true,
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Load more button", 'uncode') ,
		"param_name" => "infinite_button",
		"description" => esc_html__("Activate this to load more items by pressing the button.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
		'dependency' => array(
			'element' => 'pagination',
			'is_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		)
	) ,
	array(
		"type" => "checkbox",
		"heading" => esc_html__("Load more button outlined", 'uncode') ,
		"param_name" => "infinite_button_outline",
		"description" => esc_html__("Activate this to the have the button outlined.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
		'dependency' => array(
			'element' => 'pagination',
			'is_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		) ,
	) ,
  array(
		"type" => "textfield",
		"heading" => esc_html__("Load more button text", 'uncode') ,
		"param_name" => "infinite_button_text",
		"description" => esc_html__("Specify the button label. NB. The default is 'Load more'.", 'uncode') ,
		'group' => esc_html__('Module', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
		'dependency' => array(
			'element' => 'pagination',
			'is_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Load more button shape", 'uncode') ,
		"param_name" => "infinite_button_shape",
		"description" => esc_html__("Specify the load more button shape.", 'uncode') ,
		'group' => esc_html__('Module', 'uncode') ,
		"value" => array(
			esc_html__('Default', 'uncode') => '',
			esc_html__('Round', 'uncode') => 'btn-round',
			esc_html__('Circle', 'uncode') => 'btn-circle',
			esc_html__('Square', 'uncode') => 'btn-square'
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
		'dependency' => array(
			'element' => 'pagination',
			'is_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Load more button color", 'uncode') ,
		"param_name" => "infinite_button_color",
		"description" => esc_html__("Specify a background color for the load more button.", 'uncode') ,
		"class" => 'uncode_colors',
		"value" => $uncode_colors,
		'group' => esc_html__('Module', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
		'dependency' => array(
			'element' => 'pagination',
			'is_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Pagination/Infinite skin", 'uncode') ,
		"param_name" => "footer_style",
		"description" => esc_html__("Specify the pagination/infinite skin color.", 'uncode') ,
		"value" => array(
			esc_html__('Light', 'uncode') => 'light',
			esc_html__('Dark', 'uncode') => 'dark'
		) ,
		'group' => esc_html__('Module', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Pagination/Infinite color", 'uncode') ,
		"param_name" => "footer_back_color",
		"description" => esc_html__("Specify a background color for the pagination/infinite.", 'uncode') ,
		"class" => 'uncode_colors',
		"value" => $uncode_colors,
		'group' => esc_html__('Module', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Pagination/Infinite full width", 'uncode') ,
		"param_name" => "footer_full_width",
		"description" => esc_html__("Activate this to force the full width of the pagination/infinite.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
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
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
			) ,
		) ,
	) ,
	$uncode_post_list,
	$uncode_page_list,
	$uncode_product_list,
);

$uncode_index_params_third = array(
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			'element' => 'index_type',
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
			esc_html__('Content under image', 'uncode') => 'under',
			esc_html__('Content overlay', 'uncode') => 'overlay'
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
		'group' => esc_html__('Blocks', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Height", 'uncode') ,
		"param_name" => "single_height",
		"description" => esc_html__("Specify the box height.", 'uncode') ,
		"value" => $units,
		"std" => "4",
		'group' => esc_html__('Blocks', 'uncode') ,
		'dependency' => array(
			'element' => 'index_type',
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
		'description' => esc_html__('Specify one if you want to shape the block.', 'uncode'),
		'group' => esc_html__('Blocks', 'uncode'),
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Text skin", 'uncode') ,
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
		"description" => esc_html__("Specify a background color for the overlay.", 'uncode') ,
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
		'group' => esc_html__('Blocks', 'uncode'),
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
		'group' => esc_html__('Blocks', 'uncode'),
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
		"heading" => esc_html__("Text horizontal alignment mobile", 'uncode') ,
		"param_name" => "single_h_align_mobile",
		"description" => esc_html__("Specify the horizontal alignment in mobile.", 'uncode') ,
		"value" => array(
			esc_html__('Inherit', 'uncode') => '',
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
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'overlay',
		) ,
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
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'overlay',
		)
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
			'element' => 'single_text',
			'value' => 'overlay',
		) ,
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
		"description" => esc_html__("Activate this to make every single elements clickable instead of the whole block (when availabe).", 'uncode') ,
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
		"heading" => esc_html__("Title text transform", 'uncode') ,
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
		"value" =>$heading_weight,
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
		"type" => 'checkbox',
		"heading" => esc_html__("Text lead", 'uncode') ,
		"param_name" => "single_text_lead",
		"description" => esc_html__("Transform the text to leading.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode') ,
	) ,
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Icon', 'uncode') ,
		'param_name' => 'single_icon',
		'description' => esc_html__('Specify icon from library.', 'uncode') ,
		'settings' => array(
			'emptyIcon' => true,
			'iconsPerPage' => 1100,
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
		"heading" => esc_html__("Remove border", 'uncode') ,
		"param_name" => "single_border",
		"description" => esc_html__("Activate this to remove the border around the block.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode') ,
	) ,
	array_merge($add_css_animation, array("group" => esc_html__("Blocks", 'uncode'), "param_name" => 'single_css_animation')),
	array_merge($add_animation_speed, array("group" => esc_html__("Blocks", 'uncode'), "param_name" => 'single_animation_speed', 'dependency' => array('element' => 'single_css_animation','not_empty' => true))),
	array_merge($add_animation_delay, array("group" => esc_html__("Blocks", 'uncode'), "param_name" => 'single_animation_delay', 'dependency' => array('element' => 'single_css_animation','not_empty' => true))),
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Custom order', 'uncode') ,
		'param_name' => 'custom_order',
		'description' => wp_kses(__('Activate this to order the items with drag & drop.<br/>NB. Custom order is only possible when the \'Infinite load more\' or pagination are deactivated.', 'uncode'), array( 'br' => array( ) ) ) ,
		'value' => Array(
			esc_html__('Yes, please', 'uncode') => 'yes'
		) ,
		'group' => esc_html__('Single block', 'uncode')
	) ,
	array(
		'type' => 'textfield',
		'edit_field_class' => 'hidden',
		'param_name' => 'order_ids',
		'group' => esc_html__('Single block', 'uncode') ,
	) ,
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
);

$uncode_index_params = array_merge($uncode_index_params_first, $uncode_index_params_second, $uncode_index_params_third);

$uncode_index_map = array(
	'name' => esc_html__('Posts', 'uncode') ,
	'base' => 'uncode_index',
	'weight' => 999,
	'php_class_name' => 'uncode_index',
	'icon' => 'fa fa-th',
	'description' => esc_html__('Isotope grid or carousel layout', 'uncode') ,
	'params' => $uncode_index_params
);

vc_map($uncode_index_map);

/* Content slider
 ---------------------------------------------------------- */
vc_map(array(
    'name' => esc_html__('Content slider', 'uncode') ,
    'description' => esc_html__('Button element', 'uncode') ,
    'base' => 'uncode_slider',
    'weight' => 96,
    'php_class_name' => 'uncode_slider',
    'show_settings_on_create' => false,
    'is_container' => true,
    'icon' => 'fa fa-fast-forward',
    'category' => esc_html__('Content', 'uncode') ,
    'description' => esc_html__('Uncode slider', 'uncode') ,
    'params' => array(
  		array(
				'type' => 'dropdown',
				'heading' => esc_html__('Transition type', 'uncode') ,
				'param_name' => 'slider_type',
				"value" => array(
					esc_html__('Slide', 'uncode') => '',
					esc_html__('Fade', 'uncode') => 'fade'
				) ,
				'description' => esc_html__('Specify the transition type.', 'uncode') ,
			) ,
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Auto rotate slides', 'uncode') ,
				'param_name' => 'slider_interval',
				'value' => array(
					3000,
					5000,
					10000,
					15000,
					esc_html__('Disable', 'uncode') => 0
				) ,
				'std' => 0,
				'description' => esc_html__('Specify the automatic timeout between slides in milliseconds.', 'uncode') ,
			) ,
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Navigation speed', 'uncode') ,
				'param_name' => 'slider_navspeed',
				'value' => array(
					200,
					400,
					700,
					1000,
					esc_html__('Disable', 'uncode') => 0
				) ,
				'std' => 400,
				'description' => esc_html__('Specify the navigation speed between slides in milliseconds.', 'uncode') ,
			) ,
			array(
				'type' => 'checkbox',
				"heading" => esc_html__("Loop", 'uncode') ,
				'param_name' => 'slider_loop',
				"value" => Array(
					esc_html__("Yes, please", 'uncode') => 'yes'
				) ,
				"description" => esc_html__("Activate the loop option to make the carousel infinite. NB. Don't activate if the slider contains an Isotope index.", 'uncode') ,
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
	<div class="tab_controls vc_element-icon" style="width: 100%; margin-top: 20px;">
	    <a class="add_tab" title="' . esc_html__('Add slide', 'uncode') . '" style="color: white;"><i class="fa fa-plus2"></i> <span class="tab-label">' . esc_html__('Add slide', 'uncode') . '</span></a>
	</div>',
    'default_content' => '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]',
    'js_view' => 'UncodeAccordionView'
));

/* Counter
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Counter', 'uncode') ,
	'base' => 'uncode_counter',
	'weight' => 90,
	'icon' => 'fa fa-sort-numerically',
	'php_class_name' => 'uncode_counter',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Animated counter', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Counter value', 'uncode') ,
			'param_name' => 'value',
			'description' => esc_html__('Input counter value here.', 'uncode') ,
			'value' => '1000',
			'admin_label' => true
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Prefix', 'uncode') ,
			'param_name' => 'prefix',
			'description' => esc_html__('Input a prefix to the value.', 'uncode') ,
			'value' => ''
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Suffix', 'uncode') ,
			'param_name' => 'suffix',
			'description' => esc_html__('Input a suffix to the value.', 'uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Counter color", 'uncode') ,
			"param_name" => "counter_color",
			"description" => esc_html__("Specify a color for the counter.", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Counter font size", 'uncode') ,
			"param_name" => "size",
			"description" => esc_html__("Specify the counter font dimension.", 'uncode') ,
			"value" => $heading_size,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Counter line height", 'uncode') ,
			"param_name" => "height",
			"description" => esc_html__("Specify the counter line height.", 'uncode') ,
			"value" => $heading_height,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Counter font family", 'uncode') ,
			"param_name" => "font",
			"description" => esc_html__("Specify the counter font family.", 'uncode') ,
			"value" => $heading_font,
			'std' => '',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Counter font weight", 'uncode') ,
			"param_name" => "weight",
			"description" => esc_html__("Specify the counter font weight.", 'uncode') ,
			"value" =>$heading_weight,
			'std' => '',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Counter text transform", 'uncode') ,
			"param_name" => "transform",
			"description" => esc_html__("Specify the counter text transformation.", 'uncode') ,
			"value" => array(
				esc_html__('Default CSS', 'uncode') => '',
				esc_html__('Uppercase', 'uncode') => 'uppercase',
				esc_html__('Lowercase', 'uncode') => 'lowercase',
				esc_html__('Capitalize', 'uncode') => 'capitalize'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator", 'uncode') ,
			"param_name" => "separator",
			"description" => esc_html__("Activate this to add a separator between the value and the description.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text under', 'uncode') ,
			'param_name' => 'text',
			'description' => esc_html__('Input a text under the counter.', 'uncode') ,
			'value' => ''
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
	) ,
));

/* Countdown
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Countdown', 'uncode') ,
	'base' => 'uncode_countdown',
	'icon' => 'fa fa-clock-o',
	'weight' => 89,
	'php_class_name' => 'uncode_countdown',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Animated countdown', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Final date', 'uncode') ,
			'param_name' => 'date',
			'description' => esc_html__('Input the countdown date with this format YYYY/MM/DD. ex. 2016/05/20', 'uncode') ,
			'admin_label' => true
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown font size", 'uncode') ,
			"param_name" => "size",
			"description" => esc_html__("Specify the countdown font size.", 'uncode') ,
			"value" => $heading_size,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown line height", 'uncode') ,
			"param_name" => "height",
			"description" => esc_html__("Specify the countdown line height.", 'uncode') ,
			"value" => $heading_height,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown font family", 'uncode') ,
			"param_name" => "font",
			"description" => esc_html__("Specify the countdown font family.", 'uncode') ,
			"value" => $heading_font,
			'std' => '',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown font weight", 'uncode') ,
			"param_name" => "weight",
			"description" => esc_html__("Specify the countdown font weight.", 'uncode') ,
			"value" =>$heading_weight,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Countdown uppercase", 'uncode') ,
			"param_name" => "transform",
			"description" => esc_html__("Specify the countdown text transformation.", 'uncode') ,
			"value" => array(
				esc_html__('Default CSS', 'uncode') => '',
				esc_html__('Uppercase', 'uncode') => 'uppercase',
				esc_html__('Lowercase', 'uncode') => 'lowercase',
				esc_html__('Capitalize', 'uncode') => 'capitalize'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator", 'uncode') ,
			"param_name" => "separator",
			"description" => esc_html__("Activate this to add a separator between the value and the description.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text under', 'uncode') ,
			'param_name' => 'text',
			'description' => esc_html__('Input a text under the countdown.', 'uncode') ,
			'value' => ''
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
	) ,
));

/* List
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('List', 'uncode') ,
	'base' => 'uncode_list',
	'weight' => 91,
	'icon' => 'fa fa-list-ol',
	'php_class_name' => 'uncode_list',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('List with icon', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textarea_html',
			'heading' => esc_html__('List text', 'uncode') ,
			'param_name' => 'content',
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Larger text", 'uncode') ,
			"param_name" => "larger",
			"description" => esc_html__("Activate this to have bigger text.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
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
			"type" => "dropdown",
			"heading" => esc_html__("Icon color", 'uncode') ,
			"param_name" => "icon_color",
			"description" => esc_html__("Specify a color for the icon.", 'uncode') ,
			"value" => $uncode_colors,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			) ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
	) ,
));

/* Pricing table
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Pricing table', 'uncode') ,
	'base' => 'uncode_pricing',
	'weight' => 92,
	'icon' => 'fa fa-list-alt',
	'php_class_name' => 'uncode_pricing',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Pricing table', 'uncode') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Insert the price table title and separate with a pipe | if you want to have subtitle.', 'uncode') ,
			'value' => esc_html__('Title|Subtitle','uncode')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Price', 'uncode') ,
			'param_name' => 'price',
			'description' => esc_html__('Insert the price and separate with a pipe | if you want to have subtitle.', 'uncode') ,
			'value' => esc_html__('$50|per month','uncode')
		) ,
		array(
			"type" => 'textarea_safe',
			"heading" => esc_html__("Body", 'uncode') ,
			"param_name" => "body",
			"description" => esc_html__("Insert body text line. Every new line is a block. If you separate with a pipe | the first part will be with bold style.", 'uncode') ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Button', 'uncode') ,
			'param_name' => 'button',
			'description' => esc_html__('Insert a link if you want a button.', 'uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Block color", 'uncode') ,
			"param_name" => "price_color",
			"description" => esc_html__("Specify a color for the block.", 'uncode') ,
			"value" => $uncode_colors,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => 'Colored elements',
			'param_name' => 'col_elements',
			'value' => array(
				esc_html__('Inside elements', 'uncode') => '',
				esc_html__('Top and bottom', 'uncode') => 'tb',
			) ,
			'description' => esc_html__('Specify how do you want to color the block.', 'uncode') ,
			'dependency' => array(
				'element' => 'price_color',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Most popular", 'uncode') ,
			"param_name" => "most",
			"description" => esc_html__("Activate this to make the block to stick out, like featured.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Alignment", 'uncode') ,
			"param_name" => "align",
			"description" => esc_html__("Specify the text aligment.", 'uncode') ,
			"value" => array(
				esc_html__('Center', 'uncode') => '',
				esc_html__('Left', 'uncode') => 'left',
			) ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
	) ,
));

/* Share
 ---------------------------------------------------------- */
vc_map(array(
	'name' => esc_html__('Share', 'uncode') ,
	'base' => 'uncode_share',
	'weight' => 86,
	'icon' => 'fa fa-share',
	'php_class_name' => 'uncode_share',
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Share buttons', 'uncode') ,
	'params' => array(
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Share layout", 'uncode') ,
			"param_name" => "layout",
			"description" => esc_html__("Specify the sharing area layout.", 'uncode') ,
			"value" => array(
				esc_html__('One popup button', 'uncode') => '',
				esc_html__('Social buttons', 'uncode') => 'multiple',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Bigger icons", 'uncode') ,
			"param_name" => "bigger",
			"description" => esc_html__("Activate this to have bigger icons.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'multiple',
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("No background", 'uncode') ,
			"param_name" => "no_back",
			"description" => esc_html__("Activate this to remove the background hover effect.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'multiple',
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Label', 'uncode') ,
			'param_name' => 'title',
			'description' => esc_html__('Insert the label for the share module.', 'uncode') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Separator", 'uncode') ,
			"param_name" => "separator",
			"description" => esc_html__("Activate this to add a separator between the value and the description.", 'uncode') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'layout',
				'value' => 'multiple',
			) ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
	) ,
));

/* Twenty Twenty
 ---------------------------------------------------------- */
vc_map(array(
	'base' => 'uncode_twentytwenty',
	'name' => esc_html__('Twenty Twenty', 'uncode') ,
	'icon' => 'fa fa-adjust',
	'php_class_name' => 'uncode_twentytwenty',
	'weight' => 30,
	'category' => esc_html__('Content', 'uncode') ,
	'description' => esc_html__('Show before-and-after pictures', 'uncode') ,
	'params' => array(
		array(
			"type" => "media_element",
			"heading" => esc_html__("Media before", 'uncode') ,
			"param_name" => "media_before",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode') ,
			"admin_label" => true
		) ,
		array(
			"type" => "media_element",
			"heading" => esc_html__("Media after", 'uncode') ,
			"param_name" => "media_after",
			"value" => "",
			"description" => esc_html__("Specify a media from the media library.", 'uncode') ,
			"admin_label" => true
		) ,
		array(
      'type' => 'textfield',
      'heading' => esc_html__('Extra class name', 'uncode') ,
      'param_name' => 'el_class',
      'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uncode')
    ) ,
	)
));

/* Content Block
 ---------------------------------------------------------- */
if (function_exists('uncode_get_current_post_type')) {
	$current_post_type = uncode_get_current_post_type();
	if ($current_post_type !== 'uncodeblock') {
		$cblock = get_posts( 'post_type="uncodeblock"&numberposts=-1' );

		$conten_blocks = array();
		if ( $cblock ) {
			foreach ( $cblock as $cform ) {
				$conten_blocks[ $cform->post_title ] = $cform->ID;
			}
		} else {
			$conten_blocks[ __( 'No Content Block found', 'uncode' ) ] = 0;
		}
		vc_map( array(
			'base' => 'uncode_block',
			'php_class_name' => 'uncode_block',
			'weight' => 97,
			'name' => __( 'Content Block VC', 'uncode' ),
			'icon' => 'dashicons-before dashicons-tagcloud',
			'category' => __( 'Content', 'uncode' ),
			'description' => __( 'Place Content Block', 'uncode' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Content Block', 'uncode' ),
					'param_name' => 'id',
					'value' => $conten_blocks,
					'admin_label' => true,
					'save_always' => true,
					'description' => __( 'Choose previously created Content Block from the drop down list.', 'uncode' ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__("Column container settings", 'uncode') ,
					"param_name" => "inside_column",
					"description" => sprintf(esc_html__("Activate this to use the Content Block inside a column.%sNB. When using this option nested row (row child) inside the Content Block will not work.", 'uncode'), '<br /><br />') ,
					"value" => Array(
						esc_html__("Yes, please", 'uncode') => 'yes'
					) ,
				) ,
			),
			'js_view' => 'UncodeBlockView'
		) );
	}
}

?>
