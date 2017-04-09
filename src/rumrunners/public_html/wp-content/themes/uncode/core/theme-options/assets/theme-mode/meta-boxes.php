<?php

/**
* Initialize the Uncode Meta Boxes.
*/

function uncode_page_options()
{

	/*
	* Init vars
	*/

	global $wpdb;

	$portfolio_cpt_name = ot_get_option('_uncode_portfolio_cpt');
	if ($portfolio_cpt_name == '') $portfolio_cpt_name = 'portfolio';

	$post_type = uncode_get_current_post_type();
	$uncode_post_types = uncode_get_post_types(true);

	$fields = array();

	function run_array_mb($array, $condition = '', $parent = '')
	{
		if ($array === null || $array === '') return false;
		$array['condition'] = $condition;
		$array['parent'] = $parent;
		return $array;
	}

	//////////////////////////
	//  General specific   ///
	//////////////////////////

	$specific_body_background = array(
		'id' => '_uncode_specific_body_background',
		'label' => esc_html__('HTML Body background', 'uncode') ,
		'desc' => esc_html__('Specify the body background color and media.', 'uncode') ,
		'type' => 'background',
		'section' => 'uncode_general_section',
	);

	$page_scroll = array(
		'id' => '_uncode_page_scroll',
		'label' => esc_html__('Section scroller', 'uncode') ,
		'type' => 'on-off',
		'desc' => esc_html__('Activate to create a section scroller navigation. NB. Every row must have a unique name.','uncode'),
		'std' => 'off',
	);

	$general_fields = array(
		array(
			'label' => '<i class="fa fa-globe3 fa-fw"></i> ' . esc_html__('General', 'uncode') ,
			'id' => '_uncode_general_tab',
			'type' => 'tab',
		) ,
		run_array_mb($specific_body_background) ,
		run_array_mb($page_scroll) ,
	);

	$fields = array_merge($fields, $general_fields);

	///////////////////////
	//  Menu specific   ///
	///////////////////////

	$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
	$menus_array = array();
	$menus_array[] = array(
		'value' => '',
		'label' => esc_html__('Inherit', 'uncode')
	);
	foreach ($menus as $menu)
	{
		$menus_array[] = array(
			'value' => $menu->slug,
			'label' => $menu->name
		);
	}

	$specific_menu = array(
		'id' => '_uncode_specific_menu',
		'label' => esc_html__('Menu', 'uncode') ,
		'desc' => esc_html__('Override the menu.','uncode'),
		'type' => 'select',
		'choices' => $menus_array
	);

	$specific_menu_width = array(
		'id' => '_uncode_specific_menu_width',
		'label' => esc_html__('Menu width', 'uncode') ,
		'desc' => esc_html__('Override the menu width.','uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'full',
				'label' => esc_html__('Full', 'uncode') ,
			) ,
			array(
				'value' => 'limit',
				'label' => esc_html__('Limit', 'uncode') ,
			) ,
		) ,
	);

	$menu_opaque = array(
		'id' => '_uncode_specific_menu_opaque',
		'label' => esc_html__('Remove transparency', 'uncode') ,
		'type' => 'on-off',
		'desc' => esc_html__('Override to remove the transparency eventually declared in \'Customize -> Light/Dark skin\'.', 'uncode') ,
		'std' => 'off',
	);

	$menu_no_shadow = array(
		'id' => '_uncode_specific_menu_no_shadow',
		'label' => esc_html__('Remove shadow', 'uncode') ,
		'type' => 'on-off',
		'desc' => esc_html__('Override to remove the shadow eventually declared in \'Menu -> Visuals\'.', 'uncode') ,
		'std' => 'off',
	);

	$menu_no_padding = array(
		'id' => '_uncode_specific_menu_no_padding',
		'label' => esc_html__('Remove menu content padding', 'uncode') ,
		'type' => 'on-off',
		'desc' => esc_html__('Remove the additional menu padding in the header.', 'uncode') ,
		'std' => 'off',
	);

	$menu_fields = array(
		array(
			'label' => '<i class="fa fa-menu fa-fw"></i> ' . esc_html__('Menu', 'uncode') ,
			'id' => '_uncode_menu_tab',
			'type' => 'tab',
		) ,
		run_array_mb($specific_menu) ,
		run_array_mb($specific_menu_width) ,
		run_array_mb($menu_opaque) ,
		run_array_mb($menu_no_shadow) ,
	);

	$fields = array_merge($fields, $menu_fields);

	/////////////////////////
	//  Header specific   ///
	/////////////////////////

	if (is_plugin_active('uncode-core/uncode-core.php')) {

		$uncodeblock = array(
			'value' => 'header_uncodeblock',
			'label' => esc_html__('Content Block', 'uncode') ,
		);

		$ubq = $wpdb->get_results("SELECT id, post_title FROM " . $wpdb->prefix . "posts WHERE post_type = 'uncodeblock' AND post_status = 'publish' ORDER BY post_title ASC LIMIT 9999");
		$uncodeblocks = array();
		if ($ubq)
		{
			foreach ($ubq as $block)
			{
				$uncodeblocks[] = array(
					'value' => $block->id,
					'label' => $block->post_title,
					'postlink' => get_edit_post_link($block->id),
				);
			}
		}
		else
		{
			$uncodeblocks[] = array(
				'value' => '',
				'label' => esc_html__('No Content Blocks found', 'uncode')
			);
		}

		$uncodeblocks_extended = array_merge(
			array(
				array(
					'value' => '','label' => esc_html__('Inherit', 'uncode')
				),
				array(
					'value' => 'none','label' => esc_html__('None', 'uncode')
				)
			),
		$uncodeblocks);

	} else {
		$uncodeblock = '';
		$uncodeblocks_extended = '';
	}

	if (is_plugin_active('revslider/revslider.php'))
	{

		$revslider = array(
			'value' => 'header_revslider',
			'label' => esc_html__('Revolution Slider', 'uncode') ,
		);

		$rs = $wpdb->get_results("SELECT id, title, alias FROM " . $wpdb->prefix . "revslider_sliders WHERE type != 'template' ORDER BY id ASC LIMIT 999");
		$revsliders = array();
		if ($rs)
		{
			foreach ($rs as $slider)
			{
				$revsliders[] = array(
					'value' => $slider->alias,
					'label' => $slider->title,
					'postlink' => admin_url( 'admin.php?page=revslider&view=slider&id=' . $slider->id  ),
				);
			}
		}
		else
		{
			$revsliders[] = array(
				'value' => '',
				'label' => esc_html__('No sliders found', 'uncode')
			);
		}
	}
	else $revslider = $revsliders = '';

	if (is_plugin_active('LayerSlider/layerslider.php'))
	{

		$layerslider = array(
			'value' => 'header_layerslider',
			'label' => esc_html__('LayerSlider', 'uncode') ,
		);

		$ls = $wpdb->get_results("SELECT id, name FROM " . $wpdb->prefix . "layerslider WHERE flag_deleted != '1' ORDER BY id ASC LIMIT 999");
		$layersliders = array();
		if ($ls)
		{
			foreach ($ls as $slider)
			{
				$layersliders[] = array(
					'value' => $slider->id,
					'label' => $slider->name,
					'postlink' => admin_url( 'admin.php?page=layerslider&action=edit&id=' . $slider->id  ),
				);
			}
		}
		else
		{
			$layersliders[] = array(
				'value' => '',
				'label' => esc_html__('No sliders found', 'uncode')
			);
		}
	}
	else $layerslider = $layersliders = '';

	$header_type = array(
		'id' => '_uncode_header_type',
		'label' => esc_html__('Type', 'uncode') ,
		'desc' => esc_html__('Override the header type.', 'uncode') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'header_basic',
				'label' => esc_html__('Basic', 'uncode') ,
			) ,
			$uncodeblock,
			$revslider,
			$layerslider,
			array(
				'value' => 'none',
				'label' => esc_html__('None', 'uncode') ,
			) ,
		)
	);

	if (is_plugin_active('uncode-core/uncode-core.php')) {

		$header_blocks_list = array(
			'id' => '_uncode_blocks_list',
			'label' => esc_html__('Content Block', 'uncode') ,
			'desc' => esc_html__('Specify the Content Block.', 'uncode') ,
			'type' => 'select',
			'operator' => 'or',
			'choices' => $uncodeblocks
		);

	} else {
		$header_blocks_list = null;
	}

	$header_revslider_list = array(
		'id' => '_uncode_revslider_list',
		'label' => esc_html__('Revslider', 'uncode') ,
		'desc' => esc_html__('Specify the Revolution Slider.', 'uncode') ,
		'type' => 'select',
		'operator' => 'or',
		'choices' => $revsliders
	);

	$header_layerslider_list = array(
		'id' => '_uncode_layerslider_list',
		'label' => esc_html__('LayerSlider', 'uncode') ,
		'desc' => esc_html__('Specify the LayerSlider.', 'uncode') ,
		'type' => 'select',
		'operator' => 'or',
		'choices' => $layersliders
	);

	$header_full_width = array(
		'id' => '_uncode_header_full_width',
		'label' => esc_html__('Container full width', 'uncode') ,
		'std' => 'on',
		'type' => 'on-off',
		'desc' => esc_html__('Activate to expand the header container to full width.', 'uncode') ,
		'operator' => 'or',
		'condition' => '',
	);

	$header_content_width = array(
		'id' => '_uncode_header_content_width',
		'label' => esc_html__('Content full width', 'uncode') ,
		'type' => 'on-off',
		'desc' => esc_html__('Activate to expand the header content to full width.', 'uncode') ,
		'std' => 'off',
		'condition' => '',
		'operator' => 'or',
	);

	$header_custom_width = array(
		'id' => '_uncode_header_custom_width',
		'label' => esc_html__('Custom inner width','uncode'),
		'desc' => esc_html__('Adjust the inner content width in %.', 'uncode') ,
		'std' => '100',
		'type' => 'numeric-slider',
		'min_max_step' => '0,100,1',
		'condition' => '',
		'operator' => 'or'
	);

	$header_align = array(
		'id' => '_uncode_header_align',
		'label' => esc_html__('Content alignment', 'uncode') ,
		'desc' => esc_html__('Specify the text/content alignment.', 'uncode') ,
		'type' => 'select',
		'condition' => '',
		'operator' => 'or',
		'std' => 'align_center',
		'choices' => array(
			array(
				'value' => 'left',
				'label' => esc_html__('Left', "uncode") ,
			) ,
			array(
				'value' => 'center',
				'label' => esc_html__('Center', "uncode") ,
			) ,
			array(
				'value' => 'right',
				'label' => esc_html__('Right', "uncode") ,
			) ,
		)
	);

	$header_height = array(
		'id' => '_uncode_header_height',
		'label' => esc_html__('Height', 'uncode') ,
		'desc' => esc_html__('Define the height of the header in px or in % (relative to the window height).', 'uncode') ,
		'std' => array(
			'50',
			'%'
		) ,
		'type' => 'measurement',
		'condition' => '',
		'operator' => 'or',
	);

	$header_min_height = array(
		'id' => '_uncode_header_min_height',
		'label' => esc_html__('Minimal height', 'uncode') ,
		'desc' => esc_html__('Enter a minimun height for the header in pixel.', 'uncode') ,
		'type' => 'text',
	);

	$header_style = array(
		'id' => '_uncode_header_style',
		'label' => esc_html__('Skin', 'uncode') ,
		'desc' => esc_html__('Specify the header text skin.', 'uncode') ,
		'type' => 'select',
		'section' => 'colors',
		'std' => 'dark',
		'condition' => '',
		'operator' => 'or',
		'choices' => array(
			array(
				'value' => 'light',
				'label' => esc_html__('Light', "uncode") ,
				'src' => ''
			) ,
			array(
				'value' => 'dark',
				'label' =>  esc_html__('Dark', "uncode") ,
				'src' => ''
			)
		)
	);

	$header_position = array(
		'id' => '_uncode_header_position',
		'label' => esc_html__('Position', 'uncode') ,
		'desc' => esc_html__('Specify the position of the header content inside the container.', 'uncode') ,
		'std' => 'header-center header-middle',
		'type' => 'select',
		'operator' => 'or',
		'condition' => '',
		'choices' => array(
			array(
				'value' => 'header-left header-top',
				'label' => esc_html__('Left Top', 'uncode') ,
			) ,
			array(
				'value' => 'header-left header-center',
				'label' => esc_html__('Left Center', 'uncode') ,
			) ,
			array(
				'value' => 'header-left header-bottom',
				'label' => esc_html__('Left Bottom', 'uncode') ,
			) ,
			array(
				'value' => 'header-center header-top',
				'label' => esc_html__('Center Top', 'uncode') ,
			) ,
			array(
				'value' => 'header-center header-middle',
				'label' => esc_html__('Center Center', 'uncode') ,
			) ,
			array(
				'value' => 'header-center header-bottom',
				'label' => esc_html__('Center Bottom', 'uncode') ,
			) ,
			array(
				'value' => 'header-right header-top',
				'label' => esc_html__('Right Top', 'uncode') ,
			) ,
			array(
				'value' => 'header-right header-center',
				'label' => esc_html__('Right Center', 'uncode') ,
			) ,
			array(
				'value' => 'header-right header-bottom',
				'label' => esc_html__('Right Bottom', 'uncode') ,
			) ,
		)
	);

	$title_size = array(
		array(
			'value' => 'h1',
			'label' => esc_html__('h1', 'uncode')
		),
		array(
			'value' => 'h2',
			'label' => esc_html__('h2', 'uncode'),
		),
		array(
			'value' => 'h3',
			'label' => esc_html__('h3', 'uncode'),
		),
		array(
			'value' => 'h4',
			'label' => esc_html__('h4', 'uncode'),
		),
		array(
			'value' => 'h5',
			'label' => esc_html__('h5', 'uncode'),
		),
		array(
			'value' => 'h6',
			'label' => esc_html__('h6', 'uncode'),
		),
	);

	$font_sizes = ot_get_option('_uncode_heading_font_sizes');
	if (!empty($font_sizes)) {
		foreach ($font_sizes as $key => $value) {
			$title_size[] = array(
				'value' => $value['_uncode_heading_font_size_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$title_size[] = array(
		'value' => 'bigtext',
		'label' => esc_html__('BigText', 'uncode'),
	);

	$title_height = array(
		array(
			'value' => '',
			'label' => esc_html__('Default CSS', "uncode")
		),
	);

	$font_heights = ot_get_option('_uncode_heading_font_heights');
	if (!empty($font_heights)) {
		foreach ($font_heights as $key => $value) {
			$title_height[] = array(
				'value' => $value['_uncode_heading_font_height_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$title_spacing = array(
		array(
			'value' => '',
			'label' => esc_html__('Default CSS', "uncode")
		),
	);

	$font_spacings = ot_get_option('_uncode_heading_font_spacings');
	if (!empty($font_spacings)) {
		foreach ($font_spacings as $key => $value) {
			$title_spacing[] = array(
				'value' => $value['_uncode_heading_font_spacing_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$title_font = array(
		array(
			'value' => '',
			'label' => esc_html__('Default CSS', "uncode"),
		)
	);

	$custom_fonts_array = ot_get_option('_uncode_font_groups');
	if (!empty($custom_fonts_array)) {
		foreach ($custom_fonts_array as $key => $value) {
			$title_font[] = array(
				'value' => $value['_uncode_font_group_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$title_weight = array(
		array(
			'value' => '',
			'label' => esc_html__('Default CSS', "uncode"),
		),
		array(
			'value' => 100,
			'label' => '100',
		),
		array(
			'value' => 200,
			'label' => '200',
		),
		array(
			'value' => 300,
			'label' => '300',
		),
		array(
			'value' => 400,
			'label' => '400',
		),
		array(
			'value' => 500,
			'label' => '500',
		),
		array(
			'value' => 600,
			'label' => '600',
		),
		array(
			'value' => 700,
			'label' => '700',
		),
		array(
			'value' => 800,
			'label' => '800',
		),
		array(
			'value' => 900,
			'label' => '900',
		)
	);

	$header_featured = array(
		'label' => esc_html__('Featured image in header', 'uncode') ,
		'id' => '_uncode_header_featured',
		'type' => 'on-off',
		'desc' => esc_html__('Activate to use the featured image in the header.', 'uncode') ,
		'std' => 'on',
	);

	$header_background = array(
		'id' => '_uncode_header_background',
		'label' => esc_html__('Background', 'uncode') ,
		'desc' => esc_html__('Specify the background media and color.', 'uncode') ,
		'type' => 'background',
		'condition' => '',
		'operator' => 'or',
		'std' => array(
			'background-color' => 'color-wayh',
		),
	);

	$header_overlay_color = array(
		'id' => '_uncode_header_overlay_color',
		'label' => esc_html__('Overlay color', 'uncode') ,
		'desc' => esc_html__('Specify the overlay background color.', 'uncode') ,
		'type' => 'uncode_color',
		'condition' => '',
		'operator' => 'or',
	);

	$header_overlay_color_alpha = array(
		'id' => '_uncode_header_overlay_color_alpha',
		'label' => esc_html__('Overlay color opacity', 'uncode') ,
		'desc' => esc_html__('Set the overlay opacity.', 'uncode') ,
		'std' => '100',
		'min_max_step' => '0,100,1',
		'type' => 'numeric-slider',
		'condition' => '',
		'operator' => 'or',
	);

	$header_scroll_opacity = array(
		'id' => '_uncode_header_scroll_opacity',
		'label' => esc_html__('Scroll opacity', 'uncode') ,
		'desc' => esc_html__('Activate alpha animation when scrolling down.', 'uncode') ,
		'type' => 'on-off',
		'std' => 'off',
		'condition' => '',
		'operator' => 'or',
	);

	$header_scrolldown = array(
		'id' => '_uncode_header_scrolldown',
		'label' => esc_html__('Scroll down arrow', 'uncode') ,
		'desc' => esc_html__('Activate the scroll down arrow button.', 'uncode') ,
		'type' => 'on-off',
		'std' => 'off',
		'condition' => '',
		'operator' => 'and',
	);

	$header_name = array(
		'id' => '_uncode_scroll_header_name',
		'label' => esc_html__('Header section name', 'uncode') ,
		'desc' => esc_html__('Insert the header section name, required for the onepage scroll.','uncode'),
		'type' => 'text',
	);

	$header_parallax = array(
		'label' => esc_html__('Parallax', 'uncode') ,
		'id' => '_uncode_header_parallax',
		'type' => 'on-off',
		'desc' => esc_html__('Activate the background parallax effect.', 'uncode') ,
		'std' => 'off',
		'operator' => 'or',
		'condition' => '',
	);

	$header_title = array(
		'label' => esc_html__('Title in header', 'uncode') ,
		'id' => '_uncode_header_title',
		'type' => 'on-off',
		'desc' => esc_html__('Activate to show title in the header.', 'uncode') ,
		'std' => 'on',
	);


	$header_title_font = array(
		'id' => '_uncode_header_title_font',
		'label' => esc_html__('Title font family', 'uncode') ,
		'desc' => esc_html__('Specify the font for the title.', 'uncode') ,
		'type' => 'select',
		'choices' => $title_font,
	);

	$header_title_size = array(
		'id' => '_uncode_header_title_size',
		'label' => esc_html__('Title font size', 'uncode') ,
		'desc' => esc_html__('Specify the font size for the title.', 'uncode') ,
		'type' => 'select',
		'choices' => $title_size,
	);

	$header_title_height = array(
		'id' => '_uncode_header_title_height',
		'label' => esc_html__('Title line height', 'uncode') ,
		'desc' => esc_html__('Specify the line height for the title.', 'uncode') ,
		'type' => 'select',
		'choices' => $title_height,
	);

	$header_title_spacing = array(
		'id' => '_uncode_header_title_spacing',
		'label' => esc_html__('Title letter spacing', 'uncode') ,
		'desc' => esc_html__('Specify the letter spacing for the title.', 'uncode') ,
		'type' => 'select',
		'choices' => $title_spacing,
	);

	$header_title_weight = array(
		'id' => '_uncode_header_title_weight',
		'label' => esc_html__('Title font weight', 'uncode') ,
		'desc' => esc_html__('Specify the font weight for the title.', 'uncode') ,
		'type' => 'select',
		'choices' => $title_weight,
	);

	$header_title_italic = array(
		'id' => '_uncode_header_title_italic',
		'label' => esc_html__('Title italic', 'uncode') ,
		'desc' => esc_html__('Activate the font style italic for the title.', 'uncode') ,
		'type' => 'on-off',
		'std' => 'off'
	);

	$header_title_transform = array(
		'id' => '_uncode_header_title_transform',
		'label' => esc_html__('Title text transform', 'uncode') ,
		'desc' => esc_html__('Specify the title text transformation.', 'uncode') ,
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Default CSS', 'uncode') ,
			) ,
			array(
				'value' => 'uppercase',
				'label' => esc_html__('Uppercase', 'uncode') ,
			) ,
			array(
				'value' => 'lowercase',
				'label' => esc_html__('Lowercase', 'uncode') ,
			) ,
			array(
				'value' => 'capitalize',
				'label' => esc_html__('Capitalize', 'uncode') ,
			) ,
		)
	);

	$header_title_custom = array(
		'label' => esc_html__('Custom content', 'uncode') ,
		'id' => '_uncode_header_title_custom',
		'type' => 'on-off',
		'desc' => esc_html__('Activate custom contents instead of the default page title.', 'uncode') ,
		'std' => 'off',
		'condition' => '',
		'operator' => 'and',
	);

	$header_text = array(
		'id' => '_uncode_header_text',
		'label' => esc_html__('Text content', 'uncode') ,
		'type' => 'textarea',
	);

	$header_text_animation = array(
		'id' => '_uncode_header_text_animation',
		'label' => esc_html__('Text animation', 'uncode') ,
		'desc' => esc_html__('Specify the entrance animation of the title text.', 'uncode') ,
		'type' => 'select',
		'condition' => '',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Select…', 'uncode') ,
			) ,
			array(
				'value' => 'top-t-bottom',
				'label' => esc_html__('Top to bottom', 'uncode') ,
			) ,
			array(
				'value' => 'left-t-right',
				'label' => esc_html__('Left to right', 'uncode') ,
			) ,
			array(
				'value' => 'right-t-left',
				'label' => esc_html__('Right to left', 'uncode') ,
			) ,
			array(
				'value' => 'bottom-t-top',
				'label' => esc_html__('Bottom to top', 'uncode') ,
			) ,
			array(
				'value' => 'zoom-in',
				'label' => esc_html__('Zoom in', 'uncode') ,
			),
			array(
				'value' => 'zoom-out',
				'label' => esc_html__('Zoom out', 'uncode') ,
			),
			array(
				'value' => 'alpha-anim',
				'label' => esc_html__('Alpha', 'uncode') ,
			)
		)
	);

	$header_animation_delay = array(
		'id' => '_uncode_header_animation_delay',
		'label' => esc_html__('Animation delay', 'uncode') ,
		'desc' => esc_html__('Specify the entrance animation delay of the title text in milliseconds.', 'uncode') ,
		'type' => 'select',
		'condition' => '',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('None', 'uncode') ,
			) ,
			array(
				'value' => '100',
				'label' => esc_html__('ms 100', 'uncode') ,
			) ,
			array(
				'value' => '200',
				'label' => esc_html__('ms 200', 'uncode') ,
			) ,
			array(
				'value' => '300',
				'label' => esc_html__('ms 300', 'uncode') ,
			) ,
			array(
				'value' => '400',
				'label' => esc_html__('ms 400', 'uncode') ,
			) ,
			array(
				'value' => '500',
				'label' => esc_html__('ms 500', 'uncode') ,
			) ,
			array(
				'value' => '600',
				'label' => esc_html__('ms 600', 'uncode') ,
			) ,
			array(
				'value' => '700',
				'label' => esc_html__('ms 700', 'uncode') ,
			) ,
			array(
				'value' => '800',
				'label' => esc_html__('ms 800', 'uncode') ,
			) ,
			array(
				'value' => '900',
				'label' => esc_html__('ms 900', 'uncode') ,
			) ,
			array(
				'value' => '1000',
				'label' => esc_html__('ms 1000', 'uncode') ,
			) ,
			array(
				'value' => '1100',
				'label' => esc_html__('ms 1100', 'uncode') ,
			) ,
			array(
				'value' => '1200',
				'label' => esc_html__('ms 1200', 'uncode') ,
			) ,
			array(
				'value' => '1300',
				'label' => esc_html__('ms 1300', 'uncode') ,
			) ,
			array(
				'value' => '1400',
				'label' => esc_html__('ms 1400', 'uncode') ,
			) ,
			array(
				'value' => '1500',
				'label' => esc_html__('ms 1500', 'uncode') ,
			) ,
			array(
				'value' => '1600',
				'label' => esc_html__('ms 1600', 'uncode') ,
			) ,
			array(
				'value' => '1700',
				'label' => esc_html__('ms 1700', 'uncode') ,
			) ,
			array(
				'value' => '1800',
				'label' => esc_html__('ms 1800', 'uncode') ,
			) ,
			array(
				'value' => '1900',
				'label' => esc_html__('ms 1900', 'uncode') ,
			) ,
			array(
				'value' => '2000',
				'label' => esc_html__('ms 2000', 'uncode') ,
			) ,
		),
	);

	$header_animation_speed = array(
		'id' => '_uncode_header_animation_speed',
		'label' => esc_html__('Animation speed', 'uncode') ,
		'desc' => esc_html__('Specify the entrance animation speed of the title text in milliseconds.', 'uncode') ,
		'type' => 'select',
		'condition' => '',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Default (400)', 'uncode') ,
			) ,
			array(
				'value' => '100',
				'label' => esc_html__('ms 100', 'uncode') ,
			) ,
			array(
				'value' => '200',
				'label' => esc_html__('ms 200', 'uncode') ,
			) ,
			array(
				'value' => '300',
				'label' => esc_html__('ms 300', 'uncode') ,
			) ,
			array(
				'value' => '400',
				'label' => esc_html__('ms 400', 'uncode') ,
			) ,
			array(
				'value' => '500',
				'label' => esc_html__('ms 500', 'uncode') ,
			) ,
			array(
				'value' => '600',
				'label' => esc_html__('ms 600', 'uncode') ,
			) ,
			array(
				'value' => '700',
				'label' => esc_html__('ms 700', 'uncode') ,
			) ,
			array(
				'value' => '800',
				'label' => esc_html__('ms 800', 'uncode') ,
			) ,
			array(
				'value' => '900',
				'label' => esc_html__('ms 900', 'uncode') ,
			) ,
			array(
				'value' => '1000',
				'label' => esc_html__('ms 1000', 'uncode') ,
			) ,
		),
	);

	$header_fields = array(
		array(
			'label' => '<i class="fa fa-columns2 fa-fw"></i> ' . esc_html__('Header', 'uncode') ,
			'id' => '_uncode_header_tab',
			'type' => 'tab',
		) ,
		run_array_mb($header_type) ,
		run_array_mb($header_blocks_list, '_uncode_header_type:is(header_uncodeblock)') ,
		run_array_mb($header_revslider_list, '_uncode_header_type:is(header_revslider)') ,
		run_array_mb($header_layerslider_list, '_uncode_header_type:is(header_layerslider)') ,
		run_array_mb($header_full_width, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_height, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_min_height, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_custom, '_uncode_header_type:is(header_basic),_uncode_header_title:is(on)') ,
		run_array_mb($header_text, '_uncode_header_type:is(header_basic),_uncode_header_title_custom:is(on)') ,
		run_array_mb($header_style, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_content_width, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_custom_width, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_align, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_position, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_font, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_size, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_height, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_spacing, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_weight, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_transform, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_italic, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_text_animation, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_animation_speed, '_uncode_header_text_animation:not()') ,
		run_array_mb($header_animation_delay, '_uncode_header_text_animation:not()') ,
		run_array_mb($header_featured, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_background, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_parallax, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_overlay_color, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_overlay_color_alpha, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_scroll_opacity, '_uncode_header_type:is(header_basic),_uncode_header_type:is(header_uncodeblock)') ,
		run_array_mb($header_scrolldown, '_uncode_header_type:not(),_uncode_header_type:not(none)') ,
		run_array_mb($header_name, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($menu_no_padding) ,
	);

	$fields = array_merge($fields, $header_fields);

	///////////////////////
	//  Body specific   ///
	///////////////////////

	$specific_style = array(
		'id' => '_uncode_specific_style',
		'label' => esc_html__('Skin', 'uncode') ,
		'desc' => esc_html__('Override the content skin.', 'uncode') ,
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'light',
				'label' => esc_html__('Light', 'uncode') ,
			) ,
			array(
				'value' => 'dark',
				'label' => esc_html__('Dark', 'uncode') ,
			) ,
		) ,
	);

	$specific_layout_width = array(
		'id' => '_uncode_specific_layout_width',
		'label' => esc_html__('Content width', 'uncode') ,
		'desc' => esc_html__('Override the content width.', 'uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'full',
				'label' => esc_html__('Full', 'uncode') ,
			) ,
			array(
				'value' => 'limit',
				'label' => esc_html__('Limit', 'uncode') ,
			) ,
		) ,
	);

	$specific_layout_width_custom = array(
		'id' => '_uncode_specific_layout_width_custom',
		'label' => esc_html__('Custom width', 'uncode') ,
		'desc' => esc_html__('Define the custom width for the content area in px or in %.', 'uncode') ,
		'type' => 'measurement',
		'operator' => 'or',
	);

	$specific_breadcrumb = array(
		'id' => '_uncode_specific_breadcrumb',
		'label' => esc_html__('Show breadcrumb', 'uncode') ,
		'desc' => esc_html__('Override to show the navigation breadcrumb.','uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode') ,
			) ,
		),
	);

	$specific_breadcrumb_align = array(
		'id' => '_uncode_specific_breadcrumb_align',
		'label' => esc_html__('Breadcrumb align', 'uncode') ,
		'desc' => esc_html__('Specify the breadcrumb alignment','uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Right', 'uncode') ,
			) ,
			array(
				'value' => 'center',
				'label' => esc_html__('Center', 'uncode') ,
			) ,
			array(
				'value' => 'left',
				'label' => esc_html__('Left', 'uncode') ,
			) ,
		) ,
		'operator' => 'or',
	);

	$specific_title = array(
		'id' => '_uncode_specific_title',
		'label' => esc_html__('Show title', 'uncode') ,
		'desc' => esc_html__('Override to show the title in the content area.','uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode') ,
			) ,
		),
	);

	$specific_media = array(
		'id' => '_uncode_specific_media',
		'label' => esc_html__('Show media', 'uncode') ,
		'desc' => esc_html__('Override to show the media in the content area.','uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode') ,
			) ,
		),
	);

	$specific_tags = array(
		'id' => '_uncode_specific_tags',
		'label' => esc_html__('Show tags', 'uncode') ,
		'desc' => esc_html__('Override to show the tags module.','uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode') ,
			) ,
		),
	);

	$specific_tags_align = array(
		'id' => '_uncode_specific_tags_align',
		'label' => esc_html__('Tags alignment', 'uncode') ,
		'desc' => esc_html__('Specify the tags alignment.','uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => 'left',
				'label' => esc_html__('Left align', 'uncode') ,
				'src' => ''
			) ,
			array(
				'value' => 'center',
				'label' => esc_html__('Center align', 'uncode') ,
				'src' => ''
			) ,
			array(
				'value' => 'right',
				'label' => esc_html__('Right align', 'uncode') ,
				'src' => ''
			)
		),
		'operator' => 'or',
		'condition' => '_uncode_specific_tags:is(on)',
	);

	$specific_share = array(
		'id' => '_uncode_specific_share',
		'label' => esc_html__('Show share', 'uncode') ,
		'desc' => esc_html__('Override to show the share module.','uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode') ,
			) ,
		),
	);

	$specific_content_block_before = array(
		'id' => '_uncode_specific_content_block_before',
		'label' => esc_html__('Content Block - Before Content', 'uncode') ,
		'desc' => esc_html__('Specify the Content Block.', 'uncode') ,
		'type' => 'select',
		'choices' => $uncodeblocks_extended
	);

	$specific_content_block_after = array(
		'id' => '_uncode_specific_content_block_after',
		'label' => esc_html__('Content Block - After Content', 'uncode') ,
		'desc' => esc_html__('Specify the Content Block.', 'uncode') ,
		'type' => 'select',
		'choices' => $uncodeblocks_extended
	);

	$specific_bg_color = array(
		'id' => '_uncode_specific_bg_color',
		'label' => esc_html__('Background color', 'uncode') ,
		'desc' => esc_html__('Specify a custom content background color.', 'uncode') ,
		'type' => 'uncode_colors_w_transp',
	);

	$body_fields = array(
		array(
			'label' => '<i class="fa fa-layout fa-fw"></i> ' . esc_html__('Content', 'uncode') ,
			'id' => '_uncode_body_tab',
			'type' => 'tab',
		) ,
		run_array_mb($specific_style) ,
		run_array_mb($specific_bg_color) ,
		run_array_mb($specific_layout_width) ,
		run_array_mb($specific_layout_width_custom, '_uncode_specific_layout_width:is(limit)') ,
		run_array_mb($specific_breadcrumb) ,
		run_array_mb($specific_breadcrumb_align, '_uncode_specific_breadcrumb:is(on)') ,
		//run_array_mb($specific_content_block_before) ,
		run_array_mb($specific_title) ,
		run_array_mb($specific_media) ,
		run_array_mb($specific_share) ,
	);

	if ($post_type === 'post') {
		$body_fields[] = run_array_mb($specific_tags);
		$body_fields[] = run_array_mb($specific_tags_align, '_uncode_specific_tags:is(on)');
	}

	$body_fields[] = run_array_mb($specific_content_block_after);

	$fields = array_merge($fields, $body_fields);

	if ($post_type !== 'product' && $post_type !== 'portfolio') {

		//////////////////////////
		//  Sidebar specific   ///
		//////////////////////////

		$active_sidebar = array(
			'id' => '_uncode_active_sidebar',
			'label' => esc_html__('Activate the sidebar', 'uncode') ,
			'desc' => esc_html__('Override the sidebar visibility.', 'uncode') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Inherit', 'uncode') ,
				) ,
				array(
					'value' => 'on',
					'label' => esc_html__('Yes', 'uncode') ,
				) ,
				array(
					'value' => 'off',
					'label' => esc_html__('No', 'uncode') ,
				) ,
			),
		);

		$sidebar = array(
			'id' => '_uncode_sidebar',
			'label' => esc_html__('Sidebar', 'uncode') ,
			'desc' => esc_html__('Specify the sidebar.', 'uncode') ,
			'type' => 'sidebar-select',
			'operator' => 'or',
		);

		$sidebar_position = array(
			'id' => '_uncode_sidebar_position',
			'label' => esc_html__('Position', 'uncode') ,
			'desc' => esc_html__('Specify the position of the sidebar.', 'uncode') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => 'sidebar_right',
					'label' => esc_html__('Right', 'uncode') ,
				) ,
				array(
					'value' => 'sidebar_left',
					'label' => esc_html__('Left', 'uncode') ,
				) ,
			) ,
			'operator' => 'and',
		);

		$sidebar_size = array(
			'id' => '_uncode_sidebar_size',
			'label' => esc_html__('Size', 'uncode') ,
			'desc' => esc_html__('Set the size of the sidebar.', 'uncode') ,
			'std' => '4',
			'min_max_step' => '1,11,1',
			'type' => 'numeric-slider',
			'operator' => 'and',
		);

		$sidebar_sticky = array(
			'id' => '_uncode_sidebar_sticky',
			'label' => esc_html__('Sticky sidebar', 'uncode') ,
			'desc' => esc_html__('Activate to have a sticky sidebar.', 'uncode') ,
			'type' => 'on-off',
			'std' => 'off',
			'operator' => 'and',
		);

		$sidebar_style = array(
			'id' => '_uncode_sidebar_style',
			'label' => esc_html__('Skin', 'uncode') ,
			'desc' => esc_html__('Override the sidebar text skin color.', 'uncode') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Inherit', "uncode") ,
				) ,
				array(
					'value' => 'light',
					'label' => esc_html__('Light', "uncode") ,
				) ,
				array(
					'value' => 'dark',
					'label' => esc_html__('Dark', "uncode") ,
				)
			),
			'operator' => 'and',
		);

		$sidebar_bgcolor = array(
			'id' => '_uncode_sidebar_bgcolor',
			'label' => esc_html__('Background color', 'uncode') ,
			'desc' => esc_html__('Specify the sidebar background color.', 'uncode') ,
			'type' => 'uncode_color',
			'operator' => 'and',
		);

		$sidebar_fill = array(
			'id' => '_uncode_sidebar_fill',
			'label' => esc_html__('Sidebar filling space', 'uncode') ,
			'desc' => esc_html__('Activate to remove padding around the sidebar and fill the height.', 'uncode') ,
			'type' => 'on-off',
			'std' => 'off',
			'operator' => 'and',
		);

		$sidebar_fields = array(
			array(
				'label' => '<i class="fa fa-content-right fa-fw"></i> ' . esc_html__('Sidebar', 'uncode') ,
				'id' => '_uncode_sidebar_tab',
				'type' => 'tab',
			) ,
			run_array_mb($active_sidebar) ,
			run_array_mb($sidebar, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_position, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_size, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_sticky, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_style, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_bgcolor, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_fill, '_uncode_active_sidebar:is(on),_uncode_sidebar_bgcolor:not()') ,
		);

		$fields = array_merge($fields, $sidebar_fields);

	}

	if ($post_type === 'portfolio') {

		////////////////////////////
		//  Portfolio specific   ///
		////////////////////////////

		$portfolio_details = ot_get_option('_uncode_portfolio_details');

		if (isset($portfolio_details) && !empty($portfolio_details))
		{
			foreach ($portfolio_details as $key => $value)
			{
				$portfolio_details[$key]['id'] = $value['_uncode_portfolio_detail_unique_id'];
				$portfolio_details[$key]['label'] = $value['title'];
				$portfolio_details[$key]['type'] = 'text';
				$portfolio_details[$key]['condition'] = '_uncode_portfolio_active:not(off)';
			}
		}

		$portfolio_fields = array(
			array(
				'label' => '<i class="fa fa-briefcase3 fa-fw"></i> ' . esc_html__('Details', 'uncode') ,
				'id' => '_uncode_portfolio_tab',
				'type' => 'tab',
			) ,
			array(
				'id' => '_uncode_portfolio_active',
				'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('details', 'uncode') ,
				'desc' => sprintf( esc_html__('Override the %s visibility.','uncode'), $portfolio_cpt_name),
				'type' => 'select',
				'choices' => array(
					array(
						'value' => '',
						'label' => esc_html__('Inherit', 'uncode') ,
					) ,
					array(
						'value' => 'on',
						'label' => esc_html__('Yes', 'uncode') ,
					) ,
					array(
						'value' => 'off',
						'label' => esc_html__('No', 'uncode') ,
					) ,
				),
			) ,
			array(
				'id' => '_uncode_portfolio_position',
				'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('details layout', 'uncode') ,
				'desc' => sprintf(esc_html__('Specify the layout template for all the %s posts.', 'uncode') , $portfolio_cpt_name) ,
				'type' => 'select',
				'choices' => array(
					array(
						'value' => 'portfolio_top',
						'label' => esc_html__('Details on the top', 'uncode') ,
					) ,
					array(
						'value' => 'sidebar_right',
						'label' => esc_html__('Details on the right', 'uncode') ,
					) ,
					array(
						'value' => 'portfolio_bottom',
						'label' => esc_html__('Details on the bottom', 'uncode') ,
					) ,
					array(
						'value' => 'sidebar_left',
						'label' => esc_html__('Details on the left', 'uncode') ,
					) ,
				),
				'operator' => 'or',
				'condition' => '_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_sidebar_size',
				'label' => esc_html__('Sidebar size', 'uncode') ,
				'desc' => esc_html__('Set the sidebar size.', 'uncode') ,
				'std' => '4',
				'min_max_step' => '1,12,1',
				'type' => 'numeric-slider',
				'operator' => 'and',
				'condition' => '_uncode_portfolio_position:contains(sidebar),_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_sidebar_sticky',
				'label' => esc_html__('Sticky sidebar', 'uncode') ,
				'desc' => esc_html__('Activate to have a sticky sidebar.', 'uncode') ,
				'type' => 'on-off',
				'std' => 'off',
				'operator' => 'and',
				'condition' => '_uncode_portfolio_position:contains(sidebar),_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_style',
				'label' => esc_html__('Skin', 'uncode') ,
				'desc' => esc_html__('Override the sidebar text skin color.', 'uncode') ,
				'type' => 'select',
				'choices' => array(
					array(
						'value' => '',
						'label' => esc_html__('Inherit', "uncode") ,
					) ,
					array(
						'value' => 'light',
						'label' => esc_html__('Light', "uncode") ,
					) ,
					array(
						'value' => 'dark',
						'label' => esc_html__('Dark', "uncode") ,
					)
				),
				'operator' => 'or',
				'condition' => '_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_bgcolor',
				'label' => esc_html__('Background color', 'uncode') ,
				'desc' => esc_html__('Specify the background color.', 'uncode') ,
				'type' => 'uncode_color',
				'operator' => 'or',
				'condition' => '_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_sidebar_fill',
				'label' => esc_html__('Sidebar filling space', 'uncode') ,
				'desc' => esc_html__('Activate to remove padding around the sidebar and fill the height.', 'uncode') ,
				'type' => 'on-off',
				'std' => 'off',
				'operator' => 'and',
				'condition' => '_uncode_portfolio_position:contains(sidebar),_uncode_portfolio_bgcolor:not(),_uncode_portfolio_active:is(on)',
			) ,
		);

		if (!empty($portfolio_details)) $portfolio_fields = array_merge($portfolio_fields, $portfolio_details);

		$fields = array_merge($fields, $portfolio_fields);

	}

	if ($post_type === 'post' || $post_type === 'portfolio' || $post_type === 'product') {

		/////////////////////////////////////////
		//  Post/Portfolio/Product specific   ///
		/////////////////////////////////////////

		$ppp_fields = array(
			array(
				'label' => '<i class="fa fa-location fa-fw"></i> ' . esc_html__('Navigation', 'uncode') ,
				'id' => '_uncode_navigation_tab',
				'type' => 'tab',
			) ,
			array(
				'id' => '_uncode_specific_navigation_index',
			  'label' => esc_html__( 'Navigation parent', 'uncode' ),
		    'type' => 'page-select',
		    'desc' => esc_html__('Specify the parent page to create the navigation logic.', 'uncode') ,
			) ,
		);

		$fields = array_merge($fields, $ppp_fields);

	}

	/////////////////////////
	//  Footer specific   ///
	/////////////////////////

	if (is_plugin_active('uncode-core/uncode-core.php')) {

		$specific_footer_blocks_list = array(
			'id' => '_uncode_specific_footer_block',
			'label' => esc_html__('Content Block', 'uncode') ,
			'desc' => esc_html__('Specify the Content Block.', 'uncode') ,
			'type' => 'select',
			'operator' => 'or',
			'choices' => $uncodeblocks_extended
		);

	} else {
		$specific_footer_blocks_list = null;
		$uncodeblocks_extended = null;
	}

	$specific_footer_width = array(
		'id' => '_uncode_specific_footer_width',
		'label' => esc_html__('Footer width', 'uncode') ,
		'desc' => esc_html__('Override the footer width.' ,'uncode'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode') ,
			) ,
			array(
				'value' => 'full',
				'label' => esc_html__('Full', 'uncode') ,
			) ,
			array(
				'value' => 'limit',
				'label' => esc_html__('Limit', 'uncode') ,
			) ,
		) ,
	);

	$footer_fields = array(
		array(
			'label' => '<i class="fa fa-ellipsis fa-fw"></i> ' . esc_html__('Footer', 'uncode') ,
			'id' => '_uncode_footer_tab',
			'type' => 'tab',
		) ,
		run_array_mb($specific_footer_blocks_list) ,
		run_array_mb($specific_footer_width) ,
	);

	$fields = array_merge($fields, $footer_fields);

	$get_custom_fields = ot_get_option('_uncode_'.$post_type.'_custom_fields');
	if (isset($get_custom_fields) && !empty($get_custom_fields))
	{
		foreach ($get_custom_fields as $key => $value)
		{
			$get_custom_fields[$key]['id'] = $value['_uncode_cf_unique_id'];
			$get_custom_fields[$key]['label'] = $value['title'];
			$get_custom_fields[$key]['type'] = 'text';
		}
	}

	$custom_fields = array(
		array(
			'label' => '<i class="fa fa-pencil3 fa-fw"></i> ' . esc_html__('Custom fields', 'uncode') ,
			'id' => '_uncode_cf_tab',
			'type' => 'tab',
		) ,
	);

	if (!empty($get_custom_fields)) $custom_fields = array_merge($custom_fields, $get_custom_fields);

	$fields = array_merge($fields, $custom_fields);

	$uncode_page_array = array(
		'id' => '_uncode_page_options',
		'title' => esc_html__('Page Options', 'uncode') ,
		'desc' => '',
		'pages' => $uncode_post_types,
		'context' => 'normal',
		'priority' => 'default',
		'fields' => $fields
	);

	if (function_exists('ot_register_meta_box')) ot_register_meta_box($uncode_page_array);

}
add_action('admin_init', 'uncode_page_options');