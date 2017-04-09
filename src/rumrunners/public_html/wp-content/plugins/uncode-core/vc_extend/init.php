<?php

function uncode_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag)
{
	if ($tag == 'vc_row' || $tag == 'vc_row_inner')
	{
		$class_string = str_replace('vc_row-fluid', 'row', $class_string);
	}
	if ($tag == 'vc_column' || $tag == 'vc_column_inner')
	{
		$class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'col-lg-$1', $class_string);
	}
	return $class_string;
}

// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'uncode_custom_css_classes_for_vc_row_and_vc_column', 10, 2);

function uncode_init_front_custom_vc() {

	vc_disable_frontend();
	/**
	 * 	Deregister vc scripts
	 */
	function uncode_dequeue_visual_composer() {
		wp_dequeue_style('js_composer_front');
		wp_deregister_style('js_composer_front');
		wp_deregister_script( 'wpb_composer_front_js' );
		wp_deregister_script('vc_pie');
		wp_deregister_script('waypoints');
	}
	add_action('wp_enqueue_scripts','uncode_dequeue_visual_composer');
	remove_action('wp_head', array(visual_composer(), 'addMetaData'));
	require_once 'config/uncode_map.php';
}

add_action('init', 'uncode_init_front_custom_vc', 1000);

function uncode_init_back_custom_vc()
{

	require_once 'config/override_map.php';
	require_once 'config/uncode_map.php';
	require_once 'remove_components.php';
	require_once 'add_components.php';

}

add_action('admin_init', 'uncode_init_back_custom_vc');

