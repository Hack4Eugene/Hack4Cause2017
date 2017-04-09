<?php
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';

extract(shortcode_atts(array(
	'title' => '',
	'interval' => 0,
	'el_class' => '',
	'collapsible' => 'no',
	'active_tab' => '1'
) , $atts));

$el_id = 'accordion_' . rand();
preg_match_all('/vc_accordion_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE);
$accordion_tab = array();
if (isset($matches[0]))
{
	$accordion_tab = $matches[0];
}
$counter = 1;
foreach ($accordion_tab as $tab)
{
	if ($counter == $active_tab) $content = str_replace($tab[0], $tab[0] . ' id="' . $el_id . '" active="1"', $content);
	else
	{
		$content = str_replace($tab[0], $tab[0] . ' id="' . $el_id . '"', $content);
	}
	$counter++;
}

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-accordion ' . $el_class, $this->settings['base'], $atts);

$output.= '<div class="' . esc_attr(trim($css_class)) . '" data-collapsible="' . esc_attr($collapsible) . '" data-active-tab="' . esc_attr($active_tab) . '">';
$output.= '<div class="panel-group" id="' . $el_id . '" role="tablist" aria-multiselectable="true">';
$output.= wpb_widget_title(array(
	'title' => $title,
	'extraclass' => 'wpb_accordion_heading'
));
$output.= $content;
$output.= '</div>';
$output.= '</div>';

echo uncode_remove_wpautop($output);
