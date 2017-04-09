<?php
$google_api_key = ot_get_option('_uncode_gmaps_api');
if ($google_api_key !== '') $google_api_key = '?key=' . $google_api_key;
wp_enqueue_script('google-maps-api', '//maps.googleapis.com/maps/api/js' . $google_api_key, array(), false, true);
wp_enqueue_script('uncode-google-maps', get_template_directory_uri() . '/library/js/min/uncode.gmaps.min.js', array('google-maps-api') , UNCODE_VERSION, true);

$output = $title = $latlon = $link = $size = $address = $zoom = $map_color = $ui_color = $map_saturation = $map_brightness = $type = $bubble = $mobile_no_drag = $el_class = $ui_color_map = '';
extract(shortcode_atts(array(
	'title' => '',
	'latlon' => '40.686236, 73.995409',
	'size' => '',
	'address' => '',
	'zoom' => 14,
	'map_color' => '',
	'ui_color' => '',
	'map_saturation' => 0,
	'map_brightness' => 0,
	'mobile_no_drag' => '',
	'el_class' => ''
) , $atts));

if ($latlon == '')
{
	return null;
}
$latlon = explode(',', $latlon);

global $front_background_colors;

if ($map_color !== '') $map_color = $front_background_colors[$map_color];
if ($ui_color !== '') $ui_color_map = $front_background_colors[$ui_color];
$map_saturation = ($map_saturation !== '' && $map_color !== '') ? $map_saturation = $map_saturation : '';
$map_brightness = ($map_brightness !== '' && $map_color !== '') ? $map_brightness = $map_brightness : '';
$ui_color = (isset($ui_color) && $ui_color !== '') ? $ui_color : '';

$el_id = 'gmap' . uncode_randomstring();

if ($address !== '') $address = '<address class="style-'.(($ui_color !== '') ? $ui_color : 'accent').'-bg">'.$address.'</address>';

$size = str_replace(array('px',' ') , array('','') , $size);

$el_class = $this->getExtraClass($el_class);
$el_class .= ($size == '') ? ' uncode-map-responsive' : '';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-gmaps-widget ' . $el_class, $this->settings['base'], $atts); ?>
<div class="<?php echo esc_attr($css_class); ?>">
	<?php echo wpb_widget_title(array(
			'title' => $title,
			'extraclass' => 'wpb_map_heading'
		));
	?>
	<div class="uncode-wrapper">
		<div id="<?php echo esc_attr($el_id); ?>" class="uncode-map-wrapper" data-draggable="<?php echo ($mobile_no_drag === 'yes' && wp_is_mobile()) ? 'false' : 'true'; ?>" data-zoom="<?php echo esc_attr($zoom); ?>"<?php if ($map_color !== '') echo ' data-color="' . esc_attr($map_color) . '"'; if ($ui_color_map !== '') echo ' data-ui="' . esc_attr($ui_color_map) .'"' ; ?> data-lat="<?php echo esc_attr(trim($latlon[0])); ?>" data-lon="<?php echo esc_attr(trim($latlon[1])); ?>"<?php if ($map_saturation !== '') echo ' data-saturation="' . esc_attr($map_saturation) . '"'; if ($map_brightness !== '') echo ' data-brightness="' . esc_attr($map_brightness) .'"'; if (is_numeric($size)) echo ' style="height: ' . esc_attr($size) . 'px"'; ?>>
		</div>
		<?php if ($ui_color !== '') { ?>
		<div id="<?php echo esc_attr($el_id); ?>-zoom-in" class="gmap-buttons gmap-zoom-min btn style-<?php echo esc_attr($ui_color); ?>-bg"></div>
		<div id="<?php echo esc_attr($el_id); ?>-zoom-out" class="gmap-buttons gmap-zoom-out btn style-<?php echo esc_attr($ui_color); ?>-bg"></div>
		<?php } ?>
		<?php echo uncode_remove_wpautop($address); ?>
	</div>
</div>