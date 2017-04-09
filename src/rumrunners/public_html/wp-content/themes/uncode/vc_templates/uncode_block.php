<?php

$id = $inside_column = $output = '';

extract(shortcode_atts(array(
	'id' => '',
	'inside_column' => '',
) , $atts));

$id = apply_filters( 'wpml_object_id', $id, 'post' );
$the_content = get_post_field('post_content', $id);

if ($inside_column === 'yes') {
	$output = str_replace('vc_row', 'vc_row_inner', $the_content);
} else {
	$output = $the_content;
}

echo uncode_remove_wpautop($output);