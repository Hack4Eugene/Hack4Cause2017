<?php

/**
 * Theme Mode
 */
add_filter('ot_theme_mode', '__return_true');

/**
 * Show Settings Pages
 */
add_filter('ot_show_pages', '__return_true');

/**
 * Show Theme Options UI Builder
 */
add_filter('ot_show_options_ui', '__return_false');

/**
 * Show Documentation
 */
add_filter('ot_show_docs', '__return_false');

/**
 * Meta Boxes
 */
add_filter('ot_meta_boxes', '__return_true');

function uncode_upload_text() {
    return 'Insert to options';
}
add_filter('ot_upload_text', 'uncode_upload_text', 10, 2);

function uncode_id()
{
	return 'uncode';
}

add_filter('ot_options_id', 'uncode_id', 10, 2);

function uncode_settings_id()
{
	return 'uncode_settings';
}

add_filter('ot_settings_id', 'uncode_settings_id', 10, 2);

function uncode_layouts_id()
{
	return 'uncode_layouts';
}

add_filter('ot_layouts_id', 'uncode_layouts_id', 10, 2);

function uncode_header_logo_link()
{
	return '';
}

add_filter('ot_header_logo_link', 'uncode_header_logo_link', 10, 2);

function custom_theme_options_menu_slug() {
    return 'uncode-options';
}
add_filter('ot_theme_options_menu_slug', 'custom_theme_options_menu_slug', 10, 2);

function uncode_admin_slug() {
	return 'uncode-menu';
}

add_filter('ot_theme_options_parent_slug', 'uncode_admin_slug');

function uncode_to_title() {
	return esc_html__('Theme Options','uncode');
}

add_filter('ot_theme_options_menu_title', 'uncode_to_title');
add_filter('ot_theme_options_page_title', 'uncode_to_title');

function custom_register_pages_array($array) {
	unset($array[0]);
  $array[1]['parent_slug'] = 'uncode-menu';
  $array[1]['page_title'] = esc_html__('Options Import/Export','uncode');
  $array[1]['menu_title'] = esc_html__('Options Utils','uncode');
  return $array;
}
add_filter('ot_register_pages_array', 'custom_register_pages_array', 10, 2);

//ot_register_pages_array
function uncode_header_version_text()
{
	return esc_html__('Version','uncode') . ' ' . UNCODE_VERSION;
}

add_filter('ot_header_version_text', 'uncode_header_version_text', 10, 2);

function uncode_type_background_size_choices()
{
	return array(
		array(
			'label' => 'background-size',
			'value' => ''
		) ,
		array(
			'label' => 'cover',
			'value' => 'cover'
		) ,
		array(
			'label' => 'contain',
			'value' => 'contain'
		) ,
		array(
			'label' => 'initial',
			'value' => 'initial'
		)
	);
}

add_filter('ot_type_background_size_choices', 'uncode_type_background_size_choices', 10, 2);

if (!function_exists('ot_recognized_uncode_color'))
{

	function ot_recognized_uncode_color($field_id = '')
	{

		global $UNCODE_COLORS;

		return apply_filters('ot_recognized_uncode_color', $UNCODE_COLORS, $field_id);
	}
}

if (!function_exists('ot_recognized_uncode_colors_w_transp'))
{

	function ot_recognized_uncode_colors_w_transp($field_id = '')
	{

		global $UNCODE_COLORS;

		return apply_filters('ot_recognized_uncode_colors_w_transp', array_merge(array(
			array(
				'value' => 'transparent',
				'label' => esc_html__('Transparent', 'uncode')
			)
		) , $UNCODE_COLORS) , $field_id);
	}
}

