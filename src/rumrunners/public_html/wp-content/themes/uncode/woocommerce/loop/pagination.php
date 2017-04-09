<?php

/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if (!defined('ABSPATH'))
{
	exit;
}

global $wp_query;

if ($wp_query->max_num_pages <= 1)
{
	return;
}

$paginate_links = paginate_links(apply_filters('woocommerce_pagination_args', array(
	'base' => esc_url(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false)))) ,
	'format' => '',
	'current' => max(1, get_query_var('paged')) ,
	'total' => $wp_query->max_num_pages,
	'prev_next' => false,
	'type' => 'array',
	'end_size' => 3,
	'mid_size' => 3
)));

if (is_array($paginate_links))
{
	$output = "<ul class='pagination'>";
	$prev = get_previous_posts_link('<i class="fa-fw fa fa-angle-left"></i>');
	if ($prev !== NULL) $output.= '<li class="page-prev">' . $prev . '</li>';
	else
	{
		$output.= '<li class="page-prev"><span class="btn btn-link text-gray-x11-color btn-icon-left btn-disable-hover"><i class="fa-fw fa fa-angle-left"></i></span></li>';
	}

	foreach ($paginate_links as $page)
	{
		$output.= '<li><span class="btn-container">' . $page . '</span></li>';
	}
	$next = get_next_posts_link('<i class="fa-fw fa fa-angle-right"></i>');
	if ($next !== NULL) $output.= '<li class="page-next">' . $next . '</li>';
	else
	{
		$output.= '<li class="page-next"><span class="btn btn-link text-gray-x11-color btn-icon-right btn-disable-hover"><i class="fa-fw fa fa-angle-right"></i></span></li>';
	}

	$output.= "</ul><!-- .pagination -->";
}

echo wp_kses_post($output);
