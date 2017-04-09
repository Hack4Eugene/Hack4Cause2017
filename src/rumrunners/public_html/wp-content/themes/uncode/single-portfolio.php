<?php

/**
 * The Template for displaying all single portfolio.
 *
 * @package uncode
 */

get_header();

/**
 * DATA COLLECTION - START
 *
 */

/** Init variables **/
$limit_width = $limit_content_width = $the_content = $main_content = $media_content = $info_content = $navigation_content = $layout = $bg_color = $portfolio_style = $portfolio_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $comment_content = $page_custom_width = $row_classes = $main_classes = $media_classes = $info_classes = $footer_content = $content_after_body = '';
$with_builder = false;

$post_type = 'portfolio';

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

if ($boxed !== 'on')
{
	$page_content_full = (isset($metabox_data['_uncode_specific_layout_width'][0])) ? $metabox_data['_uncode_specific_layout_width'][0] : '';
	if ($page_content_full === '')
	{

		/** Use generic page width **/
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
				if ($generic_custom_width[1] === 'px')
				{
					$generic_custom_width[0] = 12 * round(($generic_custom_width[0]) / 12);
				}
				if (is_array($generic_custom_width) && !empty($generic_custom_width))
				{
					$page_custom_width = ' style="max-width: ' . implode("", $generic_custom_width) . '; margin: auto;"';
				}
			}
		}
	}
	else
	{

		/** Override page width **/
		if ($page_content_full === 'limit')
		{
			$limit_content_width = ' limit-width';
			$page_custom_width = (isset($metabox_data['_uncode_specific_layout_width_custom'][0])) ? unserialize($metabox_data['_uncode_specific_layout_width_custom'][0]) : '';
			if (is_array($page_custom_width) && !empty($page_custom_width) && $page_custom_width[0] !== '')
			{
				if ($page_custom_width[1] === 'px')
				{
					$page_custom_width[0] = 12 * round(($page_custom_width[0]) / 12);
				}
				$page_custom_width = ' style="max-width: ' . implode("", $page_custom_width) . '; margin: auto;"';
			} else $page_custom_width = '';
		}
	}
}

$media = get_post_meta($post->ID, '_uncode_featured_media', 1);
$media_display = get_post_meta($post->ID, '_uncode_featured_media_display', 1);
$featured_image = get_post_thumbnail_id($post->ID);
if ($featured_image === '') $featured_image = $media;

/** Collect header data **/
if (isset($metabox_data['_uncode_header_type'][0]) && $metabox_data['_uncode_header_type'][0] !== '')
{
	$page_header_type = $metabox_data['_uncode_header_type'][0];
	if ($page_header_type !== 'none')
	{
		$meta_data = uncode_get_specific_header_data($metabox_data, $post_type, $featured_image);
		$metabox_data = $meta_data['meta'];
		$show_title = $meta_data['show_title'];
	}
}
else
{
	$page_header_type = ot_get_option('_uncode_' . $post_type . '_header');
	if ($page_header_type !== '' && $page_header_type !== 'none')
	{
		$metabox_data['_uncode_header_type'] = array(
			$page_header_type
		);
		$meta_data = uncode_get_general_header_data($metabox_data, $post_type, $featured_image);
		$metabox_data = $meta_data['meta'];
		$show_title = $meta_data['show_title'];
	}
}

