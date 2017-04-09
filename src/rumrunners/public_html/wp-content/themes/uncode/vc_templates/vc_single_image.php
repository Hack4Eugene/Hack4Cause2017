<?php

$title = $title = $media = $col_width = $media_width_use_pixel = $media_width_percent = $media_width_pixel = $media_ratio = $media_lightbox = $media_poster = $media_link = $advanced = $media_items = $media_text = $media_style = $media_back_color = $media_overlay_color = $media_overlay_coloration = $media_overlay_opacity = $media_text_visible = $media_text_anim = $media_text_anim_type = $media_overlay_visible = $media_overlay_anim = $media_image_coloration = $media_image_color_anim = $media_image_anim = $media_h_align = $media_v_position = $media_reduced = $media_h_position = $media_padding = $media_text_reduced = $media_title_transform = $media_title_dimension = $media_title_family = $media_title_weight = $media_title_height = $media_title_space = $media_icon = $media_elements_click = $lbox_skin = $lbox_dir = $lbox_title = $lbox_caption = $lbox_social = $lbox_deep = $lbox_no_tmb = $lbox_no_arrows = $lbox_connected = $link = $alignment = $el_class = $css_animation = $animation_delay = $animation_speed = $shape = $caption = $border = $shadow = $output = $single_width = $single_height = $single_fixed = $style_preset = $css = $div_data = $lightbox_classes = $dummy_oembed = $carousel_textual = $media_code = '';

extract(shortcode_atts(array(
	'title' => '',
	'image' => '',
	'media' => '',
	'col_width' => '12',
	'media_width_use_pixel' => '',
	'media_width_percent' => 100,
	'media_width_pixel' => '',
	'media_ratio' => '',
	'media_lightbox' => false,
	'media_poster' => '',
	'media_link' => '',
	'advanced' => false,
	'media_items' => 'media',
	'media_text' => 'overlay',
	'media_style' => 'light',
	'media_back_color' => '',
	'media_overlay_color' => '',
	'media_overlay_coloration' => '',
	'media_overlay_opacity' => 50,
	'media_text_visible' => 'no',
	'media_text_anim' => 'yes',
	'media_text_anim_type' => '',
	'media_overlay_visible' => 'no',
	'media_overlay_anim' => 'yes',
	'media_image_coloration' => '',
	'media_image_color_anim' => '',
	'media_image_anim' => 'yes',
	'media_h_align' => 'left',
	'media_v_position' => '',
	'media_reduced' => '',
	'media_h_position' => 'left',
	'media_padding' => '',
	'media_text_reduced' => '',
	'media_title_transform' => '',
	'media_title_dimension' => '',
	'media_title_family' => '',
	'media_title_weight' => '',
	'media_title_height' => '',
	'media_title_space' => '',
	'media_icon' => '',
  'media_elements_click' => '',
	'lbox_skin' => '',
	'lbox_dir' => '',
	'lbox_title' => '',
	'lbox_caption' => '',
	'lbox_social' => '',
	'lbox_deep' => '',
	'lbox_no_tmb' => '',
	'lbox_no_arrows' => '',
	'lbox_connected' => '',
	'no_double_tap' => '',
	'link' => '',
	'alignment' => 'left',
	'el_class' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'shape' => '',
	'caption' => '',
	'border' => '',
	'shadow' => '',
) , $atts));

$stylesArray = array(
    'light',
    'dark'
);

global $lightbox_id;

$el_class = $this->getExtraClass($el_class);

if ($image !== '' && $media === '') $media = $image;

$multiple = false;
$medias = explode(',', $media);
if (count($medias) > 1 ) $multiple = true;
$media_link = ( $media_link == '||' ) ? '' : $media_link;
$media_link = vc_build_link( $media_link );
$a_href = $media_link['url'];
$a_title = $media_link['title'];
$a_target = $media_link['target'];

$alignment = ' text-' . $alignment;

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-single-media ' . $el_class , $this->settings['base'], $atts);

