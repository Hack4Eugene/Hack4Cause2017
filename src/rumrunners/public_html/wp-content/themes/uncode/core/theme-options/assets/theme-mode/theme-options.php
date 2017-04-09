<?php

/**
 * Initialize the custom Theme Options.
 */
add_action('admin_init', 'custom_theme_options');

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options()
{

	global $wpdb, $uncode_colors, $uncode_post_types;

	if (!isset($uncode_post_types)) $uncode_post_types = uncode_get_post_types();
	/**
	 * Get a copy of the saved settings array.
	 */
	$saved_settings = get_option(ot_settings_id() , array());

	/**
	 * Custom settings array that will eventually be
	 * passes to the OptionTree Settings API Class.
	 */

	if (!function_exists('ot_filter_measurement_unit_types'))
	{
		function ot_filter_measurement_unit_types($array, $field_id)
		{
			return array(
				'px' => 'px',
				'%' => '%'
			);
		}
	}

	add_filter('ot_measurement_unit_types', 'ot_filter_measurement_unit_types', 10, 2);

	function run_array_to($array, $key = '', $value = '')
	{
		$array[$key] = $value;
		return $array;
	}

	$stylesArrayMenu = array(
		array(
			'value' => 'light',
			'label' => esc_html__('Light', 'uncode') ,
			'src' => ''
		) ,
		array(
			'value' => 'dark',
			'label' => esc_html__('Dark', 'uncode') ,
			'src' => ''
		)
	);

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

	if (is_plugin_active('uncode-core/uncode-core.php')) {

		$uncodeblock = array(
			'value' => 'header_uncodeblock',
			'label' => esc_html__('Content Block', 'uncode') ,
		);

		$uncodeblocks = array(
			array(
				'value' => '','label' => esc_html__('Inherit', 'uncode')
			),
			array(
				'value' => 'none','label' => esc_html__('None', 'uncode')
			)
		);

		$blocks_query = new WP_Query( 'post_type=uncodeblock&posts_per_page=-1&post_status=publish' );

		foreach ($blocks_query->posts as $block) {
			$uncodeblocks[] = array(
				'value' => $block->ID,
				'label' => $block->post_title,
				'postlink' => get_edit_post_link($block->ID),
			);
		}

		if ($blocks_query->post_count === 0) {
			$uncodeblocks[] = array(
				'value' => '',
				'label' => esc_html__('No Content Blocks found', 'uncode')
			);
		}

		$uncodeblock_404 = array(
			'id' => '_uncode_404_body',
			'label' => esc_html__('404 content', 'uncode') ,
			'desc' => esc_html__('Specify a content for the 404 page.', 'uncode'),
			'std' => '',
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode') ,
				) ,
				array(
					'value' => 'body_uncodeblock',
					'label' => esc_html__('Content Block', 'uncode') ,
				),
			),
			'section' => 'uncode_404_section',
		);

		$uncodeblocks_404 = array(
			'id' => '_uncode_404_body_block',
			'label' => esc_html__('404 content block', 'uncode') ,
			'desc' => esc_html__('Specify a content for the 404 page.', 'uncode'),
			'type' => 'select',
			'choices' => $uncodeblocks,
			'section' => 'uncode_404_section',
			'operator' => 'and',
			'condition' => '_uncode_404_body:is(body_uncodeblock)',
		);

	} else {
		$uncodeblock = $uncodeblock_404 = $uncodeblocks_404 = '';
		$uncodeblocks = array();
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
				'label' => esc_html__('No Revolution Sliders found', 'uncode')
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
				'label' => esc_html__('No LayerSliders found', 'uncode')
			);
		}
	}
	else $layerslider = $layersliders = '';

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

	$fonts = get_option('uncode_font_options');
	$title_font = array();

	if (isset($fonts['font_stack']) && $fonts['font_stack'] !== '[]')
	{
		$font_stack_string = $fonts['font_stack'];
		$font_stack = json_decode(str_replace('&quot;', '"', $font_stack_string) , true);

		foreach ($font_stack as $font)
		{
			if ($font['source'] === 'Font Squirrel')
			{
				$variants = explode(',', $font['variants']);
				$label = (string)$font['family'] . ' - ';
				$weight = array();
				foreach ($variants as $variant)
				{
					if (strpos(strtolower($variant) , 'hairline') !== false)
					{
						$weight[] = 100;
					}
					else if (strpos(strtolower($variant) , 'light') !== false)
					{
						$weight[] = 200;
					}
					else if (strpos(strtolower($variant) , 'regular') !== false)
					{
						$weight[] = 400;
					}
					else if (strpos(strtolower($variant) , 'semibold') !== false)
					{
						$weight[] = 500;
					}
					else if (strpos(strtolower($variant) , 'bold') !== false)
					{
						$weight[] = 600;
					}
					else if (strpos(strtolower($variant) , 'black') !== false)
					{
						$weight[] = 800;
					}
					else
					{
						$weight[] = 400;
					}
				}
				$label.= implode(',', $weight);
				$title_font[] = array(
					'value' => urlencode((string)$font['family']),
					'label' => $label
				);
			}
			else if ($font['source'] === 'Google Web Fonts')
			{
				$label = (string)$font['family'] . ' - ' . $font['variants'];
				$title_font[] = array(
					'value' => urlencode((string)$font['family']),
					'label' => $label
				);
			}
			else if ($font['source'] === 'Typekit')
			{
				$label = (string)$font['family'] . ' - ';
				$variants = explode(',', $font['variants']);
				foreach ($variants as $key => $variant)
				{
					preg_match("|\d+|", $variants[$key], $weight);
					$variants[$key] = $weight[0] . '00';
				}
				$label.= implode(',', $variants);
				$title_font[] = array(
					'value' => urlencode(str_replace('"', '', (string)$font['stub'])),
					'label' => $label
				);
			}
			else
			{
				$title_font[] = array(
					'value' => urlencode((string)$font['family']),
					'label' => (string)$font['family']
				);
			}
		}
	}
	else
	{
		$title_font = array(
			array(
				'value' => '',
				'label' => esc_html__('No fonts activated.', "uncode"),
			)
		);
	}

	$title_font[] = array(
		'value' => 'manual',
		'label' => __('Manually entered','uncode')
	);

	$custom_fonts = array(
		array(
			'value' => '',
			'label' => esc_html__('Default CSS', "uncode"),
		)
	);

	$custom_fonts_array = ot_get_option('_uncode_font_groups');
	if (!empty($custom_fonts_array)) {
		foreach ($custom_fonts_array as $key => $value) {
			$custom_fonts[] = array(
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

	$menu_section_title = array(
		'id' => '_uncode_%section%_menu_block_title',
		'label' => ' <i class="fa fa-menu"></i> ' . esc_html__('Menu', 'uncode') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$menu = array(
		'id' => '_uncode_%section%_menu',
		'label' => esc_html__('Menu', 'uncode') ,
		'desc' => esc_html__('Override the primary menu created in \'Appearance -> Menus\'.','uncode'),
		'type' => 'select',
		'choices' => $menus_array,
		'section' => 'uncode_%section%_section',
	);

	$menu_width = array(
		'id' => '_uncode_%section%_menu_width',
		'label' => esc_html__('Menu width', 'uncode') ,
		'desc' => esc_html__('Override the menu width.', 'uncode'),
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
		'section' => 'uncode_%section%_section',
	);

	$menu_opaque = array(
		'id' => '_uncode_%section%_menu_opaque',
		'label' => esc_html__('Remove transparency', 'uncode') ,
		'type' => 'on-off',
		'desc' => esc_html__('Override to remove the transparency eventually declared in \'Customize -> Light/Dark skin\'.', 'uncode') ,
		'std' => 'off',
		'section' => 'uncode_%section%_section',
	);

	$header_section_title = array(
		'id' => '_uncode_%section%_header_block_title',
		'label' => '<i class="fa fa-columns2"></i> ' . esc_html__('Header', 'uncode') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$header_type = array(
		'id' => '_uncode_%section%_header',
		'label' => esc_html__('Type', 'uncode') ,
		'desc' => esc_html__('Specify the header type.', 'uncode'),
		'std' => 'none',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => 'none',
				'label' => esc_html__('Select…', 'uncode') ,
			) ,
			array(
				'value' => 'header_basic',
				'label' => esc_html__('Basic', 'uncode') ,
			) ,
			$uncodeblock,
			$revslider,
			$layerslider,
		),
		'section' => 'uncode_%section%_section',
	);

	if (is_plugin_active('uncode-core/uncode-core.php')) {

		$header_uncode_block = array(
			'id' => '_uncode_%section%_blocks',
			'label' => esc_html__('Content Block', 'uncode') ,
			'desc' => esc_html__('Specify the Content Block.', 'uncode') ,
			'type' => 'custom-post-type-select',
			'condition' => '_uncode_%section%_header:is(header_uncodeblock)',
			'operator' => 'or',
			'post_type' => 'uncodeblock',
			'section' => 'uncode_%section%_section',
		);

	} else {
		$header_uncode_block = null;
	}

	$header_revslider = array(
		'id' => '_uncode_%section%_revslider',
		'label' => esc_html__('Revslider', 'uncode') ,
		'desc' => esc_html__('Specify the RevSlider.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_revslider)',
		'operator' => 'or',
		'choices' => $revsliders,
		'section' => 'uncode_%section%_section',
	);

	$header_layerslider = array(
		'id' => '_uncode_%section%_layerslider',
		'label' => esc_html__('LayerSlider', 'uncode') ,
		'desc' => esc_html__('Specify the LayerSlider.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_layerslider)',
		'operator' => 'or',
		'choices' => $layersliders,
		'section' => 'uncode_%section%_section',
	);

	$header_title = array(
		'label' => esc_html__('Title in header', 'uncode') ,
		'id' => '_uncode_%section%_header_title',
		'type' => 'on-off',
		'desc' => esc_html__('Activate to show title in the header.', 'uncode') ,
		'std' => 'on',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'or',
	);

	$header_title_text = array(
		'id' => '_uncode_%section%_header_title_text',
		'label' => esc_html__('Custom text', 'uncode') ,
		'desc' => esc_html__('Add custom text for the header. Every newline in the field is a new line in the title.', 'uncode') ,
		'type' => 'textarea-simple',
		'rows' => '15',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
	);

	$header_style = array(
		'id' => '_uncode_%section%_header_style',
		'label' => esc_html__('Skin', 'uncode') ,
		'desc' => esc_html__('Specify the header text skin.', 'uncode') ,
		'std' => 'light',
		'type' => 'select',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'and',
		'choices' => $stylesArrayMenu
	);

	$header_width = array(
		'id' => '_uncode_%section%_header_width',
		'label' => esc_html__('Header width', 'uncode') ,
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
		'desc' => esc_html__('Override the header width.', 'uncode') ,
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:contains(header)',
		'operator' => 'or',
	);

	$header_content_width = array(
		'id' => '_uncode_%section%_header_content_width',
		'label' => esc_html__('Content full width', 'uncode') ,
		'type' => 'on-off',
		'desc' => esc_html__('Activate to expand the header content to full width.', 'uncode') ,
		'std' => 'off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'and',
	);

	$header_custom_width = array(
		'id' => '_uncode_%section%_header_custom_width',
		'label' => esc_html__('Custom inner width','uncode'),
		'desc' => esc_html__('Adjust the inner content width in %.', 'uncode') ,
		'std' => '100',
		'type' => 'numeric-slider',
		'min_max_step' => '0,100,1',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'and',
		'section' => 'uncode_%section%_section',
	);

	$header_align = array(
		'id' => '_uncode_%section%_header_align',
		'label' => esc_html__('Content alignment', 'uncode') ,
		'desc' => esc_html__('Specify the text/content alignment.', 'uncode') ,
		'std' => 'center',
		'type' => 'select',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => 'left',
				'label' => esc_html__('Left', 'uncode') ,
				'src' => ''
			) ,
			array(
				'value' => 'center',
				'label' => esc_html__('Center', 'uncode') ,
				'src' => ''
			) ,
			array(
				'value' => 'right',
				'label' => esc_html__('Right', 'uncode') ,
				'src' => ''
			)
		)
	);

	$header_height = array(
		'id' => '_uncode_%section%_header_height',
		'label' => esc_html__('Height', 'uncode') ,
		'desc' => esc_html__('Define the height of the header in px or in % (relative to the window height).', 'uncode') ,
		'type' => 'measurement',
		'std' => array(
			'60',
			'%'
		) ,
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'or',
		'section' => 'uncode_%section%_section',
	);

	$header_min_height = array(
		'id' => '_uncode_%section%_header_min_height',
		'label' => esc_html__('Minimal height', 'uncode') ,
		'desc' => esc_html__('Enter a minimun height for the header in pixel.', 'uncode') ,
		'type' => 'text',
		'std' => '300',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'or',
		'section' => 'uncode_%section%_section',
	);

	$header_position = array(
		'id' => '_uncode_%section%_header_position',
		'label' => esc_html__('Position', 'uncode') ,
		'desc' => esc_html__('Specify the position of the header content inside the container.', 'uncode') ,
		'std' => 'header-center header-middle',
		'type' => 'select',
		'operator' => 'and',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
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
		),
		'section' => 'uncode_%section%_section',
	);

	$header_title_font = array(
		'id' => '_uncode_%section%_header_title_font',
		'label' => esc_html__('Title font family', 'uncode') ,
		'desc' => esc_html__('Specify the font for the title.', 'uncode') ,
		'std' => 'font-762333',
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
		'choices' => $custom_fonts,
		'section' => 'uncode_%section%_section',
	);

	$header_title_size = array(
		'id' => '_uncode_%section%_header_title_size',
		'label' => esc_html__('Title font size', 'uncode') ,
		'desc' => esc_html__('Specify the font size for the title.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
		'choices' => $title_size,
		'section' => 'uncode_%section%_section',
	);

	$header_title_height = array(
		'id' => '_uncode_%section%_header_title_height',
		'label' => esc_html__('Title line height', 'uncode') ,
		'desc' => esc_html__('Specify the line height for the title.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
		'choices' => $title_height,
		'section' => 'uncode_%section%_section',
	);

	$header_title_spacing = array(
		'id' => '_uncode_%section%_header_title_spacing',
		'label' => esc_html__('Title letter spacing', 'uncode') ,
		'desc' => esc_html__('Specify the letter spacing for the title.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
		'choices' => $title_spacing,
		'section' => 'uncode_%section%_section',
	);

	$header_title_weight = array(
		'id' => '_uncode_%section%_header_title_weight',
		'label' => esc_html__('Title font weight', 'uncode') ,
		'desc' => esc_html__('Specify the font weight for the title.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
		'choices' => $title_weight,
		'section' => 'uncode_%section%_section',
	);

	$header_title_italic = array(
		'id' => '_uncode_%section%_header_title_italic',
		'label' => esc_html__('Title italic', 'uncode') ,
		'desc' => esc_html__('Activate the font style italic for the title.', 'uncode') ,
		'type' => 'on-off',
		'std' => 'off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
	);

	$header_title_transform = array(
		'id' => '_uncode_%section%_header_title_transform',
		'label' => esc_html__('Title text transform', 'uncode') ,
		'desc' => esc_html__('Specify the title text transformation.', 'uncode') ,
		'type' => 'select',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
		'operator' => 'and',
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

	$header_text_animation = array(
		'id' => '_uncode_%section%_header_text_animation',
		'label' => esc_html__('Text animation', 'uncode') ,
		'desc' => esc_html__('Specify the entrance animation of the title text.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
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
		),
		'section' => 'uncode_%section%_section',
	);

	$header_animation_delay = array(
		'id' => '_uncode_%section%_header_animation_delay',
		'label' => esc_html__('Animation delay', 'uncode') ,
		'desc' => esc_html__('Specify the entrance animation delay of the title text in milliseconds.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on),_uncode_%section%_header_text_animation:not()',
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
		'section' => 'uncode_%section%_section',
	);

	$header_animation_speed = array(
		'id' => '_uncode_%section%_header_animation_speed',
		'label' => esc_html__('Animation speed', 'uncode') ,
		'desc' => esc_html__('Specify the entrance animation speed of the title text in milliseconds.', 'uncode') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on),_uncode_%section%_header_text_animation:not()',
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
		'section' => 'uncode_%section%_section',
	);

	$header_featured = array(
		'label' => esc_html__('Featured media in header', 'uncode') ,
		'id' => '_uncode_%section%_header_featured',
		'type' => 'on-off',
		'desc' => esc_html__('Activate to use the featured image in the header.', 'uncode') ,
		'std' => 'on',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'or',
	);

	$header_background = array(
		'id' => '_uncode_%section%_header_background',
		'label' => esc_html__('Background', 'uncode') ,
		'desc' => esc_html__('Specify the background media and color.', 'uncode') ,
		'type' => 'background',
		'std' => array(
			'background-color' => 'color-lxmt',
			'background-repeat' => '',
			'background-attachment' => '',
			'background-position' => '',
			'background-size' => '',
			'background-image' => '',
		),
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'or',
	);

	$header_parallax = array(
		'id' => '_uncode_%section%_header_parallax',
		'label' => esc_html__('Parallax', 'uncode') ,
		'type' => 'on-off',
		'desc' => esc_html__('Activate the background parallax effect.', 'uncode') ,
		'std' => 'off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'or',
	);

	$header_overlay_color = array(
		'id' => '_uncode_%section%_header_overlay_color',
		'label' => esc_html__('Overlay color', 'uncode') ,
		'desc' => esc_html__('Specify the overlay background color.', 'uncode') ,
		'type' => 'uncode_color',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'or',
	);

	$header_overlay_color_alpha = array(
		'id' => '_uncode_%section%_header_overlay_color_alpha',
		'label' => esc_html__('Overlay color opacity', 'uncode') ,
		'desc' => esc_html__('Set the overlay opacity.', 'uncode') ,
		'std' => '100',
		'min_max_step' => '0,100,1',
		'type' => 'numeric-slider',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic)',
		'operator' => 'or',
	);

	$header_scroll_opacity = array(
		'id' => '_uncode_%section%_header_scroll_opacity',
		'label' => esc_html__('Scroll opacity', 'uncode') ,
		'desc' => esc_html__('Activate alpha animation when scrolling down.', 'uncode') ,
		'type' => 'on-off',
		'std' => 'off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header:is(header_uncodeblock)',
		'operator' => 'or',
	);

	$header_scrolldown = array(
		'id' => '_uncode_%section%_header_scrolldown',
		'label' => esc_html__('Scroll down arrow', 'uncode') ,
		'desc' => esc_html__('Activate the scroll down arrow button.', 'uncode') ,
		'type' => 'on-off',
		'std' => 'on',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:not(none)',
		'operator' => 'or',
	);

	$show_breadcrumb = array(
		'id' => '_uncode_%section%_breadcrumb',
		'label' => esc_html__('Show breadcrumb', 'uncode') ,
		'desc' => esc_html__('Activate to show the navigation breadcrumb.', 'uncode') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$breadcrumb_align = array(
		'id' => '_uncode_%section%_breadcrumb_align',
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
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_breadcrumb:is(on)',
		'operator' => 'or',
	);

	$show_title = array(
		'id' => '_uncode_%section%_title',
		'label' => esc_html__('Show title', 'uncode') ,
		'desc' => esc_html__('Activate to show the title in the content area.', 'uncode') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'operator' => 'or'
	);

	$show_media = array(
		'id' => '_uncode_%section%_media',
		'label' => esc_html__('Show media', 'uncode') ,
		'desc' => esc_html__('Activate to show the medias in the content area.', 'uncode') ,
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$show_tags = array(
		'id' => '_uncode_%section%_tags',
		'label' => esc_html__('Show tags', 'uncode') ,
		'desc' => esc_html__('Activate to show the tags and choose visbility by post to post bases.', 'uncode') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$show_tags_align = array(
		'id' => '_uncode_%section%_tags_align',
		'label' => esc_html__('Tags alignment', 'uncode') ,
		'desc' => esc_html__('Specify the tags alignment.', 'uncode') ,
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
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_tags:is(on)',
		'operator' => 'or',
	);

	$show_comments = array(
		'id' => '_uncode_%section%_comments',
		'label' => esc_html__('Show comments', 'uncode') ,
		'desc' => esc_html__('Activate to show the comments and choose visbility by post to post bases.', 'uncode') ,
		'std' => 'on',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$show_share = array(
		'id' => '_uncode_%section%_share',
		'label' => esc_html__('Show share', 'uncode') ,
		'desc' => esc_html__('Activate to show the share module.', 'uncode') ,
		'std' => 'on',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$body_section_title = array(
		'id' => '_uncode_%section%_body_title',
		'label' => '<i class="fa fa-layout"></i> ' . esc_html__('Content', 'uncode') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$body_uncode_block = array(
		'id' => '_uncode_%section%_content_block',
		'label' => esc_html__('Content Block', 'uncode') ,
		'desc' => esc_html__('Define the content block to use.', 'uncode') ,
		'type' => 'select',
		'choices' => $uncodeblocks,
		'section' => 'uncode_%section%_section',
	);

	$body_uncode_block_before = array(
		'id' => '_uncode_%section%_content_block_before',
		'label' => esc_html__('Content Block - Before Content', 'uncode') ,
		'desc' => esc_html__('Define the content block to use.', 'uncode') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
	);

	$body_uncode_block_after = array(
		'id' => '_uncode_%section%_content_block_after',
		'label' => esc_html__('Content Block - After Content', 'uncode') ,
		'desc' => esc_html__('Define the content block to use.', 'uncode') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
	);

	$body_layout_width = array(
		'id' => '_uncode_%section%_layout_width',
		'label' => esc_html__('Content width', 'uncode') ,
		'desc' => esc_html__('Specify the content width.', 'uncode'),
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
		'section' => 'uncode_%section%_section',
	);

	$body_layout_width_custom = array(
		'id' => '_uncode_%section%_layout_width_custom',
		'label' => esc_html__('Custom width', 'uncode') ,
		'desc' => esc_html__('Define the custom width for the content area in px or in %.', 'uncode') ,
		'type' => 'measurement',
		'condition' => '_uncode_%section%_layout_width:is(limit)',
		'operator' => 'or',
		'section' => 'uncode_%section%_section',
	);

	$body_single_post_width = array(
		'id' => '_uncode_%section%_single_width',
		'label' => esc_html__('Single post width', 'uncode') ,
		'desc' => esc_html__('Specify the single post width from 1 to 12.', 'uncode'),
		'type' => 'select',
		'std' => '4',
		'condition' => '_uncode_%section%_content_block:is(),_uncode_%section%_content_block:is(none)',
		'operator' => 'or',
		'choices' => array(
			array(
				'value' => '1',
				'label' => '1' ,
			) ,
			array(
				'value' => '2',
				'label' => '2' ,
			) ,
			array(
				'value' => '3',
				'label' => '3' ,
			) ,
			array(
				'value' => '4',
				'label' => '4' ,
			) ,
			array(
				'value' => '5',
				'label' => '5' ,
			) ,
			array(
				'value' => '6',
				'label' => '6' ,
			) ,
			array(
				'value' => '7',
				'label' => '7' ,
			) ,
			array(
				'value' => '8',
				'label' => '8' ,
			) ,
			array(
				'value' => '9',
				'label' => '9' ,
			) ,
			array(
				'value' => '10',
				'label' => '10' ,
			) ,
			array(
				'value' => '11',
				'label' => '11' ,
			) ,
			array(
				'value' => '12',
				'label' => '12' ,
			) ,
		) ,
		'section' => 'uncode_%section%_section',
	);

	$body_single_text_lenght = array(
		'id' => '_uncode_%section%_single_text_length',
		'label' => esc_html__('Single teaser text length', 'uncode') ,
		'desc' => esc_html__('Enter the number of words you want for the teaser. If nothing in entered the full content will be showed.', 'uncode') ,
		'type' => 'text',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_content_block:is(),_uncode_%section%_content_block:is(none)',
		'operator' => 'or',
	);

	$sidebar_section_title = array(
		'id' => '_uncode_%section%_sidebar_title',
		'label' => '<i class="fa fa-content-right"></i> ' . esc_html__('Sidebar', 'uncode') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_activate = array(
		'id' => '_uncode_%section%_activate_sidebar',
		'label' => esc_html__('Activate the sidebar', 'uncode') ,
		'desc' => esc_html__('Activate to show the sidebar.', 'uncode') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_widget = array(
		'id' => '_uncode_%section%_sidebar',
		'label' => esc_html__('Sidebar', 'uncode') ,
		'desc' => esc_html__('Specify the sidebar.', 'uncode') ,
		'type' => 'sidebar-select',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
	);

	$sidebar_position = array(
		'id' => '_uncode_%section%_sidebar_position',
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
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_size = array(
		'id' => '_uncode_%section%_sidebar_size',
		'label' => esc_html__('Size', 'uncode') ,
		'desc' => esc_html__('Set the size of the sidebar.', 'uncode') ,
		'std' => '4',
		'min_max_step' => '1,11,1',
		'type' => 'numeric-slider',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_sticky = array(
		'id' => '_uncode_%section%_sidebar_sticky',
		'label' => esc_html__('Sticky sidebar', 'uncode') ,
		'desc' => esc_html__('Activate to have a sticky sidebar.', 'uncode') ,
		'std' => 'off',
		'type' => 'on-off',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_style = array(
		'id' => '_uncode_%section%_sidebar_style',
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
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
	);

	$sidebar_bgcolor = array(
		'id' => '_uncode_%section%_sidebar_bgcolor',
		'label' => esc_html__('Background color', 'uncode') ,
		'desc' => esc_html__('Specify the sidebar background color.', 'uncode') ,
		'type' => 'uncode_color',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
	);

	$sidebar_fill = array(
		'id' => '_uncode_%section%_sidebar_fill',
		'label' => esc_html__('Sidebar filling space', 'uncode') ,
		'desc' => esc_html__('Activate to remove padding around the sidebar and fill the height.', 'uncode') ,
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'std' => 'off',
		'operator' => 'and',
		'condition' => '_uncode_%section%_sidebar_bgcolor:not(),_uncode_%section%_activate_sidebar:not(off)',
	);

	$navigation_section_title = array(
		'id' => '_uncode_%section%_navigation_title',
		'label' => '<i class="fa fa-location"></i> ' . esc_html__('Navigation', 'uncode') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$navigation_activate = array(
		'id' => '_uncode_%section%_navigation_activate',
		'label' => esc_html__('Navigation bar', 'uncode') ,
		'desc' => esc_html__('Activate to show the navigation bar.', 'uncode') ,
		'std' => 'on',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$navigation_page_index = array(
		'id' => '_uncode_%section%_navigation_index',
		'label' => esc_html__('Navigation index', 'uncode') ,
		'desc' => esc_html__('Specify the page you want to use as index.', 'uncode'),
		'type' => 'page-select',
		'section' => 'uncode_%section%_section',
		'operator' => 'and',
		'condition' => '_uncode_%section%_navigation_activate:not(off)',
	);

	$navigation_index_label = array(
		'id' => '_uncode_%section%_navigation_index_label',
		'label' => esc_html__('Index custom label', 'uncode') ,
		'desc' => esc_html__('Enter a custom label for the index button.', 'uncode') ,
		'type' => 'text',
		'section' => 'uncode_%section%_section',
		'operator' => 'and',
		'condition' => '_uncode_%section%_navigation_activate:not(off)',
	);

	$navigation_nextprev_title = array(
		'id' => '_uncode_%section%_navigation_nextprev_title',
		'label' => esc_html__('Navigation titles', 'uncode') ,
		'desc' => esc_html__('Activate to show the next/prev post title.', 'uncode') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'operator' => 'and',
		'condition' => '_uncode_%section%_navigation_activate:not(off)',
	);

	$footer_section_title = array(
		'id' => '_uncode_%section%_footer_block_title',
		'label' => '<i class="fa fa-ellipsis"></i> ' . esc_html__('Footer', 'uncode') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	if (is_plugin_active('uncode-core/uncode-core.php')) {

		$footer_uncode_block = array(
			'id' => '_uncode_%section%_footer_block',
			'label' => esc_html__('Content Block', 'uncode') ,
			'desc' => esc_html__('Override the Content Block.', 'uncode') ,
			'type' => 'select',
			'choices' => $uncodeblocks,
			'section' => 'uncode_%section%_section',
		);

	} else {
		$footer_uncode_block = null;
	}

	$footer_width = array(
		'id' => '_uncode_%section%_footer_width',
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
		'section' => 'uncode_%section%_section',
	);

	$custom_fields_section_title = array(
		'id' => '_uncode_%section%_cf_title',
		'label' => '<i class="fa fa-pencil3"></i> ' . esc_html__('Custom fields', 'uncode') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$custom_fields_list = array(
		'id' => '_uncode_%section%_custom_fields',
		'label' => esc_html__('Custom fields', 'uncode') ,
		'desc' => esc_html__('Create here all the custom fields that can be used inside the posts module.', 'uncode') ,
		'type' => 'list-item',
		'section' => 'uncode_%section%_section',
		'settings' => array(
			array(
				'id' => '_uncode_cf_unique_id',
				'class' => 'unique_id',
				'std' => 'detail-',
				'type' => 'text',
				'label' => esc_html__('Unique custom field ID','uncode') ,
				'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
			),
		)
	);

	$portfolio_cpt_name = ot_get_option('_uncode_portfolio_cpt');
	if ($portfolio_cpt_name == '') $portfolio_cpt_name = 'portfolio';

	$cpt_single_sections = array();
	$cpt_index_sections = array();
	$cpt_single_options = array();
	$cpt_index_options = array();

	if (count($uncode_post_types) > 0) {
		foreach ($uncode_post_types as $key => $value) {
			if ($value !== 'portfolio' && $value !== 'product') {
				$cpt_single_sections[] = array(
					'id' => 'uncode_'.$value.'_section',
					'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . ucfirst($value) . '</span>'
				);
				$cpt_index_sections[] = array(
					'id' => 'uncode_'.$value.'_index_section',
					'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . ucfirst($value) . '</span>'
				);
			}
		}
		foreach ($uncode_post_types as $key => $value) {
			if ($value !== 'portfolio' && $value !== 'product') {
				$cpt_single_options[] = str_replace('%section%', $value, $menu_section_title);
				$cpt_single_options[] = str_replace('%section%', $value, $menu);
				$cpt_single_options[] = str_replace('%section%', $value, $menu_width);
				$cpt_single_options[] = str_replace('%section%', $value, $menu_opaque);
				$cpt_single_options[] = str_replace('%section%', $value, $header_section_title);
				$cpt_single_options[] = str_replace('%section%', $value, $header_type);
				$cpt_single_options[] = str_replace('%section%', $value, $header_uncode_block);
				$cpt_single_options[] = str_replace('%section%', $value, $header_revslider);
				$cpt_single_options[] = str_replace('%section%', $value, $header_layerslider);
				$cpt_single_options[] = str_replace('%section%', $value, $header_width);
				$cpt_single_options[] = str_replace('%section%', $value, $header_height);
				$cpt_single_options[] = str_replace('%section%', $value, $header_min_height);
				$cpt_single_options[] = str_replace('%section%', $value, $header_title);
				$cpt_single_options[] = str_replace('%section%', $value, $header_style);
				$cpt_single_options[] = str_replace('%section%', $value, $header_content_width);
				$cpt_single_options[] = str_replace('%section%', $value, $header_custom_width);
				$cpt_single_options[] = str_replace('%section%', $value, $header_align);
				$cpt_single_options[] = str_replace('%section%', $value, $header_position);
				$cpt_single_options[] = str_replace('%section%', $value, $header_title_font);
				$cpt_single_options[] = str_replace('%section%', $value, $header_title_size);
				$cpt_single_options[] = str_replace('%section%', $value, $header_title_height);
				$cpt_single_options[] = str_replace('%section%', $value, $header_title_spacing);
				$cpt_single_options[] = str_replace('%section%', $value, $header_title_weight);
				$cpt_single_options[] = str_replace('%section%', $value, $header_title_transform);
				$cpt_single_options[] = str_replace('%section%', $value, $header_title_italic);
				$cpt_single_options[] = str_replace('%section%', $value, $header_text_animation);
				$cpt_single_options[] = str_replace('%section%', $value, $header_animation_speed);
				$cpt_single_options[] = str_replace('%section%', $value, $header_animation_delay);
				$cpt_single_options[] = str_replace('%section%', $value, $header_featured);
				$cpt_single_options[] = str_replace('%section%', $value, $header_background);
				$cpt_single_options[] = str_replace('%section%', $value, $header_parallax);
				$cpt_single_options[] = str_replace('%section%', $value, $header_overlay_color);
				$cpt_single_options[] = str_replace('%section%', $value, $header_overlay_color_alpha);
				$cpt_single_options[] = str_replace('%section%', $value, $header_scroll_opacity);
				$cpt_single_options[] = str_replace('%section%', $value, $header_scrolldown);
				$cpt_single_options[] = str_replace('%section%', $value, $body_section_title);
				$cpt_single_options[] = str_replace('%section%', $value, $body_layout_width);
				$cpt_single_options[] = str_replace('%section%', $value, $body_layout_width_custom);
				$cpt_single_options[] = str_replace('%section%', $value, run_array_to($show_breadcrumb, 'std', 'on'));
				$cpt_single_options[] = str_replace('%section%', $value, $breadcrumb_align);
				$cpt_single_options[] = str_replace('%section%', $value, run_array_to($show_title, 'std', 'on'));
				$cpt_single_options[] = str_replace('%section%', $value, $show_media);
				$cpt_single_options[] = str_replace('%section%', $value, $show_comments);
				$cpt_single_options[] = str_replace('%section%', $value, $body_uncode_block_after);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_section_title);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_activate);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_widget);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_position);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_size);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_sticky);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_style);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_bgcolor);
				$cpt_single_options[] = str_replace('%section%', $value, $sidebar_fill);
				$cpt_single_options[] = str_replace('%section%', $value, $footer_section_title);
				$cpt_single_options[] = str_replace('%section%', $value, $footer_uncode_block);
				$cpt_single_options[] = str_replace('%section%', $value, $footer_width);
				$cpt_single_options[] = str_replace('%section%', $value, $custom_fields_section_title);
				$cpt_single_options[] = str_replace('%section%', $value, $custom_fields_list);
			}
		}
		foreach ($uncode_post_types as $key => $value) {
			if ($value !== 'portfolio' && $value !== 'product') {
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $menu_section_title);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $menu);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $menu_width);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $menu_opaque);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_section_title);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', run_array_to($header_type, 'std', 'header_basic'));
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_uncode_block);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_revslider);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_layerslider);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_width);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_height);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_min_height);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_title);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_style);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_content_width);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_custom_width);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_align);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_position);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_title_font);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_title_size);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_title_height);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_title_spacing);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_title_weight);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_title_transform);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_title_italic);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_text_animation);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_animation_speed);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_animation_delay);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_featured);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_background);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_parallax);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_overlay_color);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_overlay_color_alpha);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_scroll_opacity);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $header_scrolldown);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $body_section_title);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $show_breadcrumb);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $breadcrumb_align);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $body_uncode_block);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', run_array_to($body_layout_width, 'condition', '_uncode_%section%_content_block:is(),_uncode_%section%_content_block:is(none)'));
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $body_single_post_width);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $body_single_text_lenght);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $show_title);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $sidebar_section_title);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', run_array_to($sidebar_activate, 'std', 'on'));
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $sidebar_widget);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $sidebar_position);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $sidebar_size);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $sidebar_sticky);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $sidebar_style);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $sidebar_bgcolor);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $sidebar_fill);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $footer_section_title);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $footer_uncode_block);
				$cpt_index_options[] = str_replace('%section%', $value . '_index', $footer_width);
			}
		}
	}

	$custom_settings_section_one = array(
		array(
			'id' => 'uncode_logo_section',
			'title' => '<i class="fa fa-heart3"></i> ' . esc_html__('Logo', 'uncode')
		) ,
		array(
			'id' => 'uncode_header_section',
			'title' => '<i class="fa fa-menu"></i> ' . esc_html__('Menu', 'uncode')
		) ,
		array(
			'id' => 'uncode_main_section',
			'title' => '<i class="fa fa-layers"></i> ' . esc_html__('Layout', 'uncode')
		) ,
		array(
			'id' => 'uncode_post_section',
			'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . esc_html__('Post', 'uncode') . '</span>'
		) ,
		array(
			'id' => 'uncode_page_section',
			'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . esc_html__('Page', 'uncode') . '</span>'
		) ,
		array(
			'id' => 'uncode_portfolio_section',
			'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . ucfirst($portfolio_cpt_name) . '</span>'
		) ,
	);

	$custom_settings_section_one = array_merge( $custom_settings_section_one, $cpt_single_sections );

	$custom_settings_section_two = array(
		array(
			'id' => 'uncode_post_index_section',
			'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Posts', 'uncode') . '</span>'
		) ,
		array(
			'id' => 'uncode_page_index_section',
			'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Pages', 'uncode') . '</span>'
		) ,
		array(
			'id' => 'uncode_portfolio_index_section',
			'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . ucfirst($portfolio_cpt_name) . 's</span>'
		) ,
	);

	$custom_settings_section_one = array_merge( $custom_settings_section_one, $custom_settings_section_two );
	$custom_settings_section_one = array_merge( $custom_settings_section_one, $cpt_index_sections );

	$custom_settings_section_three = array(
		array(
			'id' => 'uncode_search_index_section',
			'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Search', 'uncode') . '</span>'
		) ,
		array(
			'id' => 'uncode_404_section',
			'title' => '<span class="smaller"><i class="fa fa-help"></i> ' . esc_html__('404', 'uncode') . '</span>'
		) ,
		array(
			'id' => 'uncode_footer_section',
			'title' => '<i class="fa fa-ellipsis"></i> ' . esc_html__('Footer', 'uncode')
		) ,
		array(
			'id' => 'uncode_colors_section',
			'title' => '<i class="fa fa-drop"></i> ' . esc_html__('Palette', 'uncode')
		) ,
		array(
			'id' => 'uncode_typography_section',
			'title' => '<i class="fa fa-font"></i> ' . esc_html__('Typography', 'uncode')
		) ,
		array(
			'id' => 'uncode_customize_section',
			'title' => '<i class="fa fa-box"></i> ' . esc_html__('Customize', 'uncode')
		) ,
		array(
			'id' => 'uncode_sidebars_section',
			'title' => '<i class="fa fa-content-right"></i> ' . esc_html__('Sidebars', 'uncode')
		) ,
		array(
			'id' => 'uncode_connections_section',
			'title' => '<i class="fa fa-share2"></i> ' . esc_html__('Connections', 'uncode')
		) ,
		array(
			'id' => 'uncode_gmaps_section',
			'title' => '<i class="fa fa-map-o"></i> ' . esc_html__('Google Maps', 'uncode')
		) ,
		array(
			'id' => 'uncode_redirect_section',
			'title' => '<i class="fa fa-reply2"></i> ' . esc_html__('Redirect', 'uncode')
		) ,
		array(
			'id' => 'uncode_cssjs_section',
			'title' => '<i class="fa fa-code"></i> ' . esc_html__('CSS & JS', 'uncode')
		) ,
		array(
			'id' => 'uncode_performance_section',
			'title' => '<i class="fa fa-loader"></i> ' . esc_html__('Performance', 'uncode')
		) ,
	);

	$custom_settings_section_one = array_merge( $custom_settings_section_one, $custom_settings_section_three );

	$custom_settings_one = array(
		array(
			'id' => '_uncode_general_block_title',
			'label' => '<i class="fa fa-globe3"></i> ' . esc_html__('General', 'uncode') ,
			'desc' => '',
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_main_section',
		) ,
		array(
			'id' => '_uncode_main_width',
			'label' => esc_html__('Site width', 'uncode') ,
			'desc' => esc_html__('Enter the width of your site.', 'uncode') ,
			'std' => array(
				'1200',
				'px'
			) ,
			'type' => 'measurement',
			'section' => 'uncode_main_section',
		) ,
		array(
			'id' => '_uncode_main_align',
			'label' => esc_html__('Site layout align', 'uncode') ,
			'desc' => esc_html__('Specify the alignment of the content area when is less then 100% width.', 'uncode') ,
			'std' => 'center',
			'type' => 'select',
			'section' => 'uncode_main_section',
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
			)
		) ,
		array(
			'id' => '_uncode_boxed',
			'label' => esc_html__('Boxed', 'uncode') ,
			'desc' => esc_html__('Activate for the boxed layout.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_main_section',
		) ,
		array(
			'id' => '_uncode_body_border',
			'label' => esc_html__('Body frame', 'uncode') ,
			'desc' => esc_html__('Specify the thickness of the frame around the body', 'uncode') ,
			'std' => '0',
			'type' => 'numeric-slider',
			'min_max_step'=> '0,36,9',
			'section' => 'uncode_main_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_body_border_color',
			'label' => esc_html__('Body frame color', 'uncode') ,
			'desc' => esc_html__('Specify the body frame color.', 'uncode') ,
			'type' => 'uncode_color',
			'section' => 'uncode_main_section',
			'condition' => '_uncode_boxed:is(off),_uncode_body_border:not(0)',
			'operator' => 'and'
		) ,
		str_replace('%section%', 'main', run_array_to($header_section_title, 'condition', '_uncode_boxed:is(off)')),
		array(
			'id' => '_uncode_header_full',
			'label' => esc_html__('Container full width', 'uncode') ,
			'desc' => esc_html__('Activate to expand the header container to full width.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_main_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		str_replace('%section%', 'main', run_array_to($body_section_title, 'condition', '_uncode_boxed:is(off)')),
		array(
			'id' => '_uncode_body_full',
			'label' => esc_html__('Content area full width', 'uncode') ,
			'desc' => esc_html__('Activate to expand the content area to full width.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_main_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_switch',
			'label' => esc_html__('Switchable logo', 'uncode') ,
			'desc' => esc_html__('Activate to upload different logo for each skin.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_logo_section',
		) ,
		array(
			'id' => '_uncode_logo',
			'label' => esc_html__('Logo', 'uncode') ,
			'desc' => esc_html__('Upload a logo. You can use Images, SVG code or HTML code.', 'uncode') ,
			'type' => 'upload',
			'section' => 'uncode_logo_section',
			'condition' => '_uncode_logo_switch:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_light',
			'label' => esc_html__('Logo - Light', 'uncode') ,
			'desc' => esc_html__('Upload a logo for the light skin.', 'uncode') ,
			'type' => 'upload',
			'section' => 'uncode_logo_section',
			'condition' => '_uncode_logo_switch:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_dark',
			'label' => esc_html__('Logo - Dark', 'uncode') ,
			'desc' => esc_html__('Upload a logo for the dark skin.', 'uncode') ,
			'type' => 'upload',
			'section' => 'uncode_logo_section',
			'condition' => '_uncode_logo_switch:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_height',
			'label' => esc_html__('Logo height', 'uncode'),
			'desc' => esc_html__('Enter the height of the logo in px.', 'uncode') ,
			'std' => '20',
			'type' => 'text',
			'section' => 'uncode_logo_section',
		) ,
		array(
			'id' => '_uncode_logo_height_mobile',
			'label' => esc_html__('Logo height mobile', 'uncode'),
			'desc' => esc_html__('Enter the height of the logo in px for mobile version.', 'uncode') ,
			'type' => 'text',
			'section' => 'uncode_logo_section',
		) ,
		array(
			'id' => '_uncode_headers_block_title',
			'label' => '<i class="fa fa-layers"></i> ' . esc_html__('Layout', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_headers',
			'desc' => esc_html__('Specify the menu layout.', 'uncode') ,
			'label' => '' ,
			'std' => 'hmenu-right',
			'type' => 'radio-image',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_vmenu_position',
			'label' => esc_html__('Menu horizontal position', 'uncode') ,
			'desc' => esc_html__('Specify the horizontal position of the menu.', 'uncode') ,
			'std' => 'left',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(vmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode') ,
					'src' => ''
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_vmenu_v_position',
			'label' => esc_html__('Menu vertical alignment', 'uncode') ,
			'desc' => esc_html__('Specify the vertical alignment of the menu.', 'uncode') ,
			'std' => 'middle',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(vmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'top',
					'label' => esc_html__('Top', 'uncode') ,
					'src' => ''
				) ,
				array(
					'value' => 'middle',
					'label' => esc_html__('Middle', 'uncode') ,
					'src' => ''
				) ,
				array(
					'value' => 'bottom',
					'label' => esc_html__('Bottom', 'uncode') ,
					'src' => ''
				) ,
			)
		) ,
		array(
			'id' => '_uncode_vmenu_align',
			'label' => esc_html__('Menu horizontal alignment', 'uncode') ,
			'desc' => esc_html__('Specify the horizontal alignment of the menu.', 'uncode') ,
			'std' => 'left',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(vmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Left Align', 'uncode') ,
					'src' => ''
				) ,
				array(
					'value' => 'center',
					'label' => esc_html__('Center Align', 'uncode') ,
					'src' => ''
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Right Align', 'uncode') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_vmenu_width',
			'label' => esc_html__('Vertical menu width','uncode') ,
			'desc' => esc_html__('Vertical menu width in px', 'uncode') ,
			'std' => '252',
			'type' => 'numeric-slider',
			'section' => 'uncode_header_section',
			'rows' => '',
			'post_type' => '',
			'taxonomy' => '',
			'min_max_step' => '108,504,12',
			'class' => '',
			'condition' => '_uncode_headers:contains(vmenu)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_full',
			'label' => esc_html__('Menu full width', 'uncode') ,
			'desc' => esc_html__('Activate to expand the menu to full width. (Only for the horizontal menus).', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_visuals_block_title',
			'label' => '<i class="fa fa-eye2"></i> ' . esc_html__('Visuals', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_shadows',
			'label' => esc_html__('Menu shadows', 'uncode') ,
			'desc' => esc_html__('Activate to show the menu shadows.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_borders',
			'label' => esc_html__('Menu borders', 'uncode') ,
			'desc' => esc_html__('Activate to show the menu borders.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_no_arrows',
			'label' => esc_html__('Hide dropdown arrows', 'uncode') ,
			'desc' => esc_html__('Activate to hide the dropdow arrows.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_animation_block_title',
			'label' => '<i class="fa fa-fast-forward2"></i> ' . esc_html__('Animation', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
			// 'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(vmenu-offcanvas),_uncode_headers:is(menu-overlay)',
			// 'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_sticky',
			'label' => esc_html__('Menu sticky', 'uncode') ,
			'desc' => esc_html__('Activate the sticky menu. This is a menu that is locked into place so that it does not disappear when the user scrolls down the page.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(vmenu-offcanvas),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_sticky_mobile',
			'label' => esc_html__('Menu sticky mobile', 'uncode') ,
			'desc' => esc_html__('Activate the sticky menu on mobile devices. This is a menu that is locked into place so that it does not disappear when the user scrolls down the page.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_hide',
			'label' => esc_html__('Menu hide', 'uncode') ,
			'desc' => esc_html__('Activate the autohide menu. This is a menu that is hiding after the user have scrolled down the page.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center),_uncode_headers:is(vmenu-offcanvas)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_hide_mobile',
			'label' => esc_html__('Menu hide mobile', 'uncode') ,
			'desc' => esc_html__('Activate the sticky menu on mobile devices. This is a menu that is locked into place so that it does not disappear when the user scrolls down the page.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_shrink',
			'label' => esc_html__('Menu shrink', 'uncode') ,
			'desc' => esc_html__('Activate the shrink menu. This is a menu where the logo shrinks after the user have scrolled down the page.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center),_uncode_headers:is(vmenu-offcanvas)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_mobile_animation',
			'label' => esc_html__('Menu open items animation', 'uncode') ,
			'desc' => esc_html__('Specify the menu items animation when opening.', 'uncode') ,
			'std' => 'none',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_sticky_mobile:is(on),_uncode_menu_hide_mobile:is(on)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'none',
					'label' => esc_html__('None', 'uncode') ,
				) ,
				array(
					'value' => 'scale',
					'label' => esc_html__('Scale', 'uncode') ,
				) ,
			)
		) ,
		array(
			'id' => '_uncode_menu_overlay_animation',
			'label' => esc_html__('Menu overlay animation', 'uncode') ,
			'desc' => esc_html__('Specify the overlay menu animation when opening and closing.', 'uncode') ,
			'std' => 'sequential',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'and',
			'choices' => array(
				array(
					'value' => '3d',
					'label' => esc_html__('3D', 'uncode') ,
				) ,
				array(
					'value' => 'sequential',
					'label' => esc_html__('Flat', 'uncode') ,
				) ,
			)
		) ,
		array(
			'id' => '_uncode_min_logo',
			'label' => esc_html__('Minimum logo height', 'uncode'),
			'desc' => esc_html__('Enter the minimal height of the shrinked logo in <b>px</b>.', 'uncode') ,
			'type' => 'text',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_shrink:is(on),_uncode_headers:not(vmenu)',
			'operator' => 'and',
		) ,
		array(
			'id' => '_uncode_menu_typo_block_title',
			'label' => '<i class="fa fa-font"></i> ' . esc_html__('Typography', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_first_uppercase',
			'label' => esc_html__('Menu first level uppercase', 'uncode') ,
			'desc' => esc_html__('Activate to transform the first menu level to uppercase.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_other_uppercase',
			'label' => esc_html__('Menu other levels uppercase', 'uncode') ,
			'desc' => esc_html__('Activate to transform all the others menu level to uppercase.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_add_block_title',
			'label' => '<i class="fa fa-square-plus"></i> ' . esc_html__('Additionals', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_no_secondary',
			'label' => esc_html__('Hide secondary menu', 'uncode') ,
			'desc' => esc_html__('Activate to hide the secondary menu.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_socials',
			'label' => esc_html__('Social icons', 'uncode') ,
			'desc' => esc_html__('Activate to show the social connection icons in the menu bar.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_search',
			'label' => esc_html__('Search icon', 'uncode') ,
			'desc' => esc_html__('Activate to show the search icon in the menu bar.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_search_animation',
			'label' => esc_html__('Search overlay animation', 'uncode') ,
			'desc' => esc_html__('Specify the search overlay animation when opening and closing.', 'uncode') ,
			'std' => 'sequential',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'choices' => array(
				array(
					'value' => '3d',
					'label' => esc_html__('3D', 'uncode') ,
				) ,
				array(
					'value' => 'sequential',
					'label' => esc_html__('Flat', 'uncode') ,
				) ,
			) ,
			'condition' => '_uncode_menu_search:is(on)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_woocommerce_cart',
			'label' => esc_html__('Woocommerce cart', 'uncode') ,
			'desc' => esc_html__('Activate to show the Woocommerce icon in the menu bar.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_woocommerce_cart_desktop',
			'label' => esc_html__('Woocommerce cart on menu bar', 'uncode') ,
			'desc' => esc_html__('Show the cart icon in the menu bar when layout is on desktop mode (Only for overlay and offcanvas menu).', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_woocommerce_cart:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_woocommerce_cart_mobile',
			'label' => esc_html__('Woocommerce cart on menu bar for mobile', 'uncode') ,
			'desc' => esc_html__('Show the cart icon in the menu bar when layout is on mobile mode.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_woocommerce_cart:is(on)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_bloginfo',
			'label' => esc_html__('Top line text', 'uncode') ,
			'desc' => esc_html__('Insert additional text on top of the menu.','uncode') ,
			'type' => 'textarea',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:is(hmenu-right),_uncode_headers:is(hmenu-left),_uncode_headers:is(hmenu-justify),_uncode_headers:is(hmenu-center)',
			'operator' => 'or'
		) ,
		//////////////////////
		//  Post Single		///
		//////////////////////
		str_replace('%section%', 'post', $menu_section_title),
		str_replace('%section%', 'post', $menu),
		str_replace('%section%', 'post', $menu_width),
		str_replace('%section%', 'post', $menu_opaque),
		str_replace('%section%', 'post', $header_section_title),
		str_replace('%section%', 'post', run_array_to($header_type, 'std', 'header_basic')),
		str_replace('%section%', 'post', $header_uncode_block),
		str_replace('%section%', 'post', $header_revslider),
		str_replace('%section%', 'post', $header_layerslider),

		str_replace('%section%', 'post', $header_width),
		str_replace('%section%', 'post', $header_height),
		str_replace('%section%', 'post', $header_min_height),
		str_replace('%section%', 'post', $header_title),
		str_replace('%section%', 'post', $header_style),
		str_replace('%section%', 'post', $header_content_width),
		str_replace('%section%', 'post', $header_custom_width),
		str_replace('%section%', 'post', $header_align),
		str_replace('%section%', 'post', $header_position),
		str_replace('%section%', 'post', $header_title_font),
		str_replace('%section%', 'post', $header_title_size),
		str_replace('%section%', 'post', $header_title_height),
		str_replace('%section%', 'post', $header_title_spacing),
		str_replace('%section%', 'post', $header_title_weight),
		str_replace('%section%', 'post', $header_title_transform),
		str_replace('%section%', 'post', $header_title_italic),
		str_replace('%section%', 'post', $header_text_animation),
		str_replace('%section%', 'post', $header_animation_speed),
		str_replace('%section%', 'post', $header_animation_delay),
		str_replace('%section%', 'post', $header_featured),
		str_replace('%section%', 'post', $header_background),
		str_replace('%section%', 'post', $header_parallax),
		str_replace('%section%', 'post', $header_overlay_color),
		str_replace('%section%', 'post', $header_overlay_color_alpha),
		str_replace('%section%', 'post', $header_scroll_opacity),
		str_replace('%section%', 'post', $header_scrolldown),

		str_replace('%section%', 'post', $body_section_title),
		str_replace('%section%', 'post', $body_layout_width),
		str_replace('%section%', 'post', $body_layout_width_custom),
		str_replace('%section%', 'post', $show_breadcrumb),
		str_replace('%section%', 'post', $breadcrumb_align),
		// str_replace('%section%', 'post', $body_uncode_block_before),
		str_replace('%section%', 'post', $show_title),
		str_replace('%section%', 'post', $show_media),
		str_replace('%section%', 'post', $show_comments),
		str_replace('%section%', 'post', $show_share),
		str_replace('%section%', 'post', $show_tags),
		str_replace('%section%', 'post', $show_tags_align),
		str_replace('%section%', 'post', $body_uncode_block_after),
		str_replace('%section%', 'post', $sidebar_section_title),
		str_replace('%section%', 'post', run_array_to($sidebar_activate, 'std', 'on')),
		str_replace('%section%', 'post', $sidebar_widget),
		str_replace('%section%', 'post', $sidebar_position),
		str_replace('%section%', 'post', $sidebar_size),
		str_replace('%section%', 'post', $sidebar_sticky),
		str_replace('%section%', 'post', $sidebar_style),
		str_replace('%section%', 'post', $sidebar_bgcolor),
		str_replace('%section%', 'post', $sidebar_fill),

		str_replace('%section%', 'post', $navigation_section_title),
		str_replace('%section%', 'post', $navigation_activate),
		str_replace('%section%', 'post', $navigation_page_index),
		str_replace('%section%', 'post', $navigation_index_label),
		str_replace('%section%', 'post', $navigation_nextprev_title),
		str_replace('%section%', 'post', $footer_section_title),
		str_replace('%section%', 'post', $footer_uncode_block),
		str_replace('%section%', 'post', $footer_width),
		str_replace('%section%', 'post', $custom_fields_section_title),
		str_replace('%section%', 'post', $custom_fields_list),
		///////////////
		//  Page		///
		///////////////
		str_replace('%section%', 'page', $menu_section_title),
		str_replace('%section%', 'page', $menu),
		str_replace('%section%', 'page', $menu_width),
		str_replace('%section%', 'page', $menu_opaque),
		str_replace('%section%', 'page', $header_section_title),
		str_replace('%section%', 'page', $header_type),
		str_replace('%section%', 'page', $header_uncode_block),
		str_replace('%section%', 'page', $header_revslider),
		str_replace('%section%', 'page', $header_layerslider),

		str_replace('%section%', 'page', $header_width),
		str_replace('%section%', 'page', $header_height),
		str_replace('%section%', 'page', $header_min_height),
		str_replace('%section%', 'page', $header_title),
		str_replace('%section%', 'page', $header_style),
		str_replace('%section%', 'page', $header_content_width),
		str_replace('%section%', 'page', $header_custom_width),
		str_replace('%section%', 'page', $header_align),
		str_replace('%section%', 'page', $header_position),
		str_replace('%section%', 'page', $header_title_font),
		str_replace('%section%', 'page', $header_title_size),
		str_replace('%section%', 'page', $header_title_height),
		str_replace('%section%', 'page', $header_title_spacing),
		str_replace('%section%', 'page', $header_title_weight),
		str_replace('%section%', 'page', $header_title_transform),
		str_replace('%section%', 'page', $header_title_italic),
		str_replace('%section%', 'page', $header_text_animation),
		str_replace('%section%', 'page', $header_animation_speed),
		str_replace('%section%', 'page', $header_animation_delay),
		str_replace('%section%', 'page', $header_featured),
		str_replace('%section%', 'page', $header_background),
		str_replace('%section%', 'page', $header_parallax),
		str_replace('%section%', 'page', $header_overlay_color),
		str_replace('%section%', 'page', $header_overlay_color_alpha),
		str_replace('%section%', 'page', $header_scroll_opacity),
		str_replace('%section%', 'page', $header_scrolldown),
		str_replace('%section%', 'page', $body_section_title),
		str_replace('%section%', 'page', $body_layout_width),
		str_replace('%section%', 'page', $body_layout_width_custom),
		str_replace('%section%', 'page', run_array_to($show_breadcrumb, 'std', 'on')),
		str_replace('%section%', 'page', $breadcrumb_align),
		str_replace('%section%', 'page', run_array_to($show_title, 'std', 'on')),
		str_replace('%section%', 'page', $show_media),
		str_replace('%section%', 'page', $show_comments),
		str_replace('%section%', 'page', $body_uncode_block_after),
		str_replace('%section%', 'page', $sidebar_section_title),
		str_replace('%section%', 'page', $sidebar_activate),
		str_replace('%section%', 'page', $sidebar_widget),
		str_replace('%section%', 'page', $sidebar_position),
		str_replace('%section%', 'page', $sidebar_size),
		str_replace('%section%', 'page', $sidebar_sticky),
		str_replace('%section%', 'page', $sidebar_style),
		str_replace('%section%', 'page', $sidebar_bgcolor),
		str_replace('%section%', 'page', $sidebar_fill),
		str_replace('%section%', 'page', $footer_section_title),
		str_replace('%section%', 'page', $footer_uncode_block),
		str_replace('%section%', 'page', $footer_width),
		str_replace('%section%', 'page', $custom_fields_section_title),
		str_replace('%section%', 'page', $custom_fields_list),
		///////////////////////////
		//  Portfolio Single		///
		///////////////////////////
		str_replace('%section%', 'portfolio', $menu_section_title),
		str_replace('%section%', 'portfolio', $menu),
		str_replace('%section%', 'portfolio', $menu_width),
		str_replace('%section%', 'portfolio', $menu_opaque),
		str_replace('%section%', 'portfolio', $header_section_title),
		str_replace('%section%', 'portfolio', $header_type),
		str_replace('%section%', 'portfolio', $header_uncode_block),
		str_replace('%section%', 'portfolio', $header_revslider),
		str_replace('%section%', 'portfolio', $header_layerslider),

		str_replace('%section%', 'portfolio', $header_width),
		str_replace('%section%', 'portfolio', $header_height),
		str_replace('%section%', 'portfolio', $header_min_height),
		str_replace('%section%', 'portfolio', $header_title),
		str_replace('%section%', 'portfolio', $header_style),
		str_replace('%section%', 'portfolio', $header_content_width),
		str_replace('%section%', 'portfolio', $header_custom_width),
		str_replace('%section%', 'portfolio', $header_align),
		str_replace('%section%', 'portfolio', $header_position),
		str_replace('%section%', 'portfolio', $header_title_font),
		str_replace('%section%', 'portfolio', $header_title_size),
		str_replace('%section%', 'portfolio', $header_title_height),
		str_replace('%section%', 'portfolio', $header_title_spacing),
		str_replace('%section%', 'portfolio', $header_title_weight),
		str_replace('%section%', 'portfolio', $header_title_transform),
		str_replace('%section%', 'portfolio', $header_title_italic),
		str_replace('%section%', 'portfolio', $header_text_animation),
		str_replace('%section%', 'portfolio', $header_animation_speed),
		str_replace('%section%', 'portfolio', $header_animation_delay),
		str_replace('%section%', 'portfolio', $header_featured),
		str_replace('%section%', 'portfolio', $header_background),
		str_replace('%section%', 'portfolio', $header_parallax),
		str_replace('%section%', 'portfolio', $header_overlay_color),
		str_replace('%section%', 'portfolio', $header_overlay_color_alpha),
		str_replace('%section%', 'portfolio', $header_scroll_opacity),
		str_replace('%section%', 'portfolio', $header_scrolldown),

		str_replace('%section%', 'portfolio', $body_section_title),
		str_replace('%section%', 'portfolio', $body_layout_width),
		str_replace('%section%', 'portfolio', $body_layout_width_custom),
		str_replace('%section%', 'portfolio', run_array_to($show_breadcrumb, 'std', 'on')),
		str_replace('%section%', 'portfolio', $breadcrumb_align),
		str_replace('%section%', 'portfolio', run_array_to($show_title, 'std', 'on')),
		str_replace('%section%', 'portfolio', $show_media),
		str_replace('%section%', 'portfolio', run_array_to($show_comments, 'std', 'off')),
		str_replace('%section%', 'portfolio', $show_share),
		str_replace('%section%', 'portfolio', $body_uncode_block_after),
		array(
			'id' => '_uncode_portfolio_details_title',
			'label' => '<i class="fa fa-briefcase3"></i> ' . esc_html__('Details', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_portfolio_section',
		) ,
		array(
			'id' => '_uncode_portfolio_details',
			'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('details', 'uncode') ,
			'desc' => sprintf(esc_html__('Create here all the %s details label that you need.', 'uncode') , $portfolio_cpt_name) ,
			'type' => 'list-item',
			'section' => 'uncode_portfolio_section',
			'settings' => array(
				array(
					'id' => '_uncode_portfolio_detail_unique_id',
					'class' => 'unique_id',
					'std' => 'detail-',
					'type' => 'text',
					'label' => sprintf(esc_html__('Unique %s detail ID','uncode') , $portfolio_cpt_name) ,
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
				),
			)
		) ,
		array(
			'id' => '_uncode_portfolio_position',
			'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('details layout', 'uncode') ,
			'desc' => sprintf(esc_html__('Specify the layout template for all the %s posts.', 'uncode') , $portfolio_cpt_name) ,
			'type' => 'select',
			'section' => 'uncode_portfolio_section',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Select…', 'uncode') ,
				) ,
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
			)
		) ,
		array(
			'id' => '_uncode_portfolio_sidebar_size',
			'label' => esc_html__('Sidebar size', 'uncode') ,
			'desc' => esc_html__('Set the sidebar size.', 'uncode') ,
			'std' => '4',
			'min_max_step' => '1,12,1',
			'type' => 'numeric-slider',
			'section' => 'uncode_portfolio_section',
			'operator' => 'and',
			'condition' => '_uncode_portfolio_position:not(),_uncode_portfolio_position:contains(sidebar)',
		) ,
		str_replace('%section%', 'portfolio', run_array_to($sidebar_sticky, 'condition', '_uncode_portfolio_position:not(),_uncode_portfolio_position:contains(sidebar)')),
		array(
			'id' => '_uncode_portfolio_style',
			'label' => esc_html__('Skin', 'uncode') ,
			'desc' => esc_html__('Specify the sidebar text skin color.', 'uncode') ,
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
			'section' => 'uncode_portfolio_section',
			'condition' => '_uncode_portfolio_position:not()',
		) ,
		array(
			'id' => '_uncode_portfolio_bgcolor',
			'label' => esc_html__('Sidebar color', 'uncode') ,
			'desc' => esc_html__('Specify the sidebar background color.', 'uncode') ,
			'type' => 'uncode_color',
			'section' => 'uncode_portfolio_section',
			'condition' => '_uncode_portfolio_position:not()',
		) ,
		array(
			'id' => '_uncode_portfolio_sidebar_fill',
			'label' => esc_html__('Sidebar filling space', 'uncode') ,
			'desc' => esc_html__('Activate to remove padding around the sidebar and fill the height.', 'uncode') ,
			'type' => 'on-off',
			'section' => 'uncode_portfolio_section',
			'std' => 'off',
			'operator' => 'and',
			'condition' => '_uncode_portfolio_position:not(),_uncode_portfolio_sidebar_bgcolor:not(),_uncode_portfolio_position:contains(sidebar)',
		),
		str_replace('%section%', 'portfolio', $navigation_section_title),
		str_replace('%section%', 'portfolio', $navigation_activate),
		str_replace('%section%', 'portfolio', $navigation_page_index),
		str_replace('%section%', 'portfolio', $navigation_index_label),
		str_replace('%section%', 'portfolio', $navigation_nextprev_title),
		str_replace('%section%', 'portfolio', $footer_section_title),
		str_replace('%section%', 'portfolio', $footer_uncode_block),
		str_replace('%section%', 'portfolio', $footer_width),
		str_replace('%section%', 'portfolio', $custom_fields_section_title),
		str_replace('%section%', 'portfolio', $custom_fields_list),
	);

	$custom_settings_one = array_merge( $custom_settings_one, $cpt_single_options );

	$custom_settings_two = array(
		///////////////////
		//  Page 404		///
		///////////////////
		str_replace('%section%', '404', $menu_section_title),
		str_replace('%section%', '404', $menu),
		str_replace('%section%', '404', $menu_width),
		str_replace('%section%', '404', $menu_opaque),
		str_replace('%section%', '404', $header_section_title),
		str_replace('%section%', '404', $header_type),
		str_replace('%section%', '404', $header_uncode_block),
		str_replace('%section%', '404', $header_revslider),
		str_replace('%section%', '404', $header_layerslider),

		str_replace('%section%', '404', $header_width),
		str_replace('%section%', '404', $header_height),
		str_replace('%section%', '404', $header_min_height),
		str_replace('%section%', '404', $header_title),
		str_replace('%section%', '404', $header_title_text),
		str_replace('%section%', '404', $header_style),
		str_replace('%section%', '404', $header_content_width),
		str_replace('%section%', '404', $header_custom_width),
		str_replace('%section%', '404', $header_align),
		str_replace('%section%', '404', $header_position),
		str_replace('%section%', '404', $header_title_font),
		str_replace('%section%', '404', $header_title_size),
		str_replace('%section%', '404', $header_title_height),
		str_replace('%section%', '404', $header_title_spacing),
		str_replace('%section%', '404', $header_title_weight),
		str_replace('%section%', '404', $header_title_transform),
		str_replace('%section%', '404', $header_title_italic),
		str_replace('%section%', '404', $header_text_animation),
		str_replace('%section%', '404', $header_animation_speed),
		str_replace('%section%', '404', $header_animation_delay),
		str_replace('%section%', '404', $header_background),
		str_replace('%section%', '404', $header_parallax),
		str_replace('%section%', '404', $header_overlay_color),
		str_replace('%section%', '404', $header_overlay_color_alpha),
		str_replace('%section%', '404', $header_scroll_opacity),
		str_replace('%section%', '404', $header_scrolldown),

		str_replace('%section%', '404', $body_section_title),
		str_replace('%section%', '404', $body_layout_width),
		str_replace('%section%', '404', $uncodeblock_404),
		str_replace('%section%', '404', $uncodeblocks_404),
		str_replace('%section%', '404', $footer_section_title),
		str_replace('%section%', '404', $footer_uncode_block),
		str_replace('%section%', '404', $footer_width),
		//////////////////////
		//  Posts Index		///
		//////////////////////
		str_replace('%section%', 'post_index', $menu_section_title),
		str_replace('%section%', 'post_index', $menu),
		str_replace('%section%', 'post_index', $menu_width),
		str_replace('%section%', 'post_index', $menu_opaque),
		str_replace('%section%', 'post_index', $header_section_title),
		str_replace('%section%', 'post_index', run_array_to($header_type, 'std', 'header_basic')),
		str_replace('%section%', 'post_index', $header_uncode_block),
		str_replace('%section%', 'post_index', $header_revslider),
		str_replace('%section%', 'post_index', $header_layerslider),

		str_replace('%section%', 'post_index', $header_width),
		str_replace('%section%', 'post_index', $header_height),
		str_replace('%section%', 'post_index', $header_min_height),
		str_replace('%section%', 'post_index', $header_title),
		str_replace('%section%', 'post_index', $header_style),
		str_replace('%section%', 'post_index', $header_content_width),
		str_replace('%section%', 'post_index', $header_custom_width),
		str_replace('%section%', 'post_index', $header_align),
		str_replace('%section%', 'post_index', $header_position),
		str_replace('%section%', 'post_index', $header_title_font),
		str_replace('%section%', 'post_index', $header_title_size),
		str_replace('%section%', 'post_index', $header_title_height),
		str_replace('%section%', 'post_index', $header_title_spacing),
		str_replace('%section%', 'post_index', $header_title_weight),
		str_replace('%section%', 'post_index', $header_title_transform),
		str_replace('%section%', 'post_index', $header_title_italic),
		str_replace('%section%', 'post_index', $header_text_animation),
		str_replace('%section%', 'post_index', $header_animation_speed),
		str_replace('%section%', 'post_index', $header_animation_delay),
		str_replace('%section%', 'post_index', $header_featured),
		str_replace('%section%', 'post_index', $header_background),
		str_replace('%section%', 'post_index', $header_parallax),
		str_replace('%section%', 'post_index', $header_overlay_color),
		str_replace('%section%', 'post_index', $header_overlay_color_alpha),
		str_replace('%section%', 'post_index', $header_scroll_opacity),
		str_replace('%section%', 'post_index', $header_scrolldown),

		str_replace('%section%', 'post_index', $body_section_title),
		str_replace('%section%', 'post_index', $show_breadcrumb),
		str_replace('%section%', 'post_index', $breadcrumb_align),
		str_replace('%section%', 'post_index', $body_uncode_block),
		str_replace('%section%', 'post_index', $body_layout_width),
		str_replace('%section%', 'post_index', $body_single_post_width),
		str_replace('%section%', 'post_index', $body_single_text_lenght),
		str_replace('%section%', 'post_index', $show_title),
		str_replace('%section%', 'post_index', $sidebar_section_title),
		str_replace('%section%', 'post_index', run_array_to($sidebar_activate, 'std', 'on')),
		str_replace('%section%', 'post_index', $sidebar_widget),
		str_replace('%section%', 'post_index', $sidebar_position),
		str_replace('%section%', 'post_index', $sidebar_size),
		str_replace('%section%', 'post_index', $sidebar_sticky),
		str_replace('%section%', 'post_index', $sidebar_style),
		str_replace('%section%', 'post_index', $sidebar_bgcolor),
		str_replace('%section%', 'post_index', $sidebar_fill),
		str_replace('%section%', 'post_index', $footer_section_title),
		str_replace('%section%', 'post_index', $footer_uncode_block),
		str_replace('%section%', 'post_index', $footer_width),
		//////////////////////
		//  Pages Index		///
		//////////////////////
		str_replace('%section%', 'page_index', $menu_section_title),
		str_replace('%section%', 'page_index', $menu),
		str_replace('%section%', 'page_index', $menu_width),
		str_replace('%section%', 'page_index', $menu_opaque),
		str_replace('%section%', 'page_index', $header_section_title),
		str_replace('%section%', 'page_index', run_array_to($header_type, 'std', 'header_basic')),
		str_replace('%section%', 'page_index', $header_uncode_block),
		str_replace('%section%', 'page_index', $header_revslider),
		str_replace('%section%', 'page_index', $header_layerslider),

		str_replace('%section%', 'page_index', $header_width),
		str_replace('%section%', 'page_index', $header_height),
		str_replace('%section%', 'page_index', $header_min_height),
		str_replace('%section%', 'page_index', $header_title),
		str_replace('%section%', 'page_index', $header_style),
		str_replace('%section%', 'page_index', $header_content_width),
		str_replace('%section%', 'page_index', $header_custom_width),
		str_replace('%section%', 'page_index', $header_align),
		str_replace('%section%', 'page_index', $header_position),
		str_replace('%section%', 'page_index', $header_title_font),
		str_replace('%section%', 'page_index', $header_title_size),
		str_replace('%section%', 'page_index', $header_title_height),
		str_replace('%section%', 'page_index', $header_title_spacing),
		str_replace('%section%', 'page_index', $header_title_weight),
		str_replace('%section%', 'page_index', $header_title_transform),
		str_replace('%section%', 'page_index', $header_title_italic),
		str_replace('%section%', 'page_index', $header_text_animation),
		str_replace('%section%', 'page_index', $header_animation_speed),
		str_replace('%section%', 'page_index', $header_animation_delay),
		str_replace('%section%', 'page_index', $header_featured),
		str_replace('%section%', 'page_index', $header_background),
		str_replace('%section%', 'page_index', $header_parallax),
		str_replace('%section%', 'page_index', $header_overlay_color),
		str_replace('%section%', 'page_index', $header_overlay_color_alpha),
		str_replace('%section%', 'page_index', $header_scroll_opacity),
		str_replace('%section%', 'page_index', $header_scrolldown),

		str_replace('%section%', 'page_index', $body_section_title),
		str_replace('%section%', 'page_index', $show_breadcrumb),
		str_replace('%section%', 'page_index', $breadcrumb_align),
		str_replace('%section%', 'page_index', $body_uncode_block),
		str_replace('%section%', 'page_index', run_array_to($body_layout_width, 'condition', '_uncode_%section%_content_block:is(),_uncode_%section%_content_block:is(none)')),
		str_replace('%section%', 'page_index', $body_single_post_width),
		str_replace('%section%', 'page_index', $body_single_text_lenght),
		str_replace('%section%', 'page_index', $show_title),
		str_replace('%section%', 'page_index', $sidebar_section_title),
		str_replace('%section%', 'page_index', run_array_to($sidebar_activate, 'std', 'on')),
		str_replace('%section%', 'page_index', $sidebar_widget),
		str_replace('%section%', 'page_index', $sidebar_position),
		str_replace('%section%', 'page_index', $sidebar_size),
		str_replace('%section%', 'page_index', $sidebar_sticky),
		str_replace('%section%', 'page_index', $sidebar_style),
		str_replace('%section%', 'page_index', $sidebar_bgcolor),
		str_replace('%section%', 'page_index', $sidebar_fill),
		str_replace('%section%', 'page_index', $footer_section_title),
		str_replace('%section%', 'page_index', $footer_uncode_block),
		str_replace('%section%', 'page_index', $footer_width),
		////////////////////////
		//  Archive Index		///
		////////////////////////
		str_replace('%section%', 'portfolio_index', $menu_section_title),
		str_replace('%section%', 'portfolio_index', $menu),
		str_replace('%section%', 'portfolio_index', $menu_width),
		str_replace('%section%', 'portfolio_index', $menu_opaque),
		str_replace('%section%', 'portfolio_index', $header_section_title),
		str_replace('%section%', 'portfolio_index', run_array_to($header_type, 'std', 'header_basic')),
		str_replace('%section%', 'portfolio_index', $header_uncode_block),
		str_replace('%section%', 'portfolio_index', $header_revslider),
		str_replace('%section%', 'portfolio_index', $header_layerslider),

		str_replace('%section%', 'portfolio_index', $header_width),
		str_replace('%section%', 'portfolio_index', $header_height),
		str_replace('%section%', 'portfolio_index', $header_min_height),
		str_replace('%section%', 'portfolio_index', $header_title),
		str_replace('%section%', 'portfolio_index', $header_style),
		str_replace('%section%', 'portfolio_index', $header_content_width),
		str_replace('%section%', 'portfolio_index', $header_custom_width),
		str_replace('%section%', 'portfolio_index', $header_align),
		str_replace('%section%', 'portfolio_index', $header_position),
		str_replace('%section%', 'portfolio_index', $header_title_font),
		str_replace('%section%', 'portfolio_index', $header_title_size),
		str_replace('%section%', 'portfolio_index', $header_title_height),
		str_replace('%section%', 'portfolio_index', $header_title_spacing),
		str_replace('%section%', 'portfolio_index', $header_title_weight),
		str_replace('%section%', 'portfolio_index', $header_title_transform),
		str_replace('%section%', 'portfolio_index', $header_title_italic),
		str_replace('%section%', 'portfolio_index', $header_text_animation),
		str_replace('%section%', 'portfolio_index', $header_animation_speed),
		str_replace('%section%', 'portfolio_index', $header_animation_delay),
		str_replace('%section%', 'portfolio_index', $header_featured),
		str_replace('%section%', 'portfolio_index', $header_background),
		str_replace('%section%', 'portfolio_index', $header_parallax),
		str_replace('%section%', 'portfolio_index', $header_overlay_color),
		str_replace('%section%', 'portfolio_index', $header_overlay_color_alpha),
		str_replace('%section%', 'portfolio_index', $header_scroll_opacity),
		str_replace('%section%', 'portfolio_index', $header_scrolldown),

		str_replace('%section%', 'portfolio_index', $body_section_title),
		str_replace('%section%', 'portfolio_index', $show_breadcrumb),
		str_replace('%section%', 'portfolio_index', $breadcrumb_align),
		str_replace('%section%', 'portfolio_index', $body_uncode_block),
		str_replace('%section%', 'portfolio_index', run_array_to($body_layout_width, 'condition', '_uncode_%section%_content_block:is(),_uncode_%section%_content_block:is(none)')),
		str_replace('%section%', 'portfolio_index', $body_single_post_width),
		str_replace('%section%', 'portfolio_index', $show_title),
		str_replace('%section%', 'portfolio_index', $sidebar_section_title),
		str_replace('%section%', 'portfolio_index', $sidebar_activate),
		str_replace('%section%', 'portfolio_index', $sidebar_widget),
		str_replace('%section%', 'portfolio_index', $sidebar_position),
		str_replace('%section%', 'portfolio_index', $sidebar_size),
		str_replace('%section%', 'portfolio_index', $sidebar_sticky),
		str_replace('%section%', 'portfolio_index', $sidebar_style),
		str_replace('%section%', 'portfolio_index', $sidebar_bgcolor),
		str_replace('%section%', 'portfolio_index', $sidebar_fill),
		str_replace('%section%', 'portfolio_index', $footer_section_title),
		str_replace('%section%', 'portfolio_index', $footer_uncode_block),
		str_replace('%section%', 'portfolio_index', $footer_width),
	);

	$custom_settings_one = array_merge( $custom_settings_one, $custom_settings_two );
	$custom_settings_one = array_merge( $custom_settings_one, $cpt_index_options );

	$custom_settings_three = array(
		///////////////////////
		//  Search Index		///
		///////////////////////
		str_replace('%section%', 'search_index', $menu_section_title),
		str_replace('%section%', 'search_index', $menu),
		str_replace('%section%', 'search_index', $menu_width),
		str_replace('%section%', 'search_index', $menu_opaque),
		str_replace('%section%', 'search_index', $header_section_title),
		str_replace('%section%', 'search_index', run_array_to($header_type, 'std', 'header_basic')),
		str_replace('%section%', 'search_index', $header_uncode_block),
		str_replace('%section%', 'search_index', $header_revslider),
		str_replace('%section%', 'search_index', $header_layerslider),

		str_replace('%section%', 'search_index', $header_width),
		str_replace('%section%', 'search_index', $header_height),
		str_replace('%section%', 'search_index', $header_min_height),
		str_replace('%section%', 'search_index', $header_title),
		str_replace('%section%', 'search_index', $header_title_text),
		str_replace('%section%', 'search_index', $header_style),
		str_replace('%section%', 'search_index', $header_content_width),
		str_replace('%section%', 'search_index', $header_custom_width),
		str_replace('%section%', 'search_index', $header_align),
		str_replace('%section%', 'search_index', $header_position),
		str_replace('%section%', 'search_index', $header_title_font),
		str_replace('%section%', 'search_index', $header_title_size),
		str_replace('%section%', 'search_index', $header_title_height),
		str_replace('%section%', 'search_index', $header_title_spacing),
		str_replace('%section%', 'search_index', $header_title_weight),
		str_replace('%section%', 'search_index', $header_title_transform),
		str_replace('%section%', 'search_index', $header_title_italic),
		str_replace('%section%', 'search_index', $header_text_animation),
		str_replace('%section%', 'search_index', $header_animation_speed),
		str_replace('%section%', 'search_index', $header_animation_delay),
		str_replace('%section%', 'search_index', $header_background),
		str_replace('%section%', 'search_index', $header_parallax),
		str_replace('%section%', 'search_index', $header_overlay_color),
		str_replace('%section%', 'search_index', $header_overlay_color_alpha),
		str_replace('%section%', 'search_index', $header_scroll_opacity),
		str_replace('%section%', 'search_index', $header_scrolldown),

		str_replace('%section%', 'search_index', $body_section_title),
		str_replace('%section%', 'search_index', $body_uncode_block),
		str_replace('%section%', 'search_index', $body_layout_width),
		str_replace('%section%', 'search_index', $sidebar_section_title),
		str_replace('%section%', 'search_index', $sidebar_activate),
		str_replace('%section%', 'search_index', $sidebar_widget),
		str_replace('%section%', 'search_index', $sidebar_position),
		str_replace('%section%', 'search_index', $sidebar_size),
		str_replace('%section%', 'search_index', $sidebar_sticky),
		str_replace('%section%', 'search_index', $sidebar_style),
		str_replace('%section%', 'search_index', $sidebar_bgcolor),
		str_replace('%section%', 'search_index', $sidebar_fill),
		str_replace('%section%', 'search_index', $footer_section_title),
		str_replace('%section%', 'search_index', $footer_uncode_block),
		str_replace('%section%', 'search_index', $footer_width),

		array(
			'id' => '_uncode_sidebars',
			'label' => esc_html__('Site sidebars', 'uncode') ,
			'desc' => esc_html__('Define here all the sidebars you will need. A default sidebar is already defined.', 'uncode') ,
			'type' => 'list-item',
			'section' => 'uncode_sidebars_section',
			'class' => 'list-item',
			'settings' => array(
				array(
					'id' => '_uncode_sidebar_unique_id',
					'class' => 'unique_id',
					'std' => 'sidebar-',
					'type' => 'text',
					'label' => esc_html__('Unique sidebar ID','uncode'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
				),
			)
		) ,
		array(
			'id' => '_uncode_font_groups',
			'label' => esc_html__('Custom fonts', 'uncode') ,
			'desc' => esc_html__('Define here all the fonts you will need.', 'uncode') ,
			'std' => array(
				array(
					'title' => 'Font Poppins (Sans Serif)',
					'_uncode_font_group_unique_id' => 'font-762333',
					'_uncode_font_group' => 'Poppins'
				),
				array(
					'title' => 'Font Hind (Sans Serif)',
					'_uncode_font_group_unique_id' => 'font-377884',
					'_uncode_font_group' => 'Hind'
				),
			) ,
			'type' => 'list-item',
			'section' => 'uncode_typography_section',
			'settings' => array(
				array(
					'id' => '_uncode_font_group_unique_id',
					'class' => 'unique_id',
					'std' => 'font-',
					'type' => 'text',
					'label' => esc_html__('Unique font ID','uncode'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
				),
				array(
					'id' => '_uncode_font_group',
					'label' => esc_html__('Uncode font', 'uncode') ,
					'desc' => esc_html__('Specify a font.', 'uncode') ,
					'type' => 'select',
					'choices' => $title_font,
				),
				array(
					'id' => '_uncode_font_manual',
					'label' => esc_html__('Font family', 'uncode') ,
					'desc' => esc_html__('Enter a font family.', 'uncode') ,
					'type' => 'text',
					'condition' => '_uncode_font_group:is(manual)',
					'operator' => 'and'
				)
			)
		) ,
		array(
			'id' => '_uncode_font_size',
			'label' => esc_html__('Default font size', 'uncode') ,
			'desc' => esc_html__('Font size for p,li,dt,dd,dl,address,label,small,pre in <b>px</b>.', 'uncode') ,
			'std' => '15',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h1',
			'label' => esc_html__('Font size H1', 'uncode') ,
			'desc' => esc_html__('Font size for H1 in <b>px</b>.', 'uncode') ,
			'std' => '35',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h2',
			'label' => esc_html__('Font size H2', 'uncode') ,
			'desc' => esc_html__('Font size for H2 in <b>px</b>.', 'uncode') ,
			'std' => '29',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h3',
			'label' => esc_html__('Font size H3', 'uncode') ,
			'desc' => esc_html__('Font size for H3 in <b>px</b>.', 'uncode') ,
			'std' => '24',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h4',
			'label' => esc_html__('Font size H4', 'uncode') ,
			'desc' => esc_html__('Font size for H4 in <b>px</b>.', 'uncode') ,
			'std' => '20',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h5',
			'label' => esc_html__('Font size H5', 'uncode') ,
			'desc' => esc_html__('Font size for H5 in <b>px</b>.', 'uncode') ,
			'std' => '17',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h6',
			'label' => esc_html__('Font size H6', 'uncode') ,
			'desc' => esc_html__('Font size for H6 in <b>px</b>.', 'uncode') ,
			'std' => '14',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_font_sizes',
			'label' => esc_html__('Custom font size', 'uncode') ,
			'desc' => esc_html__('Define here all the additional font sizes you will need.', 'uncode') ,
			'std' => '',
			'type' => 'list-item',
			'section' => 'uncode_typography_section',
			'settings' => array(
				array(
					'id' => '_uncode_heading_font_size_unique_id',
					'class' => 'unique_id',
					'std' => 'fontsize-',
					'type' => 'text',
					'label' => esc_html__('Unique font size ID','uncode'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
				),
				array(
					'id' => '_uncode_heading_font_size',
					'label' => esc_html__('Font size', 'uncode') ,
					'desc' => esc_html__('Font size in <b>px</b>.', 'uncode') ,
					'std' => '',
					'type' => 'text',
				)
			)
		) ,
		array(
			'id' => '_uncode_heading_font_heights',
			'label' => esc_html__('Custom line height', 'uncode') ,
			'desc' => esc_html__('Define here all the additional font line heights you will need.', 'uncode') ,
			'std' => '',
			'type' => 'list-item',
			'section' => 'uncode_typography_section',
			'settings' => array(
				array(
					'id' => '_uncode_heading_font_height_unique_id',
					'class' => 'unique_id',
					'std' => 'fontheight-',
					'type' => 'text',
					'label' => esc_html__('Unique font height ID','uncode'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
				),
				array(
					'id' => '_uncode_heading_font_height',
					'label' => esc_html__('Font line height', 'uncode') ,
					'desc' => esc_html__('Insert a line height.', 'uncode') ,
					'std' => '',
					'type' => 'text',
				)
			)
		) ,
		array(
			'id' => '_uncode_heading_font_spacings',
			'label' => esc_html__('Custom letter spacing', 'uncode') ,
			'desc' => esc_html__('Define here all the letter spacings you will need.', 'uncode') ,
			'std' => '',
			'type' => 'list-item',
			'section' => 'uncode_typography_section',
			'settings' => array(
				array(
					'id' => '_uncode_heading_font_spacing_unique_id',
					'class' => 'unique_id',
					'std' => 'fontspace-',
					'type' => 'text',
					'label' => esc_html__('Unique letter spacing ID','uncode'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
				),
				array(
					'id' => '_uncode_heading_font_spacing',
					'label' => esc_html__('Letter spacing', 'uncode') ,
					'desc' => esc_html__('Letter spacing with the unit (em or px). Ex. 0.2em', 'uncode') ,
					'std' => '',
					'type' => 'text',
				)
			)
		) ,
		array(
			'id' => '_uncode_custom_colors_list',
			'label' => esc_html__('Color palettes', 'uncode') ,
			'desc' => esc_html__('Define all the colors you will need.', 'uncode') ,
			'std' => array(
				array(
					'title' => esc_html__('Black','uncode'),
					'_uncode_custom_color_unique_id' => 'color-jevc',
					'_uncode_custom_color' => '#000000',
				),
				array(
					'title' => esc_html__('Dark 1','uncode'),
					'_uncode_custom_color_unique_id' => 'color-nhtu',
					'_uncode_custom_color' => '#101213',
				),
				array(
					'title' => esc_html__('Dark 2','uncode'),
					'_uncode_custom_color_unique_id' => 'color-wayh',
					'_uncode_custom_color' => '#141618',
				),
				array(
					'title' => esc_html__('Dark 3','uncode'),
					'_uncode_custom_color_unique_id' => 'color-rgdb',
					'_uncode_custom_color' => '#1b1d1f',
				),
				array(
					'title' => esc_html__('Dark 4','uncode'),
					'_uncode_custom_color_unique_id' => 'color-prif',
					'_uncode_custom_color' => '#303133',
				),
				array(
					'title' => esc_html__('White','uncode'),
					'_uncode_custom_color_unique_id' => 'color-xsdn',
					'_uncode_custom_color' => '#ffffff',
				),
				array(
					'title' => esc_html__('Light 1','uncode'),
					'_uncode_custom_color_unique_id' => 'color-lxmt',
					'_uncode_custom_color' => '#f7f7f7',
				),
				array(
					'title' => esc_html__('Light 2','uncode'),
					'_uncode_custom_color_unique_id' => 'color-gyho',
					'_uncode_custom_color' => '#eaeaea',
				),
				array(
					'title' => esc_html__('Light 3','uncode'),
					'_uncode_custom_color_unique_id' => 'color-uydo',
					'_uncode_custom_color' => '#dddddd',
				),
				array(
					'title' => esc_html__('Light 4','uncode'),
					'_uncode_custom_color_unique_id' => 'color-wvjs',
					'_uncode_custom_color' => '#777',
				),
				array(
					'title' => esc_html__('Cerulean','uncode'),
					'_uncode_custom_color_unique_id' => 'color-vyce',
					'_uncode_custom_color' => '#0cb4ce',
				),
					array(
					'title' => esc_html__('International Orange','uncode'),
					'_uncode_custom_color_unique_id' => 'color-dfgh',
					'_uncode_custom_color' => '#FF590A',
				),
					array(
					'title' => esc_html__('Malachite','uncode'),
					'_uncode_custom_color_unique_id' => 'color-iopl',
					'_uncode_custom_color' => '#0CCE50',
				),
					array(
					'title' => esc_html__('Sunglow','uncode'),
					'_uncode_custom_color_unique_id' => 'color-zsdf',
					'_uncode_custom_color' => '#FFC42E',
				),
			),
			'type' => 'list-item',
			'section' => 'uncode_colors_section',
			'class' => 'list-colors',
			'settings' => array(
				array(
					'id' => '_uncode_custom_color_unique_id',
					'std' => 'color-',
					'class' => 'unique_id',
					'type' => 'text',
					'label' => esc_html__('Unique color ID','uncode'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
				),
				array(
					'id' => '_uncode_custom_color_regular',
					'label' => esc_html__('Monochrome', 'uncode') ,
					'desc' => esc_html__('Activate to assign a monochromatic color, otherwise a gradient will be used.', 'uncode') ,
					'std' => 'on',
					'type' => 'on-off',
					'section' => 'uncode_customize_section',
				) ,
				array(
					'id' => '_uncode_custom_color',
					'label' => esc_html__('Colorpicker', 'uncode') ,
					'desc' => esc_html__('Specify the color for this palette. You can also define a color with the alpha value.', 'uncode') ,
					'std' => '',
					'type' => 'colorpicker',
					'condition' => '_uncode_custom_color_regular:is(on)',
				) ,
				array(
					'id' => '_uncode_custom_color_gradient',
					'label' => esc_html__('Gradient', 'uncode') ,
					'desc' => esc_html__('Specify the gradient color for this palette. NB. You can use a gradient color only as a background color.', 'uncode') ,
					'std' => '',
					'type' => 'gradientpicker',
					'condition' => '_uncode_custom_color_regular:is(off)',
				) ,
			)
		) ,
		array(
			'id' => '_uncode_custom_light_block_title',
			'label' => '<i class="fa fa-square-o"></i> ' . esc_html__('Light skin', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_logo_color_light',
			'label' => esc_html__('SVG/Text logo color', 'uncode') ,
			'desc' => esc_html__('Specify the logo color if it\'s a SVG or textual.', 'uncode') ,
			'std' => 'color-prif',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_color_light',
			'label' => esc_html__('Menu text color', 'uncode') ,
			'desc' => esc_html__('Specify the menu text color.', 'uncode') ,
			'std' => 'color-prif',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_bg_color_light',
			'label' => esc_html__('Primary menu background color', 'uncode') ,
			'desc' => esc_html__('Specify the primary menu background color.', 'uncode') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_bg_alpha_light',
			'label' => esc_html__('Primary menu background opacity', 'uncode') ,
			'desc' => esc_html__('Adjust the primary menu background transparency.', 'uncode') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_submenu_bg_color_light',
			'label' => esc_html__('Primary submenu background color', 'uncode') ,
			'desc' => esc_html__('Specify the primary submenu text color.', 'uncode') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_border_color_light',
			'label' => esc_html__('Primary menu border color', 'uncode') ,
			'desc' => esc_html__('Specify the primary menu border color.', 'uncode') ,
			'std' => 'color-gyho',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_border_alpha_light',
			'label' => esc_html__('Primary menu border opacity', 'uncode') ,
			'desc' => esc_html__('Adjust the primary menu border transparency.', 'uncode') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_secmenu_bg_color_light',
			'label' => esc_html__('Secondary menu background color', 'uncode') ,
			'desc' => esc_html__('Specify the secondary menu background color.', 'uncode') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_heading_color_light',
			'label' => esc_html__('Headings color', 'uncode') ,
			'desc' => esc_html__('Specify the headings text color.', 'uncode') ,
			'std' => 'color-prif',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_text_color_light',
			'label' => esc_html__('Content text color', 'uncode') ,
			'desc' => esc_html__('Specify the content area text color.', 'uncode') ,
			'std' => 'color-wvjs',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_background_color_light',
			'label' => esc_html__('Content background color', 'uncode') ,
			'desc' => esc_html__('Specify the content background color.', 'uncode') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_custom_dark_block_title',
			'label' => '<i class="fa fa-square"></i> ' . esc_html__('Dark skin', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_logo_color_dark',
			'label' => esc_html__('SVG/Text logo color', 'uncode') ,
			'desc' => esc_html__('Specify the logo color if it\'s a SVG or textual.', 'uncode') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_color_dark',
			'label' => esc_html__('Menu text color', 'uncode') ,
			'desc' => esc_html__('Specify the menu text color.', 'uncode') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_bg_color_dark',
			'label' => esc_html__('Primary menu background color', 'uncode') ,
			'desc' => esc_html__('Specify the primary menu background color.', 'uncode') ,
			'std' => 'color-wayh',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_bg_alpha_dark',
			'label' => esc_html__('Primary menu background opacity', 'uncode') ,
			'desc' => esc_html__('Adjust the primary menu background transparency.', 'uncode') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_submenu_bg_color_dark',
			'label' => esc_html__('Primary submenu background color', 'uncode') ,
			'desc' => esc_html__('Specify the primary submenu text color.', 'uncode') ,
			'std' => 'color-rgdb',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_border_color_dark',
			'label' => esc_html__('Primary menu border color', 'uncode') ,
			'desc' => esc_html__('Specify the primary menu border color.', 'uncode') ,
			'std' => 'color-prif',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_border_alpha_dark',
			'label' => esc_html__('Primary menu border opacity', 'uncode') ,
			'desc' => esc_html__('Adjust the primary menu border transparency.', 'uncode') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_secmenu_bg_color_dark',
			'label' => esc_html__('Secondary menu background color', 'uncode') ,
			'desc' => esc_html__('Specify the secondary menu background color.', 'uncode') ,
			'std' => 'color-wayh',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_heading_color_dark',
			'label' => esc_html__('Headings color', 'uncode') ,
			'desc' => esc_html__('Specify the headings text color.', 'uncode') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_text_color_dark',
			'label' => esc_html__('Content text color', 'uncode') ,
			'desc' => esc_html__('Specify the content area text color.', 'uncode') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_background_color_dark',
			'label' => esc_html__('Content background color', 'uncode') ,
			'desc' => esc_html__('Specify the content background color.', 'uncode') ,
			'std' => 'color-wayh',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_custom_general_block_title',
			'label' => '<i class="fa fa-globe3"></i> ' . esc_html__('General', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_body_background',
			'label' => esc_html__('HTML body background', 'uncode') ,
			'desc' => esc_html__('Specify the body background color and media.', 'uncode') ,
			'type' => 'background',
			'std' => array(
				'background-color' => 'color-lxmt',
				'background-repeat' => '',
				'background-attachment' => '',
				'background-position' => '',
				'background-size' => '',
				'background-image' => '',
			),
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_accent_color',
			'label' => esc_html__('Accent color', 'uncode') ,
			'desc' => esc_html__('Specify the accent color.', 'uncode') ,
			'std' => 'color-vyce',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_body_font_family',
			'label' => esc_html__('Body font family', 'uncode') ,
			'desc' => esc_html__('Specify the body font family.', 'uncode') ,
			'std' => 'font-377884',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_ui_font_family',
			'label' => esc_html__('UI font family', 'uncode') ,
			'desc' => esc_html__('Specify the UI font family.', 'uncode') ,
			'std' => 'font-762333',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_ui_font_weight',
			'label' => esc_html__('UI font weight', 'uncode') ,
			'desc' => esc_html__('Specify the UI font weight.', 'uncode') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_heading_font_family',
			'label' => esc_html__('Headings font family', 'uncode') ,
			'desc' => esc_html__('Specify the headings font family.', 'uncode') ,
			'std' => 'font-377884',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_heading_font_weight',
			'label' => esc_html__('Headings font weight', 'uncode') ,
			'desc' => esc_html__('Specify the Headings font weight.', 'uncode') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_smooth_scroller',
			'label' => esc_html__('Smooth scroller', 'uncode') ,
			'desc' => esc_html__('Activate the enhanced smooth scroller.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_input_underline',
			'label' => esc_html__('Input text underlined', 'uncode') ,
			'desc' => esc_html__('Activate to style all the input text with the underline.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_style_block_title',
			'label' => '<i class="fa fa-menu"></i> ' . esc_html__('Menu', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_overlay_menu_style',
			'label' => esc_html__('Overlay menu skin', 'uncode') ,
			'desc' => esc_html__('Specify the overlay menu skin.', 'uncode') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'choices' => $stylesArrayMenu
		) ,
		array(
			'id' => '_uncode_menu_color_hover',
			'label' => esc_html__('Menu highlight color', 'uncode') ,
			'desc' => esc_html__('Specify the menu active and hover effect color (If not specified an opaque version of the menu color will be used).', 'uncode') ,
			'std' => '',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_primary_menu_style',
			'label' => esc_html__('Primary menu skin', 'uncode') ,
			'desc' => esc_html__('Specify the primary menu skin.', 'uncode') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'choices' => $stylesArrayMenu
		) ,
		array(
			'id' => '_uncode_primary_submenu_style',
			'label' => esc_html__('Primary submenu skin', 'uncode') ,
			'desc' => esc_html__('Specify the primary submenu skin.', 'uncode') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'choices' => $stylesArrayMenu
		) ,
		array(
			'id' => '_uncode_secondary_menu_style',
			'label' => esc_html__('Secondary menu skin', 'uncode') ,
			'desc' => esc_html__('Specify the secondary menu skin.', 'uncode') ,
			'std' => 'dark',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(hmenu-right),_uncode_headers:is(hmenu-left),_uncode_headers:is(hmenu-justify),_uncode_headers:is(hmenu-center)',
			'operator' => 'or',
			'choices' => $stylesArrayMenu
		) ,
		array(
			'id' => '_uncode_menu_font_size',
			'label' => esc_html__('Menu font size', 'uncode') ,
			'desc' => esc_html__('Specify the menu font size.', 'uncode') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_submenu_font_size',
			'label' => esc_html__('Submenu font size', 'uncode') ,
			'desc' => esc_html__('Specify the submenu font size.', 'uncode') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_mobile_font_size',
			'label' => esc_html__('Mobile menu font size', 'uncode') ,
			'desc' => esc_html__('Specify the menu font size for mobile.', 'uncode') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_font_family',
			'label' => esc_html__('Menu font family', 'uncode') ,
			'desc' => esc_html__('Specify the menu font family.', 'uncode') ,
			'std' => 'font-762333',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_menu_font_weight',
			'label' => esc_html__('Menu font weight', 'uncode') ,
			'desc' => esc_html__('Specify the menu font weight.', 'uncode') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_custom_content_block_title',
			'label' => '<i class="fa fa-layout"></i> ' . esc_html__('Content', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_general_style',
			'label' => esc_html__('Skin', 'uncode') ,
			'desc' => esc_html__('Specify the content skin.', 'uncode') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '',
			'operator' => 'and',
			'choices' => array(
				array(
					'value' => 'light',
					'label' => esc_html__('Light', 'uncode') ,
					'src' => ''
				) ,
				array(
					'value' => 'dark',
					'label' => esc_html__('Dark', 'uncode') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_general_bg_color',
			'label' => esc_html__('Background color', 'uncode') ,
			'desc' => esc_html__('Specify a custom content background color.', 'uncode') ,
			'std' => '',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_custom_buttons_block_title',
			'label' => '<i class="fa fa-download3"></i> ' . esc_html__('Buttons', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_buttons_font_family',
			'label' => esc_html__('Buttons font family', 'uncode') ,
			'desc' => esc_html__('Specify the buttons font family.', 'uncode') ,
			'std' => 'font-762333',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_buttons_font_weight',
			'label' => esc_html__('Buttons font weight', 'uncode') ,
			'desc' => esc_html__('Specify the buttons font weight.', 'uncode') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_buttons_text_transform',
			'label' => esc_html__('Buttons text transform', 'uncode') ,
			'desc' => esc_html__('Specify the buttons text transform.', 'uncode') ,
			'std' => 'uppercase',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => array(
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
			) ,
		) ,
		array(
			'id' => '_uncode_footer_style_block_title',
			'label' => '<i class="fa fa-ellipsis"></i> ' . esc_html__('Footer', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_footer_last_style',
			'label' => esc_html__('Copyright area skin', 'uncode') ,
			'desc' => esc_html__('Specify the copyright area skin color.', 'uncode') ,
			'std' => 'dark',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '',
			'operator' => 'and',
			'choices' => $stylesArrayMenu
		) ,
		array(
			'id' => '_uncode_footer_bg_color',
			'label' => esc_html__('Copyright area custom background color', 'uncode') ,
			'desc' => esc_html__('Specify a custom copyright area background color.', 'uncode') ,
			'std' => '',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_custom_portfolio_block_title',
			'label' => '<i class="fa fa-briefcase3"></i> ' . ucfirst($portfolio_cpt_name) . ' ' . esc_html__('CPT', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_portfolio_cpt',
			'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('CPT label', 'uncode') ,
			'desc' => esc_html__('Enter a custom portfolio post type label.', 'uncode') ,
			'std' => 'portfolio',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_portfolio_cpt_slug',
			'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('CPT slug', 'uncode') ,
			'desc' => esc_html__('Enter a custom portfolio post type slug.', 'uncode') ,
			'std' => 'portfolio',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_footer_layout_block_title',
			'label' => '<i class="fa fa-layers"></i> ' . esc_html__('Layout', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_full',
			'label' => esc_html__('Footer full width', 'uncode') ,
			'desc' => esc_html__('Expand the footer to full width.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_footer_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_footer_content_block_title',
			'label' => '<i class="fa fa-cog2"></i> ' . esc_html__('Widget area', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_block',
			'label' => esc_html__('Content Block', 'uncode') ,
			'desc' => esc_html__('Specify the Content Block to use as a footer content.', 'uncode') ,
			'std' => '',
			'type' => 'custom-post-type-select',
			'section' => 'uncode_footer_section',
			'post_type' => 'uncodeblock',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_footer_last_block_title',
			'label' => '&copy; ' . esc_html__('Copyright area', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_copyright',
			'label' => esc_html__('Automatic copyright text', 'uncode') ,
			'desc' => esc_html__('Activate to use an automatic copyright text.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_text',
			'label' => esc_html__('Custom copyright text', 'uncode') ,
			'desc' => esc_html__('Insert a custom text for the footer copyright area.', 'uncode') ,
			'type' => 'textarea',
			'section' => 'uncode_footer_section',
			'operator' => 'or',
			'condition' => '_uncode_footer_copyright:is(off)',
		) ,
		array(
			'id' => '_uncode_footer_position',
			'label' => esc_html__('Content alignment', 'uncode') ,
			'desc' => esc_html__('Specify the footer copyright text alignment.', 'uncode') ,
			'std' => 'left',
			'type' => 'select',
			'section' => 'uncode_footer_section',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode')
				) ,
				array(
					'value' => 'center',
					'label' => esc_html__('Center', 'uncode')
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode')
				)
			)
		) ,
		array(
			'id' => '_uncode_footer_social',
			'label' => esc_html__('Social links', 'uncode') ,
			'desc' => esc_html__('Activate to have the social icons in the footer copyright area.', 'uncode') ,
			'type' => 'on-off',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_add_block_title',
			'label' => '<i class="fa fa-square-plus"></i> ' . esc_html__('Additionals', 'uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_uparrow',
			'label' => esc_html__('Scroll up button', 'uncode') ,
			'desc' => esc_html__('Activate to add a scroll up button in the footer.', 'uncode') ,
			'type' => 'on-off',
			'std' => 'on',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_uparrow_mobile',
			'label' => esc_html__('Scroll up button on mobile', 'uncode') ,
			'desc' => esc_html__('Activate to add a scroll up button in the footer for mobile devices.', 'uncode') ,
			'type' => 'on-off',
			'std' => 'on',
			'condition' => '_uncode_footer_uparrow:is(on)',
			'operator' => 'and',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_social_list',
			'label' => esc_html__('Social Networks', 'uncode') ,
			'desc' => esc_html__('Define here all the social networks you will need.', 'uncode') ,
			'type' => 'list-item',
			'section' => 'uncode_connections_section',
			'class' => 'list-social',
			'settings' => array(
				array(
					'id' => '_uncode_social_unique_id',
					'class' => 'unique_id',
					'std' => 'social-',
					'type' => 'text',
					'label' => esc_html__('Unique social ID','uncode'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode'),
				),
				array(
					'id' => '_uncode_social',
					'label' => esc_html__('Social Network Icon', 'uncode') ,
					'desc' => esc_html__('Specify the social network icon.', 'uncode') ,
					'type' => 'text',
					'class' => 'button_icon_container',
				) ,
				array(
					'id' => '_uncode_link',
					'label' => esc_html__('Social Network Link', 'uncode') ,
					'desc' => esc_html__('Enter your social network link.', 'uncode') ,
					'std' => '',
					'type' => 'text',
					'condition' => '',
					'operator' => 'and'
				) ,
				array(
					'id' => '_uncode_menu_hidden',
					'label' => esc_html__('Hide In The Menu', 'uncode') ,
					'desc' => esc_html__('Activate to hide the social icon in the menu (if the social connections in the menu is active).', 'uncode') ,
					'std' => 'off',
					'type' => 'on-off',
					'condition' => '',
					'operator' => 'and'
				) ,
			)
		) ,
		array(
			'id' => '_uncode_gmaps_api',
			'label' => esc_html__('Google Maps API KEY', 'uncode') ,
			'desc' => sprintf( wp_kses(__( 'To use Uncode custom styled Google Maps you need to create <a href="%s" target="_blank">here the Google API KEY</a> and paste it in this field.', 'uncode' ), array( 'a' => array( 'href' => array(),'target' => array() ) ) ), 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ),
			'type' => 'text',
			'section' => 'uncode_gmaps_section',
		) ,
		array(
			'id' => '_uncode_custom_css',
			'label' => esc_html__('CSS', 'uncode') ,
			'desc' => esc_html__('Enter here your custom CSS.', 'uncode') ,
			'std' => '',
			'type' => 'css',
			'section' => 'uncode_cssjs_section',
			'rows' => '20',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_custom_js',
			'label' => esc_html__('Javascript', 'uncode') ,
			'desc' => esc_html__('Enter here your custom Javacript code.', 'uncode') ,
			'std' => '',
			'type' => 'textarea-simple',
			'section' => 'uncode_cssjs_section',
			'rows' => '20',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_adaptive',
			'label' => esc_html__('Adaptive images', 'uncode') ,
			'desc' => esc_html__('Activate to take advantage of the Adaptive Images system. Adaptive Images detects your visitor\'s screen size and automatically delivers device appropriate re-scaled images.', 'uncode') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_adaptive_async',
			'label' => esc_html__('Asynchronous adaptive image system', 'uncode') ,
			'desc' => esc_html__('Activate to load the adaptive images asynchronously, this will improve the loading performance and it\'s necessary if using an aggresive caching system.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'or',
			'condition' => '_uncode_adaptive:is(on)',
		) ,
		array(
			'id' => '_uncode_adaptive_async_blur',
			'label' => esc_html__('Asynchronous loading blur effect', 'uncode') ,
			'desc' => esc_html__('Activate to use a bluring effect when loading the images.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'and',
			'condition' => '_uncode_adaptive:is(on),_uncode_adaptive_async:is(on)',
		) ,
		array(
			'id' => '_uncode_adaptive_quality',
			'label' => esc_html__('Image quality', 'uncode') ,
			'desc' => esc_html__('Adjust the images compression quality.', 'uncode') ,
			'std' => '90',
			'type' => 'numeric-slider',
			'min_max_step'=> '60,100,1',
			'section' => 'uncode_performance_section',
			'operator' => 'or',
			'condition' => '_uncode_adaptive:is(on)',
		) ,
		array(
			'id' => '_uncode_adaptive_sizes',
			'label' => esc_html__('Image sizes range', 'uncode') ,
			'desc' => esc_html__('Enter all the image sizes you want use for the Adaptive Images system. NB. The values needs to be comma separated.', 'uncode') ,
			'type' => 'text',
			'std' => '258,516,720,1032,1440,2064,2880',
			'section' => 'uncode_performance_section',
			'operator' => 'or',
			'condition' => '_uncode_adaptive:is(on)',
		) ,
		array(
			'id' => '_uncode_htaccess',
			'label' => esc_html__('Apache Server Configs', 'uncode') ,
			'desc' => esc_html__('Activate the enhanced .htaccess, this will improve the web site\'s performance and security.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_production',
			'label' => esc_html__('Production mode', 'uncode') ,
			'desc' => esc_html__('Activate this to switch to production mode, the CSS and JS will be cached by the browser and the JS minified.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_redirect',
			'label' => esc_html__('Activate page redirect', 'uncode') ,
			'desc' => esc_html__('Activate to redirect all the website calls to a specific page. NB. This can only be visible when the user is not logged in.', 'uncode') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_redirect_section',
		) ,
		array(
			'id' => '_uncode_redirect_page',
			'label' => esc_html__('Redirect page', 'uncode') ,
			'desc' => esc_html__('Specify the redirect page. NB. This page will be presented without menu and footer.', 'uncode') ,
			'type' => 'page_select',
			'section' => 'uncode_redirect_section',
			'post_type' => 'page',
			'condition' => '_uncode_redirect:is(on)',
			'operator' => 'and'
		) ,
	);

	$custom_settings_one = array_merge( $custom_settings_one, $custom_settings_three );

	$custom_settings = array(
		'sections' => $custom_settings_section_one,
		'settings' => $custom_settings_one,
	);

	if (class_exists('WooCommerce'))
	{

		$woo_section = array(
			array(
				'id' => 'uncode_woocommerce_section',
				'title' => '<i class="fa fa-shopping-cart"></i> ' . esc_html__('WooCommerce', 'uncode')
			),
			array(
				'id' => 'uncode_product_section',
				'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . esc_html__('Product', 'uncode') . '</span>'
			) ,
			array(
				'id' => 'uncode_product_index_section',
				'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Products', 'uncode') . '</span>'
			) ,
		);

		$menus_array[] = array(
			'value' => '',
			'label' => esc_html__('Select…', 'uncode')
		);
		$menu_array = array();
		$nav_menus = get_registered_nav_menus();

		foreach ($nav_menus as $location => $description)
		{

			$menu_array['value'] = $location;
			$menu_array['label'] = $description;
			$menus_array[] = $menu_array;
		}

		$menus_array[] = array(
			'value' => 'social',
			'label' => esc_html__('Social Menu', 'uncode')
		);

		$woocommerce_cart_icon = array(
			'id' => '_uncode_woocommerce_cart_icon',
			'label' => esc_html__('Cart icon', 'uncode') ,
			'desc' => esc_html__('Specify the cart icon', 'uncode') ,
			'std' => 'fa fa-bag',
			'type' => 'text',
			'class' => 'button_icon_container',
			'section' => 'uncode_woocommerce_section',
		);

		$woocommerce_post = array(
			/////////////////////////
			//  Product Single		///
			/////////////////////////
			str_replace('%section%', 'product', $menu_section_title),
			str_replace('%section%', 'product', $menu),
			str_replace('%section%', 'product', $menu_width),
			str_replace('%section%', 'product', $menu_opaque),
			str_replace('%section%', 'product', $header_section_title),
			str_replace('%section%', 'product', $header_type),
			str_replace('%section%', 'product', $header_uncode_block),
			str_replace('%section%', 'product', $header_revslider),
			str_replace('%section%', 'product', $header_layerslider),

			str_replace('%section%', 'product', $header_width),
			str_replace('%section%', 'product', $header_height),
			str_replace('%section%', 'product', $header_min_height),
			str_replace('%section%', 'product', $header_title),
			str_replace('%section%', 'product', $header_style),
			str_replace('%section%', 'product', $header_content_width),
			str_replace('%section%', 'product', $header_custom_width),
			str_replace('%section%', 'product', $header_align),
			str_replace('%section%', 'product', $header_position),
			str_replace('%section%', 'product', $header_title_font),
			str_replace('%section%', 'product', $header_title_size),
			str_replace('%section%', 'product', $header_title_height),
			str_replace('%section%', 'product', $header_title_spacing),
			str_replace('%section%', 'product', $header_title_weight),
			str_replace('%section%', 'product', $header_title_transform),
			str_replace('%section%', 'product', $header_title_italic),
			str_replace('%section%', 'product', $header_text_animation),
			str_replace('%section%', 'product', $header_animation_speed),
			str_replace('%section%', 'product', $header_animation_delay),
			str_replace('%section%', 'product', $header_featured),
			str_replace('%section%', 'product', $header_background),
			str_replace('%section%', 'product', $header_parallax),
			str_replace('%section%', 'product', $header_overlay_color),
			str_replace('%section%', 'product', $header_overlay_color_alpha),
			str_replace('%section%', 'product', $header_scroll_opacity),
			str_replace('%section%', 'product', $header_scrolldown),

			str_replace('%section%', 'product', $body_section_title),
			str_replace('%section%', 'product', $body_layout_width),
			str_replace('%section%', 'product', $body_layout_width_custom),
			str_replace('%section%', 'product', $show_breadcrumb),
			str_replace('%section%', 'product', $breadcrumb_align),
			str_replace('%section%', 'product', $show_title),
			str_replace('%section%', 'product', $body_uncode_block_after),
			str_replace('%section%', 'product', $navigation_section_title),
			str_replace('%section%', 'product', $navigation_activate),
			str_replace('%section%', 'product', $navigation_page_index),
			str_replace('%section%', 'product', $navigation_index_label),
			str_replace('%section%', 'product', $navigation_nextprev_title),
			str_replace('%section%', 'product', $footer_section_title),
			str_replace('%section%', 'product', $footer_uncode_block),
			str_replace('%section%', 'product', $footer_width),
			str_replace('%section%', 'product', $custom_fields_section_title),
			str_replace('%section%', 'product', $custom_fields_list),
			/////////////////////////
			//  Products Index		///
			/////////////////////////
			str_replace('%section%', 'product_index', $menu_section_title),
			str_replace('%section%', 'product_index', $menu),
			str_replace('%section%', 'product_index', $menu_width),
			str_replace('%section%', 'product_index', $menu_opaque),
			str_replace('%section%', 'product_index', $header_section_title),
			str_replace('%section%', 'product_index', run_array_to($header_type, 'std', 'header_basic')),
			str_replace('%section%', 'product_index', $header_uncode_block),
			str_replace('%section%', 'product_index', $header_revslider),
			str_replace('%section%', 'product_index', $header_layerslider),

			str_replace('%section%', 'product_index', $header_width),
			str_replace('%section%', 'product_index', $header_height),
			str_replace('%section%', 'product_index', $header_min_height),
			str_replace('%section%', 'product_index', $header_title),
			str_replace('%section%', 'product_index', $header_style),
			str_replace('%section%', 'product_index', $header_content_width),
			str_replace('%section%', 'product_index', $header_custom_width),
			str_replace('%section%', 'product_index', $header_align),
			str_replace('%section%', 'product_index', $header_position),
			str_replace('%section%', 'product_index', $header_title_font),
			str_replace('%section%', 'product_index', $header_title_size),
			str_replace('%section%', 'product_index', $header_title_height),
			str_replace('%section%', 'product_index', $header_title_spacing),
			str_replace('%section%', 'product_index', $header_title_weight),
			str_replace('%section%', 'product_index', $header_title_transform),
			str_replace('%section%', 'product_index', $header_title_italic),
			str_replace('%section%', 'product_index', $header_text_animation),
			str_replace('%section%', 'product_index', $header_animation_speed),
			str_replace('%section%', 'product_index', $header_animation_delay),
			str_replace('%section%', 'product_index', $header_featured),
			str_replace('%section%', 'product_index', $header_background),
			str_replace('%section%', 'product_index', $header_parallax),
			str_replace('%section%', 'product_index', $header_overlay_color),
			str_replace('%section%', 'product_index', $header_overlay_color_alpha),
			str_replace('%section%', 'product_index', $header_scroll_opacity),
			str_replace('%section%', 'product_index', $header_scrolldown),

			str_replace('%section%', 'product_index', $body_section_title),
			str_replace('%section%', 'product_index', $show_breadcrumb),
			str_replace('%section%', 'product_index', $breadcrumb_align),
			str_replace('%section%', 'product_index', $body_uncode_block),
			str_replace('%section%', 'product_index', $body_layout_width),
			str_replace('%section%', 'product_index', $body_single_post_width),
			str_replace('%section%', 'product_index', $show_title),
			str_replace('%section%', 'product_index', $sidebar_section_title),
			str_replace('%section%', 'product_index', run_array_to($sidebar_activate, 'std', 'on')),
			str_replace('%section%', 'product_index', $sidebar_widget),
			str_replace('%section%', 'product_index', $sidebar_position),
			str_replace('%section%', 'product_index', $sidebar_size),
			str_replace('%section%', 'product_index', $sidebar_sticky),
			str_replace('%section%', 'product_index', $sidebar_style),
			str_replace('%section%', 'product_index', $sidebar_bgcolor),
			str_replace('%section%', 'product_index', $sidebar_fill),
			str_replace('%section%', 'product_index', $footer_section_title),
			str_replace('%section%', 'product_index', $footer_uncode_block),
			str_replace('%section%', 'product_index', $footer_width),
		);

		$custom_settings['sections'] = array_merge( $custom_settings['sections'], $woo_section );
		array_push($custom_settings['settings'], $woocommerce_cart_icon);
		$custom_settings['settings'] = array_merge( $custom_settings['settings'], $woocommerce_post );

	}

	$custom_settings['settings'] = array_filter( $custom_settings['settings'], 'uncode_is_not_null' );

	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters(ot_settings_id() . '_args', $custom_settings);

	/* settings are not the same update the DB */
	if ($saved_settings !== $custom_settings)
	{
		update_option(ot_settings_id() , $custom_settings);
	}

	/**
	 * Filter on layout images.
	 */
	function filter_layout_radio_images($array, $layout)
	{

		/* only run the filter where the field ID is my_radio_images */
		if ($layout == '_uncode_headers')
		{
			$array = array(
				array(
					'value' => 'hmenu-right',
					'label' => esc_html__('Right', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-right.jpg'
				) ,
				array(
					'value' => 'hmenu-justify',
					'label' => esc_html__('Justify', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-justify.jpg'
				) ,
				array(
					'value' => 'hmenu-left',
					'label' => esc_html__('Left', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-left.jpg'
				) ,
				array(
					'value' => 'hmenu-center',
					'label' => esc_html__('Center', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-center.jpg'
				) ,
				array(
					'value' => 'hmenu-center-split',
					'label' => esc_html__('Center Split', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-splitted.jpg'
				) ,
				array(
					'value' => 'vmenu',
					'label' => esc_html__('Lateral', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/vmenu.jpg'
				) ,
				array(
					'value' => 'vmenu-offcanvas',
					'label' => esc_html__('Offcanvas', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/offcanvas.jpg'
				) ,
				array(
					'value' => 'menu-overlay',
					'label' => esc_html__('Overlay', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/overlay.jpg'
				) ,
				array(
					'value' => 'menu-overlay-center',
					'label' => esc_html__('Overlay Center', 'uncode') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/overlay-center.jpg'
				) ,
			);
		}
		return $array;
	}
	add_filter('ot_radio_images', 'filter_layout_radio_images', 10, 2);
}
