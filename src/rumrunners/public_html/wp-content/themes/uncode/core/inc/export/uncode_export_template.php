<?php
/**
 * WordPress Export Administration API
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * Version number for the export format.
 *
 * Bump this when something changes that might affect compatibility.
 *
 * @since 2.5.0
 */
define( 'WXR_VERSION', '1.2' );

/**
 * Generates the WXR export file for download
 *
 * @since 2.1.0
 *
 * @param array $args Filters defining what should be included in the export
 */
function uncode_export_wp( $args = array() ) {
	global $wpdb, $post;

	$defaults = array( 'content' => 'all', 'author' => false, 'category' => false,
		'start_date' => false, 'end_date' => false, 'status' => false,
	);

	$args = wp_parse_args( $args, $defaults );

	do_action( 'uncode_export_wp', $args );

	if ( 'all' != $args['content'] && post_type_exists( $args['content'] ) ) {
		$ptype = get_post_type_object( $args['content'] );
		if ( ! $ptype->can_export )
			$args['content'] = 'post';

		$where = $wpdb->prepare( "{$wpdb->posts}.post_type = %s", $args['content'] );
	} else {
		$post_types = get_post_types( array( 'can_export' => true ) );
		$esses = array_fill( 0, count($post_types), '%s' );
		$where = $wpdb->prepare( "{$wpdb->posts}.post_type IN (" . implode( ',', $esses ) . ')', $post_types );
	}

	if ( $args['status'] && ( 'post' == $args['content'] || 'page' == $args['content'] ) )
		$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_status = %s", $args['status'] );
	else
		$where .= " AND {$wpdb->posts}.post_status != 'auto-draft'";

	$join = '';
	if ( $args['category'] && 'post' == $args['content'] ) {
		if ( $term = term_exists( $args['category'], 'category' ) ) {
			$join = "INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id)";
			$where .= $wpdb->prepare( " AND {$wpdb->term_relationships}.term_taxonomy_id = %d", $term['term_taxonomy_id'] );
		}
	}

	if ( 'post' == $args['content'] || 'page' == $args['content'] ) {
		if ( $args['author'] )
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_author = %d", $args['author'] );

		if ( $args['start_date'] )
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_date >= %s", date( 'Y-m-d', strtotime($args['start_date']) ) );

		if ( $args['end_date'] )
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_date < %s", date( 'Y-m-d', strtotime('+1 month', strtotime($args['end_date'])) ) );
	}

	// grab a snapshot of post IDs, just in case it changes during the export
	$post_ids = $wpdb->get_col( "SELECT ID FROM {$wpdb->posts} $join WHERE $where" );

	// get the requested terms ready, empty unless posts filtered by category or all content
	$cats = $tags = $terms = array();
	if ( isset( $term ) && $term ) {
		$cat = get_term( $term['term_id'], 'category' );
		$cats = array( $cat->term_id => $cat );
		unset( $term, $cat );
	} else if ( 'all' == $args['content'] ) {
		$categories = (array) get_categories( array( 'get' => 'all' ) );
		$tags = (array) get_tags( array( 'get' => 'all' ) );

		$custom_taxonomies = get_taxonomies( array( '_builtin' => false ) );
		$custom_terms = (array) get_terms( $custom_taxonomies, array( 'get' => 'all' ) );

		// put categories in order with no child going before its parent
		while ( $cat = array_shift( $categories ) ) {
			if ( $cat->parent == 0 || isset( $cats[$cat->parent] ) )
				$cats[$cat->term_id] = $cat;
			else
				$categories[] = $cat;
		}

		// put terms in order with no child going before its parent
		while ( $t = array_shift( $custom_terms ) ) {
			if ( $t->parent == 0 || isset( $terms[$t->parent] ) )
				$terms[$t->term_id] = $t;
			else
				$custom_terms[] = $t;
		}

		unset( $categories, $custom_taxonomies, $custom_terms );
	}

	/**
	 * Wrap given string in XML CDATA tag.
	 *
	 * @since 2.1.0
	 *
	 * @param string $str String to wrap in XML CDATA tag.
	 * @return string
	 */
	function wxr_cdata( $str ) {
		if ( seems_utf8( $str ) == false )
			$str = utf8_encode( $str );

		// $str = ent2ncr(esc_html($str));
		$str = '<![CDATA[' . str_replace( ']]>', ']]]]><![CDATA[>', $str ) . ']]>';

		return $str;
	}

	/**
	 * Return the URL of the site
	 *
	 * @since 2.5.0
	 *
	 * @return string Site URL.
	 */
	function wxr_site_url() {
		// ms: the base url
		if ( is_multisite() )
			return network_home_url();
		// wp: the blog url
		else
			return get_bloginfo_rss( 'url' );
	}

	/**
	 * Output a cat_name XML tag from a given category object
	 *
	 * @since 2.1.0
	 *
	 * @param object $category Category Object
	 */
	function wxr_cat_name( $category ) {
		if ( empty( $category->name ) )
			return;

		echo '<wp:cat_name>' . wxr_cdata( $category->name ) . '</wp:cat_name>';
	}

	/**
	 * Output a category_description XML tag from a given category object
	 *
	 * @since 2.1.0
	 *
	 * @param object $category Category Object
	 */
	function wxr_category_description( $category ) {
		if ( empty( $category->description ) )
			return;

		echo '<wp:category_description>' . wxr_cdata( $category->description ) . '</wp:category_description>';
	}

	/**
	 * Output a tag_name XML tag from a given tag object
	 *
	 * @since 2.3.0
	 *
	 * @param object $tag Tag Object
	 */
	function wxr_tag_name( $tag ) {
		if ( empty( $tag->name ) )
			return;

		echo '<wp:tag_name>' . wxr_cdata( $tag->name ) . '</wp:tag_name>';
	}

	/**
	 * Output a tag_description XML tag from a given tag object
	 *
	 * @since 2.3.0
	 *
	 * @param object $tag Tag Object
	 */
	function wxr_tag_description( $tag ) {
		if ( empty( $tag->description ) )
			return;

		echo '<wp:tag_description>' . wxr_cdata( $tag->description ) . '</wp:tag_description>';
	}

	/**
	 * Output a term_name XML tag from a given term object
	 *
	 * @since 2.9.0
	 *
	 * @param object $term Term Object
	 */
	function wxr_term_name( $term ) {
		if ( empty( $term->name ) )
			return;

		echo '<wp:term_name>' . wxr_cdata( $term->name ) . '</wp:term_name>';
	}

	/**
	 * Output a term_description XML tag from a given term object
	 *
	 * @since 2.9.0
	 *
	 * @param object $term Term Object
	 */
	function wxr_term_description( $term ) {
		if ( empty( $term->description ) )
			return;

		echo '<wp:term_description>' . wxr_cdata( $term->description ) . '</wp:term_description>';
	}

	/**
	 * Output list of authors with posts
	 *
	 * @since 3.1.0
	 */
	function wxr_authors_list() {
		global $wpdb;

		$authors = array();
		$results = $wpdb->get_results( "SELECT DISTINCT post_author FROM $wpdb->posts WHERE post_status != 'auto-draft'" );
		foreach ( (array) $results as $result )
			$authors[] = get_userdata( $result->post_author );

		$authors = array_filter( $authors );

		foreach ( $authors as $author ) {
			echo "\t<wp:author>";
			echo '<wp:author_id>' . $author->ID . '</wp:author_id>';
			echo '<wp:author_login>' . $author->user_login . '</wp:author_login>';
			echo '<wp:author_email>' . $author->user_email . '</wp:author_email>';
			echo '<wp:author_display_name>' . wxr_cdata( $author->display_name ) . '</wp:author_display_name>';
			echo '<wp:author_first_name>' . wxr_cdata( $author->user_firstname ) . '</wp:author_first_name>';
			echo '<wp:author_last_name>' . wxr_cdata( $author->user_lastname ) . '</wp:author_last_name>';
			echo "</wp:author>\n";
		}
	}

	/**
	 * Ouput all navigation menu terms
	 *
	 * @since 3.1.0
	 */
	function wxr_nav_menu_terms() {
		$nav_menus = wp_get_nav_menus();
		if ( empty( $nav_menus ) || ! is_array( $nav_menus ) )
			return;

		foreach ( $nav_menus as $menu ) {
			echo "\t<wp:term><wp:term_id>{$menu->term_id}</wp:term_id><wp:term_taxonomy>nav_menu</wp:term_taxonomy><wp:term_slug>{$menu->slug}</wp:term_slug>";
			wxr_term_name( $menu );
			echo "</wp:term>\n";
		}
	}

	/**
	 * Output list of taxonomy terms, in XML tag format, associated with a post
	 *
	 * @since 2.3.0
	 */
	function wxr_post_taxonomy() {
		$post = get_post();

		$taxonomies = get_object_taxonomies( $post->post_type );
		if ( empty( $taxonomies ) )
			return;
		$terms = wp_get_object_terms( $post->ID, $taxonomies );

		foreach ( (array) $terms as $term ) {
			echo "\t\t<category domain=\"{$term->taxonomy}\" nicename=\"{$term->slug}\">" . wxr_cdata( $term->name ) . "</category>\n";
		}
	}

	function wxr_filter_postmeta( $return_me, $meta_key ) {
		if ( '_edit_lock' == $meta_key )
			$return_me = true;
		return $return_me;
	}
	add_filter( 'wxr_export_skip_postmeta', 'wxr_filter_postmeta', 10, 2 );
	echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . "\" ?>\n";?>
<!-- This is a WordPress eXtended RSS file generated by WordPress as an export of your site. -->
<!-- It contains information about your site's posts, pages, comments, categories, and other content. -->
<!-- You may use this file to transfer that content from one site to another. -->
<!-- This file is not intended to serve as a complete backup of your site. -->

<!-- To import this information into a WordPress site follow these steps: -->
<!-- 1. Log in to that site as an administrator. -->
<!-- 2. Go to Tools: Import in the WordPress admin panel. -->
<!-- 3. Install the "WordPress" importer from the list. -->
<!-- 4. Activate & Run Importer. -->
<!-- 5. Upload this file using the form provided on that page. -->
<!-- 6. You will first be asked to map the authors in this export file to users -->
<!--    on the site. For each author, you may choose to map to an -->
<!--    existing user on the site or to create a new user. -->
<!-- 7. WordPress will then import each of the posts, pages, comments, categories, etc. -->
<!--    contained in this file into your site. -->

<?php the_generator( 'export' ); ?>
<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/<?php echo WXR_VERSION; ?>/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/<?php echo WXR_VERSION; ?>/"
>

<channel>
	<title><?php bloginfo_rss( 'name' ); ?></title>
	<link><?php bloginfo_rss( 'url' ); ?></link>
	<description><?php bloginfo_rss( 'description' ); ?></description>
	<pubDate><?php echo date( 'D, d M Y H:i:s +0000' ); ?></pubDate>
	<language><?php bloginfo_rss( 'language' ); ?></language>
	<wp:wxr_version><?php echo WXR_VERSION; ?></wp:wxr_version>
	<wp:base_site_url><?php echo wxr_site_url(); ?></wp:base_site_url>
	<wp:base_blog_url><?php bloginfo_rss( 'url' ); ?></wp:base_blog_url>

<?php wxr_authors_list(); ?>

<?php foreach ( $cats as $c ) : ?>
	<wp:category><wp:term_id><?php echo wp_kses_post($c->term_id); ?></wp:term_id><wp:category_nicename><?php echo esc_html($c->slug); ?></wp:category_nicename><wp:category_parent><?php if ($c->parent) echo esc_html($cats[$c->parent]->slug); ?></wp:category_parent><?php wxr_cat_name( $c ); ?><?php wxr_category_description( $c ); ?></wp:category>
<?php endforeach; ?>
<?php foreach ( $tags as $t ) : ?>
	<wp:tag><wp:term_id><?php echo esc_html($t->term_id); ?></wp:term_id><wp:tag_slug><?php echo esc_html($t->slug); ?></wp:tag_slug><?php wxr_tag_name( $t ); ?><?php wxr_tag_description( $t ); ?></wp:tag>
<?php endforeach; ?>
<?php foreach ( $terms as $t ) : ?>
	<wp:term><wp:term_id><?php echo esc_html($t->term_id); ?></wp:term_id><wp:term_taxonomy><?php echo esc_html($t->taxonomy); ?></wp:term_taxonomy><wp:term_slug><?php echo esc_html($t->slug); ?></wp:term_slug><wp:term_parent><?php if ($t->parent) echo esc_html($terms[$t->parent]->slug); ?></wp:term_parent><?php wxr_term_name( $t ); ?><?php wxr_term_description( $t ); ?></wp:term>
<?php endforeach; ?>
<?php if ( 'all' == $args['content'] ) wxr_nav_menu_terms(); ?>

	<?php do_action( 'rss2_head' ); ?>

<?php if ( $post_ids ) {
	global $wp_query;
	$wp_query->in_the_loop = true; // Fake being in the loop.

	// fetch 20 posts at a time rather than loading the entire table into memory
	while ( $next_posts = array_splice( $post_ids, 0, 20 ) ) {
	$where = 'WHERE ID IN (' . join( ',', $next_posts ) . ')';
	$posts = $wpdb->get_results( "SELECT * FROM {$wpdb->posts} $where" );

	// Begin Loop
	foreach ( $posts as $post ) {
		setup_postdata( $post );
		$is_sticky = is_sticky( $post->ID ) ? 1 : 0;
?>
	<item>
		<?php /** This filter is documented in wp-includes/feed.php */
		$post_title = $post->post_title;
		$post_name = $post->post_name;
		$media_url = wp_get_attachment_url( $post->ID );
		$post_guid = get_the_guid();
		$post_meta_key = '';
		if ( $post->post_type == 'attachment') :
			if (strpos($post->post_mime_type,'image/') !== false && $post->post_mime_type !== 'image/url' && $post->post_mime_type !== 'image/url' && strpos($post_guid,'undsgn.com') !== false) {
				$random_value = rand();
				$post_title = 'Demo media ' . $random_value;
				$post_name = 'demo-media-' . $random_value;
				if ($post->post_mime_type === 'image/svg+xml') {
					$media_name = basename($post_guid);
				} else if ($post->post_mime_type === 'image/png') {
					$media_name = basename($post_guid);
				} else {
					$upload_dir = wp_upload_dir();
					if (strpos($media_url,'product-') !== false) {
						$media_name = 'product-placeholder.jpg';
					} else {
						$media_name = 'photo-placeholder-'.rand(1,20).'.jpg';
					}
				}
				$media_url = 'http://static.undsgn.com/uncode/placeholder/' . $media_name;
				$post_guid = 'http://static.undsgn.com/uncode/placeholder/' . $media_name;
				$post_meta_key = trailingslashit(ltrim($upload_dir['subdir'], '/')).$media_name;
			}
		endif; ?>
		<title><?php echo apply_filters( 'the_title_rss', $post_title );  ?></title>
		<link><?php the_permalink_rss() ?></link>
		<pubDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ); ?></pubDate>
		<dc:creator><?php echo wxr_cdata( get_the_author_meta( 'login' ) ); ?></dc:creator>
		<guid isPermaLink="false"><?php echo esc_url($post_guid); ?></guid>
		<description></description>
		<content:encoded><?php echo wxr_cdata( apply_filters( 'the_content_export', $post->post_content ) ); ?></content:encoded>
		<excerpt:encoded><?php echo wxr_cdata( apply_filters( 'the_excerpt_export', $post->post_excerpt ) ); ?></excerpt:encoded>
		<wp:post_id><?php echo esc_html($post->ID); ?></wp:post_id>
		<wp:post_date><?php echo esc_html($post->post_date); ?></wp:post_date>
		<wp:post_date_gmt><?php echo esc_html($post->post_date_gmt); ?></wp:post_date_gmt>
		<wp:comment_status><?php echo esc_html($post->comment_status); ?></wp:comment_status>
		<wp:ping_status><?php echo esc_html($post->ping_status); ?></wp:ping_status>
		<wp:post_name><?php echo esc_html($post_name); ?></wp:post_name>
		<wp:status><?php echo esc_html($post->post_status); ?></wp:status>
		<wp:post_parent><?php echo esc_html($post->post_parent); ?></wp:post_parent>
		<wp:menu_order><?php echo esc_html($post->menu_order); ?></wp:menu_order>
		<wp:post_type><?php echo esc_html($post->post_type); ?></wp:post_type>
		<wp:post_password><?php echo esc_html($post->post_password); ?></wp:post_password>
		<wp:is_sticky><?php echo esC_html($is_sticky); ?></wp:is_sticky>
<?php	if ( $post->post_type == 'attachment' ) : ?>
		<wp:attachment_url><?php echo esc_url($media_url); ?></wp:attachment_url>
		<wp:post_mime_type><?php echo esc_html($post->post_mime_type); ?></wp:post_mime_type>
<?php 	endif; ?>
<?php 	wxr_post_taxonomy(); ?>
<?php	$postmeta = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE post_id = %d", $post->ID ) );
		foreach ( $postmeta as $meta ) :
			if ( apply_filters( 'wxr_export_skip_postmeta', false, $meta->meta_key, $meta ) )
				continue;

			if ('_wp_attached_file' === $meta->meta_key && $post_meta_key !== '' ) {
				$post_meta_value = $post_meta_key;
			} else {
				$post_meta_value = $meta->meta_value;
			}
		?>
		<wp:postmeta>
			<wp:meta_key><?php echo esc_html($meta->meta_key); ?></wp:meta_key>
			<wp:meta_value><?php echo wxr_cdata($post_meta_value); ?></wp:meta_value>
		</wp:postmeta>
<?php	endforeach; ?>
<?php	$comments = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved <> 'spam'", $post->ID ) );
		foreach ( $comments as $c ) : ?>
		<wp:comment>
			<wp:comment_id><?php echo esc_html($c->comment_ID); ?></wp:comment_id>
			<wp:comment_author><?php echo wxr_cdata( wp_kses_post($c->comment_author) ); ?></wp:comment_author>
			<wp:comment_author_email><?php echo esc_html($c->comment_author_email); ?></wp:comment_author_email>
			<wp:comment_author_url><?php echo esc_url_raw( $c->comment_author_url ); ?></wp:comment_author_url>
			<wp:comment_author_IP><?php echo esc_html($c->comment_author_IP); ?></wp:comment_author_IP>
			<wp:comment_date><?php echo esc_html($c->comment_date); ?></wp:comment_date>
			<wp:comment_date_gmt><?php echo esc_html($c->comment_date_gmt); ?></wp:comment_date_gmt>
			<wp:comment_content><?php echo wxr_cdata( wp_kses_post($c->comment_content) ) ?></wp:comment_content>
			<wp:comment_approved><?php echo esc_html($c->comment_approved); ?></wp:comment_approved>
			<wp:comment_type><?php echo esc_html($c->comment_type); ?></wp:comment_type>
			<wp:comment_parent><?php echo esc_html($c->comment_parent); ?></wp:comment_parent>
			<wp:comment_user_id><?php echo esc_html($c->user_id); ?></wp:comment_user_id>
<?php		$c_meta = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->commentmeta WHERE comment_id = %d", $c->comment_ID ) );
			foreach ( $c_meta as $meta ) : ?>
			<wp:commentmeta>
				<wp:meta_key><?php echo esc_html($meta->meta_key); ?></wp:meta_key>
				<wp:meta_value><?php echo wxr_cdata( wp_kses_post($meta->meta_value) ); ?></wp:meta_value>
			</wp:commentmeta>
<?php		endforeach; ?>
		</wp:comment>
<?php	endforeach; ?>
	</item>
<?php
	}
	}
} ?>
</channel>
</rss>
<?php
} ?>
