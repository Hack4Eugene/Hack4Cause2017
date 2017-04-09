<?php
/**
 * Custom template tags for this theme.
 *
 * @package uncode
 */

if ( ! function_exists( 'uncode_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 */
function uncode_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$pagination_args = array(
		'prev_next'		=> false,
		'type'			=> 'array',
	);
	$paginate_links = paginate_links($pagination_args);

	if (is_array($paginate_links)) {
		$output = "<ul class='pagination'>";
		$prev = get_previous_posts_link('<i class="fa fa-angle-left"></i>');
		if ($prev !== NULL) $output .= '<li class="page-prev">'.$prev.'</li>';
		else $output .= '<li class="page-prev"><span class="btn btn-link btn-icon-left btn-disable-hover"><i class="fa fa-angle-left"></i></span></li>';

		foreach ( $paginate_links as $page ) {
			$output .= '<li><span class="btn-container">'.$page.'</span></li>';
		}
		$next = get_next_posts_link('<i class="fa fa-angle-right"></i>');
		if ($next !== NULL) $output .= '<li class="page-next">'.$next.'</li>';
		else $output .= '<li class="page-next"><span class="btn btn-link btn-icon-right btn-disable-hover"><i class="fa fa-angle-right"></i></span></li>';

		$output .= "</ul><!-- .pagination -->";
	}

	return $output;
}
endif;

if ( ! function_exists( 'uncode_post_navigation' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function uncode_post_navigation($index_btn = '', $nextprev_title = 'off', $navigation_index = '', $generic = true) {
		// Don't print empty markup if there's nowhere to navigate.
		if ($navigation_index !== '' && !$generic) {
			global $adjacent_index;
			$adjacent_index = $navigation_index;
			add_filter( 'get_next_post_join', 'uncode_get_adjacent_post_join_filter' );
			add_filter( 'get_previous_post_join', 'uncode_get_adjacent_post_join_filter' );
			add_filter( 'get_next_post_where', 'uncode_get_adjacent_post_where_filter' );
			add_filter( 'get_previous_post_where', 'uncode_get_adjacent_post_where_filter' );
		}
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		$prev_label = ($nextprev_title === 'on') ? (isset($previous->post_title) ? $previous->post_title : '') : __('Prev','uncode');
		$next_label = ($nextprev_title === 'on') ? (isset($next->post_title) ? $next->post_title : '') : __('Next','uncode');

		$output =	'<nav class="post-navigation">
									<ul class="navigation">';

		$prev = get_previous_post_link( '<li class="page-prev"><span class="btn-container">%link</span></li>', '<i class="fa fa-angle-left"></i><span>'. esc_html($prev_label) . '</span>');
		if ($prev !== '') $output .= $prev;
		else $output .= '<li class="page-prev"><span class="btn-container"><span class="btn btn-link btn-icon-left btn-disable-hover"><i class="fa fa-angle-left"></i>'.esc_html($prev_label).'</span></span></li>';
		if ($index_btn !== '') $output .=	'<li class="nav-back"><span class="btn-container">'.$index_btn.'</span></li>';
		$next = get_next_post_link( '<li class="page-next"><span class="btn-container">%link</span></li>', '<span>' . esc_html($next_label) .'</span><i class="fa fa-angle-right"></i>');
		if ($next !== '') $output .= $next;
		else $output .= '<li class="page-next"><span class="btn-container"><span class="btn btn-link btn-icon-right btn-disable-hover">'.esc_html($next_label).'<i class="fa fa-angle-right"></i></span></span></li>';

		$output .=	'</ul><!-- .navigation -->
							</nav><!-- .post-navigation -->';

		return $output;
	}
endif;

function uncode_get_adjacent_post_where_filter( $where ) {
	global $adjacent_index;
	$where .= " AND pj.meta_key = '_uncode_specific_navigation_index' AND pj.meta_value = '" . $adjacent_index . "'";
	return $where;
}

function uncode_get_adjacent_post_join_filter( $join ) {
	global $wpdb;
	$join .= " INNER JOIN {$wpdb->postmeta} AS pj ON p.ID = pj.post_id";
	return $join;
}

function uncode_post_link_next_class($format){
	$format = str_replace('href=', 'class="btn btn-link text-default-color btn-icon-right" href=', $format);
	return $format;
}
add_filter('next_post_link', 'uncode_post_link_next_class');

function uncode_post_link_prev_class($format) {
	$format = str_replace('href=', 'class="btn btn-link text-default-color btn-icon-left" href=', $format);
	return $format;
}
add_filter('previous_post_link', 'uncode_post_link_prev_class');

function uncode_posts_link_next_class() {
	return 'class="btn btn-link text-default-color btn-icon-right"';
}

add_filter('next_posts_link_attributes', 'uncode_posts_link_next_class');
add_filter('next_comments_link_attributes', 'uncode_posts_link_next_class');

function uncode_posts_link_prev_class() {
	return 'class="btn btn-link text-default-color btn-icon-left"';
}

add_filter('previous_posts_link_attributes', 'uncode_posts_link_prev_class');
add_filter('previous_comments_link_attributes', 'uncode_posts_link_prev_class');


if ( ! function_exists( 'uncode_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function uncode_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'uncode' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'uncode' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

	}
endif;

if ( ! function_exists( 'uncode_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function uncode_entry_meta() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'uncode' ) );
			if ( $categories_list && uncode_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'uncode' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'uncode' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'uncode' ) . '</span>', $tags_list );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'uncode' ), esc_html__( '1 Comment', 'uncode' ), esc_html__( '% Comments', 'uncode' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'uncode' ), '<span class="edit-link">', '</span>' );
	}
endif;

if ( ! function_exists( 'uncode_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function uncode_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'uncode' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'uncode' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'uncode' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'uncode' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'uncode' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'uncode' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'uncode' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'uncode' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'uncode' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'uncode' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'uncode' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'uncode' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'uncode' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'uncode' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'uncode' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives %s', 'uncode' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = single_term_title( '', false );
	} else {
		$title = esc_html__( 'Archives', 'uncode' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		return $before . $title . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function uncode_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'uncode_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'uncode_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so uncode_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so uncode_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in uncode_categorized_blog.
 */
function uncode_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'uncode_categories' );
}
add_action( 'edit_category', 'uncode_category_transient_flusher' );
add_action( 'save_post',     'uncode_category_transient_flusher' );
