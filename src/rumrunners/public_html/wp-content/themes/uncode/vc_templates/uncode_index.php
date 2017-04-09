<?php

global $uncode_post_types;
$title = $index_type = $isotope_mode = $index_back_color = $items = $filtering = $filter_style = $filter_back_color = $filtering_full_width = $filtering_position = $filtering_uppercase = $filter_all_opposite = $filter_mobile = $filter_scroll = $footer_style = $footer_back_color = $footer_full_width = $pagination = $infinite = $infinite_button = $infinite_button_text = $infinite_button_shape = $infinite_button_outline = $infinite_button_color = $style_preset = $images_size = $thumb_size = $single_width = $single_height = $single_back_color = $single_shape = $single_text = $single_elements_click = $single_text_visible = $single_text_anim = $single_text_anim_type = $single_overlay_visible = $single_overlay_anim = $single_image_coloration = $single_image_color_anim = $single_image_anim = $single_reduced = $single_padding = $single_text_reduced = $single_h_align = $single_h_align_mobile = $single_v_position = $single_h_position = $single_style = $single_overlay_color = $single_overlay_coloration = $single_overlay_opacity = $single_shadow = $single_border = $single_icon = $single_title_transform = $single_title_weight = $single_title_family = $single_title_dimension = $single_title_height = $single_title_space = $single_text_lead = $single_css_animation = $single_animation_delay = $single_animation_speed = $carousel_height = $carousel_v_align = $carousel_type = $carousel_interval = $carousel_navspeed = $carousel_loop = $carousel_nav = $carousel_nav_mobile = $carousel_nav_skin = $carousel_dots = $carousel_dots_mobile = $carousel_dots_inside = $carousel_autoh = $carousel_lg = $carousel_md = $carousel_sm = $gutter_size = $inner_padding = $post_items = $portfolio_items = $page_items = $product_items = $screen_lg = $screen_md = $screen_sm = $filter = $el_id = $lbox_skin = $lbox_dir = $lbox_title = $lbox_caption = $lbox_social = $lbox_deep = $lbox_no_tmb = $lbox_no_arrows = $no_double_tap = $el_class = $orderby = $order = $custom_order = $order_ids = $css_class = $filter = $filter_background = $filter_sticky = $offset = $search_query = $using_plugin = '';
$post_types = array();
$wc_filtered = array();

$attributes_first = array(
  'title' => '',
  'index_type' => 'isotope',
  'isotope_mode' => 'masonry',
  'index_back_color' => '',
  'items' => '',
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
  'footer_style' => 'light',
  'footer_back_color' => '',
  'footer_full_width' => '',
  'pagination' => '',
  'infinite' => '',
  'infinite_button' => '',
  'infinite_button_text' => '',
  'infinite_button_shape' => '',
  'infinite_button_outline' => '',
  'infinite_button_color' => '',
  'style_preset' => 'masonry',
  'images_size' => '',
  'thumb_size' => '',
  'single_width' => '4',
  'single_height' => '4',
  'single_back_color' => '',
  'single_shape' => '',
  'single_text' => 'under',
  'single_elements_click' => '',
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
  'single_h_align_mobile' => '',
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
  'single_title_weight' => '',
  'single_title_family' => '',
  'single_title_dimension' => '',
  'single_title_height' => '',
  'single_title_space' => '',
  'single_text_lead' => '',
  'single_css_animation' => '',
  'single_animation_delay' => '',
  'single_animation_speed' => '',
  'carousel_height' => 'auto',
  'carousel_v_align' => '',
  'carousel_type' => '',
  'carousel_interval' => 3000,
  'carousel_navspeed' => 400,
  'carousel_loop' => '',
  'carousel_nav' => '',
  'carousel_nav_skin' => 'light',
  'carousel_nav_mobile' => '',
  'carousel_dots' => '',
  'carousel_dots_mobile' => '',
  'carousel_dots_inside' => '',
  'carousel_autoh' => '',
  'carousel_lg' => '',
  'carousel_md' => '',
  'carousel_sm' => '',
  'gutter_size' => 3,
  'inner_padding' => '',
  'post_items' => 'media|featured|onpost|original,title,category|nobg,date,text|excerpt,link|default,author,sep-one|full,extra',
  'page_items' => 'media|featured,title,type,category,text',
  'product_items' => 'media|featured,title,type,category,text,price',
  'screen_lg' => 1000,
  'screen_md' => 600,
  'screen_sm' => 480,
  'filter' => '',
  'el_id' => '',
  'lbox_skin' => '',
  'lbox_dir' => '',
  'lbox_title' => '',
  'lbox_caption' => '',
  'lbox_social' => '',
  'lbox_deep' => '',
  'lbox_no_tmb' => '',
  'lbox_no_arrows' => '',
  'no_double_tap' => '',
  'el_class' => '',
  'orderby' => NULL,
  'order' => 'DESC',
  'custom_order' => '',
  'order_ids' => '',
  'loop' => 'size:10|order_by:date|post_type:post',
  'offset' => '',
  'using_plugin' => '',
  'css_class' => ''
);