$css_class .= $alignment;

if ($media_width_use_pixel === 'yes' && $media_width_pixel !== '') {
	$media_width = preg_replace("/[^0-9,.]/", "", $media_width_pixel);
	$single_width = $media_width;
	$actual_width = $media_width_pixel. 'px';
	$single_fixed = 'width';
} else {
	$single_width = ($col_width * $media_width_percent) / 100;
	$actual_width = $media_width_percent . '%';
}

$block_data = array();
$block_classes = array('tmb');
$tmb_data = array();
$title_classes = array();

$shape = $tmb_shape = ($shape != '') ? ' ' . $shape : '';

if ($border === 'yes') {
	$shape .= ' img-thumbnail';
	$tmb_shape .= ' tmb-bordered';
}
if ($shadow === 'yes') {
	$shape .= ' tmb-shadow';
	$tmb_shape .= ' tmb-media-shadow';
}

$block_classes[] = 'tmb-' . $media_style;
$overlay_style = $stylesArray[!array_search($media_style, $stylesArray) ];

if ($media_overlay_color === '') $media_overlay_color = 'style-'.$overlay_style.'-bg';
else $media_overlay_color .= ' style-' . $media_overlay_color .'-bg';

switch ($media_overlay_coloration) {
	case 'top_gradient':
		$block_classes[] = 'tmb-overlay-gradient-top';
		$media_overlay_color = '';
	break;
	case 'bottom_gradient':
		$block_classes[] = 'tmb-overlay-gradient-bottom';
		$media_overlay_color = '';
	break;
}

if ($advanced === 'yes') {
	if ($media_text_visible === 'yes') $block_classes[] = 'tmb-text-showed';
	if ($media_text_anim === 'yes') $block_classes[] = 'tmb-overlay-text-anim';
	if ($media_text_anim_type === 'btt') $block_classes[] = 'tmb-reveal-bottom';
	if ($media_overlay_visible === 'yes') $block_classes[] = 'tmb-overlay-showed';
	if ($media_overlay_anim === 'yes') $block_classes[] = 'tmb-overlay-anim';
	if ($media_image_coloration === 'desaturated') $block_classes[] = 'tmb-desaturated';
	if ($media_image_color_anim === 'yes') $block_classes[] = 'tmb-image-color-anim';
	if ($media_text === 'overlay') {
	    if ($media_reduced !== '') {
	        switch ($media_reduced) {
	            case 'three_quarter':
	                $block_classes[] = 'tmb-overlay-text-reduced';
	                break;
	            case 'half':
	                $block_classes[] = 'tmb-overlay-text-reduced-2';
	                break;
	        }
	        if ($media_h_position !== '') $block_classes[] = 'tmb-overlay-' . $media_h_position;
	    }
	    if ($media_v_position !== '') $block_classes[] = 'tmb-overlay-' . $media_v_position;
	    if ($media_h_align !== '') $block_classes[] = 'tmb-overlay-text-' . $media_h_align;
	} else {
	    $block_classes[] = 'tmb-content-' . $media_h_align;
	}

	if ($media_text_reduced === 'yes') $block_classes[] = 'tmb-text-space-reduced';
	if ($media_image_anim === 'yes' && $carousel_textual !== 'yes') $block_classes[] = 'tmb-image-anim';
	if ($media_title_transform !== '') $block_classes[] = 'tmb-entry-title-' . $media_title_transform;
	if ($media_title_dimension !== '') $title_classes[] = $media_title_dimension;
	else $title_classes[] = 'h6';
	if ($media_title_family !== '') $title_classes[] = $media_title_family;
	if ($media_title_weight !== '') $title_classes[] = 'font-weight-' . $media_title_weight;
	if ($media_title_height !== '') $title_classes[] = $media_title_height;
	if ($media_title_space !== '') $title_classes[] = $media_title_space;
}

if ($advanced !== 'on') $block_classes[] = $tmb_shape;
if ($no_double_tap === 'yes') $block_classes[] = 'tmb-no-double-tap';