function uncode_init_custom_js()
{
	wp_enqueue_style('vc-admin', plugins_url( 'assets/css/vc_admin.css', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-admin-fix-inputs', plugins_url( 'assets/js/fix_inputs.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-admin-index-items', plugins_url( 'assets/js/index_items.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-admin-media-elements', plugins_url( 'assets/js/media_element.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-admin-extend', plugins_url( 'assets/js/js_composer_extend.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	global $wp_styles;
	if (isset($wp_styles->registered['font-awesome'])) wp_dequeue_style('font-awesome');
}

add_action('vc_backend_editor_render', 'uncode_init_custom_js');

function uncode_hide_posts_not_published($query)
{

	$query->set('post_status', array(
		'publish',
		'private'
	));

	if (isset($query->query['post__not_in'])) {
		$get_array_not_in = $query->query['post__not_in'];
		$get_array_not_in[] = $_POST['postid'];
		$query->set('post__not_in', $get_array_not_in);
	}

	return $query;
}

function uncode_all_posts($query)
{

	$query->set( 'posts_per_page', -1 );

	return;
}

function uncode_index_get_query()
{
	$post_types = array();
	if (function_exists('uncode_get_post_types')) $post_types = uncode_get_post_types(true);
	$loop = vc_post_param('content');
	$allItems = vc_post_param('allItems');
	$template_single = vc_post_param('templateSingle');
	$templatePostArray = array();
	foreach ($post_types as $key => $value) {
    $templatePostArray[$value] = vc_post_param('template' . ucfirst($value));
  }
	$exclude_current = vc_post_param('postid');
	if (empty($loop)) return;
	require_once vc_path_dir('PARAMS_DIR', 'loop/loop.php');
	add_filter('pre_get_posts', 'uncode_hide_posts_not_published');
	if ($allItems === 'true') add_filter('pre_get_posts', 'uncode_all_posts');

	global $uncode_index_map;
	$u_index = new uncode_index($uncode_index_map);
	list($args, $my_query) = $u_index->vc_build_loop_query($loop, get_the_ID());

	if(vc_post_param('custom_order') === 'true') {
		if (vc_post_param('order_ids') !== '') {
			$ordered = array();
			$post_list = explode(',', vc_post_param('order_ids'));
			foreach($post_list as $key) {
			    foreach($my_query->posts as $skey => $spost) {
			        if($key == $spost->ID) {
			            $ordered[] = $spost;
			            unset($my_query->posts[$skey]);
			        }
			    }
			}
			$my_query->posts = array_merge($my_query->posts, $ordered);
		}
	}

	$html = '';
	while ($my_query->have_posts())
	{
		$my_query->the_post();

		// Get post from query
		$post = new stdClass();

		// Creating post object.
		$post->id = get_the_ID();
		$post->link = get_permalink($post->id);
		$post->type = get_post_type($post->id);
		$template_cat = $templatePostArray[$post->type];
		$html.= '<li class="list-list-item" data-id="' . $post->id . '">
						<div class="option-tree-setting">
							<div class="open"><span class="post-title">' . get_the_title() . '</span> <span class="grey">' . $post->type . '</span><span class="grey size">width: <span class="single_width_factor"></span>, height: <span class="single_height_factor"></span></span></div>
							<div class="button-section">
								<a href="javascript:void(0);" class="option-tree-setting-edit option-tree-ui-button button left-item" title="Edit">
									<span class="icon fa fa-pencil3"></span>Edit
								</a>
								<a href="javascript:void(0);" class="option-tree-setting-reset option-tree-ui-button button left-item hidden" title="Reset">
									<span class="icon fa fa-reload"></span>
								</a>
							</div>
							<div class="option-tree-setting-body">' . $template_single . $template_cat . '</div>
						</div>
					</li>';
	}

	$html = str_replace('\"', '"', $html);
	echo do_shortcode( shortcode_unautop( $html ) );

	die();
}

//For logged in users
add_action('wp_ajax_uncode_get_query','uncode_index_get_query');

function uncode_get_medias() {
	$loop = vc_post_param('content');
	$template_single = vc_post_param('templateSingle');
	$template_media = vc_post_param('templateMedia');

	$html = '';

	foreach ($loop as $key => $value) {
		$post = get_post($value);

		if (isset($post) && !empty($post)) {
			$html.= 	'<li class="list-list-item" data-id="' . $post->ID . '">
							<div class="option-tree-setting">
								<div class="open"><span class="post-title">' . (isset($post->post_title) ? $post->post_title : $post->post_name) . '</span> <span class="grey">' . $post->post_mime_type . '</span><span class="grey size">width: <span class="single_width_factor"></span>, height: <span class="single_height_factor"></span></span></div>
								<div class="button-section">
									<a href="javascript:void(0);" class="option-tree-setting-edit option-tree-ui-button button left-item" title="Edit">
										<span class="icon fa fa-pencil3"></span>Edit
									</a>
									<a href="javascript:void(0);" class="option-tree-setting-reset option-tree-ui-button button left-item hidden" title="Reset">
										<span class="icon fa fa-reload"></span>
									</a>
								</div>
								<div class="option-tree-setting-body">' . $template_single . $template_media . '</div>
							</div>
						</li>';
		}
	}

	$html = str_replace('\"', '"', $html);
	echo do_shortcode( shortcode_unautop( $html ) );

	die();
}

add_action('wp_ajax_uncode_get_medias', 'uncode_get_medias');

/**
 * Suggestion list for wp_query field
 *
 */
class UncodeLoopSuggestions {
	protected $content = array();
	protected $exclude = array();
	protected $field;

	function __construct( $field, $query, $exclude ) {
		$this->exclude = explode( ',', $exclude );
		$method_name = 'get_' . preg_replace( '/_out$/', '', $field );
		if ( method_exists( $this, $method_name ) ) {
			$this->$method_name( $query );
		}
	}

	public function get_authors( $query ) {
		$args = ! empty( $query ) ? array( 'search' => '*' . $query . '*', 'search_columns' => array( 'user_nicename' ) ) : array();
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$users = get_users( $args );
		foreach ( $users as $user ) {
			$this->content[] = array( 'value' => (string)$user->ID, 'name' => (string)$user->data->user_nicename );
		}
	}

	public function get_categories( $query ) {
		$args = ! empty( $query ) ? array( 'search' => $query ) : array();
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$categories = get_categories( $args );

		foreach ( $categories as $cat ) {
			$this->content[] = array( 'value' => (string)$cat->cat_ID, 'name' => $cat->cat_name );
		}
	}

	public function get_tags( $query ) {
		$args = ! empty( $query ) ? array( 'search' => $query ) : array();
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$tags = get_tags( $args );
		foreach ( $tags as $tag ) {
			$this->content[] = array( 'value' => (string)$tag->term_id, 'name' => $tag->name );
		}
	}

	public function get_tax_query( $query ) {
		$args = ! empty( $query ) ? array( 'search' => $query ) : array();
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$tags = get_terms( VcLoopSettings::getTaxonomies(), $args );
		foreach ( $tags as $tag ) {
			$this->content[] = array( 'value' => $tag->term_id, 'name' => $tag->name );
		}
	}

	public function get_by_id( $query ) {
		$args = ! empty( $query ) ? array( 's' => $query, 'post_type' => 'any', 'posts_per_page' => -1 ) : array( 'post_type' => 'any', 'posts_per_page' => -1 );
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$this->content[] = array( 'value' => $post->ID, 'name' => $post->post_title );
		}
	}

	public function render() {
		echo json_encode( $this->content );
	}
}

function uncode_get_loop_suggestion() {
	$loop_suggestions = new UncodeLoopSuggestions(vc_post_param('field'), vc_post_param('query'), vc_post_param('exclude'));
	$loop_suggestions->render();
	die();
}

add_action( 'wp_ajax_wpb_get_loop_suggestion', 'uncode_get_loop_suggestion' );

function uncode_get_html()
{
	$content = vc_post_param('content');
	$content = stripslashes($content);
	$pattern = get_shortcode_regex();

	if ($content != '') echo Html::trim($content, 120);

	die();
}

add_action('wp_ajax_uncode_get_html', 'uncode_get_html');

function uncode_get_admin_media_post()
{
	$id = vc_post_param('content');
	$back_post = get_post($id);
	$post_mime = $back_post->post_mime_type;

	$back_url = $back_icon = '';
	if (strpos($post_mime, 'image/') !== false)
	{
		$background_url = wp_get_attachment_thumb_url( $id );
		$back_url = ($background_url != '') ? 'background-image: url(' . $background_url . ');' : '';
	} else if (strpos($post_mime, 'video/') !== false)
	{
		$back_icon = '<i class="fa fa-media-play" />';
	} else
	{
		switch ($post_mime)
		{
		case 'oembed/flickr':
		case 'oembed/instagram':
		case 'oembed/Imgur':
		case 'oembed/photobucket':
			$back_oembed = wp_oembed_get($back_post->guid);
			preg_match_all('/src="([^"]*)"/i', $back_oembed, $img_src);
			$back_url = (isset($img_src[1][0])) ? 'background-image: url(' . str_replace('"', '', $img_src[1][0]) . ');' : '';
			break;

		case 'oembed/vimeo':
		case 'oembed/youtube':
			$back_icon = '<i class="fa fa-social-' . str_replace('oembed/', '', $post_mime) . '" />';
			break;
		}
	}

	echo json_encode(array(
		'back_url' => $back_url,
		'back_icon' => $back_icon,
		'back_mime' => $post_mime
	));
	die();
}

add_action('wp_ajax_uncode_get_media_post', 'uncode_get_admin_media_post');

class Html
{

	protected $reachedLimit = false, $totalLen = 0, $maxLen = 25, $toRemove = array();

	public static function trim($html, $maxLen = 25)
	{
		$html = strip_tags($html, '<img/>');
		require_once get_template_directory() . '/core/inc/HTML5/Parser.php';
		$dom = HTML5_Parser::parse($html);

		$html = new static ();
		$toRemove = $html->walk($dom, $maxLen);

		// remove any nodes that passed our limit
		foreach ($toRemove as $child) $child
			->parentNode
			->removeChild($child);

		// remove wrapper tags added by DD (doctype, html...)
		if (version_compare(PHP_VERSION, '5.3.6') < 0)
		{
			if ($dom->firstChild->firstChild->firstChild !== null && $dom->firstChild !== null) {
				$dom->removeChild($dom->firstChild);
				$dom->replaceChild($dom->firstChild->firstChild->firstChild, $dom->firstChild);
			}
			return $dom->saveHTML();
		}

		return $dom
			->saveHTML($dom
			->getElementsByTagName('body')
			->item(0));
	}

	protected function walk(DomNode $node, $maxLen)
	{

		if ($this
			->reachedLimit)
		{
			$this->toRemove[] = $node;
		} else
		{

			// only text nodes should have text,
			// so do the splitting here
			if ($node instanceof DomText)
			{
				$this
					->totalLen+= $nodeLen = strlen($node->nodeValue);

				// use mb_strlen / mb_substr for UTF-8 support
				if ($this
					->totalLen > $maxLen)
				{
					$node
						->nodeValue = substr($node
						->nodeValue, 0, $nodeLen - ($this->totalLen - $maxLen)) . '...';
					$this->reachedLimit = true;
				}
			}

			// if node has children, walk its child elements
			if (isset($node
				->childNodes)) foreach ($node
				->childNodes as $child) $this->walk($child, $maxLen);
		}

		return $this->toRemove;
	}
}

class uncode_generic_admin extends WPBakeryShortCode
{
	public function singleParamHtmlHolder($param, $value)
	{
		$output = '';
		$param_name = isset($param['param_name']) ? $param['param_name'] : '';
		$type = isset($param['type']) ? $param['type'] : '';
		$class = isset($param['class']) ? $param['class'] : '';
		if (!empty($param['admin_label']) && $param['admin_label'] === true)
		{
			$output.= '<span class="vc_admin_label admin_label_' . $param['param_name'] . (empty($value) ? ' hidden-label' : '') . '"><label>' . $param['heading'] . '</label>: ' . $value . '</span>';
		}
		if (!empty($param['holder']))
		{
			$output.= '<' . $param['holder'] . ' class="vc_admin_label wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
		}
		return $output;
	}
}

class uncode_row extends WPBakeryShortCode
{
	protected $predefined_atts = array(
		'el_class' => '',
	);

	protected function content($atts, $content = null)
	{
		$prefix = '';
		return $prefix . $this->loadTemplate($atts, $content);
	}

	/* This returs block controls
	 ---------------------------------------------------------- */
	public function getColumnControls($controls, $extended_css = ''/*, $atts*/)
	{
		global $vc_row_layouts;
		$controls_start = '<div class="vc_controls vc_controls-row controls controls_row vc_clearfix">';
		$controls_end = '</div>';

		//Create columns
		$controls_layout = '<span class="vc_row_layouts vc_control">';
		foreach ($vc_row_layouts as $layout)
		{
			$controls_layout.= '<a class="vc_control-set-column set_columns ' . $layout['icon_class'] . '" data-cells="' . $layout['cells'] . '" data-cells-mask="' . $layout['mask'] . '" title="' . $layout['title'] . '"></a> ';
		}
		$controls_layout.= '<a class="vc_control-set-column set_columns custom_columns" data-cells="custom" data-cells-mask="custom" title="' . esc_html__('Custom layout', 'js_composer') . '"><i class="fa fa-magic" /><span>' . esc_html__('Custom', 'js_composer') . '</span></a> ';
		$controls_layout.= '</span>';

		$controls_move = ' <a class="vc_control column_move" href="#" title="' . esc_html__('Drag row to reorder', 'js_composer') . '"><i class="vc_icon"></i></a>';
		$controls_back = '';
		$controls_delete = '<a class="vc_control column_delete vc_column-delete" href="#" title="' . esc_html__('Delete this row', 'js_composer') . '" data-vc-control="delete"><i class="vc_icon"></i></a>';
		$controls_edit = ' <a class="vc_control column_edit vc_column-edit" href="#" title="' . esc_html__('Edit this row', 'js_composer') . '" data-vc-control="edit"><i class="vc_icon"></i></a>';
		$controls_clone = ' <a class="vc_control column_clone vc_column-clone" href="#" title="' . esc_html__('Clone this row', 'js_composer') . '" data-vc-control="clone"><i class="vc_icon"></i></a>';
		$controls_toggle = ' <a class="vc_control column_toggle vc_column-toggle" href="#" title="' . esc_html__('Toggle row', 'js_composer') . '" data-vc-control="toggle"><i class="vc_icon"></i></a>';
		$controls_center_end = '</span>';

		$row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
		$row_edit_clone_delete.= $controls_delete . $controls_clone /*. $controls_add*/ . $controls_toggle;
		$column_controls_full = $controls_start . $controls_move . $controls_layout . $controls_edit . $controls_back . $row_edit_clone_delete . $controls_end;

		return $column_controls_full;
	}

	public function contentAdmin($atts, $content = null)
	{
		$width = $el_class = '';
		extract(shortcode_atts($this->predefined_atts, $atts));

		$output = '';

		$column_controls = $this->getColumnControls($this->settings('controls') , null, $atts);

		for ($i = 0;$i < count($width);$i++)
		{
			$output.= '<div' . $this->customAdminBockParams() . ' data-element_type="' . $this->settings["base"] . '" class="wpb_' . $this->settings['base'] . ' wpb_sortable">';
			$output.= str_replace("%column_size%", 1, $column_controls);
			$output.= '<div class="wpb_element_wrapper">';
			$output.= '<div class="vc_row vc_row-fluid wpb_row_container vc_container_for_children">';
			if ($content == '' && !empty($this->settings["default_content_in_template"]))
			{
				$output.= do_shortcode(shortcode_unautop($this->settings["default_content_in_template"]));
			} else
			{
				$output.= do_shortcode(shortcode_unautop($content));
			}
			$output.= '</div>';
			if (isset($this->settings['params']))
			{
				$inner = '';
				foreach ($this->settings['params'] as $param)
				{
					$param_value = isset(${$param['param_name']}) ? ${$param['param_name']} : '';
					if (is_array($param_value))
					{

						// Get first element from the array
						reset($param_value);
						$first_key = key($param_value);
						$param_value = $param_value[$first_key];
					}
					$inner.= $this->singleParamHtmlHolder($param, $param_value);
				}
				$output.= $inner;
			}
			$output.= '</div>';
			$output.= '</div>';
		}

		return $output;
	}

	public function customAdminBockParams()
	{
		return '';
	}

	public function buildStyle($bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '')
	{
		$has_image = false;
		$style = '';
		if ((int)$bg_image > 0 && ($image_url = wp_get_attachment_url($bg_image, 'large')) !== false)
		{
			$has_image = true;
			$style.= "background-image: url(" . $image_url . ");";
		}
		if (!empty($bg_color))
		{
			$style.= vc_get_css_color('background-color', $bg_color);
		}
		if (!empty($bg_image_repeat) && $has_image)
		{
			if ($bg_image_repeat === 'cover')
			{
				$style.= "background-repeat:no-repeat;background-size: cover;";
			} elseif ($bg_image_repeat === 'contain')
			{
				$style.= "background-repeat:no-repeat;background-size: contain;";
			} elseif ($bg_image_repeat === 'no-repeat')
			{
				$style.= 'background-repeat: no-repeat;';
			}
		}
		if (!empty($font_color))
		{
			$style.= vc_get_css_color('color', $font_color);
		}
		if ($padding != '')
		{
			$style.= 'padding: ' . (preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding . 'px') . ';';
		}
		if ($margin_bottom != '')
		{
			$style.= 'margin-bottom: ' . (preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom . 'px') . ';';
		}
		return empty($style) ? $style : ' style="' . $style . '"';
	}
}

class uncode_slider extends WPBakeryShortCode {
	protected $controls_css_settings = 'out-tc vc_controls-content-widget';
	public function __construct( $settings ) {
		parent::__construct( $settings );
	}


	public function contentAdmin( $atts, $content = null ) {
		$width = $custom_markup = '';
		$shortcode_attributes = array( 'width' => '1/1' );
		foreach ( $this->settings['params'] as $param ) {
			if ( $param['param_name'] != 'content' ) {
				if ( isset( $param['value'] ) && is_string( $param['value'] ) ) {
					$shortcode_attributes[$param['param_name']] = $param['value'];
				} elseif ( isset( $param['value'] ) ) {
					$shortcode_attributes[$param['param_name']] = $param['value'];
				}
			} else if ( $param['param_name'] == 'content' && $content == NULL ) {
				$content = $param['value'];
			}
		}
		extract( shortcode_atts(
			$shortcode_attributes
			, $atts ) );

		$output = '';

		$elem = $this->getElementHolder( $width );

		$inner = '';
		foreach ( $this->settings['params'] as $param ) {
			$param_value = '';
			$param_value = isset( ${$param['param_name']} ) ? ${$param['param_name']} : '';
			if ( is_array( $param_value ) ) {
				// Get first element from the array
				reset( $param_value );
				$first_key = key( $param_value );
				$param_value = $param_value[$first_key];
			}
			$inner .= $this->singleParamHtmlHolder( $param, $param_value );
		}

		$tmp = '';

		if ( isset( $this->settings["custom_markup"] ) && $this->settings["custom_markup"] != '' ) {
			if ( $content != '' ) {
				$custom_markup = str_ireplace( "%content%", $tmp . $content, $this->settings["custom_markup"] );
			} else if ( $content == '' && isset( $this->settings["default_content_in_template"] ) && $this->settings["default_content_in_template"] != '' ) {
				$custom_markup = str_ireplace( "%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"] );
			} else {
				$custom_markup = str_ireplace( "%content%", '', $this->settings["custom_markup"] );
			}
			$inner .= do_shortcode( $custom_markup );
		}
		$elem = str_ireplace( '%wpb_element_content%', $inner, $elem );
		$output = $elem;

		return $output;
	}
}