/** Get layout info **/
if (isset($metabox_data['_uncode_portfolio_active'][0]) && $metabox_data['_uncode_portfolio_active'][0] !== '')
{
	/** Page specific info **/
	if ($metabox_data['_uncode_portfolio_active'][0] !== 'off')
	{
		$layout = (isset($metabox_data['_uncode_portfolio_position'][0])) ? $metabox_data['_uncode_portfolio_position'][0] : '';
		$sidebar_size = (isset($metabox_data['_uncode_portfolio_sidebar_size'][0])) ? $metabox_data['_uncode_portfolio_sidebar_size'][0] : 4;
		$sidebar_sticky = (isset($metabox_data['_uncode_portfolio_sidebar_sticky'][0]) && $metabox_data['_uncode_portfolio_sidebar_sticky'][0] === 'on') ? ' sticky-element sticky-sidebar' : '';
		$sidebar_fill = (isset($metabox_data['_uncode_portfolio_sidebar_fill'][0])) ? $metabox_data['_uncode_portfolio_sidebar_fill'][0] : '';
		$portfolio_style = (isset($metabox_data['_uncode_portfolio_style'][0])) ? $metabox_data['_uncode_portfolio_style'][0] : $style;
		$portfolio_bg_color = (isset($metabox_data['_uncode_portfolio_bgcolor'][0]) && $metabox_data['_uncode_portfolio_bgcolor'][0] !== '') ? ' style-' . $metabox_data['_uncode_portfolio_bgcolor'][0] . '-bg' : '';
	}
}
else
{
	/** Page generic info **/
	$layout = ot_get_option('_uncode_' . $post_type . '_position');
	if ($layout !== 'off')
	{
		$portfolio_style = ot_get_option('_uncode_' . $post_type . '_style');
		$sidebar_size = ot_get_option('_uncode_' . $post_type . '_size');
		$sidebar_sticky = ot_get_option('_uncode_' . $post_type . '_sidebar_sticky');
		$sidebar_sticky = ($sidebar_sticky === 'on') ? ' sticky-element sticky-sidebar' : '';
		$sidebar_fill = ot_get_option('_uncode_' . $post_type . '_sidebar_fill');
		$portfolio_bg_color = ot_get_option('_uncode_' . $post_type . '_bgcolor');
		$portfolio_bg_color = ($portfolio_bg_color !== '') ? ' style-' . $portfolio_bg_color . '-bg' : '';
	}
}
if ($portfolio_style === '') $portfolio_style = $style;

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
$generic_show_title = ot_get_option('_uncode_' . $post_type . '_title');
$page_show_title = (isset($metabox_data['_uncode_specific_title'][0])) ? $metabox_data['_uncode_specific_title'][0] : '';
if ($page_show_title === '')
{
	$show_title = ($generic_show_title === 'off') ? false : true;
}
else
{
	$show_title = ($page_show_title === 'off') ? false : true;
}

/** Get media info **/
$generic_show_media = ot_get_option('_uncode_' . $post_type . '_media');
$page_show_media = (isset($metabox_data['_uncode_specific_media'][0])) ? $metabox_data['_uncode_specific_media'][0] : '';
if ($page_show_media === '')
{
	$show_media = ($generic_show_media === 'off') ? false : true;
}
else
{
	$show_media = ($page_show_media === 'off') ? false : true;
}

/**
 * DATA COLLECTION - END
 *
 */

$portfolio_details = ot_get_option('_uncode_portfolio_details');

if (!empty($portfolio_details))
{

	foreach ($portfolio_details as $key => $value)
	{
		$portfolio_detail = (isset($metabox_data[$value['_uncode_portfolio_detail_unique_id']][0])) ? $metabox_data[$value['_uncode_portfolio_detail_unique_id']][0] : '';
		if ($portfolio_detail !== '')
		{

			$get_url = parse_url($portfolio_detail);
			$portfolio_detail = make_clickable($portfolio_detail);
			if (isset($get_url['host'])) $portfolio_detail = preg_replace('/<a(.+?)>.+?<\/a>/i','<a$1 target="_blank">'.$get_url['host'].'</a>',$portfolio_detail);
			else $portfolio_detail = preg_replace('/<a /','<a target="_blank" ',$portfolio_detail);
			$info_content.= '<span class="detail-container"><span class="detail-label">' . $value['title'] . '</span><span class="detail-value">' . $portfolio_detail . '</span></span>';
		}
	}
	if ($info_content !== '') $info_content = '<p>' . $info_content . '</p>';
}

