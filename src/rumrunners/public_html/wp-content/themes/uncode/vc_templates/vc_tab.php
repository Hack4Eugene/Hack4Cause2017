<?php
/** @var $this WPBakeryShortCode_VC_Tab */
$output = $title = $tab_id = $no_margin = $first = '';
extract( shortcode_atts( array(
	'title' => '',
	'tab_id' => 0,
	'no_margin' => '',
	'first' => ''
), $atts ) );

if ($first) $first = ' in active';
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tab-pane fade' . $first, $this->settings['base'], $atts );
if ($no_margin === 'yes') $css_class .= ' remove-top-margin';
$output .= '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="'.esc_attr(trim($css_class)).'">';
$output .= ($content=='' || $content==' ') ? esc_html__("Empty tab. Edit page to add content here.", "uncode") : "\n\t\t\t\t" . $content;
$output .= '</div> ';

echo uncode_remove_wpautop($output);