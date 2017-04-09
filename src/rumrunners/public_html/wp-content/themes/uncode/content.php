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
	'tmb',
	'tmb-post',
);
$block_classes[] = 'tmb-' . $general_style;
$block_classes[] = 'tmb-overlay-anim';
$block_classes[] = 'tmb-overlay-text-anim';
$block_classes[] = 'tmb-reveal-bottom';
$block_classes[] = 'tmb-shadowed';
$block_classes[] = 'tmb-bordered';
$block_classes[] = 'tmb-iso-w' . $single_post_width;
$block_classes[] = implode(' ', get_post_class());

$media_items = array();
$block_data = array();
$tmb_data = array();
$title_classes = array();
$layout = array();

$title_classes[] = 'h3';

global $uncode_index_map;
if (!class_exists('uncode_index')) {
	echo __('Please active Uncode Core plugin to version > 1.0.5','uncode');
	die();
}
$uncode_index_instance = new uncode_index($uncode_index_map);
$post_category = $uncode_index_instance->getCategoriesCss( $post->ID);
$block_data['content'] = get_the_content();
$block_data['single_categories_id'] = $post_category['cat_id'];
$block_data['single_categories'] = $uncode_index_instance->getCategoriesLink( $post->ID );
$block_data['classes'] = $block_classes;
$block_data['tmb_data'] = $tmb_data;
$block_data['id'] = $post->ID;
$block_data['media_id'] = $item_thumb_id;
$block_data['single_title'] = $post->post_title;
$block_data['single_width'] = $single_post_width;
$block_data['single_back_color'] = $general_style;
$block_data['single_icon'] = 'fa fa-plus2';
$block_data['single_text'] = 'under';
$block_data['text_padding'] = 'single-block-padding';
$block_data['single_style'] = $general_style;
$block_data['overlay_color'] = $overlay_back_color;
$block_data['overlay_opacity'] = '50';
$block_data['title_classes'] = $title_classes;
$block_data['link'] = get_permalink();
if (isset($vars['single_text_length'])) $block_data['text_length'] = $vars['single_text_length'];

if ($item_thumb_id !== '') {
	$layout['media'] = array();
	$media_items = explode(',', $item_thumb_id);
	if (count($media_items) > 1) $block_data['poster'] = true;
}

$post_format = get_post_format();

if ($post_format !== 'aside' && $post_format !== 'quote') $layout['title'] = array();
if (($post_format !== 'aside' && $post_format !== 'link' && $post_format !== 'quote') && !is_archive()) $layout['meta'] = array();
$layout['text'] = array('full');
if ($post_format === 'quote' && !is_archive()) $layout['meta'] = array();
if ($post_format === 'aside' || $post_format === 'link') $layout['date'] = array();
if ($post_format !== 'aside' && $post_format !== 'link' && $post_format !== 'quote') $layout['sep-one'] = array();
if ($post_format !== 'aside' && $post_format !== 'link' && $post_format !== 'quote') $layout['author'] = array();
$layout['icon'] = array();

echo uncode_create_single_block($block_data, rand() , 'masonry', $layout, false, 'no');