while (have_posts()):
	the_post();

	/** Build header **/
	if ($page_header_type !== '' && $page_header_type !== 'none')
	{
		$page_header = new unheader($metabox_data, $post->post_title);

		$header_html = $page_header->html;
		if ($header_html !== '') {
			echo '<div id="page-header">';
			echo uncode_remove_wpautop( $page_header->html );
			echo '</div>';
		}
	}
	echo '<script type="text/javascript">UNCODE.initHeader();</script>';
	/** Build breadcrumb **/

	if ($show_breadcrumb && !is_front_page() && !is_home())
	{
		if ($breadcrumb_align === '') $breadcrumb_align = 'right';
		$breadcrumb_align = ' text-' . $breadcrumb_align;

		if (isset($metabox_data['_uncode_specific_navigation_index'][0]) && $metabox_data['_uncode_specific_navigation_index'][0] !== '') {
			$navigation_index = $metabox_data['_uncode_specific_navigation_index'][0];
		} else {
			$navigation_index = ot_get_option('_uncode_' . $post_type . '_navigation_index');
		}
		$content_breadcrumb = uncode_breadcrumbs($navigation_index);
		$breadcrumb_title = '<div class="breadcrumb-title h5 text-bold">' . get_the_title() . '</div>';
		echo uncode_get_row_template($breadcrumb_title . $content_breadcrumb, '', $limit_content_width, $style, ' row-breadcrumb row-breadcrumb-' . $style . $breadcrumb_align, 'half', true, 'half');
	}

	/** Build title **/

	if ($show_title)
	{
		$title_content .= apply_filters( 'uncode_before_body_title', '' );
		$title_content .= '<div class="post-title-wrapper"><h1 class="post-title">' . get_the_title() . '</h1></div>';
		$title_content .= apply_filters( 'uncode_after_body_title', '' );
	}

	/** Build content **/

	$the_content = get_the_content();
	if (has_shortcode($the_content, 'vc_row')) $with_builder = true;

	if (!$with_builder) $the_content = apply_filters('the_content', $the_content);
	else {
		$get_content_appended = apply_filters('the_content', '');
		if (!is_null($get_content_appended) && $get_content_appended !== '') $the_content = $the_content . uncode_get_row_template($get_content_appended, $limit_width, $limit_content_width, $style, '', false, true, 'double', $page_custom_width);
	}

	$text_content = apply_filters('the_excerpt',get_the_excerpt());

	/** Build media **/

	if ($media !== '' && !$with_builder && $show_media && !post_password_required())
	{
		if ($layout === 'sidebar_right' || $layout === 'sidebar_left')
		{
			$media_size = 12 - $sidebar_size;
		}
		else $media_size = 12;

		$media_array = explode(',', $media);
		$media_counter = count($media_array);
		$rand_id = big_rand();
		if ($media_counter === 0) $media_array = array(
			$media
		);

		if ($media_display === 'isotope') $media_content.=
				'<div id="gallery-' . $rand_id . '" class="isotope-system">
					<div class="isotope-wrapper half-gutter">
      			<div class="isotope-container isotope-layout style-masonry" data-type="masonry" data-layout="masonry" data-lg="1000" data-md="600" data-sm="480">';

		foreach ($media_array as $key => $value)
		{
			if ($media_display === 'carousel') $value = $media;
			$block_data = array();
			$block_data['tmb_data'] = array();
			$block_layout['media'] = array();
			$block_layout['icon'] = array();
			$block_data['title_classes'] = array();
			$block_data['media_id'] = $value;
			$block_data['classes'] = array(
				'tmb'
			);
			$block_data['text_padding'] = 'no-block-padding';
			if ($media_display === 'isotope')
			{
				$block_data['single_width'] = 4;
				$block_data['classes'][] = 'tmb-iso-w4';
			}
			else $block_data['single_width'] = $media_size;
			$block_data['single_style'] = $style;
			$block_data['classes'][] = 'tmb-' . $style;
			if ($media_display === 'isotope')
			{
				$block_data['classes'][] = 'tmb-overlay-anim';
				$block_data['classes'][] = 'tmb-overlay-text-anim';
				$block_data['single_icon'] = 'fa fa-plus2';
				$block_data['overlay_color'] = ($style == 'light') ? 'style-dark-bg' : 'style-light-bg';
				$block_data['overlay_opacity'] = '50';
				$lightbox_classes = array();
				$lightbox_classes['data-noarr'] = false;
				$lightbox_classes['data-caption'] = true;
			}
			else
			{
				$lightbox_classes = false;
				$block_data['link_class'] = 'inactive-link';
				$block_data['link'] = '#';
			}
			if ($media_display !== 'carousel')
			{
				$block_data['classes'][] = 'tmb-media';
				$block_data['animation'] = ' animate_when_almost_visible alpha-anim';
				$block_data['tmb_data']['data-delay'] = 200;
			}
			$media_html = uncode_create_single_block($block_data, $rand_id, 'masonry', $block_layout, $lightbox_classes, false, true);
			if ($media_display !== 'isotope') $media_content.= '<div class="post-media' . ((($media_counter - 1) !== $key && $media_display === 'stack') ? ' single-bottom-padding' : '') . '">' . $media_html . '</div>';
			else
			{
				$media_content.= $media_html;
			}
			if ($media_display === 'carousel') break;
		}

		if ($media_display === 'isotope') $media_content.=
					'</div>
				</div>
			</div>';
	}

	/** Build post after block **/

	$page_content_block_after = (isset($metabox_data['_uncode_specific_content_block_after'][0])) ? $metabox_data['_uncode_specific_content_block_after'][0] : '';
	if ($page_content_block_after === '') {
		$generic_content_block_after = ot_get_option('_uncode_' . $post_type . '_content_block_after');
		$content_block_after = $generic_content_block_after !== '' ? $generic_content_block_after : false;
	} else {
		$content_block_after = $page_content_block_after !== 'none' ? $page_content_block_after : false;
	}

	if ($content_block_after !== false) {
		$content_after_body = apply_filters( 'wpml_object_id', $content_after_body, 'post' );
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
						$parse_query['post_type'] = $post->post_type;
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

	/** Build post footer **/

	$generic_show_share = ot_get_option('_uncode_' . $post_type . '_share');
	$page_show_share = (isset($metabox_data['_uncode_specific_share'][0])) ? $metabox_data['_uncode_specific_share'][0] : '';
	if ($page_show_share === '')
	{
		$show_share = ($generic_show_share === 'off') ? false : true;
	}
	else
	{
		$show_share = ($page_show_share === 'off') ? false : true;
	}

	if ($show_share)
		$footer_content = '<div class="post-share">
	          						<div class="detail-container">
													<span class="detail-label">' . esc_html__('Share', 'uncode') . '</span>
													<div class="share-button share-buttons share-inline only-icon"></div>
												</div>
											</div>';

	$show_comments = ot_get_option('_uncode_' . $post_type . '_comments');

	if ((comments_open() || '0' != get_comments_number()) && $show_comments === 'on')
	{
		ob_start();
		comments_template();
		$comment_content = ob_get_clean();
		$comment_content = uncode_get_row_template($comment_content, '', $limit_content_width, $style, ' portfolio-comments portfolio-comments-' . $style, false, true, 'double');
	}

	if ($layout === 'sidebar_right' || $layout === 'sidebar_left')
	{

		/** Build structure with sidebar **/

		if ($sidebar_size === '' || empty($sidebar_size)) $sidebar_size = 4;
		$main_size = 12 - $sidebar_size;
		$expand_col = '';

		if ($with_builder) $the_content = $media_content . $the_content;
		else
		{
			if ($the_content !== '' && !empty($the_content))
			{
				$the_content = uncode_get_row_template($the_content, '', '', $style, ' limit-width', ($media_content !== '' ? true : 'double') , false, 'double');
				$the_content = '<div class="post-content">' . $the_content . '</div>';
				if ($media_content !== '') $the_content = uncode_get_row_template($media_content, '', $limit_content_width, $style, '', false, false, false) . $the_content;
			}
			else
			{
				if ($media_content !== '') $media_content = uncode_get_row_template($media_content, '', $limit_content_width, $style, '', false, false, 'double');
				$the_content = $media_content . $the_content;
			}
		}

		/** Collect paddings data **/

		$footer_classes = ' no-bottom-padding';

		if ($portfolio_bg_color !== '')
		{
			if ($sidebar_fill === 'on')
			{
				$sidebar_inner_padding.= ' std-block-padding';
				$sidebar_padding.= $portfolio_bg_color;
				$expand_col = ' unexpand';
				$media_content = str_replace(' single-bottom-padding', '', $media_content);
				if ($limit_content_width === '')
				{
					$row_classes.= ' no-h-padding col-no-gutter no-top-padding';
					$footer_classes = ' single-top-padding';
					if (!$with_builder)
					{
						$main_classes.= ' std-block-padding';
					}
				}
				else
				{
					$row_classes.= ' no-top-padding';
					if (!$with_builder)
					{
						$main_classes.= ' double-top-padding';
					}
				}
			}
			else
			{
				$row_classes .= ' double-top-padding';
  			$row_classes .= ' double-bottom-padding';
				$sidebar_inner_padding.= $portfolio_bg_color . ' single-block-padding';
			}
		}
		else
		{
			if ($with_builder)
			{
				if ($limit_content_width === '')
				{
					$row_classes.= ' col-half-gutter no-top-padding no-h-padding';
					$sidebar_inner_padding.= ' double-top-padding single-block-padding';
				}
				else
				{
					$row_classes.= ' col-std-gutter no-top-padding';
					$sidebar_inner_padding.= ' double-top-padding';
				}
			}
			else
			{
				$row_classes.= ' col-std-gutter double-top-padding';
				$main_classes.= ' double-bottom-padding';
			}
		}

		$row_classes.= ' no-bottom-padding';
		$sidebar_inner_padding.= ' double-bottom-padding';

		/** Create html with sidebar **/

		if ($footer_content !== '') $footer_content = '<div class="post-footer post-footer-' . $style . ' style-' . $style . $footer_classes . '">' . $footer_content . '</div>';

		$main_content = '<div class="col-lg-' . $main_size . '">
									' . $the_content . '
								</div>';

		$info_content = '<div class="info-content">' . $title_content . $text_content . '<hr />' . $info_content . '</div>';

		$the_content = '<div class="row-container">
			        				<div class="row row-parent' . $row_classes . $limit_content_width . '">
												<div class="row-inner">
													' . (($layout === 'sidebar_right') ? $main_content : '') . '
													<div class="col-lg-' . $sidebar_size . '">
														<div class="uncol style-' . $portfolio_style . $expand_col . $sidebar_padding . (($sidebar_fill === 'on' && $portfolio_bg_color !== '') ? '' : $sidebar_sticky) . '">
															<div class="uncoltable' . (($sidebar_fill === 'on' && $portfolio_bg_color !== '') ? $sidebar_sticky : '') . '">
																<div class="uncell' . $sidebar_inner_padding . '">
																	<div class="uncont">
																		' . $info_content . $footer_content . '
																	</div>
																</div>
															</div>
														</div>
													</div>
													' . (($layout === 'sidebar_left') ? $main_content : '') . '
												</div>
											</div>
										</div>';
	}

	if ($layout === 'portfolio_top' || $layout === 'portfolio_bottom')
	{

		/** Create html without sidebar **/

		if ($with_builder) $the_content = $media_content . $the_content;
		else
		{
			if ($the_content !== '' && !empty($the_content))
			{
				$the_content = uncode_get_row_template($the_content, '', '', $style, ' limit-width', ($layout === 'portfolio_top' ? false : 'double') , false, ($layout === 'portfolio_top' ? 'double' : false));
				$the_content = '<div class="post-content">' . $the_content . '</div>';
			}
			if ($media_content !== '') $media_content = uncode_get_row_template($media_content, '', $limit_content_width, $style, '', ($layout === 'portfolio_top' && $portfolio_bg_color === '' ? false : 'double') , true, ($layout === 'portfolio_bottom' && $portfolio_bg_color === '' ? false : 'double'));
			$the_content = $media_content . $the_content;
		}

		if ($footer_content !== '') $footer_content = '<div class="post-footer">' . $footer_content . '</div>';

		if ($title_content !== '')
		{
			$title_content = '<div class="row-inner">
													<div class="col-lg-12">
														<div class="uncont">
															' . $title_content . '
														</div>
													</div>
												</div>';
		}

		$info_content = '<div class="row-portfolio-info row-container style-' . $portfolio_style . $portfolio_bg_color . '">
        							<div class="row row-parent col-std-gutter limit-width double-top-padding double-bottom-padding' . $info_classes . '">
        								' . $title_content . '
												<div class="row-inner">
													<div class="col-lg-8">
														<div class="uncol">
															<div class="uncont">
																' . $text_content . '
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="uncol">
															<div class="uncont">
																<div class="info-content">
																	' . $info_content . '
																</div>
																' . $footer_content . '
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>';

		if ($layout === 'portfolio_top')
		{
			$the_content = $info_content . $the_content;
		}
		else
		{
			$the_content = $the_content . $info_content;
		}
	}

	/** Display post html **/
	if ($layout === '')
	{
		if ($with_builder) $the_content = $media_content . $the_content;
		else
		{
			if ($title_content !== '' || $the_content !== '') $the_content = uncode_get_row_template($title_content . $the_content, '', '', $style, ' limit-width', ($media_content === '' ? 'double' : false), false, 'double');
			if ($media_content !== '') $media_content = uncode_get_row_template($media_content, '', $limit_content_width, $style, '', 'double', true, 'double');
			$the_content = $media_content . $the_content;
		}
		$the_content = '<div class="post-content">' . $the_content . '</div>';
	}

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
		if ($page_custom_width !== '') $limit_content_width = ' limit-width';
		if (!empty($navigation) && $navigation !== '') $navigation_content = uncode_get_row_template($navigation, '', $limit_content_width, $style, ' row-navigation row-navigation-' . $style, true, true, true);
	}

	echo '<div class="page-body' . $bg_color . '">
					<div class="portfolio-wrapper"' . $page_custom_width . '>
						<div class="portfolio-body">' . uncode_remove_wpautop($the_content) . '</div>' .
						 uncode_remove_wpautop($content_after_body) . $comment_content .
					'</div>
				</div>'
				. $navigation_content;
endwhile;
// end of the loop.

get_footer(); ?>