$attributes_second = array();

if (!isset($uncode_post_types)) $uncode_post_types = uncode_get_post_types();
if (isset($uncode_post_types) && !empty($uncode_post_types)) {
  foreach ($uncode_post_types as $key => $value) {
    $post_types[] = $value;
    if (isset($atts[$value . '_items']) && strpos($value, '-') !== false) {
      $new_key = str_replace('-', '_', $value);
      $atts[$new_key . '_items'] = $atts[$value . '_items'];
      unset($atts[$value . '_items']);
      $value = $new_key;
    }
    $attributes_second[$value . '_items'] = 'media|featured,title,type,category,text';
  }
}

$post_types[] = 'post';
$post_types[] = 'page';

$attributes = array_merge($attributes_first, $attributes_second);

extract( shortcode_atts($attributes , $atts ) );

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

$stylesArray = array(
  'light',
  'dark'
);
$general_style = ot_get_option('_uncode_general_style');
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
$general_h_align_mobile = $single_h_align_mobile;
$general_v_position = $single_v_position;
$general_h_position = $single_h_position;
$general_shadow = $single_shadow;
$general_border = $single_border;
$general_icon = $single_icon;
$general_back_color = $single_back_color;
$general_title_transform = $single_title_transform;
$general_title_weight = $single_title_weight;
$general_title_family = $single_title_family;
$general_title_dimension = $single_title_dimension;
$general_title_height = $single_title_height;
$general_title_space = $single_title_space;
$general_text_lead = $single_text_lead;
$general_css_animation = $single_css_animation;
$general_animation_delay = $single_animation_delay;
$general_animation_speed = $single_animation_speed;

$this->resetTaxonomies();
if ( empty( $loop ) ) return;
$loop_parse = uncode_parse_loop_data($loop);

global $wp_query, $temp_index_id;

$temp_index_id = $el_id;
$paged = (get_query_var('paged')) ? get_query_var('paged') : (isset($wp_query->query['paged']) ? $wp_query->query['paged'] : 1);

if (class_exists('WC_Query') && ( isset( $_GET['max_price'] ) || isset( $_GET['min_price'] ) )) {
  global $woocommerce;
  if( version_compare( $woocommerce->version, '2.6', "<" ) ) {
    $instanceWC_Query = new WC_Query();
    $wc_filtered = $instanceWC_Query->price_filter();
    if (!empty($wc_filtered)) {
      $wc_filtered = (implode(',', array_filter($wc_filtered)));
    }
  } else {
    $products_ids = wp_list_pluck( $wp_query->posts, 'ID' );
    $wc_filtered = (implode(',', array_filter($products_ids)));
  }
  $loop .= '|by_id:' . $wc_filtered;
}

if (isset($_GET['upage'])) $paged = $_GET['upage'];
if ($infinite !== 'yes') {
  $loop_pagination = $loop;
  if(isset($_GET['ucat'])) $loop .= '|category:'.$_GET['ucat'];
}
$loop .= '|paged:' . $paged;

if (function_exists('is_plugin_active') && is_plugin_active( 'relevanssi/relevanssi.php' ) && is_search() && $using_plugin === 'yes') {
  $search_query = $wp_query;
}

