<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if (class_exists('RP4WP')) {

	/**
	 * Class RP4WP_Settings
	 *
	 * @todo Make class for each input type with own sanitize method.
	 */
	class Uncode_RP4WP_Settings extends RP4WP_Settings {

		const PREFIX = 'rp4wp_';
		const PAGE = 'rp4wp';

		public function __construct() {

			// CSS default
			$css_default_lines   = array();
			$css_default_lines[] = '.rp4wp-related-posts ul{width:100%;padding:0;margin:0;float:left;}';
			$css_default_lines[] = '.rp4wp-related-posts ul>li{list-style:none;padding:0;margin:0;padding-bottom:20px;clear:both;}';
			$css_default_lines[] = '.rp4wp-related-posts ul>li>p{margin:0;padding:0;}';
			$css_default_lines[] = '.rp4wp-related-post-image{width:35%;padding-right:25px;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;float:left;}';

			if ( is_rtl() ) {
				$css_default_lines   = array();
				$css_default_lines[] = '.rp4wp-related-posts ul{width:100%;padding:0;margin:0;float:right;}';
				$css_default_lines[] = '.rp4wp-related-posts ul>li{list-style:none;padding:0;margin:0;padding-bottom:20px;float:right;}';
				$css_default_lines[] = '.rp4wp-related-posts ul>li>p{margin:0;padding:0;}';
				$css_default_lines[] = '.rp4wp-related-post-image{width:35%;padding-left:25px;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;float:right;}';
			}

			// The fields
			$this->sections = array(
				'general' => array(
					'id'          => 'general',
					'label'       => __( 'General', 'related-posts-for-wp' ),
					'description' => __( 'The following options affect the general behaviour of the plugin.', 'related-posts-for-wp' ),
					'fields'      => array(
						array(
							'id'          => 'automatic_linking',
							'label'       => __( 'Enable', 'related-posts-for-wp' ),
							'description' => __( 'Checking this will enable automatically linking posts to new posts', 'related-posts-for-wp' ),
							'type'        => 'checkbox',
							'default'     => 1,
						),
						array(
							'id'          => 'automatic_linking_post_amount',
							'label'       => __( 'Amount of Posts', 'related-posts-for-wp' ),
							'description' => __( 'The amount of automatically linked post', 'related-posts-for-wp' ),
							'type'        => 'text',
							'default'     => '3',
						),
						array(
							'id'          => 'heading_text',
							'label'       => __( 'Heading text', 'related-posts-for-wp' ),
							'description' => __( 'The text that is displayed above the related posts. To disable, leave field empty.', 'related-posts-for-wp' ),
							'type'        => 'text',
							'default'     => __( 'Related Posts', 'related-posts-for-wp' ),
						),
						array(
							'id'          => 'excerpt_length',
							'label'       => __( 'Excerpt length', 'related-posts-for-wp' ),
							'description' => __( 'The amount of words to be displayed below the title on website. To disable, set value to 0.', 'related-posts-for-wp' ),
							'type'        => 'text',
							'default'     => '15',
						)
					) ),
				'styling'               => array(
					'id'          => 'styling',
					'label'       => __( 'Styling', 'related-posts-for-wp' ),
					'description' => __( 'The following options affect how related posts are displayed on the frontend.', 'related-posts-for-wp' ),
					'fields'      => array(
						array(
							'id'          => 'display_image',
							'label'       => __( 'Display Image', 'related-posts-for-wp' ),
							'description' => __( 'Checking this will enable displaying featured images of related posts.', 'related-posts-for-wp' ),
							'type'        => 'checkbox',
							'default'     => 0,
						),
						array(
							'id'          => 'css',
							'label'       => __( 'CSS', 'related-posts-for-wp' ),
							'description' => __( 'Warning! This is an advanced feature! An error here will break frontend display. To disable, leave field empty.', 'related-posts-for-wp' ),
							'type'        => 'textarea',
							'default'     => implode( PHP_EOL, $css_default_lines ),
						)
					) ),
				'misc'              => array(
					'id'          => 'misc',
					'label'       => __( 'Misc', 'related-posts-for-wp' ),
					'description' => __( "A shelter for options that just don't fit in anywhere else.", 'related-posts-for-wp' ),
					'fields'      => array(
						array(
							'id'          => 'restart_wizard_button',
							'label'       => __( 'Restart the wizard?', 'related-posts-for-wp' ),
							'description' => __( "Click this button if you want to restart the wizard. Please note that this will delete all current related post links, also those you've manually added. Of course, we will never delete your actual posts.", 'related-posts-for-wp' ),
							'type'        => 'button_link',
							'href'        => admin_url( '?page=rp4wp_install&reinstall=1&rp4wp_nonce=' . wp_create_nonce( RP4WP_Constants::NONCE_INSTALL ) ),
							'default'     => __( 'Restart wizard', 'related-posts-for-wp' ),
						),
						array(
							'id'          => 'clean_on_uninstall',
							'label'       => __( 'Remove Data on Uninstall?', 'related-posts-for-wp' ),
							'description' => __( 'Check this box if you would like to completely remove all of its data when the plugin is deleted.', 'related-posts-for-wp' ),
							'type'        => 'checkbox',
							'default'     => 0,
						),
						array(
							'id'          => 'show_love',
							'label'       => __( 'Show love?', 'related-posts-for-wp' ),
							'description' => __( "Display a 'Powered by' line under your related posts. <strong>BEWARE! Only for the real fans.</strong>", 'related-posts-for-wp' ),
							'type'        => 'checkbox',
							'default'     => 0,
						),
					) ),
			);

			// Set defaults
			foreach ( $this->sections as $section ) {
				foreach ( $section['fields'] as $field ) {
					$this->defaults[$field['id']] = $field['default'];
				}
			}

			// Setup settings
			add_action( 'admin_init', array( $this, 'setup' ) );

		}

	}
	class Uncode_RP4WP_Hook_Settings_Page extends RP4WP_Hook {
		protected $tag = 'admin_menu';

		/**
		 * Hook callback, add the sub menu page
		 *
		 * @since  1.1.0
		 * @access public
		 */
		public function run() {
			$menu_hook = add_submenu_page( 'uncode-menu', __( 'Related Posts', 'related-posts-for-wp' ), __( 'Related Posts', 'related-posts-for-wp' ), 'manage_options', 'rp4wp', array(
				$this,
				'screen'
			) );

			add_action( 'load-' . $menu_hook, array( $this, 'enqueue_assets' ) );
		}

		/**
		 * Enqueue settings page assets
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function enqueue_assets() {
			global $pagenow;
			wp_enqueue_style( 'rp4wp-settings-css', plugins_url( '/assets/css/settings.css', RP4WP::get_plugin_file() ), array(), RP4WP::VERSION );
			if ( 'admin.php' == $pagenow && isset( $_GET['page'] ) && $_GET['page'] === 'rp4wp' ) {

				// Main settings JS
				wp_enqueue_script(
					'rp4wp_settings_js',
					plugins_url( '/assets/js/settings' . ( ( ! SCRIPT_DEBUG ) ? '.min' : '' ) . '.js', RP4WP::get_plugin_file() ),
					array( 'jquery' ),
					RP4WP::VERSION
				);

			}
		}

		/**
		 * Settings screen output
		 *
		 * @since  1.1.0
		 * @access public
		 */
		public function screen() {
			global $wp_settings_sections, $wp_settings_fields;
			?>
			<div class="wrap">
				<h2><?php esc_html_e('Related posts','uncode'); ?></h2>

				<div class="rp4wp-content">
					<form method="post" action="options.php" id="rp4wp-settings-form">
						<?php
						//pass slug name of page, also referred  to in Settings API as option group name
						settings_fields( 'rp4wp' );

						if ( isset( $wp_settings_sections['rp4wp'] ) ) {

							unset($wp_settings_sections['rp4wp']['styling']);

							echo '<h2 class="nav-tab-wrapper">';
							foreach ( (array) $wp_settings_sections['rp4wp'] as $section ) {
								//nav-tab-active
								echo '<a href="#rp4wp-settings-' . $section['id'] . '" class="nav-tab">' . $section['title'] . '</a>';
							}
							echo '</h2>' . PHP_EOL;
							?>
							<?php

							foreach ( (array) $wp_settings_sections['rp4wp'] as $section ) {

								echo '<div id="rp4wp-settings-' . $section['id'] . '" class="rp4wp-settings-section">';

								if ( $section['title'] ) {
									echo "<h3>{$section['title']}</h3>\n";
								}

								if ( $section['callback'] ) {
									call_user_func( $section['callback'], $section );
								}

								if ( isset( $wp_settings_fields ) && isset( $wp_settings_fields['rp4wp'] ) && isset( $wp_settings_fields['rp4wp'][ $section['id'] ] ) ) {
									echo '<table class="form-table">';
									do_settings_fields( 'rp4wp', $section['id'] );
									echo '</table>';

								}

								echo '</div>';
							}


						}

						// submit button
						submit_button();
						?>
					</form>
				</div>
			</div>
			<?php
		}
	}


		add_filter( 'rp4wp_append_content', '__return_false' );
		function uncode_related_menu_page_removing() {
	    remove_submenu_page( 'options-general.php', 'rp4wp' );
	    $uncode_rp4wp = new Uncode_RP4WP_Hook_Settings_Page();
	    $uncode_rp4wp->run();
		}
		add_action( 'admin_menu', 'uncode_related_menu_page_removing', 100 );
	}

?>