class uncode_row_inner extends uncode_row
{
	protected function getFileName()
	{
		return 'vc_row';
	}

	public function template($content = '')
	{
		return $this->contentAdmin($this->atts);
	}
}

class uncode_slide extends uncode_row
{
	protected function getFileName()
	{
		return 'vc_row';
	}

	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}

class uncode_counter extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}

class uncode_countdown extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}

class uncode_list extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}

class uncode_pricing extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}

class uncode_share extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}

class uncode_twentytwenty extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}

class uncode_block extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}

class uncode_index extends WPBakeryShortCode
{
	protected $filter_categories = array();
	protected $query = false;
	protected $loop_args = array();
	protected $taxonomies = false;

	function __construct($settings)
	{
		parent::__construct($settings);
	}

	protected function getFileName()
	{
		return 'uncode_index';
	}

	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}

	public function getCategoriesLink( $post_id ) {
		$categories_link = array();
		$args = array('orderby' => 'term_group', 'order' => 'DESC', 'fields' => 'all');
		$post_categories = wp_get_object_terms( $post_id, $this->getTaxonomies(), $args);
		foreach ( $post_categories as $cat ) {
			if (is_taxonomy_hierarchical($cat->taxonomy) && substr( $cat->taxonomy, 0, 3 ) !== 'pa_') {
				$categories_link[] = array('link' => '<a href="'.get_term_link($cat->term_id, $cat->taxonomy).'">'.$cat->name.'</a>', 'tax' => $cat->taxonomy, 'cat_id' => $cat->term_id);
			} else if ($cat->taxonomy === 'post_tag') {
				$categories_link[] = array('link' => '<a href="'.get_term_link($cat->term_id, $cat->taxonomy).'">'.$cat->name.'</a>', 'tax' => $cat->taxonomy, 'cat_id' => $cat->term_id);
			}
		}
		return $categories_link;
	}

	public function getCategoriesCss($post_id) {
		$categories_css = '';
		$categories_name = array();
		$tag_name = array();
		$categories_id = array();
		$post_categories = wp_get_object_terms($post_id, $this->getTaxonomies());
		foreach ($post_categories as $cat) {
			if (is_taxonomy_hierarchical($cat->taxonomy) && substr( $cat->taxonomy, 0, 3 ) !== 'pa_') {
				if (!in_array($cat->term_id, $this->filter_categories)) {
					$this->filter_categories[] = $cat->term_id;
				}
				if ($cat->taxonomy !== 'post_tag') $categories_css.= ' grid-cat-' . $cat->term_id;
				$categories_name[] = $cat->name;
				$categories_id[] = $cat->term_id;
			} else if ($cat->taxonomy === 'post_tag') {
				$categories_id[] = $cat->term_id;
				$categories_name[] = $cat->name;
				$tag_name[] = $cat->name;
			}
		}
		return array('cat_css' => $categories_css, 'cat_name' => $categories_name, 'cat_id' => $categories_id, 'tag' => $tag_name );
	}
	protected function resetTaxonomies()
	{
		$this->taxonomies = false;
	}
	protected function getTaxonomies()
	{
		if ($this
			->taxonomies === false)
		{
			$this
				->taxonomies = get_object_taxonomies(!empty($this
				->loop_args['post_type']) ? $this->loop_args['post_type'] : get_post_types(array(
				'public' => false,
				'name' => 'attachment'
			) , 'names', 'NOT'));
		}

		return $this->taxonomies;
	}

	protected function getFilterCategories()
	{
		return get_terms($this
			->getTaxonomies() , array(
			'orderby' => 'name',
			'include' => implode(',', $this->filter_categories)
		));
	}

	protected function getPostContent()
	{
		remove_filter('the_content', 'wpautop');
		$content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
		return $content;
	}

	protected function getPostExcerpt()
	{
		remove_filter('the_excerpt', 'wpautop');
		$content = apply_filters('the_excerpt', get_the_excerpt());
		return $content;
	}

	public function buildWpQuery($query, $exclude_id = false, $offset = false)
	{
		$data = self::parseData($query);
		$query_builder = new UncodeLoopQueryBuilder( $data );
		if ($exclude_id){
			$query_builder->excludeId($exclude_id);
		}
		return $query_builder->build($offset);
	}
	public function vc_build_loop_query($query, $exclude_id = false, $offset = false)
	{
		return self::buildWpQuery($query, $exclude_id, $offset);
	}
	protected function parseData($value)
	{
		if (is_array($value)) return $value;
		$data = array();
		$values_pairs = preg_split('/\|/', $value);
		foreach ($values_pairs as $pair)
		{
			if (!empty($pair))
			{
				list($key, $value) = preg_split('/\:/', $pair);
				$data[$key] = $value;
			}
		}
		return $data;
	}
	protected function getLoop($loop,$offset = false)
	{
		$data = self::parseData($loop);
		foreach ($data as $key => $value)
		{
			$method = 'parse_' . $key;
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}

		$exclude_post = is_single() || is_page() ? get_the_ID() : '';
		list($this->loop_args, $this->query) = $this->vc_build_loop_query($loop, $exclude_post, $offset);
	}

}

