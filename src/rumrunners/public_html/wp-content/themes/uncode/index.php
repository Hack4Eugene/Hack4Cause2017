<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package uncode
 */

get_header();

/**
 * DATA COLLECTION - START
 *
 */

/** Init variables **/
$limit_width = $limit_content_width = $the_content = $main_content = $layout = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $navigation_content = $page_custom_width = $row_classes = $main_classes = $footer_classes = '';
$with_builder = false;
$index_has_navigation = false;

$post_type = 'post_index';
$single_post_width = ot_get_option('_uncode_' . $post_type . '_single_width');
$single_text_length = ot_get_option('_uncode_' . $post_type . '_single_text_length');
set_query_var( 'single_post_width', $single_post_width );
if ($single_text_length !== '') set_query_var( 'single_text_length', $single_text_length );

/** Get general datas **/
$style = ot_get_option('_uncode_general_style');
if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
	$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
} else $bg_color = ot_get_option('_uncode_general_bg_color');
$bg_color = ($bg_color == '') ? ' style-'.$style.'-bg' : ' style-'.$bg_color.'-bg';

/** Get page width info **/
$boxed = ot_get_option('_uncode_boxed');

if ($boxed !== 'on') {
	/** Use generic page width **/
	$generic_content_full = ot_get_option('_uncode_'.$post_type.'_layout_width');
	if ($generic_content_full === '') {
		$main_content_full = ot_get_option('_uncode_body_full');
		if ($main_content_full !== 'on') $limit_content_width = ' limit-width';
	} else {
		if ($generic_content_full === 'limit') {
			$generic_custom_width = ot_get_option('_uncode_'.$post_type.'_layout_width_custom');
			if (isset($generic_custom_width[0]) && isset($generic_custom_width[1])) {
				if ($generic_custom_width[1] === 'px') {
					$page_custom_width[0] = 12 * round(($generic_custom_width[0]) / 12);
				}
				if (is_array($generic_custom_width) && !empty($generic_custom_width)) {
					$page_custom_width = ' style="max-width: '.implode('', $generic_custom_width).'; margin: auto;"';
				}
			} else {
				$limit_content_width = ' limit-width';
			}
		}
	}
}

if (!empty($metabox_data)) {
	$media = get_post_meta($post->ID, '_uncode_featured_media', 1);
	$media_display = get_post_meta($post->ID, '_uncode_featured_media_display', 1);
	$featured_image = get_post_thumbnail_id($post->ID);
	if ($featured_image === '') $featured_image = $media;
}


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
		$metabox_data['_uncode_header_type'] = array($page_header_type);
		$meta_data = uncode_get_general_header_data($metabox_data, $post_type);
		$metabox_data = $meta_data['meta'];
		$show_title = $meta_data['show_title'];
	}
}

/** Get layout info **/
$activate_sidebar = ot_get_option('_uncode_'.$post_type.'_activate_sidebar');
if ($activate_sidebar !== 'off') {
	$layout = ot_get_option('_uncode_'.$post_type.'_sidebar_position');
	if ($layout === '') $layout = 'sidebar_right';
	$sidebar = ot_get_option('_uncode_'.$post_type.'_sidebar');
	$sidebar_style = ot_get_option('_uncode_'.$post_type.'_sidebar_style');
	$sidebar_size = ot_get_option('_uncode_'.$post_type.'_sidebar_size');
	$sidebar_sticky = ot_get_option('_uncode_' . $post_type . '_sidebar_sticky');
	$sidebar_sticky = ($sidebar_sticky === 'on') ? ' sticky-element sticky-sidebar' : '';
	$sidebar_fill = ot_get_option('_uncode_'.$post_type.'_sidebar_fill');
	$sidebar_bg_color = ot_get_option('_uncode_'.$post_type.'_sidebar_bgcolor');
	$sidebar_bg_color = ($sidebar_bg_color !== '') ? ' style-' . $sidebar_bg_color . '-bg' : '';
}

if ($sidebar_style === '') $sidebar_style = $style;

/**
 * DATA COLLECTION - END
 *
 */

$posts_counter = $wp_query->post_count;

/** Build header **/
if ($page_header_type !== '' && $page_header_type !== 'none')
{
	$page_title = (is_home()) ? get_bloginfo('description') : ot_get_option('_uncode_'.$post_type.'_header_title_text');
	$page_header = new unheader($metabox_data, $page_title);

	$header_html = $page_header->html;
	if ($header_html !== '') {
		echo '<div id="page-header">';
		echo uncode_remove_wpautop( $page_header->html );
		echo '</div>';
	}
}
echo '<script type="text/javascript">UNCODE.initHeader();</script>';

if (have_posts()):

	if (isset($metabox_data['post_id']) && $metabox_data['post_id'] !== '') {
		$content_id = $metabox_data['post_id'];
	} else {
		$content_id = ot_get_option('_uncode_' . $post_type . '_content_block');
	}

	if ($content_id === '') {

		$the_content .=
			'<div id="index-' . rand() . '" class="isotope-system">
				<div class="isotope-wrapper single-gutter">
					<div class="isotope-container isotope-layout style-masonry isotope-pagination" data-type="masonry" data-layout="masonry" data-lg="800">';

		/* Start the Loop */
		while (have_posts()):
			the_post();

			/* Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			ob_start();
			$get_post_type = get_post_format();
			get_template_part('content', $get_post_type);
			$the_content .= ob_get_clean();
		endwhile;

		$the_content .=
					'</div>
				</div>
			</div>';

	} else {

		$content_id = apply_filters( 'wpml_object_id', $content_id, 'post' );
		$uncode_block = get_post_field('post_content', $content_id);
		if (has_shortcode($uncode_block, 'vc_row')) $with_builder = true;
		$archive_query = ' loop="size:'.get_option('posts_per_page').'|order_by:date|post_type:post"';
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
					}
				}
			}
			if ($index_found) {
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
		$the_content = '<div class="post-content"' . $page_custom_width . '>' . uncode_get_row_template($the_content, $limit_width, $limit_content_width, $style, '', ($with_builder ? '' : 'double'), true, ($with_builder ? '' : 'double')) . '</div>';

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

get_footer(); ?>