$this->getLoop( $loop, $offset );

if ($search_query === '') $my_query = $this->query;
else $my_query = $search_query;

$args = $this->loop_args;
if (isset($loop_parse['by_id']) && isset($loop_parse['order']) && $loop_parse['order'] === 'none') {
  $custom_order = 'yes';
  $order_ids = $loop_parse['by_id'];
}

if ($custom_order === 'yes') {
  if ($order_ids !== '') {
    $post_list = explode(',', $order_ids);
    $ordered = array();
    foreach($post_list as $key) {
      foreach($my_query->posts as $skey => $spost) {
        if($key == $spost->ID) {
          $ordered[] = $spost;
          unset($my_query->posts[$skey]);
        }
      }
    }
    $my_query->posts = array_merge($ordered, $my_query->posts);
  }
}

$post_blocks = array();
foreach ($post_types as $key => $value) {
  $value = str_replace('-', '_', $value);
  $post_blocks['uncode_' . $value] = uncode_flatArray(vc_sorted_list_parse_value( ${$value . '_items'} ));
}

$posts = array();
$this->filter_categories = array();
while ( $my_query->have_posts() ) {
  $my_query->the_post(); // Get post from query
  $post = new stdClass(); // Creating post object.
  $post->id = get_the_ID();
  $post->title = get_the_title($post->id);
  $post->type = get_post_type( $post->id );
  $post->format = ($post->type === 'post') ? get_post_format( $post->id ) : '';
  $post->link = get_permalink( $post->id );
  $post->content = get_the_content();
  $post_category = $this->getCategoriesCss( $post->id );
  $post->categories_css = $post_category['cat_css'];
  $post->categories_name = $post_category['cat_name'];
  $post->tags_name = $post_category['tag'];
  $post->categories_id = $post_category['cat_id'];
  $posts[] = $post;
}
wp_reset_query();
$parent_container_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $atts );
$parent_container_classes = array_filter($parent_container_classes);
$items = json_decode( base64_decode( strip_tags( $items ) ), true);

$posts_counter = count( $posts );

/*** init classes ***/

if ($posts_counter === 1) {
    $gutter_size = 'no-gutter';
}

if ($index_type == 'isotope') {
  $main_container_classes[] = 'isotope-system';
  $main_container_classes[] = 'isotope-general-' . $general_style;
  $parent_container_classes[] = 'isotope-wrapper';
  $parent_container_classes[] = $gutter_size;
  $container_classes[] = 'isotope-container';
  $container_classes[] = 'isotope-layout';
  $container_classes[] = 'style-' . $style_preset;
  if ($inner_padding === 'yes') $parent_container_classes[] = 'isotope-inner-padding';
  if ( $infinite === 'yes' && $pagination !== 'yes')  {
    $container_classes[] = 'isotope-infinite';
    if ($infinite_button === 'yes') $container_classes[] = 'isotope-infinite-button';
  }
  else $container_classes[] = 'isotope-pagination';
  if ($index_back_color !== '') $parent_container_classes[] = 'style-'.$index_back_color.'-bg';
} else if ($index_type == 'carousel') {
  $main_container_classes[] = 'owl-carousel-wrapper';
  $parent_container_classes[] = 'owl-carousel-container owl-carousel-loading';
  $parent_container_classes[] = $gutter_size;
  $container_classes[] = 'owl-carousel owl-element';
  $style_preset = 'masonry';
  $images_size = $thumb_size;
  if ($inner_padding === 'yes') $parent_container_classes[] = 'carousel-inner-padding';
  if ($carousel_v_align !== '') $container_classes[] = 'owl-valign-' . $carousel_v_align;
  if ($carousel_height !== '') $container_classes[] = 'owl-height-' . $carousel_height;
  if ($index_back_color !== '') $container_classes[] = 'style-'.$index_back_color.'-bg';
} else {
  $main_container_classes[] = 'index-system';
  $main_container_classes[] = $gutter_size;
  $parent_container_classes[] = 'index-wrapper clearfix';
  $parent_container_classes[] = 'style-' . $style_preset;
  $container_classes[] = 'index-row';
  if ( $infinite === 'yes' && $pagination !== 'yes')  {
    $parent_container_classes[] = 'index-infinite';
    if ($infinite_button === 'yes') $parent_container_classes[] = 'index-infinite-button';
  }
  else $parent_container_classes[] = 'index-pagination';
  if ($index_back_color !== '') $parent_container_classes[] = 'style-'.$index_back_color.'-bg';
}