$block_data['classes'] = $block_classes;
$block_data['tmb_data'] = $tmb_data;
$block_data['media_id'] = $media;
$block_data['images_size'] = $media_ratio;
$block_data['single_style'] = $media_style;
$block_data['single_text'] = $media_text;
$block_data['single_elements_click'] = $media_elements_click;
$block_data['overlay_color'] = $media_overlay_color;
$block_data['overlay_opacity'] = $media_overlay_opacity;
$block_data['single_back_color'] = $media_back_color;
$block_data['single_width'] = $single_width;
$block_data['single_height'] = $single_height;
$block_data['single_fixed'] = $single_fixed;
$block_data['single_icon'] = $media_icon;
$block_data['title_classes'] = $title_classes;

switch ($media_padding) {
	case 1:
		$block_data['text_padding'] = 'half-block-padding';
	break;
	case 2:
	default:
		$block_data['text_padding'] = 'single-block-padding';
	break;
	case 3:
		$block_data['text_padding'] = 'double-block-padding';
	break;
	case 4:
		$block_data['text_padding'] = 'triple-block-padding';
	break;
	case 5:
		$block_data['text_padding'] = 'quad-block-padding';
	break;
}

if ($css_animation !== '') {
	$css_class .= ' animate_when_almost_visible ' . $css_animation;
	if ($animation_delay !== '') $div_data .= ' data-delay="'.$animation_delay.'"';
	if ($animation_speed !== '') $div_data .= ' data-speed="'.$animation_speed.'"';
}

if ($media_lightbox === 'yes') {
	$lightbox_classes = array();
	if ($lbox_skin !== '') $lightbox_classes['data-skin'] = $lbox_skin;
	if ($lbox_title !== '') $lightbox_classes['data-title'] = true;
	if ($lbox_caption !== '') $lightbox_classes['data-caption'] = true;
	if ($lbox_dir !== '') $lightbox_classes['data-dir'] = $lbox_dir;
	if ($lbox_social !== '') $lightbox_classes['data-social'] = true;
	if ($lbox_deep !== '') $lightbox_classes['data-deep'] = $media;
	if ($lbox_no_tmb !== '') $lightbox_classes['data-notmb'] = true;
	if ($lbox_no_arrows !== '') $lightbox_classes['data-noarr'] = true;
	if (count($lightbox_classes) === 0) $lightbox_classes['data-active'] = true;
	if ($lbox_connected === 'yes') {
		if (!isset($lightbox_id) || $lightbox_id === '') $lightbox_id = big_rand();
		$lbox_id = $lightbox_id;
	} else $lbox_id = $media_lightbox;
} else $lbox_id = $media;