require_once vc_path_dir('PARAMS_DIR', 'loop/loop.php');

class UncodeLoopQueryBuilder extends VcLoopQueryBuilder
{
	protected function parse_paged($value)
	{
		$this->args['paged'] = $value;
	}
	protected function parse_category($value)
	{
		global $wpdb;
		$term_query = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->term_taxonomy WHERE term_id = %d",$value ));
		$term_type = $term_query->taxonomy;
		$this->args['tax_query'] = array(
			'relation' => 'AND'
		);
		$this->args['tax_query'][] = array(
			'field' => 'term_id',
			'taxonomy' => $term_type,
			'terms' => $value,
			'operator' => 'IN'
		);
	}

	protected function parse_order_ids( $value ) {
	}

	protected function parse_search($value) {
		$this->args['s'] = $value;
	}

	protected function parse_year($value)
	{
		$this->args['year'] = $value;
	}

	protected function parse_month($value)
	{
		$this->args['monthnum'] = $value;
	}

	protected function parse_day($value)
	{
		$this->args['day'] = $value;
	}

	/**
	 * @return array
	 */
	public function build($offset = false) {
		if ($offset){
			$offset_args = $this->args;
			$offset_args['posts_per_page'] = $offset;
			$limit_posts = new WP_Query( $offset_args );
			$offset_array = array();
			foreach ($limit_posts->posts as $off_post) {
				$offset_array[] = $off_post->ID;
			}
			if (isset($this->args['post__not_in'])) {
				$this->args['post__not_in'] = array_merge($this->args['post__not_in'], $offset_array);
			} else $this->args['post__not_in'] = $offset_array;
		}
		return array( $this->args, new WP_Query( $this->args ) );
	}
}

