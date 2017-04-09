<?php

$empty_h = $el_class = $desktop_visibility = $medium_visibility = $mobile_visibility = '';

extract(shortcode_atts(array(
    'empty_h'=> '',
    'desktop_visibility' => '',
    'medium_visibility' => '',
    'mobile_visibility' => '',
    'el_class' => ''
), $atts));

$class = "empty-space ";

switch ($empty_h) {
	case '1':
		$class .= 'empty-half';
		break;
	case '2':
		$class .= 'empty-single';
		break;
	case '3':
		$class .= 'empty-double';
		break;
	case '4':
		$class .= 'empty-triple';
		break;
	case '5':
		$class .= 'empty-quad';
		break;
	default:
		$class .= 'empty-quart';
		break;
}

$class .= $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

if ($desktop_visibility === 'yes') $css_class .= ' desktop-hidden';
if ($medium_visibility === 'yes') $css_class .= ' tablet-hidden';
if ($mobile_visibility === 'yes') $css_class .= ' mobile-hidden';

?>
<div class="<?php echo esc_attr(trim($css_class)); ?>"><span class="empty-space-inner"></span></div>