$general_images_size = $images_size;

$main_container_classes[] = trim($this->getExtraClass( $el_class ));

?>
<div<?php if ($index_type === 'isotope') echo ' id="' . esc_attr($el_id) .'"'; ?> class="<?php echo esc_attr(trim(implode(' ', $main_container_classes))); ?>">
    <?php if ( $posts_counter > 0 && $index_type === 'isotope'):  ?>
    <?php if ( $filtering === 'yes') :
        $this->resetTaxonomies();
        $categories_array = array();
        if ($infinite === 'yes' || $pagination != 'yes') {
          if (count($this->filter_categories) != 0) $categories_array = $this->getFilterCategories();
        }
        else {
          $parse_query = $this->parseData($loop_pagination);
          $parse_query['size'] = '-1';
          $this->getLoop( $parse_query );
          $my_query_filter = $this->query;
          foreach ($my_query_filter->posts as &$value) {
            $get_cat = $this->getCategoriesCss( $value->ID );
            $post->categories_css = $get_cat['cat_css'];
          }
          if (count($this->filter_categories) != 0) $categories_array = $this->getFilterCategories();
          wp_reset_query();
        }

        if (count($categories_array) > 1 || ($infinite === 'yes' && $filtering === 'yes')) :
          if ($filter_back_color !== '') {
            $filter_background .= ' style-'.$filter_back_color.'-bg with-bg';
          }
        ?>
          <div class="isotope-filters menu-container <?php echo esc_attr($gutter_size) . esc_attr($filter_background); if ($filter_mobile === 'yes') echo ' mobile-hidden table-hidden'; if ($filter_scroll === 'yes') echo ' filter-scroll'; if ($inner_padding === 'yes') echo ' filters-inner-padding'; if ($filter_sticky === 'yes') echo ' sticky-element';?>">
              <div class="menu-horizontal<?php if ($filtering_full_width !== 'yes') echo ' limit-width'; ?> menu-<?php echo esc_attr($filter_style); ?> text-<?php echo esc_attr($filtering_position); ?>">
                  <ul class="menu-smart<?php  if ($filtering_uppercase === 'yes') echo ' text-uppercase'; ?>">
                      <?php
                        global $wp;
                        $current_url = home_url(add_query_arg(array(),$wp->request));
                        $show_all_class = 'filter-show-all';
                        if ($filter_all_opposite === 'yes') {
                          if ($filtering_position === 'left') $show_all_class = ' float-right';
                          if ($filtering_position === 'right') $show_all_class = ' float-left';
                        }
                      ?>
                      <li class="<?php echo esc_attr($show_all_class); ?>">
                          <span>
                      <?php if ($infinite === 'yes' || $pagination !== 'yes' || $my_query->max_num_pages == 1) : ?>
                          <a href="#" data-filter="*" class="<?php if (!isset($_GET['ucat'])) echo 'active'; ?>">
                      <?php else: ?>
                          <a href="<?php echo $current_url; ?>" class="<?php if (isset($_GET['ucat'])) echo 'active'; ?>">
                      <?php endif; ?>
                          <?php esc_html_e( 'Show all', 'uncode' ) ?></a>
                          </span>
                      </li>
                  <?php foreach ( $categories_array as $cat ):
                      if ($cat->taxonomy !== 'product_type'): ?>
                      <?php if (($infinite === 'yes' || $pagination !== 'yes' || $my_query->max_num_pages == 1) && !isset($_GET['ucat'])) : ?>
                      <li class="filter-cat-<?php echo esc_attr($cat->term_id); ?>"><span><a href="#" data-filter="grid-cat-<?php echo esc_attr($cat->term_id); ?>" class="<?php if (isset($_GET['ucat']) && $_GET['ucat'] == $cat->term_id) echo 'active'; ?>"><?php echo esc_attr( $cat->name ) ?></a></span></li>
                      <?php else: ?>
                      <li class="filter-cat-<?php echo esc_attr($cat->term_id); ?>"><span><a href="<?php echo $current_url; ?>?id=<?php echo esc_attr($el_id); ?>&amp;ucat=<?php echo esc_attr($cat->term_id); ?>" class="<?php if (isset($_GET['ucat']) && $_GET['ucat'] == $cat->term_id) echo 'active'; ?>"><?php echo esc_attr( $cat->name ) ?></a></span></li>
                      <?php endif; ?>
                  <?php endif;
                  endforeach; ?>
                  </ul>
              </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>
    <?php

    /*** data module preparation ***/
    $div_data = array();
    switch ($index_type) {
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

    $div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

    ?>
    <div class="<?php echo esc_attr(trim(implode(' ', $parent_container_classes))); ?>">
      <div<?php if ($index_type === 'carousel') echo ' id="' . esc_attr($el_id) .'"'; ?> class="<?php if ($posts_counter > 0) echo esc_attr(trim(implode(' ', $container_classes))); ?>" <?php echo implode(' ', $div_data_attributes); ?>>
        <?php if ( $posts_counter > 0 ):
          foreach ( $posts as $post ):

            if (!in_array($post->type, $post_types)) continue;
            $block_data = array();
            $tmb_data = array();
            $item_thumb_id = '';

            if ($index_type === 'carousel') $block_classes = array('tmb tmb-carousel');
            else $block_classes = array('tmb');

            $title_classes = array();
            $lightbox_classes = array();

            if (!empty($post->format)) $block_classes[] = 'tmb-format-' . $post->format;

            $item_prop = (isset($items[$post->id . '_i'])) ? $items[$post->id . '_i'] : '';

            if ($post->type === 'product') {
              $block_classes[] = 'tmb-woocommerce';
              $block_data['product'] = true;
            }
            else $block_data['product'] = false;

            $typeLayout = $post_blocks['uncode_' . str_replace('-', '_', $post->type)];
            if (isset($item_prop['single_layout'])) $typeLayout = uncode_flatArray(vc_sorted_list_parse_value($item_prop['single_layout']));

            $single_text = (isset($item_prop['single_text'])) ? $item_prop['single_text'] : $general_text;

            if ($index_type !== 'carousel') {
              $single_width = (isset($item_prop['single_width'])) ? $item_prop['single_width'] : $general_width;
              $block_classes[] = 'tmb-iso-w' . $single_width;
            } else {
              $single_width = 12 / $carousel_lg;
            }

            $single_height = (isset($item_prop['single_height'])) ? $item_prop['single_height'] : $general_height;
            $block_classes[] = 'tmb-iso-h' . $single_height;

            $images_size = (isset($item_prop['images_size'])) ? $item_prop['images_size'] : $general_images_size;

            $single_back_color = (isset($item_prop['single_back_color'])) ? $item_prop['single_back_color'] : $general_back_color;

            $single_shape = (isset($item_prop['single_shape'])) ? $item_prop['single_shape'] : $general_shape;
            if ($single_shape !== '') $block_classes[] = ($single_back_color === '' || (count($typeLayout) === 1 && array_key_exists('media',$typeLayout))) ? 'img-' . $single_shape : 'tmb-' . $single_shape;

            if (!array_key_exists('media',$typeLayout) && $single_text === 'overlay' && $style_preset === 'masonry') $block_classes[] = 'tmb-no-media';

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
                    break;
                case 'bottom_gradient':
                    $block_classes[] = 'tmb-overlay-gradient-bottom';
                    break;
            }

            $single_overlay_opacity = (isset($item_prop['single_overlay_opacity'])) ? $item_prop['single_overlay_opacity'] : $general_overlay_opacity;

            $single_elements_click = (isset($item_prop['single_elements_click'])) ? $item_prop['single_elements_click'] : $general_elements_click;

            $single_h_align = (isset($item_prop['single_h_align'])) ? $item_prop['single_h_align'] : $general_h_align;
            $single_h_align_mobile = (isset($item_prop['single_h_align_mobile'])) ? $item_prop['single_h_align_mobile'] : $general_h_align_mobile;

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
                if ($single_h_align_mobile !== '') $block_classes[] = 'tmb-overlay-text-mobile-' . $single_h_align_mobile;
            } else {
                $block_classes[] = 'tmb-content-' . $single_h_align;
                if ($single_h_align_mobile !== '') $block_classes[] = 'tmb-content-mobile-' . $single_h_align_mobile;
            }

            $single_text_reduced = (isset($item_prop['single_text_reduced'])) ? $item_prop['single_text_reduced'] : $general_text_reduced;
            if ($single_text_reduced === 'yes') $block_classes[] = 'tmb-text-space-reduced';

            $single_image_coloration = (isset($item_prop['single_image_coloration'])) ? $item_prop['single_image_coloration'] : $general_image_coloration;
            if ($single_image_coloration === 'desaturated') $block_classes[] = 'tmb-desaturated';

            $single_image_color_anim = (isset($item_prop['single_image_color_anim'])) ? $item_prop['single_image_color_anim'] : $general_image_color_anim;
            if ($single_image_color_anim === 'yes') $block_classes[] = 'tmb-image-color-anim';

            $single_image_anim = (isset($item_prop['single_image_anim'])) ? $item_prop['single_image_anim'] : $general_image_anim;
            if ($single_image_anim === 'yes') $block_classes[] = 'tmb-image-anim';

            $single_icon = (isset($item_prop['single_icon'])) ? $item_prop['single_icon'] : $general_icon;

            $single_shadow = (isset($item_prop['single_shadow'])) ? $item_prop['single_shadow'] : $general_shadow;
            if ($single_shadow === 'yes') {
              $block_classes[] = 'tmb-shadowed';
            }

            $single_border = (isset($item_prop['single_border'])) ? $item_prop['single_border'] : $general_border;
            if ($single_border !== 'yes') $block_classes[] = 'tmb-bordered';

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

            $single_text_lead = (isset($item_prop['single_text_lead'])) ? $item_prop['single_text_lead'] : $general_text_lead;
            if ($single_text_lead === 'yes') $block_data['text_lead'] = 'yes';

            $single_animation_delay = (isset($item_prop['single_animation_delay'])) ? $item_prop['single_animation_delay'] : $general_animation_delay;
            $single_animation_speed = (isset($item_prop['single_animation_speed'])) ? $item_prop['single_animation_speed'] : $general_animation_speed;
            $single_css_animation = (isset($item_prop['single_css_animation'])) ? $item_prop['single_css_animation'] : $general_css_animation;

            $single_css_animation = (isset($item_prop['single_css_animation'])) ? $item_prop['single_css_animation'] : $general_css_animation;
            if ($single_css_animation !== '') {
              $block_data['animation'] = ' animate_when_almost_visible ' . $single_css_animation;
              if ($single_animation_delay !== '') $tmb_data['data-delay'] = $single_animation_delay;
              if ($single_animation_speed !== '') $tmb_data['data-speed'] = $single_animation_speed;
            }

            if (isset($typeLayout['media']) && isset($typeLayout['media'][0])) {
              switch ($typeLayout['media'][0]) {
                case 'featured':
                  $item_thumb_id = get_post_thumbnail_id($post->id);
                  if ($item_thumb_id === '') {
                    $item_thumb_id = get_post_meta( $post->id, '_uncode_featured_media', 1);
                    $medias = explode(',', $item_thumb_id);
                    if (is_array($medias) && isset($medias[0])) $item_thumb_id = $medias[0];
                  }
                break;
                case 'media':
                  $item_thumb_id = get_post_meta( $post->id, '_uncode_featured_media', 1);
                  if ($item_thumb_id === '') $item_thumb_id = get_post_thumbnail_id($post->id);
                break;
                case 'custom':
                  $item_thumb_id = $item_prop['back_image'];
                break;
              }
            }

            if (isset($typeLayout['media']) && $item_thumb_id === '' && $single_text !== 'overlay') {
              unset($typeLayout['media']);
              if ($single_back_color === '') $item_prop['single_padding'] = 0;
            }

            $block_classes[] = $post->categories_css;
            if ($no_double_tap === 'yes') $block_classes[] = 'tmb-no-double-tap';

            $block_data['id'] = $post->id;
            $block_data['content'] = $post->content;
            $block_data['classes'] = $block_classes;
            $block_data['tmb_data'] = $tmb_data;
            $block_data['media_id'] = $item_thumb_id;
            $block_data['images_size'] = $images_size;
            $block_data['single_style'] = $single_style;
            $block_data['single_text'] = $single_text;
            $block_data['single_elements_click'] = $single_elements_click;
            $block_data['overlay_opacity'] = $single_overlay_opacity;
            $block_data['overlay_color'] = $single_overlay_color;
            $block_data['overlay_style'] = $overlay_style;
            $block_data['single_width'] = $single_width;
            $block_data['single_height'] = $single_height;
            $block_data['single_back_color'] = $single_back_color;
            $block_data['single_icon'] = $single_icon;
            $block_data['single_title'] = $post->title;

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

            if (isset($item_prop['text_length'])) $block_data['text_length'] = $item_prop['text_length'];

            if (isset($item_prop['single_link']) && $item_prop['single_link'] != '') {
              $post->link = $item_prop['single_link'];
              $link = vc_build_link( $item_prop['single_link'] );
              $post->link = $link['url'];
              $a_title = $link['title'];
              $a_target = $link['target'];
              $block_data['link'] = $link;
            } else {
              $block_data['link'] = array(
                'url' => $post->link,
                'target' => '_self'
              );
            }

            $block_data['title_classes'] = $title_classes;
            if ($single_text === 'overlay' && $single_elements_click !== 'yes') {
              $block_data['single_categories'] = $post->categories_name;
              $block_data['single_tags'] = $post->tags_name;
            } else $block_data['single_categories'] = $this->getCategoriesLink( $post->id );

            $block_data['single_categories_id'] = $post->categories_id;

            if (isset($typeLayout['media'][1]) && $typeLayout['media'][1] === 'lightbox') {
              if ($lbox_skin !== '') $lightbox_classes['data-skin'] = $lbox_skin;
              if ($lbox_title !== '') $lightbox_classes['data-title'] = true;
              if ($lbox_caption !== '') $lightbox_classes['data-caption'] = true;
              if ($lbox_dir !== '') $lightbox_classes['data-dir'] = $lbox_dir;
              if ($lbox_social !== '') $lightbox_classes['data-social'] = true;
              if ($lbox_deep !== '') $lightbox_classes['data-deep'] = $el_id;
              if ($lbox_no_tmb !== '') $lightbox_classes['data-notmb'] = true;
              if ($lbox_no_arrows !== '') $lightbox_classes['data-noarr'] = true;
              if (count($lightbox_classes) === 0) $lightbox_classes['data-active'] = true;
            } else if (isset($typeLayout['media'][1]) && $typeLayout['media'][1] === 'nolink') {
              $block_data['link_class'] = 'inactive-link';
              $block_data['link'] = '#';
            }

            if (isset($typeLayout['media'][2]) && $typeLayout['media'][2] === 'poster') $block_data['poster'] = true;
            else $block_data['poster'] = false;

            echo uncode_create_single_block($block_data, $el_id, $style_preset, $typeLayout, $lightbox_classes, 'no');

          endforeach;
        else: ?>
        <div class="tmb tmb-iso-w12 tmb-iso-h1"><p class="t-entry-title"><?php esc_html_e( "Nothing found.", "uncode" ) ?></p></div>
        <?php endif; ?>
      </div>

    </div>
    <?php if (($infinite === 'yes' || $pagination === 'yes') && $index_type !== 'carousel'):
        $page_url = explode("?", get_pagenum_link(1, false));
        $footer_background = ' style-' . $footer_style;
        if ($footer_back_color !== '') {
          $footer_background .= ' style-'.$footer_back_color.'-bg with-bg';
        }
    ?>
    <div class="<?php echo esc_attr($index_type); ?>-footer<?php echo esc_attr($footer_background) . ' ' . esc_attr($gutter_size); ?>">
        <div class="<?php echo esc_attr($index_type); ?>-footer-inner<?php if ($footer_full_width !== 'yes') echo ' limit-width'; ?> menu-<?php echo esc_attr($footer_style); ?> text-center">
            <?php if ($infinite === 'yes' && $pagination !== 'yes' && $my_query->max_num_pages != 1 && $paged < $my_query->max_num_pages): ?>
            <nav class="loadmore-button"<?php if ($infinite_button !== 'yes') echo ' style="display: none;"'; ?>>
              <?php
                if ($infinite_button_text === '') {
                  $infinite_button_text = ($infinite_button === 'yes') ? esc_html__('Load more' , 'uncode') : esc_html__('Loading…' , 'uncode');
                }
                $nextpage = intval($paged) + 1;
                if (isset($page_url[1]) && $page_url[1] !== '') {
                  parse_str($page_url[1], $output);
                  if (!isset($output['upage'])) $output['upage'] = $nextpage;
                  else $output['upage'] = $nextpage;
                } else {
                  $output = array('upage' => $nextpage);
                }

                $next_page_url = $page_url[0] . add_query_arg( $output, '?' );
                $load_more_button = '<a data-page="' . $nextpage . '" data-pages="' . $my_query->max_num_pages .'" href="' . $next_page_url . '" class="btn"><div class="icon-container"><i class="fa fa-refresh2 fa-lg fa-spin"></i></div><span>' . $infinite_button_text . '</span></a>';
                $load_more_classes = '';
                if ($infinite_button_color !== '') $load_more_classes .= ' btn-' . $infinite_button_color;
                else  $load_more_classes .= ' btn-default';
                if ($infinite_button_outline === 'yes') $load_more_classes .= ' btn-outline';
                if ($infinite_button_shape !== '') $load_more_classes .= ' ' . $infinite_button_shape;
                $load_more_button = str_replace('class="btn"', 'class="btn' . $load_more_classes . '" data-label="' . esc_attr($infinite_button_text) . '"', $load_more_button);
                echo uncode_remove_wpautop($load_more_button);
              ?>
            </nav>
            <?php else:
      if ($pagination === 'yes'):
        $base = $page_url[0] . '%_%';
        $prev_link = '';
        $next_link = '';
        if (isset($_GET['ucat']) || is_front_page() || is_home() || is_archive() || is_single()) {
          if (isset($page_url[1]) && $page_url[1] !== '') parse_str($page_url[1], $output);
          $output['upage'] = '%#%';
          $format = add_query_arg( $output, '?' );
          if ($paged - 1 > 0) {
            $output['upage'] = $paged - 1;
            $prev_link = $page_url[0] . add_query_arg( $output, '?' );
          }
          if ($paged < $my_query->max_num_pages) {
            $output['upage'] = $paged + 1;
            $next_link = $page_url[0] . add_query_arg( $output, '?' );
          }
        } else {
          $format = 'page/%#%';
          if ($paged - 1 > 0) {
            $prev_link = $page_url[0] . 'page/' . ($paged - 1) ;
          }
          if ($paged < $my_query->max_num_pages) {
            $next_link = $page_url[0] . 'page/' . ($paged + 1);
          }
        }
        $pagination_args = array(
          'base'            => $base,
          'format'          => $format,
          'total'           => $my_query->max_num_pages,
          'current'         => $paged,
          'show_all'        => false,
          'prev_next'       => false,
          'type'            => 'array',
          'add_args'        => false,
          'add_fragment'    => ''
        );
        $paginate_links = paginate_links($pagination_args);
          if (is_array($paginate_links)) {
            echo "<ul class='pagination'>";
            echo '<li class="page-prev"><a class="btn btn-link text-default-color" href="'.$prev_link.'"><i class="fa fa-angle-left"></i></a></li>';
            foreach ( $paginate_links as $page ) {
                echo '<li><span class="btn btn-link text-default-color">'.$page.'</span></li>';
            }
            echo '<li class="page-next"><a class="btn btn-link text-default-color" href="'.$next_link.'"><i class="fa fa-angle-right"></i></a></li>';
            echo "</ul>";
          }
            endif;
          endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>