function ot_type_background($args = array())
{

	/* turns arguments array into variables */
	extract($args);

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* If an attachment ID is stored here fetch its URL and replace the value */
	if (isset($field_value['background-image']) && wp_attachment_is_image($field_value['background-image']))
	{

		$attachment_data = wp_get_attachment_image_src($field_value['background-image'], 'original');

		/* check for attachment data */
		if ($attachment_data)
		{

			$field_src = $attachment_data[0];
		}
	}

	/* format setting outer wrapper */
	echo '<div class="format-setting type-background ' . ($has_desc ? 'has-desc' : 'no-desc') . '">';

	/* description */
	if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>';

	/* format setting inner wrapper */
	echo '<div class="format-setting-inner">';

	/* allow fields to be filtered */
	$ot_recognized_background_fields = apply_filters('ot_recognized_background_fields', array(
		'background-color',
		'background-repeat',
		'background-attachment',
		'background-position',
		'background-size',
		'background-image'
	) , $field_id);

	echo '<div class="ot-background-group">';

	/* build background color */
	if (in_array('background-color', $ot_recognized_background_fields))
	{

		$background_color = isset($field_value['background-color']) ? esc_attr($field_value['background-color']) : '';

		echo '<select name="' . esc_attr($field_name) . '[background-color]" id="' . esc_attr($field_id) . '-color" class="option-tree-ui-select uncode-color-select ' . esc_attr($field_class) . '">';

		$colors_array = ot_recognized_uncode_color($field_id);

		array_unshift($colors_array, array(
			'value' => '',
			'label' => 'background-color'
		));
		foreach ($colors_array as $key => $value)
		{
			if (isset($value['disabled'])) echo '<option value="" disabled>' . esc_attr($value['label']) . '</option>';
			else
			{
				echo '<option class="' . esc_attr($value['value']) . '" value="' . esc_attr($value['value']) . '" ' . selected($background_color, $value['value'], false) . '>' . esc_attr($value['label']) . '</option>';
			}
		}

		echo '</select>';

	}

	/* build background repeat */
	if (in_array('background-repeat', $ot_recognized_background_fields))
	{

		$background_repeat = isset($field_value['background-repeat']) ? esc_attr($field_value['background-repeat']) : '';

		echo '<select name="' . esc_attr($field_name) . '[background-repeat]" id="' . esc_attr($field_id) . '-repeat" class="option-tree-ui-select ' . esc_attr($field_class) . '">';

		echo '<option value="">' . esc_html__('background-repeat', 'uncode') . '</option>';
		foreach (ot_recognized_background_repeat($field_id) as $key => $value)
		{

			echo '<option value="' . esc_attr($key) . '" ' . selected($background_repeat, $key, false) . '>' . esc_attr($value) . '</option>';
		}

		echo '</select>';
	}

	/* build background attachment */
	if (in_array('background-attachment', $ot_recognized_background_fields))
	{

		$background_attachment = isset($field_value['background-attachment']) ? esc_attr($field_value['background-attachment']) : '';

		echo '<select name="' . esc_attr($field_name) . '[background-attachment]" id="' . esc_attr($field_id) . '-attachment" class="option-tree-ui-select ' . $field_class . '">';

		echo '<option value="">' . esc_html__('background-attachment', 'uncode') . '</option>';

		foreach (ot_recognized_background_attachment($field_id) as $key => $value)
		{

			echo '<option value="' . esc_attr($key) . '" ' . selected($background_attachment, $key, false) . '>' . esc_attr($value) . '</option>';
		}

		echo '</select>';
	}

	/* build background position */
	if (in_array('background-position', $ot_recognized_background_fields))
	{

		$background_position = isset($field_value['background-position']) ? esc_attr($field_value['background-position']) : '';

		echo '<select name="' . esc_attr($field_name) . '[background-position]" id="' . esc_attr($field_id) . '-position" class="option-tree-ui-select ' . esc_attr($field_class) . '">';

		echo '<option value="">' . esc_html__('background-position', 'uncode') . '</option>';

		foreach (ot_recognized_background_position($field_id) as $key => $value)
		{

			echo '<option value="' . esc_attr($key) . '" ' . selected($background_position, $key, false) . '>' . esc_attr($value) . '</option>';
		}

		echo '</select>';
	}

	/* Build background size  */
	if (in_array('background-size', $ot_recognized_background_fields))
	{

		$choices = apply_filters('ot_type_background_size_choices', '', $field_id);

		if (is_array($choices) && !empty($choices))
		{

			/* build select */
			echo '<select name="' . esc_attr($field_name) . '[background-size]" id="' . esc_attr($field_id) . '-size" class="option-tree-ui-select ' . esc_attr($field_class) . '">';

			foreach ((array)$choices as $choice)
			{
				if (isset($choice['value']) && isset($choice['label']))
				{
					echo '<option value="' . esc_attr($choice['value']) . '"' . selected((isset($field_value['background-size']) ? $field_value['background-size'] : '') , $choice['value'], false) . '>' . esc_attr($choice['label']) . '</option>';
				}
			}

			echo '</select>';
		}
		else
		{

			echo '<input type="text" name="' . esc_attr($field_name) . '[background-size]" id="' . esc_attr($field_id) . '-size" value="' . (isset($field_value['background-size']) ? esc_attr($field_value['background-size']) : '') . '" class="widefat ot-background-size-input option-tree-ui-input ' . esc_attr($field_class) . '" placeholder="' . esc_html__('background-size', 'uncode') . '" />';
		}
	}

	echo '</div>';

	/* build background image */
        if ( in_array( 'background-image', $ot_recognized_background_fields ) ) {

          echo '<div class="option-tree-ui-upload-parent">';

            /* input */
            echo '<input type="text" name="' . esc_attr( $field_name ) . '[background-image]" id="' . esc_attr( $field_id ) . '" value="' . ( isset( $field_value['background-image'] ) ? esc_attr( $field_value['background-image'] ) : '' ) . '" class="widefat option-tree-ui-upload-input ' . esc_attr( $field_class ) . '" />';

            /* add media button */
            echo '<a href="javascript:void(0);" class="ot_upload_media option-tree-ui-button button button-primary light" rel="' . $post_id . '" title="' . esc_html__( 'Add Media', 'uncode' ) . '"><span class="icon fa fa-plus2"></span>' . esc_html__( 'Add Media', 'uncode' ) . '</a>';

          echo '</div>';

          /* media */
          if ( isset( $field_value['background-image'] ) && $field_value['background-image'] !== '' ) {

            echo '<div class="option-tree-ui-media-wrap" id="' . esc_attr( $field_id ) . '_media">';
            $post = get_post($field_value['background-image']);
            if (isset($post)) {
              if ($post->post_mime_type === 'oembed/svg') echo '<div class="option-tree-ui-image-wrap">' . $post->post_content . '</div>';
              else if ( preg_match( '/\.(?:jpe?g|png|gif|ico)$/i', $post->guid ) ||  $post->post_mime_type == 'image/url') echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $post->guid ) . '" alt="" /></div>';
              else echo '<div class="option-tree-ui-image-wrap"><div class="oembed"><span class="spinner" style="display: block; float: left;"></span></div><div class="oembed_code" style="display: none;">' . esc_url( $post->guid ) . '</div></div>';
            }

              echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button button button-secondary light" title="' . esc_html__( 'Remove Media', 'uncode' ) . '"><span class="icon fa fa-minus2"></span>' . esc_html__( 'Remove Media', 'uncode' ) . '</a>';

            echo '</div>';

          }

        }

	echo '</div>';

	echo '</div>';
}

