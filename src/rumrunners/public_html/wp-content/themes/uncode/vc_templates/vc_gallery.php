<?php

$el_id = $isotope_mode = $gallery_back_color = $items = $random = $medias = $filtering = $filter_style = $filter_background = $filter_back_color = $filtering_full_width = $filtering_position = $filtering_uppercase = $filter_all_opposite = $filter_mobile = $filter_scroll = $filter_sticky = $style_preset = $images_size = $thumb_size = $gutter_size = $inner_padding = $single_width = $single_height = $single_back_color = $single_shape = $single_elements_click = $single_text = $single_text_visible = $single_text_visible = $single_text_anim = $single_text_anim_type = $single_overlay_visible = $single_overlay_anim = $single_image_coloration = $single_image_color_anim = $single_image_anim = $single_reduced = $single_padding = $single_text_reduced = $single_h_align = $single_v_position = $single_h_position = $single_style = $single_overlay_color = $single_overlay_coloration = $single_overlay_opacity = $single_shadow = $single_border = $single_icon = $single_title_transform = $single_title_family = $single_title_dimension = $single_title_weight = $single_title_height = $single_title_space = $single_css_animation = $single_animation_delay = $single_animation_speed = $carousel_fluid = $carousel_type = $carousel_interval = $carousel_navspeed = $carousel_loop = $carousel_nav = $carousel_dots = $carousel_nav_mobile = $carousel_nav_skin = $carousel_dots_mobile = $carousel_dots_inside = $carousel_autoh = $carousel_lg = $carousel_md = $carousel_sm = $carousel_textual = $carousel_height = $carousel_v_align = $screen_lg = $screen_md = $screen_sm = $lbox_skin = $lbox_dir = $lbox_title = $lbox_caption = $lbox_social = $lbox_deep = $lbox_no_tmb = $lbox_no_arrows = $no_double_tap = $nested = $media_items = $output = $title = $type = $el_class = '';
extract( shortcode_atts( array(
    'title' => '',
    'el_id' => '',
    'type' => 'isotope',
    'isotope_mode' => 'masonry',
    'gallery_back_color' => '',
    'items' => '',
    'random' => '',
    'medias' => '',
    'filtering' => '',
    'filter_style' => 'light',
    'filter_back_color' => '',
    'filtering_full_width' => '',
    'filtering_position' => 'left',
    'filtering_uppercase' => '',
    'filter_all_opposite' => '',
    'filter_mobile' => '',
    'filter_scroll' => '',
    'filter_sticky' => '',
    'style_preset' => 'masonry',
    'images_size' => '',
    'thumb_size' => '',
    'gutter_size' => 3,
    'inner_padding' => '',
    'single_width' => '4',
    'single_height' => '4',
    'single_back_color' => '',
    'single_shape' => '',
    'single_elements_click' => '',
    'single_text' => 'overlay',
    'single_text_visible' => '',
    'single_text_visible' => 'no',
    'single_text_anim' => 'yes',
    'single_text_anim_type' => '',
    'single_overlay_visible' => 'no',
    'single_overlay_anim' => 'yes',
    'single_image_coloration' => '',
    'single_image_color_anim' => '',
    'single_image_anim' => 'yes',
    'single_reduced' => '',
    'single_padding' => '',
    'single_text_reduced' => '',
    'single_h_align' => 'left',
    'single_v_position' => 'middle',
    'single_h_position' => 'left',
    'single_style' => 'light',
    'single_overlay_color' => '',
    'single_overlay_coloration' => '',
    'single_overlay_opacity' => 50,
    'single_shadow' => '',
    'single_border' => '',
    'single_icon' => '',
    'single_title_transform' => '',
    'single_title_family' => '',
    'single_title_dimension' => '',
    'single_title_weight' => '',
    'single_title_height' => '',
    'single_title_space' => '',
    'single_css_animation' => '',
    'single_animation_delay' => '',
    'single_animation_speed' => '',
    'carousel_fluid' => '',
    'carousel_type' => '',
    'carousel_interval' => 3000,
    'carousel_navspeed' => 400,
    'carousel_loop' => '',
    'carousel_nav' => '',
    'carousel_nav_mobile' => '',
    'carousel_nav_skin' => 'light',
    'carousel_dots' => '',
    'carousel_dots_mobile' => '',
    'carousel_dots_inside' => '',
    'carousel_autoh' => '',
    'carousel_lg' => '',
    'carousel_md' => '',
    'carousel_sm' => '',
    'carousel_textual' => '',
    'carousel_height' => 'auto',
    'carousel_v_align' => '',
    'screen_lg' => 1000,
    'screen_md' => 600,
    'screen_sm' => 480,
    'lbox_skin' => '',
    'lbox_dir' => '',
    'lbox_title' => '',
    'lbox_caption' => '',
    'lbox_social' => '',
    'lbox_deep' => '',
    'lbox_no_tmb' => '',
    'lbox_no_arrows' => '',
    'no_double_tap' => '',
    'nested' => '',
    'media_items' => 'media,icon',
    'el_class' => '',
), $atts ) );

