<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' );

/**
 * DATA COLLECTION - START
 *
 */

/** Init variables **/
$limit_width = $limit_content_width = $the_content = $main_content = $layout = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $navigation_content = $page_custom_width = $row_classes = $main_classes = $footer_classes = $generic_body_content_block = '';
$index_has_navigation = false;

global $wp_query;
$post_type = 'product_index';
$single_post_width = ot_get_option('_uncode_' . $post_type . '_single_width');
set_query_var( 'single_post_width', $single_post_width );

/** Get general datas **/
$style = ot_get_option('_uncode_general_style');
$bg_color = ot_get_option('_uncode_general_bg_color');
$bg_color = ($bg_color == '') ? ' style-'.$style.'-bg' : ' style-'.$bg_color.'-bg';

/** Get page width info **/
$boxed = ot_get_option('_uncode_boxed');

if ($boxed !== 'on')
{
	$generic_content_full = ot_get_option('_uncode_' . $post_type . '_layout_width');
	if ($generic_content_full === '')
	{
		$main_content_full = ot_get_option('_uncode_body_full');
		if ($main_content_full === '' || $main_content_full === 'off') $limit_content_width = ' limit-width';
	}
	else
	{
		if ($generic_content_full === 'limit')
		{
			$generic_custom_width = ot_get_option('_uncode_' . $post_type . '_layout_width_custom');
			if (is_array($generic_custom_width) && !empty($generic_custom_width))
			{
				$page_custom_width = ' style="max-width: ' . implode("", $generic_custom_width) . ';"';
			}
		}
	}
}

/** Collect header data **/
$page_header_type = ot_get_option('_uncode_' . $post_type . '_header');
if ($page_header_type !== '' && $page_header_type !== 'none')
{
	$metabox_data['_uncode_header_type'] = array($page_header_type);
	$tax = $wp_query->get_queried_object();
	if (isset($tax->term_id)) {
		$term_back = get_option( '_uncode_taxonomy_' . $tax->term_id );
		if (isset($term_back['term_media']) && $term_back['term_media'] !== '') $featured_image = $term_back['term_media'];
		else $featured_image = get_woocommerce_term_meta( $tax->term_id, 'thumbnail_id', true );
	} else {
		$featured_image = '';
	}
	$meta_data = uncode_get_general_header_data($metabox_data, $post_type, $featured_image);
	$metabox_data = $meta_data['meta'];
	$show_title = $meta_data['show_title'];
}

/** Get layout info **/
$activate_sidebar = ot_get_option('_uncode_' . $post_type . '_activate_sidebar');
if ($activate_sidebar !== 'off')
{
	$layout = ot_get_option('_uncode_' . $post_type . '_sidebar_position');
	if ($layout === '') $layout = 'sidebar_right';
	$sidebar = ot_get_option('_uncode_' . $post_type . '_sidebar');
	$sidebar_style = ot_get_option('_uncode_' . $post_type . '_sidebar_style');
	$sidebar_size = ot_get_option('_uncode_' . $post_type . '_sidebar_size');
	$sidebar_sticky = ot_get_option('_uncode_' . $post_type . '_sidebar_sticky');
	$sidebar_sticky = ($sidebar_sticky === 'on') ? ' sticky-element sticky-sidebar' : '';
	$sidebar_fill = ot_get_option('_uncode_' . $post_type . '_sidebar_fill');
	$sidebar_bg_color = ot_get_option('_uncode_' . $post_type . '_sidebar_bgcolor');
	$sidebar_bg_color = ($sidebar_bg_color !== '') ? ' style-' . $sidebar_bg_color . '-bg' : '';
	if ($sidebar_style === '') $sidebar_style = $style;
}

/** Get breadcrumb info **/
$generic_breadcrumb = ot_get_option('_uncode_' . $post_type . '_breadcrumb');
$show_breadcrumb = ($generic_breadcrumb === 'off') ? false : true;
if ($show_breadcrumb) $breadcrumb_align = ot_get_option('_uncode_' . $post_type . '_breadcrumb_align');

/** Get title info **/
$generic_show_title = ot_get_option('_uncode_' . $post_type . '_title');
$show_title = ($generic_show_title === 'off') ? false : true;

/**
 * DATA COLLECTION - END
 *
 */

/** Build header **/
if ($page_header_type !== '' && $page_header_type !== 'none')
{
	$get_title = woocommerce_page_title(false);
	$get_subtitle = get_queried_object()->description;
	$page_header = new unheader($metabox_data, $get_title, $get_subtitle);

	$header_html = $page_header->html;
	if ($header_html !== '') {
		echo '<div id="page-header">';
		echo uncode_remove_wpautop( $page_header->html );
		echo '</div>';
	}
}
echo '<script type="text/javascript">UNCODE.initHeader();</script>';