/**
 * Upload option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_upload' ) ) {

  function ot_type_upload( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* If an attachment ID is stored here fetch its URL and replace the value */
    if ( $field_value && wp_attachment_is_image( $field_value ) ) {

      $attachment_data = wp_get_attachment_image_src( $field_value, 'original' );

      /* check for attachment data */
      if ( $attachment_data ) {

        $field_src = $attachment_data[0];

      }

    }

    /* format setting outer wrapper */
    echo '<div class="format-setting type-upload ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . ( isset( $field_src ) ? ' ot-upload-attachment-id-wrap' : '' ) . '">';

      /* description */
      if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';

        /* build upload */
        echo '<div class="option-tree-ui-upload-parent">';

          /* input */
          echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-upload-input ' . esc_attr( $field_class ) . '" readonly />';

          /* add media button */
          echo '<a href="javascript:void(0);" class="ot_upload_media option-tree-ui-button button button-primary light" rel="' . $post_id . '" title="' . esc_html__( 'Add Media', 'uncode' ) . '"><span class="icon fa fa-plus2"></span>' . esc_html__( 'Add Media', 'uncode' ) . '</a>';

        echo '</div>';

        /* media */
        if ( $field_value ) {

          echo '<div class="option-tree-ui-media-wrap" id="' . esc_attr( $field_id ) . '_media">';

            /* replace image src */
            if ( isset( $field_src ) )
              $field_value = $field_src;

            $post = get_post($field_value);
            if (isset($post->post_mime_type) && $post->post_mime_type === 'oembed/svg') echo '<div class="option-tree-ui-image-wrap">' . $post->post_content . '</div>';
            else if ( preg_match( '/\.(?:jpe?g|png|gif|ico)$/i', $field_value ) )
              echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $field_value ) . '" alt="" /></div>';
            else echo '<div class="option-tree-ui-image-wrap"><div class="option-tree-ui-image-wrap"><div class="oembed" onload="alert(\'load\');"><span class="spinner" style="display: block; float: left;"></span></div><div class="oembed_code" style="display: none;">' . esc_url( $field_value ) . '</div></div></div>';

            echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button button button-secondary light" title="' . esc_html__( 'Remove Media', 'uncode' ) . '"><span class="icon fa fa-minus2"></span>' . esc_html__( 'Remove Media', 'uncode' ) . '</a>';

          echo '</div>';

        }

      echo '</div>';

    echo '</div>';

  }

}