$stylesArray = array(
    'light',
    'dark'
);

switch ($gutter_size) {
    case 0:
        $gutter_size = 'no-gutter';
        break;
    case 1:
        $gutter_size = 'px-gutter';
        break;
    case 2:
        $gutter_size = 'half-gutter';
        break;
    case 3:
    default:
        $gutter_size = 'single-gutter';
        break;
    case 4:
        $gutter_size = 'double-gutter';
        break;
}
$main_container_classes = array();
$parent_container_classes = array();
$container_classes = array();

$general_width = $single_width;
$general_height = $single_height;
$general_shape = $single_shape;
$general_iso_style = $single_style;
$general_overlay_color = $single_overlay_color;
$general_overlay_coloration = $single_overlay_coloration;
$general_overlay_opacity = $single_overlay_opacity;
$general_text = $single_text;
$general_elements_click = $single_elements_click;
$general_text_visible = $single_text_visible;
$general_text_anim = $single_text_anim;
$general_text_anim_type = $single_text_anim_type;
$general_overlay_visible = $single_overlay_visible;
$general_overlay_anim = $single_overlay_anim;
$general_image_coloration = $single_image_coloration;
$general_image_color_anim = $single_image_color_anim;
$general_image_anim = $single_image_anim;
$general_reduced = $single_reduced;
$general_padding = $single_padding;
$general_text_reduced = $single_text_reduced;
$general_h_align = $single_h_align;
$general_v_position = $single_v_position;
$general_h_position = $single_h_position;
$general_shadow = $single_shadow;
$general_border = $single_border;
$general_icon = $single_icon;
$general_back_color = $single_back_color;
$general_title_transform = $single_title_transform;
$general_title_family = $single_title_family;
$general_title_dimension = $single_title_dimension;
$general_title_weight = $single_title_weight;
$general_title_height = $single_title_height;
$general_title_space = $single_title_space;
$general_css_animation = $single_css_animation;
$general_animation_delay = $single_animation_delay;
$general_animation_speed = $single_animation_speed;

$items = json_decode( base64_decode( strip_tags( $items ) ), true);

$medias = explode( ',', $medias );
if ($random === 'yes') shuffle($medias);

$posts_counter = count( $medias );

$posts = array();
$categories = array();
$categories_array = get_terms('media-category' , array('orderby' => 'name', 'hide_empty' => true));

if ($posts_counter && $filtering === 'yes') {
  if ( ! empty( $categories_array ) ) {
    if ( ! is_wp_error( $categories_array ) ) {
      foreach ( $categories_array as $cat ) {
        foreach ($medias as $item_thumb_id) {
          if (has_term( $cat->term_id, 'media-category', $item_thumb_id )) {
            if (!isset($categories[$cat->term_id][$cat->name])) $categories[$cat->term_id][$cat->name] = array($item_thumb_id);
            else array_push($categories[$cat->term_id][$cat->name],$item_thumb_id);
          }
        }
      }
    }
  }
}

/*** init classes ***/

if ($posts_counter === 1) {
    $gutter_size = 'no-gutter';
}