/** Build breadcrumb **/

if ($show_breadcrumb)
{
	if ($breadcrumb_align === '') $breadcrumb_align = 'right';
	$breadcrumb_align = ' text-' . $breadcrumb_align;

	$content_breadcrumb = uncode_breadcrumbs();
	$breadcrumb_title = '<div class="breadcrumb-title h5 text-bold">' . uncode_archive_title() . '</div>';
	echo uncode_get_row_template($breadcrumb_title . $content_breadcrumb, '', ($page_custom_width !== '' ? ' limit-width' : $limit_content_width), $style, ' row-breadcrumb row-breadcrumb-' . $style . $breadcrumb_align, 'half', true, 'half');
}

/** Build title **/

if ($show_title)
{
	$get_title = get_queried_object()->description !== '' ? get_queried_object()->description : woocommerce_page_title(false);
	$title_content = '<div class="post-title-wrapper"><h1 class="post-title">' . $get_title . '</h1></div>';
}

if (have_posts()):

	$generic_body_content_block = ot_get_option('_uncode_' . $post_type . '_content_block');

	if ($generic_body_content_block === '') {

		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

		ob_start();
		woocommerce_result_count();
		$counter_content = ob_get_clean();

		ob_start();
		do_action( 'woocommerce_before_shop_loop' );
		$ordering_content = ob_get_clean();

		$body_head =
			'<div class="row-inner">
				<div class="col-lg-6">
					<div class="uncol">
						<div class="uncoltable">
							<div class="uncell no-block-padding">
								<div class="uncont">
									'.$title_content.$counter_content.'
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="uncol">
						<div class="uncoltable">
							<div class="uncell no-block-padding">
								<div class="uncont">
									'.$ordering_content.'
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>';

		$the_content .= uncode_get_row_template($body_head, $limit_width, $limit_content_width, $style, '', false, false, true);

		$the_content .=
			'<div id="index-' . big_rand() . '" class="isotope-system">
				<div class="isotope-wrapper single-gutter">
					<div class="isotope-container isotope-layout style-masonry isotope-pagination" data-type="masonry" data-layout="fitRows" data-lg="800">';

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			$generic_body_content_block = ot_get_option('_uncode_' . $post_type . '_content_block');
			ob_start();

			wc_get_template_part( 'content', 'product' );
			$the_content .= ob_get_clean();

		endwhile;

		$the_content .=
					'</div>
				</div>
			</div>';
	} else {

		$tax = $wp_query->get_queried_object();
		$tax_query = (isset($tax->term_id)) ? '|tax_query:'.$tax->term_id : '';
		$generic_body_content_block = apply_filters( 'wpml_object_id', $generic_body_content_block, 'post' );
		$uncode_block = get_post_field('post_content', $generic_body_content_block);
		$archive_query = '';
		$regex = '/\[uncode_index(.*?)\]/';
		$regex_attr = '/(.*?)=\"(.*?)\"/';
		preg_match_all($regex, $uncode_block, $matches, PREG_SET_ORDER);
		foreach ($matches as $key => $value) {
			$index_found = false;
			$index_pagination = false;
			$index_infinite = false;
			if (isset($value[1])) {
				preg_match_all($regex_attr, trim($value[1]), $matches_attr, PREG_SET_ORDER);
				foreach ($matches_attr as $key_attr => $value_attr) {
					switch (trim($value_attr[1])) {
						case 'auto_query':
							if ($value_attr[2] === 'yes') $index_found = true;
							break;
						case 'pagination':
							if ($value_attr[2] === 'yes') $index_pagination = true;
							break;
						case 'infinite':
							if ($value_attr[2] === 'yes') $index_infinite = true;
							break;
						case 'loop':
							$archive_query = $value_attr[2];
							break;
					}
				}
			}
			if ($index_found) {
				if ($archive_query === '') $archive_query = ' loop="size:'.get_option('posts_per_page').'|order_by:date|post_type:product' . $tax_query.'"';
				else {
					$parse_query = uncode_parse_loop_data($archive_query);
					$parse_query['post_type'] = 'product';
					if (isset($tax->term_id)) $parse_query['tax_query'] = $tax->term_id;
					$archive_query = ' loop="' . uncode_unparse_loop_data($parse_query) . '"';
				}
				$value[1] = preg_replace('#\s(loop)="([^"]+)"#', $archive_query, $value[1], -1, $index_count);
				if ($index_count === 0) {
					$value[1] .= $archive_query;
				}
				$replacement = '[uncode_index' . $value[1] . ']';
				$uncode_block = str_replace($value[0], $replacement, $uncode_block);
				if ($index_pagination || $index_infinite) $index_has_navigation = true;
			}
		}
		$the_content .= $uncode_block;

	}

	else :

		ob_start();
		get_template_part('content', 'none');
		$the_content .= ob_get_clean();

	endif;

	if ($layout === 'sidebar_right' || $layout === 'sidebar_left')
	{

		/** Build structure with sidebar **/

		if ($sidebar_size === '') $sidebar_size = 4;
		$main_size = 12 - $sidebar_size;
		$expand_col = '';

		/** Collect paddings data **/

		$footer_classes = ' no-top-padding double-bottom-padding';

		if ($sidebar_bg_color !== '')
		{
			if ($sidebar_fill === 'on')
			{
				$sidebar_inner_padding.= ' std-block-padding';
				$sidebar_padding.= $sidebar_bg_color;
				$expand_col = ' unexpand';
				if ($limit_content_width === '')
				{
					$row_classes.= ' no-h-padding col-no-gutter no-top-padding';
					$footer_classes = ' std-block-padding no-top-padding';
					$main_classes.= ' std-block-padding';
				}
				else
				{
					$row_classes.= ' no-top-padding';
					$main_classes.= ' double-top-padding';
				}
			}
			else
			{
				$row_classes .= ' double-top-padding';
  			$row_classes .= ' double-bottom-padding';
				$sidebar_inner_padding.= $sidebar_bg_color . ' single-block-padding';
			}
		}
		else
		{
			$row_classes.= ' col-std-gutter double-top-padding';
			$main_classes.= ' double-bottom-padding';
		}

		$row_classes.= ' no-bottom-padding';
		$sidebar_inner_padding.= ' double-bottom-padding';

		/** Build sidebar **/

		$sidebar_content = "";
		ob_start();
		if ($sidebar !== '')
		{
			dynamic_sidebar($sidebar);
		}
		else
		{
			dynamic_sidebar();
		}
		$sidebar_content = ob_get_clean();

		/** Create html with sidebar **/

		$the_content = '<div class="post-content style-' . $style . $main_classes . '">' . $the_content . '</div>';

		$main_content = '<div class="col-lg-' . $main_size . '">
											' . $the_content . '
										</div>';

		$the_content = '<div class="row-container">
        							<div class="row row-parent' . $row_classes . $limit_content_width . '"' . $page_custom_width . '>
												<div class="row-inner">
													' . (($layout === 'sidebar_right') ? $main_content : '') . '
													<div class="col-lg-' . $sidebar_size . '">
														<div class="uncol style-' . $sidebar_style . $expand_col . $sidebar_padding . (($sidebar_fill === 'on' && $sidebar_bg_color !== '') ? '' : $sidebar_sticky) . '">
															<div class="uncoltable' . (($sidebar_fill === 'on' && $sidebar_bg_color !== '') ? $sidebar_sticky : '') . '">
																<div class="uncell' . $sidebar_inner_padding . '">
																	<div class="uncont">
																		' . $sidebar_content . '
																	</div>
																</div>
															</div>
														</div>
													</div>
													' . (($layout === 'sidebar_left') ? $main_content : '') . '
												</div>
											</div>
										</div>';
	} else {

		/** Create html without sidebar **/
		if ($generic_body_content_block === '') $the_content = '<div class="post-content"' . $page_custom_width . '>' . uncode_get_row_template($the_content, $limit_width, $limit_content_width, $style, '', 'double', true, 'double') . '</div>';
		else $the_content = '<div class="post-content"' . $page_custom_width . '>' . $the_content . '</div>';

	}

	/** Build and display navigation html **/
	if (!$index_has_navigation) {
		$navigation_option = ot_get_option('_uncode_' . $post_type . '_navigation_activate');
		if ($navigation_option !== 'off')
		{
			$navigation = uncode_posts_navigation();
			if (!empty($navigation) && $navigation !== '') $navigation_content = uncode_get_row_template($navigation, '', $limit_content_width, $style, ' row-navigation row-navigation-' . $style, true, true, true);
		}
	}

	/** Display post html **/
	echo '<div class="page-body' . $bg_color . '">
          <div class="post-wrapper">
          	<div class="post-body">' . do_shortcode($the_content) . '</div>' .
          	$navigation_content . '
          </div>
        </div>';

// end of the loop.

get_footer( 'shop' ); ?>