/**
 * Helper function to display list items.
 *
 * This function is used in AJAX to add a new list items
 * and when they have already been added and saved.
 *
 * @param     string    $name The form field name.
 * @param     int       $key The array key for the current element.
 * @param     array     An array of values for the current list item.
 *
 * @return   void
 *
 * @access   public
 * @since    2.0
 */
if ( ! function_exists( 'ot_list_item_view' ) ) {

  function ot_list_item_view( $name, $key, $list_item = array(), $post_id = 0, $get_option = '', $settings = array(), $type = '' ) {

    	/* required title setting */
    $required_setting = array(
		array(
			'id'        => 'title',
			'label'     => esc_html__( 'Title', 'uncode' ),
			'desc'      => '',
			'std'       => '',
			'type'      => 'text',
			'rows'      => '',
			'class'     => 'option-tree-setting-title',
			'post_type' => '',
			'choices'   => array()
		)
	);


    /* load the old filterable slider settings */
    if ( 'slider' == $type ) {

      $settings = ot_slider_settings( $name );

    }

    /* if no settings array load the filterable list item settings */
    if ( empty( $settings ) ) {

      $settings = ot_list_item_settings( $name );

    }

    /* merge the two settings array */
    $settings = array_merge( $required_setting, $settings );

    echo '
    <div class="option-tree-setting">
      <div class="open">' . ( isset( $list_item['title'] ) ? esc_attr( $list_item['title'] ) : '' ) . '</div>
      <div class="button-section">
        <a href="javascript:void(0);" class="option-tree-setting-edit option-tree-ui-button button left-item" title="' . esc_html__( 'Edit', 'uncode' ) . '">
          <span class="icon ot-icon-pencil"></span>' . esc_html__( 'Edit', 'uncode' ) . '
        </a>
        <a href="javascript:void(0);" class="option-tree-setting-remove option-tree-ui-button button button-secondary light right-item" title="' . esc_html__( 'Delete', 'uncode' ) . '">
          <span class="icon ot-icon-trash-o"></span>' . esc_html__( 'Delete', 'uncode' ) . '
        </a>
      </div>
      <div class="option-tree-setting-body">';

      foreach( $settings as $field ) {

        // Set field value
        $field_value = isset( $list_item[$field['id']] ) ? $list_item[$field['id']] : '';

        /* set default to standard value */
        if ( isset( $field['std'] ) ) {
          $field_value = ot_filter_std_value( $field_value, ((isset($field['class']) && $field['class'] === 'unique_id') ? $field['std'] . big_rand() : $field['std']) );
        }

        // filter the title label and description
        if ( $field['id'] == 'title' ) {

          // filter the label
          $field['label'] = apply_filters( 'ot_list_item_title_label', $field['label'], $name );

          // filter the description
          $field['desc'] = apply_filters( 'ot_list_item_title_desc', $field['desc'], $name );

        }

        /* make life easier */
        $_field_name = $get_option ? $get_option . '[' . $name . ']' : $name;

        /* build the arguments array */
        $_args = array(
          'type'              => $field['type'],
          'field_id'          => $name . '_' . $field['id'] . '_' . $key,
          'field_name'        => $_field_name . '[' . $key . '][' . $field['id'] . ']',
          'field_value'       => $field_value,
          'field_desc'        => isset( $field['desc'] ) ? $field['desc'] : '',
          'field_std'         => isset( $field['std'] ) ? $field['std'] : '',
          'field_rows'        => isset( $field['rows'] ) ? $field['rows'] : 10,
          'field_post_type'   => isset( $field['post_type'] ) && ! empty( $field['post_type'] ) ? $field['post_type'] : 'post',
          'field_taxonomy'    => isset( $field['taxonomy'] ) && ! empty( $field['taxonomy'] ) ? $field['taxonomy'] : 'category',
          'field_min_max_step'=> isset( $field['min_max_step'] ) && ! empty( $field['min_max_step'] ) ? $field['min_max_step'] : '0,100,1',
          'field_class'       => isset( $field['class'] ) ? $field['class'] : '',
          'field_condition'   => isset( $field['condition'] ) ? $field['condition'] : '',
          'field_operator'    => isset( $field['operator'] ) ? $field['operator'] : 'and',
          'field_choices'     => isset( $field['choices'] ) && ! empty( $field['choices'] ) ? $field['choices'] : array(),
          'field_settings'    => isset( $field['settings'] ) && ! empty( $field['settings'] ) ? $field['settings'] : array(),
          'post_id'           => $post_id,
          'get_option'        => $get_option
        );

        $conditions = '';

        /* setup the conditions */
        if ( isset( $field['condition'] ) && ! empty( $field['condition'] ) ) {

          /* doing magic on the conditions so they work in a list item */
          $conditionals = explode( ',', $field['condition'] );
          foreach( $conditionals as $condition ) {
            $parts = explode( ':', $condition );
            if ( isset( $parts[0] ) ) {
              $field['condition'] = str_replace( $condition, $name . '_' . $parts[0] . '_' . $key . ':' . $parts[1], $field['condition'] );
            }
          }

          $conditions = ' data-condition="' . $field['condition'] . '"';
          $conditions.= isset( $field['operator'] ) && in_array( $field['operator'], array( 'and', 'AND', 'or', 'OR' ) ) ? ' data-operator="' . $field['operator'] . '"' : '';

        }

        // Build the setting CSS class
        if ( ! empty( $_args['field_class'] ) ) {

          $classes = explode( ' ', $_args['field_class'] );

          foreach( $classes as $_key => $value ) {

            $classes[$_key] = $value . '-wrap';

          }

          $class = 'format-settings ' . implode( ' ', $classes );

        } else {

          $class = 'format-settings';

        }

        /* option label */
        echo '<div id="setting_' . $_args['field_id'] . '" class="' . $class . '"' . $conditions . '>';

          /* don't show title with textblocks */
          if ( $_args['type'] != 'textblock' && ! empty( $field['label'] ) ) {
            echo '<div class="format-setting-label">';
              echo '<h3 class="label">' . esc_attr( $field['label'] ) . '</h3>';
            echo '</div>';
          }

          /* only allow simple textarea inside a list-item due to known DOM issues with wp_editor() */
          if ( apply_filters( 'ot_override_forced_textarea_simple', false, $field['id'] ) == false && $_args['type'] == 'textarea' )
            $_args['type'] = 'textarea-simple';

          /* option body, list-item is not allowed inside another list-item */
          if ( $_args['type'] !== 'list-item' && $_args['type'] !== 'slider' ) {
            echo ot_display_by_type( $_args );
          }

        echo '</div>';

      }

      echo '</div>';

    echo '</div>';

  }

}

