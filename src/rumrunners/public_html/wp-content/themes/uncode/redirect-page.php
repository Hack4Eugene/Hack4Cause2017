<?php

/**
 * The coming soon template file.
 *
 * @package uncode
 */

get_header();

/** Get general datas **/
if (isset($metabox_data['_uncode_specific_style'][0]) && $metabox_data['_uncode_specific_style'][0] !== '') {
	$style = $metabox_data['_uncode_specific_style'][0];
	if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
		$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
	}
} else {
	$style = ot_get_option('_uncode_general_style');
	if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
		$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
	} else $bg_color = ot_get_option('_uncode_general_bg_color');
}
$bg_color = ($bg_color == '') ? ' style-'.$style.'-bg' : ' style-'.$bg_color.'-bg';

$redirect_page = ot_get_option('_uncode_redirect_page');
$redirect_page = apply_filters( 'wpml_object_id', $redirect_page, 'post' );
$the_content = get_post_field('post_content', $redirect_page);
if (has_shortcode($the_content, 'vc_row'))
{
	$the_content = '<div class="post-content">' . $the_content . '</div>';
}
else
{
	$the_content = apply_filters('the_content', $the_content);
	$the_content = '<div class="post-content">' . uncode_get_row_template($the_content, '', '', $style, '', 'double', true, 'double') . '</div>';
}
/** Display post html **/
echo 	'<article id="post-'. get_the_ID().'" class="'.implode(' ', get_post_class('page-body style-'.$bg_color.'-bg')) .'">
				<div class="post-wrapper">
					<div class="post-body">' . do_shortcode($the_content) . '</div>
				</div>
			</article>';
get_footer(); ?>