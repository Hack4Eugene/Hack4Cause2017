<?php

function export_submenu_page_callback() {

	if ( !current_user_can('export') )
		wp_die(esc_html__('You do not have sufficient permissions to export the content of this site.','uncode'));

	global $wpdb;
	/** Load WordPress export API */

	$title = esc_html__('Export','uncode');

	/**
	 * Display JavaScript on the page.
	 *
	 * @since 3.5.0
	 */
	?>
	<script type="text/javascript">
	//<![CDATA[
		jQuery(document).ready(function($){
	 		var form = $('#export-filters'),
	 			filters = form.find('.export-filters');
	 		filters.hide();
	 		form.find('input:radio').change(function() {
				filters.slideUp('fast');
				switch ( $(this).val() ) {
					case 'posts': $('#post-filters').slideDown(); break;
					case 'pages': $('#page-filters').slideDown(); break;
				}
	 		});
		});
	//]]>
	</script>
	<?php

	get_current_screen()->add_help_tab( array(
		'id'      => 'overview',
		'title'   => esc_html__('Overview','uncode'),
		'content' => '<p>' . esc_html__('You can export a file of your site&#8217;s content in order to import it into another installation or platform. The export file will be an XML file format called WXR. Posts, pages, comments, custom fields, categories, and tags can be included. You can choose for the WXR file to include only certain posts or pages by setting the dropdown filters to limit the export by category, author, date range by month, or publishing status.','uncode') . '</p>' .
			'<p>' . esc_html__('Once generated, your WXR file can be imported by another WordPress site or by another blogging platform able to access this format.','uncode') . '</p>',
	) );

	get_current_screen()->set_help_sidebar(
		'<p><strong>' . esc_html__('For more information:','uncode') . '</strong></p>' .
		'<p><a href="http://codex.wordpress.org/Tools_Export_Screen" target="_blank">' . esc_html__('Documentation on Export','uncode') . '</a></p>' .
		'<p><a href="http://wordpress.org/support/" target="_blank">' . esc_html__('Support Forums','uncode') . '</a></p>'
	);


	/**
	 * Create the date options fields for exporting a given post type.
	 *
	 * @global wpdb      $wpdb      WordPress database object.
	 * @global WP_Locale $wp_locale Date and Time Locale object.
	 *
	 * @since 3.1.0
	 *
	 * @param string $post_type The post type. Default 'post'.
	 */
	function export_date_options( $post_type = 'post' ) {
		global $wpdb, $wp_locale;

		$months = $wpdb->get_results( $wpdb->prepare("SELECT DISTINCT YEAR( post_date ) AS year, MONTH( post_date ) AS month FROM $wpdb->posts WHERE post_type = %s AND post_status != 'auto-draft' ORDER BY post_date DESC", $post_type ) );

		$month_count = count( $months );
		if ( !$month_count || ( 1 == $month_count && 0 == $months[0]->month ) )
			return;

		foreach ( $months as $date ) {
			if ( 0 == $date->year )
				continue;

			$month = zeroise( $date->month, 2 );
			echo '<option value="' . $date->year . '-' . $month . '">' . $wp_locale->get_month( $month ) . ' ' . $date->year . '</option>';
		}
	}
	?>

	<div class="wrap">
	<h2><?php echo esc_html( $title ); ?></h2>

	<p><?php esc_html_e('When you click the button below WordPress will create an XML file for you to save to your computer.','uncode'); ?></p>
	<p><?php esc_html_e('This format, which we call WordPress eXtended RSS or WXR, will contain your posts, pages, comments, custom fields, categories, and tags.','uncode'); ?></p>
	<p><?php esc_html_e('Once you&#8217;ve saved the download file, you can use the Import function in another WordPress installation to import the content from this site.','uncode'); ?></p>

	<h3><?php esc_html_e( 'Choose what to export','uncode'); ?></h3>
	<form action="" method="get" id="export-filters">
	<input type="hidden" name="page" value="uncode-export" />
	<input type="hidden" name="download" value="true" />
	<p><label><input type="radio" name="content" value="all" checked="checked" /> <?php esc_html_e( 'All content','uncode'); ?></label></p>
	<p class="description"><?php esc_html_e( 'This will contain all of your posts, pages, comments, custom fields, terms, navigation menus and custom posts.','uncode'); ?></p>

	<p><label><input type="radio" name="content" value="posts" /> <?php esc_html_e( 'Posts','uncode'); ?></label></p>
	<ul id="post-filters" class="export-filters">
		<li>
			<label><?php esc_html_e( 'Categories:','uncode'); ?></label>
			<?php wp_dropdown_categories( array( 'show_option_all' => esc_html__('All','uncode') ) ); ?>
		</li>
		<li>
			<label><?php esc_html_e( 'Authors:','uncode'); ?></label>
	<?php
			$authors = $wpdb->get_col( "SELECT DISTINCT post_author FROM {$wpdb->posts} WHERE post_type = 'post'" );
			wp_dropdown_users( array( 'include' => $authors, 'name' => 'post_author', 'multi' => true, 'show_option_all' => esc_html__('All','uncode') ) );
	?>
		</li>
		<li>
			<label><?php esc_html_e( 'Date range:','uncode'); ?></label>
			<select name="post_start_date">
				<option value="0"><?php esc_html_e( 'Start Date','uncode'); ?></option>
				<?php export_date_options(); ?>
			</select>
			<select name="post_end_date">
				<option value="0"><?php esc_html_e( 'End Date','uncode'); ?></option>
				<?php export_date_options(); ?>
			</select>
		</li>
		<li>
			<label><?php esc_html_e( 'Status:','uncode'); ?></label>
			<select name="post_status">
				<option value="0"><?php esc_html_e( 'All','uncode'); ?></option>
				<?php $post_stati = get_post_stati( array( 'internal' => false ), 'objects' );
				foreach ( $post_stati as $status ) : ?>
				<option value="<?php echo esc_attr( $status->name ); ?>"><?php echo esc_html( $status->label ); ?></option>
				<?php endforeach; ?>
			</select>
		</li>
	</ul>

	<p><label><input type="radio" name="content" value="pages" /> <?php esc_html_e( 'Pages','uncode'); ?></label></p>
	<ul id="page-filters" class="export-filters">
		<li>
			<label><?php esc_html_e( 'Authors:','uncode'); ?></label>
	<?php
			$authors = $wpdb->get_col( "SELECT DISTINCT post_author FROM {$wpdb->posts} WHERE post_type = 'page'" );
			wp_dropdown_users( array( 'include' => $authors, 'name' => 'page_author', 'multi' => true, 'show_option_all' => esc_html__('All','uncode') ) );
	?>
		</li>
		<li>
			<label><?php esc_html_e( 'Date range:','uncode'); ?></label>
			<select name="page_start_date">
				<option value="0"><?php esc_html_e( 'Start Date','uncode'); ?></option>
				<?php export_date_options( 'page' ); ?>
			</select>
			<select name="page_end_date">
				<option value="0"><?php esc_html_e( 'End Date','uncode'); ?></option>
				<?php export_date_options( 'page' ); ?>
			</select>
		</li>
		<li>
			<label><?php esc_html_e( 'Status:','uncode'); ?></label>
			<select name="page_status">
				<option value="0"><?php esc_html_e( 'All','uncode'); ?></option>
				<?php foreach ( $post_stati as $status ) : ?>
				<option value="<?php echo esc_attr( $status->name ); ?>"><?php echo esc_html( $status->label ); ?></option>
				<?php endforeach; ?>
			</select>
		</li>
	</ul>

	<?php foreach ( get_post_types( array( '_builtin' => false, 'can_export' => true ), 'objects' ) as $post_type ) : ?>
	<p><label><input type="radio" name="content" value="<?php echo esc_attr( $post_type->name ); ?>" /> <?php echo esc_html( $post_type->label ); ?></label></p>
	<?php endforeach; ?>

	<?php
	/**
	 * Fires after the export filters form.
	 *
	 * @since 3.5.0
	 */
	do_action( 'export_filters' );
	?>

	<?php submit_button( esc_html__('Download Export File','uncode') ); ?>
	</form>
	</div>
<?php } ?>