/**
 * Uncode color select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if (!function_exists('ot_type_uncode_color'))
{

	function ot_type_uncode_color($args = array())
	{

		/* turns arguments array into variables */
		extract($args);

		/* verify a description */
		$has_desc = $field_desc ? true : false;

		/* format setting outer wrapper */
		echo '<div class="format-setting type-select ' . ($has_desc ? 'has-desc' : 'no-desc') . '" style="overflow: visible;">';

		/* description */
		if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>';

		/* filter choices array */
		$field_choices = apply_filters('ot_recognized_uncode_color', $field_choices, $field_id);

		$colors_array = ot_recognized_uncode_color($field_id);
		array_unshift($colors_array, array(
			'value' => '',
			'label' => 'Select…'
		));

		/* format setting inner wrapper */
		echo '<div class="format-setting-inner">';

		/* build select */
		echo '<select name="' . esc_attr($field_name) . '" id="' . esc_attr($field_id) . '" class="option-tree-ui-select uncode-color-select ' . esc_attr($field_class) . '">';
		foreach ($colors_array as $key => $value)
		{
			if (isset($value['disabled'])) echo '<option value="" disabled>' . esc_attr($value['label']) . '</option>';
			else
			{
				echo '<option class="' . esc_attr($value['value']) . '" value="' . esc_attr($value['value']) . '" ' . selected($field_value, $value['value'], false) . '>' . esc_attr($value['label']) . '</option>';
			}
		}

		echo '</select>';

		echo '</div>';

		echo '</div>';
	}
}

