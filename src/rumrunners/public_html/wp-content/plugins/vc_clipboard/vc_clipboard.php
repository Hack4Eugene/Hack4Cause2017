<?php

/**
 * Plugin Name: Visual Composer Clipboard
 * Description: Clipboard and template manager for Visual Composer
 * Version: 3.24
 * Author: bitorbit
 * Author URI: http://codecanyon.net/user/bitorbit
 */

function vc_clipboard() {
	wp_enqueue_script( 'vc_clipboard_script', plugins_url() . '/vc_clipboard/script.min.js' );
	wp_enqueue_style( 'vc_clipboard_style', plugins_url() . '/vc_clipboard/style.css' );
}
function vc_clipboard_custom_js() {
	echo '<script>window.bt_vcc_plugins_url="' . plugins_url() . '"</script>';
}
add_action( 'admin_enqueue_scripts', 'vc_clipboard' );
add_action( 'admin_head', 'vc_clipboard_custom_js' );