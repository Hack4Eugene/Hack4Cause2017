<?php

/**
 * @package uncode
 */

global $wp_query;
$vars = $wp_query->query_vars;
$single_post_width = (isset($vars['single_post_width']) && $vars['single_post_width'] !== '') ? $vars['single_post_width'] : 4;

$item_thumb_id = '';

$stylesArray = array(
	'light',
	'dark'
);
$general_style = ot_get_option('_uncode_general_style');

$overlay_style = $stylesArray[!array_search($general_style, $stylesArray) ];
$overlay_back_color = 'style-' . $overlay_style . '-bg';

$item_thumb_id = get_post_meta($post->ID, '_uncode_featured_media', 1);
if ($item_thumb_id === '') $item_thumb_id = get_post_thumbnail_id($post->ID);

$block_classes = array(
	'tmb'
);
$block_classes[] = 'tmb-' . $general_style;
$block_classes[] = 'tmb-no-bg';
$block_classes[] = 'tmb-overlay-anim';
$block_classes[] = 'tmb-overlay-text-anim';
$block_classes[] = 'tmb-image-anim';
$block_classes[] = 'tmb-text-space-reduced';
$block_classes[] = 'tmb-iso-w' . $single_post_width;
$block_classes[] = implode(' ', get_post_class());

$media_items = array();
$block_data = array();
$tmb_data = array();
$title_classes = array();
$layout = array();

$title_classes[] = 'h6';

$block_data['content'] = get_the_content();
$block_data['classes'] = $block_classes;
$block_data['tmb_data'] = $tmb_data;
$block_data['id'] = $post->ID;
$block_data['media_id'] = $item_thumb_id;
$block_data['single_title'] = $post->post_title;
$block_data['single_width'] = $single_post_width;
$block_data['single_icon'] = 'fa fa-plus2';
$block_data['single_text'] = 'under';
$block_data['text_padding'] = 'half-block-padding';
$block_data['single_style'] = $general_style;
$block_data['overlay_color'] = $overlay_back_color;
$block_data['overlay_opacity'] = '50';
$block_data['title_classes'] = $title_classes;
$block_data['link'] = get_permalink();
$block_data['text_length'] = 300;

if ($item_thumb_id !== '') {
	$layout['media'] = array();
	$media_items = explode(',', $item_thumb_id);
	if (count($media_items) > 1) $block_data['poster'] = true;
}

$layout['icon'] = array();
$layout['title'] = array();

echo uncode_create_single_block($block_data, rand() , 'masonry', $layout, false, 'no');