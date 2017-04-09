<?php
/*
Plugin Name: Uncode Core
Plugin URI: http://www.undsgn.com
Description: Uncode Core Plugin for Undsgn Themes
Version: 1.2.1
Author: Undsgn
Author URI: http://www.undsgn.com
*/

// Blocking direct access
if( ! function_exists( 'uncode_block_direct_access' ) ) {
	function uncode_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Direct access denied.' );
		}
	}
}

if( ! class_exists( 'UncodeCore_Plugin' ) ) {
	class UncodeCore_Plugin {

		const VERSION = '1.2.1';
		protected static $instance = null;

		private function __construct() {
			add_action('init', array(&$this, 'init'));
			add_action('admin_init', array(&$this, 'admin_init'));
		}

		function init() {

		}

		function admin_init() {
			load_theme_textdomain( 'uncode', plugin_dir_path( __FILE__ ) . 'languages' );
		}

		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}

// Init the plugin
add_action( 'plugins_loaded', array( 'UncodeCore_Plugin', 'get_instance' ) );

/**
* Custom posts type.
*/
require_once dirname(__FILE__) . '/custom-post-type.php';

/**
* Customizer Visual Composer
*/
function before_visual_composer() {
	$ok_php = true;
	if ( function_exists( 'phpversion' ) ) {
		$php_version = phpversion();
		if (version_compare($php_version,'5.3.0') < 0) $ok_php = false;
	}
	if ($ok_php) require_once dirname(__FILE__) . '/vc_extend/init.php';
}
add_action( 'vc_before_init', 'before_visual_composer' );

//////////////////////////////
// Add page category filter //
//////////////////////////////

add_action('restrict_manage_posts', 'uncode_page_filter_post_type_by_taxonomy');

function uncode_page_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'page'; // change to your post type
	$taxonomy  = 'page_category'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf(esc_html__("Show All %s", 'uncode'), $info_taxonomy->label),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

add_filter('parse_query', 'uncode_page_convert_id_to_term_in_query');
function uncode_page_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'page'; // change to your post type
	$taxonomy  = 'page_category'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}

///////////////////////////////////
// Add portfolio category filter //
///////////////////////////////////

add_action('restrict_manage_posts', 'uncode_portfolio_filter_post_type_by_taxonomy');

function uncode_portfolio_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'portfolio'; // change to your post type
	$taxonomy  = 'portfolio_category'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf(esc_html__("Show All %s", 'uncode'), $info_taxonomy->label),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

add_filter('parse_query', 'uncode_portfolio_convert_id_to_term_in_query');
function uncode_portfolio_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'portfolio'; // change to your post type
	$taxonomy  = 'portfolio_category'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}

///////////////////////////////////////
// Add content block category filter //
///////////////////////////////////////

add_action('restrict_manage_posts', 'uncode_cblock_filter_post_type_by_taxonomy');

function uncode_cblock_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'uncodeblock'; // change to your post type
	$taxonomy  = 'uncodeblock_category'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf(esc_html__("Show All %s", 'uncode'), $info_taxonomy->label),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

add_filter('parse_query', 'uncode_cblock_convert_id_to_term_in_query');
function uncode_cblock_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'uncodeblock'; // change to your post type
	$taxonomy  = 'uncodeblock_category'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}