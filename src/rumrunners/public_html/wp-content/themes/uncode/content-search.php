<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package uncode
 */

$post_type = get_post_type();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title h4"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php
			$text = wp_strip_all_tags(do_shortcode(get_the_content()));
			echo uncode_truncate($text, 400);
		?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
