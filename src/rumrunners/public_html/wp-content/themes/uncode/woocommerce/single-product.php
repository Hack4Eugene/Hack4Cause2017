<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' );

	/**
	* DATA COLLECTION - START
	**/

	/** Init variables **/
	$limit_width = $limit_content_width = $the_content = $bg_color = $main_content = $partial_content = $media_shortcode = $page_header_type = $title_content = $content_after_body = '';
	$post_type = 'product';

	/** Get general datas **/
	if (isset($metabox_data['_uncode_specific_style'][0]) && $metabox_data['_uncode_specific_style'][0] !== '') {
		$style = $metabox_data['_uncode_specific_style'][0];
		if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
			$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
		}
	} else {
		$style = ot_get_option('_uncode_general_style');
		if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
			$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
		} else $bg_color = ot_get_option('_uncode_general_bg_color');
	}
	$bg_color = ($bg_color == '') ? ' style-'.$style.'-bg' : ' style-'.$bg_color.'-bg';

	/** Get page width info **/
	$boxed = ot_get_option('_uncode_boxed');

	if ($boxed !== 'on') {
		$page_content_full = (isset($metabox_data['_uncode_specific_layout_width'][0])) ? $metabox_data['_uncode_specific_layout_width'][0] : '';
		if ($page_content_full === '') {
			/** Use generic page width **/
			$generic_content_full = ot_get_option('_uncode_'.$post_type.'_layout_width');
			if ($generic_content_full === '') {
				$main_content_full = ot_get_option('_uncode_body_full');
				if ($main_content_full === '' || $main_content_full === 'off') $limit_content_width = ' limit-width';
			} else {
				if ($generic_content_full === 'limit') {
					$generic_custom_width = ot_get_option('_uncode_'.$post_type.'_layout_width_custom');
					if ($generic_custom_width[1] === 'px') {
						$generic_custom_width[0] = 12 * round(($generic_custom_width[0]) / 12);
					}
					if (is_array($generic_custom_width) && !empty($generic_custom_width)) {
						$page_custom_width = ' style="max-width: '.implode('', $generic_custom_width).'; margin: auto;"';
					}
				}
			}
		} else {
			/** Override page width **/
			if ($page_content_full === 'limit') {
				$limit_content_width = ' limit-width';
				$page_custom_width = (isset($metabox_data['_uncode_specific_layout_width_custom'][0])) ? unserialize($metabox_data['_uncode_specific_layout_width_custom'][0]) : '';
				if (is_array($page_custom_width) && !empty($page_custom_width) && $page_custom_width[0] !== '') {
					if ($page_custom_width[1] === 'px') {
						$page_custom_width[0] = 12 * round(($page_custom_width[0]) / 12);
					}
					$page_custom_width = ' style="max-width: '.implode("", $page_custom_width).'; margin: auto;"';
				} else $page_custom_width = '';
			}
		}
	}

	$media = get_post_thumbnail_id($post->ID);

	/** Collect header data **/
	if (isset($metabox_data['_uncode_header_type'][0]) && $metabox_data['_uncode_header_type'][0] !== '') {
		$page_header_type = $metabox_data['_uncode_header_type'][0];
		if ($page_header_type !== 'none') {
			$meta_data = uncode_get_specific_header_data($metabox_data, $post_type, $media);
			$metabox_data = $meta_data['meta'];
			$show_title = $meta_data['show_title'];
		}
	} else {
		$page_header_type = ot_get_option('_uncode_'.$post_type.'_header');
		if ($page_header_type !== '' && $page_header_type !== 'none') {
			$metabox_data['_uncode_header_type'] = array($page_header_type);
			$meta_data = uncode_get_general_header_data($metabox_data, $post_type, $media);
			$metabox_data = $meta_data['meta'];
			$show_title = $meta_data['show_title'];
		}
	}

	/** Get breadcrumb info **/
	$generic_breadcrumb = ot_get_option('_uncode_' . $post_type . '_breadcrumb');
	$page_breadcrumb = (isset($metabox_data['_uncode_specific_breadcrumb'][0])) ? $metabox_data['_uncode_specific_breadcrumb'][0] : '';
	if ($page_breadcrumb === '')
	{
		$breadcrumb_align = ot_get_option('_uncode_' . $post_type . '_breadcrumb_align');
		$show_breadcrumb = ($generic_breadcrumb === 'off') ? false : true;
	}
	else
	{
		$breadcrumb_align = (isset($metabox_data['_uncode_specific_breadcrumb_align'][0])) ? $metabox_data['_uncode_specific_breadcrumb_align'][0] : '';
		$show_breadcrumb = ($page_breadcrumb === 'off') ? false : true;
	}

	/** Get title info **/
	$generic_show_title = ot_get_option('_uncode_'.$post_type.'_title');
	$page_show_title = (isset($metabox_data['_uncode_specific_title'][0])) ? $metabox_data['_uncode_specific_title'][0] : '';
	if ($page_show_title === '') {
		$show_title = ($generic_show_title === 'off') ? false : true;
	} else {
		$show_title = ($page_show_title === 'off') ? false : true;
	}

	$show_body_title = $show_title;

	global $show_body_title;

	/**
	* DATA COLLECTION - END
	**/

	while (have_posts()) : the_post();

		/** Build header **/
		if ($page_header_type !== '' && $page_header_type !== 'none') {
			$page_header = new unheader($metabox_data, $post->post_title);

			$header_html = $page_header->html;
			if ($header_html !== '') {
				echo '<div id="page-header">';
				echo uncode_remove_wpautop( $page_header->html );
				echo '</div>';
			}

			if (!empty($page_header->poster_id) && $page_header->poster_id !== false && $media !== '') {
				$media = $page_header->poster_id;
			}
		}
		echo '<script type="text/javascript">UNCODE.initHeader();</script>';
		/** Build breadcrumb **/

		if ($show_breadcrumb && !is_front_page() && !is_home())
		{
			if ($breadcrumb_align === '') $breadcrumb_align = 'right';
			$breadcrumb_align = ' text-' . $breadcrumb_align;

			$content_breadcrumb = uncode_breadcrumbs();
			$breadcrumb_title = '<div class="breadcrumb-title h5 text-bold">' . get_the_title() . '</div>';
			echo uncode_get_row_template($breadcrumb_title . $content_breadcrumb, '', $limit_content_width, $style, ' row-breadcrumb row-breadcrumb-' . $style . $breadcrumb_align, 'half', true, 'half');
		}

		global $limit_content_width, $style;

		?>

		<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('page-body style-'.$style.$bg_color); ?>>
			<div class="post-wrapper">
				<?php
				ob_start();
				wc_get_template_part( 'content', 'single-product' );
				$the_content = ob_get_clean();

				/** Build post after block **/

				$page_content_block_after = (isset($metabox_data['_uncode_specific_content_block_after'][0])) ? $metabox_data['_uncode_specific_content_block_after'][0] : '';
				if ($page_content_block_after === '') {
					$generic_content_block_after = ot_get_option('_uncode_' . $post_type . '_content_block_after');
					$content_block_after = $generic_content_block_after !== '' ? $generic_content_block_after : false;
				} else {
					$content_block_after = $page_content_block_after !== 'none' ? $page_content_block_after : false;
				}

				if ($content_block_after !== false) {
					$content_block_after = apply_filters( 'wpml_object_id', $content_block_after, 'post' );
					$content_after_body = get_post_field('post_content', $content_block_after);
					if (class_exists('Vc_Base')) {
						$vc = new Vc_Base();
						$vc->addShortcodesCustomCss($content_block_after);
					}
					if (has_shortcode($content_after_body, 'vc_row')) $content_after_body = '<div class="post-after row-container">' . $content_after_body . '</div>';
					else $content_after_body = '<div class="post-after row-container">' . uncode_get_row_template($content_after_body, $limit_width, $limit_content_width, $style, '', false, true, 'double', $page_custom_width) . '</div>';
					if (class_exists('RP4WP_Post_Link_Manager')) {
						$automatic_linking_post_amount = RP4WP::get()->settings->get_option( 'automatic_linking_post_amount' );
						$uncode_related = new RP4WP_Post_Link_Manager();
						$related_posts = $uncode_related->get_children($post->ID,false);
						$related_posts_ids = array();
						foreach ($related_posts as $key => $value) {
							if (isset($value->ID)) $related_posts_ids[] = $value->ID;
						}
						$archive_query = '';
						$regex = '/\[uncode_index(.*?)\]/';
						$regex_attr = '/(.*?)=\"(.*?)\"/';
						preg_match_all($regex, $content_after_body, $matches, PREG_SET_ORDER);
						foreach ($matches as $key => $value) {
							$index_found = false;
							if (isset($value[1])) {
								preg_match_all($regex_attr, trim($value[1]), $matches_attr, PREG_SET_ORDER);
								foreach ($matches_attr as $key_attr => $value_attr) {
									switch (trim($value_attr[1])) {
										case 'auto_query':
											if ($value_attr[2] === 'yes') $index_found = true;
											break;
										case 'loop':
											$archive_query = $value_attr[2];
											break;
									}
								}
							}
							if ($index_found) {
								if ($archive_query === '') $archive_query = ' loop="size:10|by_id:' . implode(',', $related_posts_ids) .'|post_type:' . $post->post_type . '"';
								else {
									$parse_query = uncode_parse_loop_data($archive_query);
									$parse_query['by_id'] = implode(',', $related_posts_ids);
									if (!isset($parse_query['order'])) $parse_query['order'] = 'none';
									$archive_query = ' loop="' . uncode_unparse_loop_data($parse_query) . '"';
								}
								$value[1] = preg_replace('#\s(loop)="([^"]+)"#', $archive_query, $value[1], -1, $index_count);
								if ($index_count === 0) {
									$value[1] .= $archive_query;
								}
								$replacement = '[uncode_index' . $value[1] . ']';
								$content_after_body = str_replace($value[0], $replacement, $content_after_body);
							}
						}
					}
				}

				if ($content_after_body !== '') $content_after_body = uncode_remove_wpautop($content_after_body);

				echo '<div class="post-body">' . do_shortcode($the_content) . $content_after_body . '</div>';

				/** Build and display navigation html **/
				$navigation_option = ot_get_option('_uncode_' . $post_type . '_navigation_activate');
				if ($navigation_option !== 'off')
				{
					$generic_index = true;
					if (isset($metabox_data['_uncode_specific_navigation_index'][0]) && $metabox_data['_uncode_specific_navigation_index'][0] !== '') {
						$navigation_index = $metabox_data['_uncode_specific_navigation_index'][0];
						$generic_index = false;
					} else {
						$navigation_index = ot_get_option('_uncode_' . $post_type . '_navigation_index');
					}
					if ($navigation_index !== '')
					{
						$navigation_index_label = ot_get_option('_uncode_' . $post_type . '_navigation_index_label');
						$navigation_index_link = get_permalink($navigation_index);
						$navigation_index_btn = '<a class="btn btn-link text-default-color" href="' . esc_url($navigation_index_link) . '">' . ($navigation_index_label === '' ? get_the_title($navigation_index) : esc_html($navigation_index_label)) . '</a>';
					}
					else $navigation_index_btn = '';
					$navigation_nextprev_title = ot_get_option('_uncode_' . $post_type . '_navigation_nextprev_title');
					$navigation = uncode_post_navigation($navigation_index_btn, $navigation_nextprev_title, $navigation_index, $generic_index);
					if (!empty($navigation) && $navigation !== '') echo uncode_get_row_template($navigation, '', $limit_content_width, $style, ' row-navigation row-navigation-' . $style, true, true, true);
				}
				?>
			</div>
		</div>
		<meta itemprop="url" content="<?php the_permalink(); ?>" /><!-- #product-<?php the_ID(); ?> -->
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>