if ($type == 'isotope') {
    $main_container_classes[] = 'isotope-system';
    $parent_container_classes[] = 'isotope-wrapper';
    $parent_container_classes[] = $gutter_size;
    $container_classes[] = 'isotope-container';
    $container_classes[] = 'isotope-layout';
    $container_classes[] = 'style-' . $style_preset;
    if ($inner_padding === 'yes') $parent_container_classes[] = 'isotope-inner-padding';
    if ($gallery_back_color !== '') $parent_container_classes[] = 'style-'.$gallery_back_color.'-bg';
} else if ($type == 'carousel') {
    $main_container_classes[] = 'owl-carousel-wrapper';
    $parent_container_classes[] = 'owl-carousel-container owl-carousel-loading';
    $parent_container_classes[] = $gutter_size;
    $container_classes[] = 'owl-carousel owl-element';
    if ($nested !== 'yes') $style_preset = 'masonry';
    $images_size = $thumb_size;
    if ($inner_padding === 'yes') $parent_container_classes[] = 'carousel-inner-padding';
    if ($carousel_textual === 'yes') $main_container_classes[] = 'textual-carousel';
    if ($carousel_fluid === 'yes') {
        $main_container_classes[] = 'style-metro';
        $style_preset = 'metro';
    }
    if ($carousel_v_align !== '') $container_classes[] = 'owl-valign-' . $carousel_v_align;
    if ($carousel_height !== '') $container_classes[] = 'owl-height-' . $carousel_height;
    if ($gallery_back_color !== '') $container_classes[] = 'style-'.$gallery_back_color.'-bg';
} else {
    $main_container_classes[] = 'index-system';
    $main_container_classes[] = $gutter_size;
    $parent_container_classes[] = 'index-wrapper clearfix';
    $parent_container_classes[] = 'style-' . $style_preset;
    $container_classes[] = 'index-row';
    if ($gallery_back_color !== '') $parent_container_classes[] = 'style-'.$gallery_back_color.'-bg';
}

$general_images_size = $images_size;

$main_container_classes[] = $this->getExtraClass( $el_class );

$media_blocks = uncode_flatArray(vc_sorted_list_parse_value( $media_items ));


/*** data module preparation ***/
$div_data = array();
switch ($type) {
  case 'isotope':
      $div_data['data-type'] = $style_preset;
      $div_data['data-layout'] = $isotope_mode;
      $div_data['data-lg'] = $screen_lg;
      $div_data['data-md'] = $screen_md;
      $div_data['data-sm'] = $screen_sm;
      break;
  case 'carousel':
      if ($carousel_type === 'fade') $div_data['data-fade'] = 'true';
      if ($carousel_loop === 'yes') $div_data['data-loop'] = 'true';
      if ($carousel_dots === 'yes' || $carousel_dots_mobile === 'yes') {
          if ($carousel_dots_inside === 'yes') $container_classes[] = 'owl-dots-inside';
          else $container_classes[] = 'owl-dots-outside';
      }
      if ($carousel_dots === 'yes') $div_data['data-dots'] = 'true';
      if ($carousel_dots_mobile === 'yes') $div_data['data-dotsmobile'] = 'true';
      if ($carousel_nav === 'yes') $div_data['data-nav'] = 'true';
      if ($carousel_nav_mobile === 'yes') $div_data['data-navmobile'] = 'true';
      else $div_data['data-navmobile'] = 'false';
      if ($carousel_nav === 'yes' || $carousel_nav_mobile === 'yes') $div_data['data-navskin'] = $carousel_nav_skin;
      if ($carousel_navspeed !== '') {
        $div_data['data-navspeed'] = $carousel_navspeed;
      }
      if ((int)$carousel_interval === 0 || $carousel_interval === '') {
        $div_data['data-autoplay'] = 'false';
      } else {
        $div_data['data-autoplay'] = 'true';
        $div_data['data-timeout'] = $carousel_interval;
      }
      if ($carousel_autoh === 'yes') $div_data['data-autoheight'] = 'true';
      $div_data['data-lg'] = $carousel_lg;
      $div_data['data-md'] = $carousel_md;
      $div_data['data-sm'] = $carousel_sm;
  break;
}

