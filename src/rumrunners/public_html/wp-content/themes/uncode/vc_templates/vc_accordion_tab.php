<?php
$output = $title = $id = $active = '';

extract(shortcode_atts(array(
	'title' => esc_html__("Section", "uncode"),
	'id' => '',
	'active' => ''
), $atts));

$create_id = preg_replace('/[^A-Za-z0-9\-]/', '', sanitize_title($title)) . '-' . big_rand();
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel panel-default', $this->settings['base'], $atts );
$output .= '<div class="'.esc_attr(trim($css_class)).'">';
$output .= '<div class="panel-heading" role="tab">';
$output .= '<p class="panel-title'.($active ? ' active' : '').'"><a data-toggle="collapse" data-parent="#'.$id.'" href="#'.$create_id.'"><span>'.$title.'</span></a></p>';
$output .= '</div>';
$output .= '<div id="'.$create_id.'" class="panel-collapse collapse'.($active ? ' in' : '').'" role="tabpanel">';
$output .= '<div class="panel-body">';
$output .= ($content=='' || $content==' ') ? esc_html__("Empty section. Edit page to add content here.", "uncode") : "\n\t\t\t\t\t\t" . $content;
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo uncode_remove_wpautop($output);