/**
 * Uncode color with transparense select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if (!function_exists('ot_type_uncode_colors_w_transp'))
{

	function ot_type_uncode_colors_w_transp($args = array())
	{

		/* turns arguments array into variables */
		extract($args);

		/* verify a description */
		$has_desc = $field_desc ? true : false;

		/* format setting outer wrapper */
		echo '<div class="format-setting type-select ' . ($has_desc ? 'has-desc' : 'no-desc') . '" style="overflow: visible;">';

		/* description */
		if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>';

		/* filter choices array */
		$field_choices = apply_filters('ot_recognized_uncode_colors_w_transp', $field_choices, $field_id);

		$colors_array = ot_recognized_uncode_colors_w_transp($field_id);
		array_unshift($colors_array, array(
			'value' => '',
			'label' => 'Select…'
		));

		/* format setting inner wrapper */
		echo '<div class="format-setting-inner">';

		/* build select */
		echo '<select name="' . esc_attr($field_name) . '" id="' . esc_attr($field_id) . '" class="option-tree-ui-select uncode-color-select ' . esc_attr($field_class) . '">';
		foreach ($colors_array as $key => $value)
		{
			if (isset($value['disabled'])) echo '<option value="" disabled>' . esc_attr($value['label']) . '</option>';
			else
			{
				echo '<option class="' . esc_attr($value['value']) . '" value="' . esc_attr($value['value']) . '" ' . selected($field_value, $value['value'], false) . '>' . esc_attr($value['label']) . '</option>';
			}
		}

		echo '</select>';

		echo '</div>';

		echo '</div>';
	}
}

function big_rand( $len = 6 ) {
    $rand   = '';
    while( !( isset( $rand[$len-1] ) ) ) {
        $rand   .= mt_rand( );
    }
    return substr( $rand , 0 , $len );
}

function uncode_is_not_null($val){
	return !empty($val);
}

function uncode_css_upload_error_notice() {
    ?>
    <div class="error">
        <p><?php esc_html_e( 'Failed to save the dynamics css files!', 'uncode' ); ?></p>
    </div>
    <?php
}

if (!function_exists('uncode_create_dynamic_css')) {
	function uncode_create_dynamic_css() {

		$css_dir = get_template_directory() . '/library/css/';
		ob_start(); // Capture all output (output buffering)

		require(get_template_directory() . '/core/inc/style-custom.css.php'); // Generate CSS

		$css = ob_get_clean(); // Get generated CSS (output buffering)

		if ($css === 'exit') return;

		global $wp_filesystem;
		if (empty($wp_filesystem)) {
			require_once (ABSPATH . '/wp-admin/includes/file.php');
		}
		if (false === ($creds = request_filesystem_credentials($css_dir, '', false, false))) {
			return array(
				'custom' => $css,
				'admin' => $admin_css,
			);
		}
		/* initialize the API */
		if ( ! WP_Filesystem($creds) ) {
			/* any problems and we exit */
			return array(
				'custom' => $css,
				'admin' => $admin_css,
			);
		}
		$ot_id = is_multisite() ? get_current_blog_id() : '';
		/* do our file manipulations below */
		$mod_file = (defined('FS_CHMOD_FILE')) ? FS_CHMOD_FILE : false;
		if (!$wp_filesystem->put_contents( $css_dir . 'style-custom'.$ot_id.'.css', $css, $mod_file ) || !$wp_filesystem->put_contents( get_template_directory() . '/core/assets/css/admin-custom'.$ot_id.'.css', $admin_css, $mod_file ))
			return array(
				'custom' => $css,
				'admin' => $admin_css,
			);
	}
}

add_filter('ot_after_theme_options_save', 'uncode_create_dynamic_css');

function uncode_init_color() {
	if (is_admin() && isset($_GET['first'] )) {
		global $front_background_colors;
		$front_background_colors = array(
			'transparent' => 'transparent',
	    'color-jevc' => '#000000',
	    'color-nhtu' => '#101213',
	    'color-wayh' => '#141618',
	    'color-rgdb' => '#1b1d1f',
	    'color-prif' => '#303133',
	    'color-xsdn' => '#ffffff',
	    'color-lxmt' => '#f7f7f7',
	    'color-gyho' => '#eaeaea',
	    'color-uydo' => '#dddddd',
	    'color-wvjs' => '#777',
	    'color-vyce' => '#0cb4ce',
	    'color-dfgh' => '#FF590A',
	    'color-iopl' => '#0CCE50',
	    'color-zsdf' => '#FFC42E',
	    'accent' => '#0cb4ce',
		);
		uncode_create_dynamic_css();
	}
}

add_action('admin_init', 'uncode_init_color');