?>
<div<?php if ($type === 'isotope') echo ' id="' . esc_attr($el_id) .'"'; ?> class="<?php echo esc_attr(trim(implode(' ', $main_container_classes))); ?>">
  <?php if ( $posts_counter > 0 && $type === 'isotope'):  ?>
    <?php if ( $filtering === 'yes' ) :
      if (count($categories) > 1) :
        if ($filter_back_color !== '') {
          $filter_background .= ' style-'.$filter_back_color.'-bg with-bg';
        } ?>
        <div class="isotope-filters menu-container <?php echo esc_attr($gutter_size) . esc_attr($filter_background); if ($filter_mobile === 'yes') echo ' mobile-hidden table-hidden'; if ($filter_scroll === 'yes') echo ' filter-scroll'; if ($inner_padding === 'yes') echo ' filters-inner-padding'; if ($filter_sticky === 'yes') echo ' sticky-element';?>">
          <div class="menu-horizontal<?php if ($filtering_full_width !== 'yes') echo ' limit-width'; ?> menu-<?php echo esc_attr($filter_style); ?> text-<?php echo esc_attr($filtering_position); ?>">
            <ul class="menu-smart<?php  if ($filtering_uppercase === 'yes') echo ' text-uppercase'; ?>">
              <?php
                $show_all_class = 'filter-show-all';
                if ($filter_all_opposite === 'yes') {
                  if ($filtering_position === 'left') $show_all_class = ' float-right';
                  if ($filtering_position === 'right') $show_all_class = ' float-left';
                } ?>
              <li class="<?php echo esc_attr($show_all_class); ?>">
                <span>
                  <a href="#" data-filter="*" class="active">
                    <?php esc_html_e( 'Show all', 'uncode' ) ?></a>
                  </a>
                </span>
              </li>
              <?php
              foreach ( $categories as $key => $cat ): ?>
                <li class="filter-cat-<?php echo esc_attr($key); ?>"><span><a href="#" data-filter="grid-cat-<?php echo esc_attr($key); ?>" class="<?php if (isset($_GET['ucat']) && $_GET['ucat'] == $key) echo 'active'; ?>"><?php echo esc_attr( key($cat) ) ?></a></span></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
  <div class="<?php echo esc_attr(trim(implode(' ', $parent_container_classes))); ?>">
    <?php
    $div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));
    ?>
    <div<?php if ($type === 'carousel') echo ' id="' . esc_attr($el_id) .'"'; ?> class="<?php echo esc_attr(trim(implode(' ', $container_classes))); ?>" <?php echo implode(' ', $div_data_attributes); ?>>
<?php
/**
 * init loop
 */