if ($advanced === 'yes') {

	$layout = uncode_flatArray(vc_sorted_list_parse_value($media_items));

	if ($media_lightbox !== 'yes') {
		$lightbox_classes = array();
		if (!isset($media_link['url']) || $media_link['url'] === '') {
			$block_data['link_class'] = 'inactive-link';
			$block_data['link'] = '#';
		} else {
			if ($media_link !== '') {
				$block_data['link']['url'] = $a_href;
				$block_data['link']['target'] = $a_target;
			}
		}
	}

	if (isset($layout['media'][0]) && $layout['media'][0] === 'poster') $block_data['poster'] = true;

	if (empty($media) || FALSE === get_post_mime_type( $media )) {
		$media_html = '<img src="https://placeholdit.imgix.net/~text?txtsize=33&amp;txt=media+not+available&amp;w=500&amp;h=500" />';
	} else {
		if (isset($div_data['data-delay']) && $div_data['data-delay'] !== '') $block_data['delay'] = $animation_delay;
		$media_html = uncode_create_single_block($block_data, 'single-' . $lbox_id, 'masonry', $layout, $lightbox_classes, $carousel_textual);
	}
	$media_string = '<div class="uncode-single-media-wrapper single-advanced">' . $media_html . '</div>';

} else {

	$dummy = '';
	$media_type = 'image';
	$style_preset = 'masonry';
	if ($media_ratio !== '') $block_data['images_size'] = $media_ratio;

	if ($media_lightbox !== 'yes') {
		$block_data['single_text'] = 'overlay';
		$block_data['single_elements_click'] = 'yes';
	}

	$layout = array('media' => array());

	if (empty($media) || FALSE === get_post_mime_type( $media )) {
		$media_html = '<div class="t-entry-visual-cont"><img src="https://placeholdit.imgix.net/~text?txtsize=33&amp;txt=media+not+available&amp;w=500&amp;h=500" /></div>';
	} else {

		if ($media_poster === 'yes') {
			$poster = get_post_meta($media, "_uncode_poster_image", true);
			if (isset($poster) && $poster !== '') $block_data['poster'] = true;
		}

		if (isset($div_data['data-delay']) && $div_data['data-delay'] !== '') $block_data['delay'] = $animation_delay;
		$media_attributes = uncode_get_media_info($media);
		$media_metavalues = unserialize($media_attributes->metadata);
		$media_html = uncode_create_single_block($block_data, 'single-' . $lbox_id, 'masonry', $layout, $lightbox_classes, $carousel_textual);

		if (class_exists('DOMDocument')) {
			libxml_use_internal_errors(true);
			if (function_exists('mb_convert_encoding')) $media_html = mb_convert_encoding($media_html, 'HTML-ENTITIES', 'UTF-8');
			$dom = new DOMDocument();
			@$dom->loadHTML($media_htm);
			if (class_exists('DomXpath')) {
				$xpath = new DomXpath($dom);
				foreach($xpath->query('//div[@class="t-entry-visual-overlay"]') as $e ) {
				  $e->parentNode->removeChild($e);
				}
				foreach($xpath->query('//div[@class="t-overlay-wrap"]') as $e ) {
				  $e->parentNode->removeChild($e);
				}
				$div = $xpath->query('//div[@class="t-entry-visual-cont"]')->item(0);
				$body = $dom->getElementsByTagName('body');
				if ( $body && 0<$body->length ) {
					$body = $body->item(0);
					$media_html = $dom->savehtml();
					preg_match("~<body.*?>(.*?)<\/body>~is", $media_html, $match);
					$media_html = $match[1];
				}
			}
		}
	}

	if ($media_lightbox === 'yes') {
		$media_string = str_replace('t-entry-visual-cont', 'uncode-single-media-wrapper' . $shape, $media_html);
		if ($media_attributes->post_mime_type === 'oembed/iframe') {
			$media_string .= '<div id="inline-'.$media.'" class="ilightbox-html" style="display: none;">' . $media_attributes->post_content . '</div>';
		}
	} else {
		if (!empty($a_href)) {
			$a_target = ($a_target !== '') ? ' target="' . $a_target . '"' : '';
			$a_title = ($a_title !== '') ? ' title="' . $a_title . '"' : '';
			$media_string = '<a class="single-media-link" href="' . $a_href . '"'.$a_target.$a_title.'>' . $media_string = str_replace('t-entry-visual-cont', 'uncode-single-media-wrapper' . $shape, $media_html) . '</a>';
		} else {
			$media_string = str_replace('t-entry-visual-cont', 'uncode-single-media-wrapper' . $shape, $media_html);
		}
	}
}

$output.= '<div class="' . esc_attr($css_class) . '"'.$div_data.'>';
$output.= '<div class="single-wrapper" style="max-width: ' . $actual_width . ';'.$dummy_oembed.'">';
$output.= wpb_widget_title(array('title' => $title,'extraclass' => 'wpb_singleimage_heading'));
$output.= $media_string;
$output.= '</div>';
if ($caption === 'yes' && isset($media_attributes->post_excerpt) && $media_attributes->post_excerpt !== '') $output.= '<figcaption>'.$media_attributes->post_excerpt.'</figcaption>';
$output.= '</div>';

echo uncode_remove_wpautop($output);