add_filter( 'vc_iconpicker-type-uncode', 'uncode_vc_iconpicker_type_uncode' );

function uncode_vc_iconpicker_type_uncode( $icons ) {
	$uncode_icons = array();
	$uncode_icons[] = array( '' =>  '');

	global $wp_filesystem;
	if (empty($wp_filesystem)) {
	  require_once (ABSPATH . '/wp-admin/includes/file.php');
	  WP_Filesystem();
	}
	$file      = OT_DIR.'selection.json';
  $response = $wp_filesystem->get_contents($file);

	/* Will result in $api_response being an array of data,
	parsed from the JSON response of the API listed above */
	$icons_file = json_decode( $response, true );

	foreach ($icons_file['icons'] as $key => $value) {
		$names = explode(',', $value['properties']['name']);
		$uncode_icons[] = array( 'fa fa-' . $names[0] =>  ucwords(implode(', ', $value['icon']['tags'])));
	}

	return array_merge( $icons, $uncode_icons );
}

class Single_width_callback {
  private $key;

  function __construct($key) {
    $this->key = $key;
  }

  public function calculate_single_width($matches) {
  	preg_match("|\d+|", reset($matches), $m);
  	return 'vc_single_image col_width="'.(($this->key / 12) * $m[0]).'"';
  }
}

function uncode_replace_inner_single_width($content, $width_media) {
	$pattern = "/vc_single_image col_width=\"[0-9]*\"/";
	$callback = new Single_width_callback($width_media);
  $content = preg_replace_callback($pattern, array($callback, 'calculate_single_width'), $content);
  return $content;
}

?>