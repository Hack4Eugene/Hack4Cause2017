<?php

$theme = wp_get_theme();

define('UNCODE_VERSION', $theme->get( 'Version' ), true);
define('UNCODE_NAME', $theme->get( 'Name' ), true);

if ( ! function_exists( 'uncode_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uncode_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on uncode, use a find and replace
	 * to change 'uncode' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'uncode', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'uncode' ),
		'secondary' => esc_html__( 'Secondary Menu', 'uncode' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'uncode_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // uncode_setup
add_action( 'after_setup_theme', 'uncode_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uncode_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uncode_content_width', 840 );
}
add_action( 'after_setup_theme', 'uncode_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function uncode_widgets_init()
{
	$sidebars_array = ot_get_option('_uncode_sidebars');
	if (isset($sidebars_array) && $sidebars_array !== '') {
		$sidebars = is_array($sidebars_array) ? $sidebars_array : array($sidebars_array);
		foreach ($sidebars as $key => $value)
		{
			if (isset($value['_uncode_sidebar_unique_id']) && $value['_uncode_sidebar_unique_id'] !== '') {
				$sidebar_name = $value['_uncode_sidebar_unique_id'];
				register_sidebar(array(
					'name' => $value['title'],
					'id' => $sidebar_name,
					'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'uncode' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s widget-container sidebar-widgets">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
				));
			}
		}
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uncode' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'uncode' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s widget-container sidebar-widgets">',
		'after_widget'  => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action('widgets_init', 'uncode_widgets_init');

function uncode_unclean_url( $good_protocol_url, $original_url, $_context){
    if (false !== strpos($original_url, 'ai-uncode')){
    	global $ai_bpoints, $adaptive_images_async;
    	$ai_sizes = implode(',', $ai_bpoints);
      remove_filter('clean_url','uncode_unclean_url',10,3);
      $url_parts = parse_url($good_protocol_url);
      $url_home = parse_url(get_option( 'home' ));
      $url_home = (isset($url_home['path'])) ? '/' . trim($url_home['path'], '/') . '/' : '/';
      $explode_path = explode('/', trim($url_parts['path'], '/'));
      $is_content = false;
      foreach ($explode_path as $key => $value) {
      	if ($value === 'wp-content') $is_content = true;
      	if ($is_content) unset($explode_path[$key]);
      }
      if (count($explode_path) > 0) {
      	$path_domain = '/' . implode('/', $explode_path) . '/';
      } else $path_domain = '/';
      $ai_async = ($adaptive_images_async === 'on') ? " data-async='true'" : "";

      return $url_parts['path'] . "' id='uncodeAI'".$ai_async." data-home='".$url_home."' data-path='".$path_domain."' data-breakpoints-images='" . $ai_sizes;
    }
    return $good_protocol_url;
}

add_filter('clean_url','uncode_unclean_url',10,3);

function uncode_oembed_result($html, $url, $args) {
	if(strpos($url, 'youtu.be') !== false || strpos($url, 'youtube.com') !== false){
		if (gettype($args) === 'array') $args = http_build_query($args);
		if ($args !== '') $html = str_replace("?feature=oembed", "?feature=oembed&" . $args, $html);
  }
  if(strpos($url, 'vimeo.com') !== false){
  	if (gettype($args) === 'array') $args = http_build_query($args);
  	$parse_url = parse_url($url);
  	if ($args !== '') $html = str_replace($parse_url['path'], $parse_url['path'] . "?" . $args, $html);
  }
  return $html;
}

add_filter('oembed_result','uncode_oembed_result', 10, 3);

/**
 * Enqueue scripts and styles.
 */
function uncode_equeue()
{

	global $LOGO, $adaptive_images, $adaptive_images_async, $adaptive_images_async_blur, $ai_bpoints, $general_style, $menutype;

	$LOGO = new stdClass;
	$logo_switchable = ot_get_option('_uncode_logo_switch');
	if ($logo_switchable === 'on') {
		$logo_light = ot_get_option('_uncode_logo_light');
		$logo_dark = ot_get_option('_uncode_logo_dark');
		$LOGO->logo_id = array($logo_light,$logo_dark);
	} else $LOGO->logo_id = ot_get_option('_uncode_logo');
	$LOGO->logo_min = ot_get_option('_uncode_min_logo');
	$LOGO->logo_height = ot_get_option('_uncode_logo_height');

	$general_style = ot_get_option('_uncode_general_style');
	if ($general_style === '') $general_style = 'light';
	$menutype = ot_get_option('_uncode_headers');

	$production_mode = ot_get_option('_uncode_production');
	$resources_version = ($production_mode === 'on') ? null : rand();

	/** CSS */
	wp_enqueue_style('uncode-style', get_template_directory_uri() . '/library/css/style.css', array() , $resources_version, 'all');
	wp_enqueue_style('uncode-icons', get_template_directory_uri() . '/library/css/uncode-icons.css', array() , $resources_version, 'all');
	$front_css = get_template_directory() . '/library/css/';
	$ot_id = is_multisite() ? get_current_blog_id() : '';
	if (file_exists($front_css . 'style-custom'.$ot_id.'.css')) {
		$dynamic_css_exists = true;
		wp_enqueue_style('uncode-custom-style', get_template_directory_uri() . '/library/css/style-custom'.$ot_id.'.css', array() , $resources_version, 'all');
	} else {
		$dynamic_css_exists = false;
		$styles = uncode_create_dynamic_css();
		wp_add_inline_style( 'uncode-style', uncode_compress_css_inline($styles['custom']));
	}

	/** Add JS parameters to frontend */
	$site_parameters = array(
		'site_url' => get_home_url(get_current_blog_id(),'/'),
		'theme_directory' => get_template_directory_uri(),
		'admin_ajax' => admin_url( 'admin-ajax.php' ),
		'uncode_ajax' => get_template_directory_uri() . '/core/inc/uncode-ajax.php',
		'days' => esc_html__( 'days', 'uncode' ),
		'hours' => esc_html__( 'hours', 'uncode' ),
		'minutes' => esc_html__( 'minutes', 'uncode' ),
		'seconds' => esc_html__( 'seconds', 'uncode' ),
	);

	/** JS */
	$ai_active = ot_get_option('_uncode_adaptive');
	wp_enqueue_script('wp-mediaelement');
	$is_ai_active = false;

	if ($ai_active === 'on' || $ai_active === '') {
		$is_ai_active = true;
		wp_enqueue_script('ai-uncode', get_template_directory_uri() . '/library/js/min/ai-uncode.min.js', array() , $resources_version, false);
		wp_localize_script( 'ai-uncode', 'SiteParameters', $site_parameters );
	}

	if ($production_mode === 'on') {
		wp_enqueue_script('uncode-init', get_template_directory_uri() . '/library/js/min/init.min.js', array() , $resources_version, false);
		wp_enqueue_script('uncode-plugins', get_template_directory_uri() . '/library/js/min/plugins.min.js', array('jquery') , $resources_version, true);
		wp_enqueue_script('uncode-app', get_template_directory_uri() . '/library/js/min/app.min.js', array('jquery') , $resources_version, true);
	} else {
		wp_enqueue_script('uncode-init', get_template_directory_uri() . '/library/js/init.js', array() , $resources_version, false);
		wp_enqueue_script('uncode-plugins', get_template_directory_uri() . '/library/js/plugins.js', array('jquery') , $resources_version, true);
		wp_enqueue_script('uncode-app', get_template_directory_uri() . '/library/js/app.js', array('jquery') , $resources_version, true);
	}

	if (!$is_ai_active) wp_localize_script( 'uncode-init', 'SiteParameters', $site_parameters );

	if (is_singular() && comments_open() && get_option('thread_comments'))
	{
		wp_enqueue_script('comment-reply');
	}

	/** Deregister CSS */
	global $wp_styles, $wp_scripts;
	if (isset($wp_styles->registered['dot-irecommendthis'])) wp_dequeue_style('dot-irecommendthis');
	if (isset($wp_styles->registered['mediaelement'])) wp_deregister_style('mediaelement');
	if (isset($wp_styles->registered['wp-mediaelement'])) wp_deregister_style('wp-mediaelement');

	$adaptive_images = ot_get_option('_uncode_adaptive');
	$adaptive_images_async = ot_get_option('_uncode_adaptive_async');
	$adaptive_images_async_blur = ot_get_option('_uncode_adaptive_async_blur');
	$ai_sizes = ot_get_option('_uncode_adaptive_sizes');
  if ($ai_sizes === '') $ai_sizes = '258,516,720,1032,1440,2064,2880';
  $ai_sizes = preg_replace('/\s+/', '', $ai_sizes);
  $ai_bpoints = explode(',', $ai_sizes);

  /** Main CSS **/
  $output_css = '';
	$main_width = ot_get_option('_uncode_main_width');
	$main_align = ot_get_option('_uncode_main_align');
	if ($main_align == 'left')
	{
		$main_align_css = 'margin-right: auto;';
	}
	elseif ($main_align == 'right')
	{
		$main_align_css = 'margin-left: auto;';
	}
	else
	{
		$main_align_css = 'margin: auto;';
	}

	$logo_height_mobile = ot_get_option('_uncode_logo_height_mobile');
	if ($logo_height_mobile !== '') {
		$logo_height_mobile = preg_replace('/[^0-9.]+/', '', $logo_height_mobile);
		$output_css .= "\n@media (max-width: 959px) { .navbar-brand > * { height: " . $logo_height_mobile . "px !important;}}";
	}

	if ((isset($main_width[0]) && $main_width[0] !== '') || (!is_array($main_width) && $main_width !== '')) {
		if (is_array($main_width)) {
			if ($main_width[1] === 'px') {
				$output_width = round($main_width[0] / 12) * 12;
				$output_unit = 'px';
			} else {
				$output_width = $main_width[0];
				$output_unit = '%';
				$output_css .= "\n@media (min-width: 960px) { .limit-width { max-width: " . $main_width[0] . "%; " . $main_align_css . "}}";
			}
		} else {
			if (strpos($main_width, 'px') !== false) {
				$output_width = preg_replace('/[^0-9,.]/', '', $main_width);
				$output_unit = 'px';
			} else {
				$output_width = preg_replace('/[^0-9,.]/', '', $main_width);
				$output_unit = '%';
			}
		}
		if ($main_width[1] === 'px') $output_css .= "\n@media (min-width: 960px) { .limit-width { max-width: " . $output_width . $output_unit . "; " . $main_align_css . "}}";
		else $output_css .= "\n@media (min-width: 960px) { .limit-width { max-width: " . $output_width . $output_unit . "; " . $main_align_css . "}}";
	}

  /** Menu CSS **/
	if (strpos($menutype, 'vmenu') !== false)
	{
		$vmenu_width = ot_get_option('_uncode_vmenu_width');
		$vmenu_position = ot_get_option('_uncode_vmenu_position');
		$body_border = ot_get_option('_uncode_body_border');
		$body_border = ($body_border !== '' && $body_border !== 0) ? $body_border : 0;

		if ($vmenu_width == '') $vmenu_width = '200';
		$output_css .= "\n@media (min-width: 960px) { .main-header, .vmenu-container { width: " . ($vmenu_width) . "px; }}";

		$vmenu_border_offset = $vmenu_width + $body_border;

		if ($menutype === 'vmenu-offcanvas')
		{
			if ($vmenu_position === 'left')
			{
				$output_css .= "\n@media (min-width: 960px) { .vmenu-container { transform: translateX(-" . $vmenu_width . "px); -webkit-transform: translateX(-" . $vmenu_width . "px); -ms-transform: translateX(-" . $vmenu_width . "px);} .off-opened .vmenu-container { transform: translateX(0px); -webkit-transform: translateX(0px); -ms-transform: translateX(0px);}}";
				$output_css .= "\n@media (min-width: 960px) { .off-opened .row-offcanvas, .off-opened .main-container { transform: translateX(" . $vmenu_width . "px); -webkit-transform: translateX(" . $vmenu_width . "px); -ms-transform: translateX(" . $vmenu_width . "px);}}";
				$output_css .= "\n@media (min-width: 960px) { .firefox .main-header, .ie .main-header { clip: rect(0px, auto, auto, 0px); } }";
			}
			else
			{
				$output_css .= "\n@media (min-width: 960px) { .vmenu-container { transform: translateX(0px); -webkit-transform: translateX(0px); -ms-transform: translateX(0px);} .off-opened .vmenu-container { transform: translateX(-" . $vmenu_width . "px); -webkit-transform: translateX(-" . $vmenu_width . "px); -ms-transform: translateX(-" . $vmenu_width . "px);}}";
				$output_css .= "\n@media (min-width: 960px) { .off-opened .row-offcanvas, .off-opened .main-container { transform: translateX(-" . $vmenu_width . "px); -webkit-transform: translateX(-" . $vmenu_width . "px); -ms-transform: translateX(-" . $vmenu_width . "px);}}";
				$output_css .= "\n@media (min-width: 960px) { .firefox .main-header, .ie .main-header { clip: rect(0px, 0px, 9999px, -" . $vmenu_width . "px); } }";
			}
		} else {
			if ($vmenu_position == 'right') {
				$output_css .= "\n@media (min-width: 960px) { .vmenu-container { left: 100%; transform: translateX(-" . $vmenu_border_offset . "px); -webkit-transform: translateX(-" . $vmenu_border_offset . "px); -ms-transform: translateX(-" . $vmenu_border_offset . "px);} body:not(.rtl) .main-container { transform: translateX(-" . $vmenu_width . "px); -webkit-transform: translateX(-" . $vmenu_width . "px); -ms-transform: translateX(-" . $vmenu_width . "px);}}";
			}
		}
	}

	$menu_first_uppercase = ot_get_option('_uncode_menu_first_uppercase');
	$menu_other_uppercase = ot_get_option('_uncode_menu_other_uppercase');

	if ($menu_first_uppercase === 'on') {
		$output_css .= "\n.menu-primary ul.menu-smart > li > a, .menu-primary ul.menu-smart li.dropdown > a, .menu-primary ul.menu-smart li.mega-menu > a, .vmenu-container ul.menu-smart > li > a, .vmenu-container ul.menu-smart li.dropdown > a { text-transform: uppercase; }";
	}

	if ($menu_other_uppercase === 'on') {
		$output_css .= "\n.menu-primary ul.menu-smart ul a, .vmenu-container ul.menu-smart ul a { text-transform: uppercase; }";
	}

	if ($output_css !== '') wp_add_inline_style('uncode-style', $output_css);

	$custom_css = ot_get_option('_uncode_custom_css');
	if ($custom_css !== '') {
		if ($dynamic_css_exists) {
			wp_add_inline_style('uncode-custom-style', uncode_compress_css_inline($custom_css));
		} else {
			wp_add_inline_style('uncode-style', uncode_compress_css_inline($custom_css));
		}
	}

}

add_action('wp_enqueue_scripts', 'uncode_equeue');


function uncode_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'uncode_add_excerpts_to_pages' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function uncode_body_classes($classes)
{
	global $menutype;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if (is_multi_author())
	{
		$classes[] = 'group-blog';
	}

	$boxed = ot_get_option('_uncode_boxed');
	$main_align = ot_get_option('_uncode_main_align');
	$smooth_scroller = ot_get_option('_uncode_smooth_scroller');
	if ($smooth_scroller === 'on' && !wp_is_mobile()) $classes[] = 'smooth-scroller';

	if ($menutype === '') $menutype = 'hmenu-right';
	if (strpos($menutype, 'vmenu') !== false)
	{
		$vmenu_v_position = ot_get_option('_uncode_vmenu_v_position');
		if ($menutype === 'vmenu-offcanvas') {
			$classes[] = 'menu-offcanvas';
			$classes[] = 'vmenu-' . $vmenu_v_position;
		} else {
			$classes[] = 'vmenu';
			$classes[] = $menutype . '-' . $vmenu_v_position;
		}
		$horizontal_align = ot_get_option('_uncode_vmenu_align');
		$classes[] = 'vmenu-' . $horizontal_align;
		$vmenu_position = ot_get_option('_uncode_vmenu_position');
		$classes[] = 'vmenu-position-' . $vmenu_position;
	}
	else
	{
		switch ($menutype)
		{
			case 'hmenu-right':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-position-right';
			break;
			case 'hmenu-left':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-position-left';
			break;
			case 'hmenu-justify':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-position-center';
			break;
			case 'hmenu-center':
				$classes[] = 'hmenu-center';
			break;
			case 'hmenu-center-split':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-center-split';
			break;
		}
	}

	if ($boxed === 'on') $classes[] = 'boxed-width';
	else $classes[] = 'header-full-width';

	if ($menutype == 'menu-overlay' || $menutype == 'menu-overlay-center')
	{
		$vmenu_v_position = ot_get_option('_uncode_vmenu_v_position');
		$vmenu_position = ot_get_option('_uncode_vmenu_position');
		if ($vmenu_position === 'left') $classes[] = 'menu-overlay-left';
		$horizontal_align = ot_get_option('_uncode_vmenu_align');
		$classes[] = 'vmenu-' . $horizontal_align;
		$classes[] = 'vmenu-' . $vmenu_v_position;
		$classes[] = 'vmenu-middle';
		$classes[] = 'menu-overlay';
		if ($menutype == 'menu-overlay-center') $classes[] = 'menu-overlay-center';
	}

	if (ot_get_option('_uncode_input_underline') === 'on') $classes[] = 'input-underline';

	$classes[] = 'main-' . $main_align . '-align';

	$menu_mobile_animation = ot_get_option('_uncode_menu_mobile_animation');
	if ($menu_mobile_animation === 'scale') {
		$classes[] = 'menu-mobile-animated';
	}

	return $classes;
}
add_filter('body_class', 'uncode_body_classes');

function uncode_inline_script() {
	$custom_js = ot_get_option('_uncode_custom_js');
	if ($custom_js !== '') {
		echo uncode_remove_wpautop( $custom_js );
	}
}
add_action( 'wp_footer', 'uncode_inline_script' );


function uncode_redirect_page($original_template) {
	if (! is_user_logged_in()) {
		global $is_redirect,$redirect_page;
		$is_redirect_active = ot_get_option('_uncode_redirect');
		if ($is_redirect_active === 'on') {
			$redirect_page = ot_get_option('_uncode_redirect_page');
			if($redirect_page !== '')
	    {
	    	$is_redirect = true;
	      return get_template_directory() . '/redirect-page.php';
	    }
		}
	}
	return $original_template;
}
add_filter('template_include', 'uncode_redirect_page');

add_filter( 'the_content_more_link', 'uncode_modify_read_more_link' );

function uncode_modify_read_more_link() {
	return '<a class="more-link btn-link" href="' . get_permalink() . '">'.esc_html__('Read more','uncode').'<i class="fa fa-angle-right"></i></a>';
}

if (!class_exists('WPBakeryShortCode')) {

	class uncode_index {
		protected $filter_categories = array();
		protected $query = false;
		protected $loop_args = array();
		protected $taxonomies = false;

		public function getCategoriesCss($post_id)
		{
			$categories_css = '';
			$categories_name = array();
			$tag_name = array();
			$categories_id = array();
			$post_categories = wp_get_object_terms($post_id, $this->getTaxonomies());
			foreach ($post_categories as $cat)
			{
				if (is_taxonomy_hierarchical($cat->taxonomy) && substr( $cat->taxonomy, 0, 3 ) !== 'pa_') {
					if (!in_array($cat
						->term_id, $this
						->filter_categories))
					{
						$this
							->filter_categories[] = $cat->term_id;
					}
					$categories_name[] = $cat->name;
					$categories_id[] = $cat->term_id;
				} else if ($cat->taxonomy === 'post_tag') {
					$categories_id[] = $cat->term_id;
					$categories_name[] = $cat->name;
					$tag_name[] = $cat->name;
				}
			}
			return array('cat_css' => $categories_css, 'cat_name' => $categories_name, 'cat_id' => $categories_id, 'tag' => $tag_name);
		}
		protected function getTaxonomies()
		{
			if ($this->taxonomies === false) {
				$this
					->taxonomies = get_object_taxonomies(!empty($this
					->loop_args['post_type']) ? $this->loop_args['post_type'] : get_post_types(array(
					'public' => false,
					'name' => 'attachment'
				) , 'names', 'NOT'));
			}

			return $this->taxonomies;
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
	}
}

?>