if (count($medias) > 0) {

  foreach ($medias as $item_thumb_id) {

    $categories_css = '';
    $categories_name = array();
    $categories_id = array();
    if ( count($categories) > 1 ) {
      foreach ($categories as $key => $cat) {
        if (in_array($item_thumb_id, $cat[key($cat)])) {
          $categories_css.= ' grid-cat-' . $key;
          $categories_name[] = key($cat);
          $categories_id[] = $key;
        }
      }
    }

    $block_data = array();
    $tmb_data = array();

    $item_prop = (isset($items[$item_thumb_id . '_i'])) ? $items[$item_thumb_id . '_i'] : '';

    $typeLayout = $media_blocks;

    if (isset($item_prop['single_layout'])) {
      if (function_exists('uncode_flatArray')) {
        $typeLayout = uncode_flatArray(vc_sorted_list_parse_value($item_prop['single_layout']));
      } else {
        $typeLayout = array();
      }
    }

    if (!isset($typeLayout['media'][0]) || $typeLayout['media'][0] === '') $typeLayout['media'][0] = 'lightbox';

    $single_text = (isset($item_prop['single_text'])) ? $item_prop['single_text'] : $general_text;

    if ($type === 'carousel') {
      if ($nested) $block_classes = array('tmb-carousel');
      else $block_classes = array('tmb tmb-carousel');
    } else $block_classes = array('tmb');

    if ($no_double_tap === 'yes') $block_classes[] = 'tmb-no-double-tap';

    $title_classes = array();
    $lightbox_classes = array();

    if ($type !== 'carousel') {
      $single_width = (isset($item_prop['single_width'])) ? $item_prop['single_width'] : $general_width;
      $block_classes[] = 'tmb-iso-w' . $single_width;
    } else {
      if (!$nested) $single_width = 12 / $carousel_lg;
    }

    $single_height = (isset($item_prop['single_height'])) ? $item_prop['single_height'] : $general_height;
    $block_classes[] = 'tmb-iso-h' . $single_height;

    $images_size = (isset($item_prop['images_size'])) ? $item_prop['images_size'] : $general_images_size;

    $single_back_color = (isset($item_prop['single_back_color'])) ? $item_prop['single_back_color'] : $general_back_color;

    $single_shape = (isset($item_prop['single_shape'])) ? $item_prop['single_shape'] : $general_shape;
    if ($single_shape !== '') $block_classes[] = ($single_back_color === '' || (count($typeLayout) === 1 && array_key_exists('media',$typeLayout))) ? 'img-' . $single_shape : 'tmb-' . $single_shape;

    $single_style = (isset($item_prop['single_style'])) ? $item_prop['single_style'] : $general_iso_style;
    $block_classes[] = 'tmb-' . $single_style;

    $single_overlay_color = (isset($item_prop['single_overlay_color']) && $item_prop['single_overlay_color'] !== '') ? $item_prop['single_overlay_color'] : $general_overlay_color;
    $overlay_style = $stylesArray[!array_search($single_style, $stylesArray) ];

    if ($single_overlay_color === '') {
      if ($overlay_style === 'light') $single_overlay_color = 'light';
      else $single_overlay_color = 'dark';
    }

    $single_overlay_color = 'style-' . $single_overlay_color .'-bg';

    $single_overlay_coloration = (isset($item_prop['single_overlay_coloration'])) ? $item_prop['single_overlay_coloration'] : $general_overlay_coloration;
    switch ($single_overlay_coloration) {
      case 'top_gradient':
        $block_classes[] = 'tmb-overlay-gradient-top';
        $single_overlay_color = '';
      break;
      case 'bottom_gradient':
        $block_classes[] = 'tmb-overlay-gradient-bottom';
        $single_overlay_color = '';
      break;
    }

    $single_overlay_opacity = (isset($item_prop['single_overlay_opacity'])) ? $item_prop['single_overlay_opacity'] : $general_overlay_opacity;

    $single_elements_click = (isset($item_prop['single_elements_click'])) ? $item_prop['single_elements_click'] : $general_elements_click;

    $single_h_align = (isset($item_prop['single_h_align'])) ? $item_prop['single_h_align'] : $general_h_align;

    $single_text_visible = (isset($item_prop['single_text_visible'])) ? $item_prop['single_text_visible'] : $general_text_visible;
    if ($single_text_visible === 'yes') $block_classes[] = 'tmb-text-showed';

    $single_text_anim = (isset($item_prop['single_text_anim'])) ? $item_prop['single_text_anim'] : $general_text_anim;
    if ($single_text_anim === 'yes') $block_classes[] = 'tmb-overlay-text-anim';

    $single_text_anim_type = (isset($item_prop['single_text_anim_type'])) ? $item_prop['single_text_anim_type'] : $general_text_anim_type;
    if ($single_text_anim_type === 'btt') $block_classes[] = 'tmb-reveal-bottom';

    $single_overlay_visible = (isset($item_prop['single_overlay_visible'])) ? $item_prop['single_overlay_visible'] : $general_overlay_visible;
    if ($single_overlay_visible === 'yes') $block_classes[] = 'tmb-overlay-showed';

    $single_overlay_anim = (isset($item_prop['single_overlay_anim'])) ? $item_prop['single_overlay_anim'] : $general_overlay_anim;
    if ($single_overlay_anim === 'yes') $block_classes[] = 'tmb-overlay-anim';

    if ($single_text === 'overlay') {

      $single_h_position = (isset($item_prop['single_h_position'])) ? $item_prop['single_h_position'] : $general_h_position;

      $single_reduced = (isset($item_prop['single_reduced'])) ? $item_prop['single_reduced'] : $general_reduced;
      if ($single_reduced !== '') {
        switch ($single_reduced) {
          case 'three_quarter':
            $block_classes[] = 'tmb-overlay-text-reduced';
          break;
          case 'half':
            $block_classes[] = 'tmb-overlay-text-reduced-2';
          break;
        }
        if ($single_h_position !== '') $block_classes[] = 'tmb-overlay-' . $single_h_position;
      }

      $single_v_position = (isset($item_prop['single_v_position'])) ? $item_prop['single_v_position'] : $general_v_position;
      if ($single_v_position !== '') $block_classes[] = 'tmb-overlay-' . $single_v_position;
      if ($single_h_align !== '') $block_classes[] = 'tmb-overlay-text-' . $single_h_align;
    } else {
      $block_classes[] = 'tmb-content-' . $single_h_align;
    }

    $single_text_reduced = (isset($item_prop['single_text_reduced'])) ? $item_prop['single_text_reduced'] : $general_text_reduced;
    if ($single_text_reduced === 'yes') $block_classes[] = 'tmb-text-space-reduced';

    $single_image_coloration = (isset($item_prop['single_image_coloration'])) ? $item_prop['single_image_coloration'] : $general_image_coloration;
    if ($single_image_coloration === 'desaturated') $block_classes[] = 'tmb-desaturated';

    $single_image_color_anim = (isset($item_prop['single_image_color_anim'])) ? $item_prop['single_image_color_anim'] : $general_image_color_anim;
    if ($single_image_color_anim === 'yes') $block_classes[] = 'tmb-image-color-anim';

    $single_image_anim = (isset($item_prop['single_image_anim'])) ? $item_prop['single_image_anim'] : $general_image_anim;
    if ($single_image_anim === 'yes' && $carousel_textual !== 'yes') $block_classes[] = 'tmb-image-anim';

    $single_icon = (isset($item_prop['single_icon'])) ? $item_prop['single_icon'] : $general_icon;

    $single_shadow = (isset($item_prop['single_shadow'])) ? $item_prop['single_shadow'] : $general_shadow;
    if ($single_shadow === 'yes') {
      $block_classes[] = 'tmb-shadowed';
    }

    $single_border = (isset($item_prop['single_border'])) ? $item_prop['single_border'] : $general_border;
    if ($single_border !== 'yes' && $carousel_textual !== 'yes') $block_classes[] = 'tmb-bordered';

    $single_title_transform = (isset($item_prop['single_title_transform'])) ? $item_prop['single_title_transform'] : $general_title_transform;
    if ($single_title_transform !== '') $block_classes[] = 'tmb-entry-title-' . $single_title_transform;

    $single_title_family = (isset($item_prop['single_title_family'])) ? $item_prop['single_title_family'] : $general_title_family;
    if ($single_title_family !== '') $title_classes[] = $single_title_family;

  $single_title_dimension = (isset($item_prop['single_title_dimension'])) ? $item_prop['single_title_dimension'] : $general_title_dimension;

    if ($single_title_dimension !== '') $title_classes[] = $single_title_dimension;
    else {
      if ($style_preset === 'metro') {
        switch ($single_width) {
          case 1:
          case 2:
            $title_classes[] = 'h6';
          break;
          case 3:
            $title_classes[] = 'h5';
          break;
          case 4:
            $title_classes[] = 'h4';
          break;
          case 6:
          case 7:
          case 8:
            $title_classes[] = 'h3';
          break;
          case 9:
          case 10:
            $title_classes[] = 'h2';
          break;
          case 11:
          case 12:
            $title_classes[] = 'h1';
          break;
        }
      } else {
        $title_classes[] = 'h6';
      }
    }

    $single_title_weight = (isset($item_prop['single_title_weight'])) ? $item_prop['single_title_weight'] : $general_title_weight;
    if ($single_title_weight !== '') $title_classes[] = 'font-weight-' . $single_title_weight;

    $single_title_height = (isset($item_prop['single_title_height'])) ? $item_prop['single_title_height'] : $general_title_height;
    if ($single_title_height !== '') $title_classes[] = $single_title_height;

    $single_title_space = (isset($item_prop['single_title_space'])) ? $item_prop['single_title_space'] : $general_title_space;
    if ($single_title_space !== '') $title_classes[] = $single_title_space;

    $single_animation_delay = (isset($item_prop['single_animation_delay'])) ? $item_prop['single_animation_delay'] : $general_animation_delay;

    $single_animation_speed = (isset($item_prop['single_animation_speed'])) ? $item_prop['single_animation_speed'] : $general_animation_speed;

    $single_css_animation = (isset($item_prop['single_css_animation'])) ? $item_prop['single_css_animation'] : $general_css_animation;
    if ($single_css_animation !== '') {
      $block_data['animation'] = ' animate_when_almost_visible ' . $single_css_animation;
      if ($single_animation_delay !== '') $tmb_data['data-delay'] = $single_animation_delay;
      if ($single_animation_speed !== '') $tmb_data['data-speed'] = $single_animation_speed;
    }

    $block_classes[] = $categories_css;
    $block_data['classes'] = $block_classes;
    $block_data['tmb_data'] = $tmb_data;
    $block_data['media_id'] = $item_thumb_id;
    $block_data['images_size'] = $images_size;
    $block_data['single_style'] = $single_style;
    $block_data['single_text'] = $single_text;
    $block_data['single_elements_click'] = $single_elements_click;
    $block_data['overlay_opacity'] = $single_overlay_opacity;
    $block_data['overlay_color'] = $single_overlay_color;
    $block_data['single_width'] = $single_width;
    $block_data['single_height'] = $single_height;
    $block_data['single_back_color'] = $single_back_color;
    $block_data['single_icon'] = $single_icon;
    $block_data['title_classes'] = $title_classes;
    $block_data['single_categories'] = $categories_name;
    $block_data['single_categories_id'] = $categories_id;

    $single_padding = (isset($item_prop['single_padding'])) ? $item_prop['single_padding'] : $general_padding;

    switch ($single_padding) {
      case 0:
        $block_data['text_padding'] = 'no-block-padding';
      break;
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

    if (isset($typeLayout['media'][0]) && $typeLayout['media'][0] === 'custom_link')
    {
      if (isset($item_prop['single_link']) && $item_prop['single_link'] != '')
      {
        $block_data['link'] = vc_build_link($item_prop['single_link']);
      }
    }
    else if (isset($typeLayout['media'][0]) && $typeLayout['media'][0] === 'nolink')
    {
      $block_data['link_class'] = 'inactive-link';
      $block_data['link'] = '#';
    }
    else
    {
      if ($lbox_skin !== '') $lightbox_classes['data-skin'] = $lbox_skin;
      if ($lbox_title !== '') $lightbox_classes['data-title'] = true;
      if ($lbox_caption !== '') $lightbox_classes['data-caption'] = true;
      if ($lbox_dir !== '') $lightbox_classes['data-dir'] = $lbox_dir;
      if ($lbox_social !== '') $lightbox_classes['data-social'] = true;
      if ($lbox_deep !== '') $lightbox_classes['data-deep'] = $el_id;
      if ($lbox_no_tmb !== '') $lightbox_classes['data-notmb'] = true;
      if ($lbox_no_arrows !== '') $lightbox_classes['data-noarr'] = true;
      if (count($lightbox_classes) === 0) $lightbox_classes['data-active'] = true;
    }

    if (isset($typeLayout['media'][1]) && $typeLayout['media'][1] === 'poster') $block_data['poster'] = true;

    echo uncode_create_single_block($block_data, $el_id, $style_preset, $typeLayout, $lightbox_classes, $carousel_textual);
  }
} ?>
        </div>
    </div>
</div>