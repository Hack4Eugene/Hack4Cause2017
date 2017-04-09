<?php

/**
 * uncode Theme Customizer
 *
 * @package uncode
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uncode_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
}
add_action('customize_register', 'uncode_customize_register');

function uncode_custom_excerpt_length($length)
{
	return 20;
}
add_filter('excerpt_length', 'uncode_custom_excerpt_length', 999);

/**
 * Customization IRecommendThis
 */
if (class_exists('DOT_IRecommendThis'))
{
	class UNCODE_IRecommendThis extends DOT_IRecommendThis
	{
		function __construct($file)
		{
			remove_action('init', array(&$this,'add_widget_most_recommended_posts'));
			add_action('init', array(&$this,'uncode_add_widget_most_recommended_posts'));
			add_action( 'wp_ajax_uncode-dot-irecommendthis', array( &$this, 'uncode_ajax_callback' ) );
			add_action( 'wp_ajax_nopriv_uncode-dot-irecommendthis', array( &$this, 'uncode_ajax_callback' ) );
		}

		function dot_recommend_this($post_id, $text_zero_suffix = false, $text_one_suffix = false, $text_more_suffix = false, $action = 'get')
		{
			if (!is_numeric($post_id)) return;
			$text_zero_suffix = strip_tags($text_zero_suffix);
			$text_one_suffix = strip_tags($text_one_suffix);
			$text_more_suffix = strip_tags($text_more_suffix);

			switch ($action)
			{
				case 'get':
					$recommended = get_post_meta($post_id, '_recommended', true);
					if (!$recommended)
					{
						$recommended = 0;
						add_post_meta($post_id, '_recommended', $recommended, true);
					}

					if ($recommended == 0)
					{
						$suffix = $text_zero_suffix;
					}
					elseif ($recommended == 1)
					{
						$suffix = $text_one_suffix;
					}
					else
					{
						$suffix = $text_more_suffix;
					}

					/* Hides the count is the count is zero. */
					$options = get_option('dot_irecommendthis_settings');
					if (!isset($options['hide_zero'])) $options['hide_zero'] = '0';

					if (($recommended == 0) && $options['hide_zero'] == 1)
					{
						$output = '<span class="extras-wrap"><i class="fa fa-heart3"></i><span><span class="likes-counter">0</span> ' . esc_html__('Like', 'uncode') . '</span></span>';
						return $output;
					}
					else
					{
						$output = '<span class="extras-wrap"><i class="fa fa-heart3"></i><span><span class="likes-counter">' . $recommended . '</span> ' . esc_html__('Likes', 'uncode') . '</span></span>';
						return $output;
					}

					break;

				case 'update':

					$recommended = get_post_meta($post_id, '_recommended', true);

					$options = get_option('dot_irecommendthis_settings');
					if (!isset($options['disable_unique_ip'])) $options['disable_unique_ip'] = '0';

					/* Check if Unique IP saving is required or disabled */
					if ($options['disable_unique_ip'] != 0)
					{

						if (isset($_COOKIE['dot_irecommendthis_' . $post_id]))
						{
							return $recommended;
						}

						$recommended++;
						update_post_meta($post_id, '_recommended', $recommended);
						setcookie('dot_irecommendthis_' . $post_id, time() , time() + 3600 * 24 * 365, '/');
					}
					else
					{

						global $wpdb;
						$ip = $_SERVER['REMOTE_ADDR'];
						$voteStatusByIp = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM " . $wpdb->prefix . "irecommendthis_votes WHERE post_id = %d AND ip = %s", $post_id, $ip));

						if (isset($_COOKIE['dot_irecommendthis_' . $post_id]) || $voteStatusByIp != 0)
						{
							return $recommended;
						}

						$recommended++;
						update_post_meta($post_id, '_recommended', $recommended);
						setcookie('dot_irecommendthis_' . $post_id, time() , time() + 3600 * 24 * 365, '/');
						$wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "irecommendthis_votes VALUES ('', NOW(), %d, %s)", $post_id, $ip));
					}

					if ($recommended == 0)
					{
						$suffix = $text_zero_suffix;
					}
					elseif ($recommended == 1)
					{
						$suffix = $text_one_suffix;
					}
					else
					{
						$suffix = $text_more_suffix;
					}

					$output = '<i class="fa fa-heart3"></i><span>' . $recommended . '</span>';
					$dot_irt_html = apply_filters('dot_irt_before_count', $output);

					return $dot_irt_html;
					break;
			}
		}

		//dot_recommend_this

		function dot_recommend($id = null, $wrap = true)
		{

			global $wpdb;
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_ID = $id ? $id : get_the_ID();
			global $post;

			$options = get_option('dot_irecommendthis_settings');
			if (!isset($options['text_zero_suffix'])) $options['text_zero_suffix'] = '';
			if (!isset($options['text_one_suffix'])) $options['text_one_suffix'] = '';
			if (!isset($options['text_more_suffix'])) $options['text_more_suffix'] = '';
			if (!isset($options['link_title_new'])) $options['link_title_new'] = '';
			if (!isset($options['link_title_active'])) $options['link_title_active'] = '';
			if (!isset($options['disable_unique_ip'])) $options['disable_unique_ip'] = '0';
			 //Check if Unique IP saving is required or disabled

			if ($options['disable_unique_ip'] != '1')
			{
				$voteStatusByIp = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM " . $wpdb->prefix . "irecommendthis_votes WHERE post_id = %d AND ip = %s", $post_ID, $ip));
			}

			$output = self::dot_recommend_this($post_ID, $options['text_zero_suffix'], $options['text_one_suffix'], $options['text_more_suffix']);

			if ($options['disable_unique_ip'] != '0')
			{

				if (!isset($_COOKIE['dot_irecommendthis_' . $post_ID]))
				{
					$class = 'uncode-dot-irecommendthis';

					if ($options['link_title_new'] == '')
					{
						$title = esc_html__('Recommend this', 'uncode');
					}
					else
					{
						$title = $options['link_title_new'];
					}
				}
				else
				{
					$class = 'uncode-dot-irecommendthis active';
					if ($options['link_title_active'] == '')
					{
						$title = esc_html__('You already recommended this', 'uncode');
					}
					else
					{
						$title = $options['link_title_active'];
					}
				}
			}
			else
			{
				if (!isset($_COOKIE['dot_irecommendthis_' . $post_ID]) && $voteStatusByIp == 0)
				{
					$class = 'uncode-dot-irecommendthis';
					if ($options['link_title_new'] == '')
					{
						$title = esc_html__('Recommend this', 'uncode');
					}
					else
					{
						$title = $options['link_title_new'];
					}
				}
				else
				{
					$class = 'uncode-dot-irecommendthis active';
					if ($options['link_title_active'] == '')
					{
						$title = esc_html__('You already recommended this', 'uncode');
					}
					else
					{
						$title = $options['link_title_active'];
					}
				}
			}

			if ($wrap)
			{
				$dot_irt_html = '<a href="#" class="' . $class . '" id="dot-irecommendthis-' . $post_ID . '" title="' . $title . '">';
				$dot_irt_html.= apply_filters('dot_irt_before_count', $output);
				$dot_irt_html.= '</a>';
			}
			else
			{
				$dot_irt_html = '<span class="' . $class . '">';
				$dot_irt_html.= apply_filters('dot_irt_before_count', $output);
				$dot_irt_html.= '</span>';
			}

			return $dot_irt_html;
		}

		/*--------------------------------------------*
		 * AJAX Callback
		 *--------------------------------------------*/

		function uncode_ajax_callback($post_id)
		{
			$options = get_option( 'dot_irecommendthis_settings' );
			if( !isset($options['add_to_posts']) ) $options['add_to_posts'] = '1';
			if( !isset($options['add_to_other']) ) $options['add_to_other'] = '1';
			if( !isset($options['text_zero_suffix']) ) $options['text_zero_suffix'] = '';
			if( !isset($options['text_one_suffix']) ) $options['text_one_suffix'] = '';
			if( !isset($options['text_more_suffix']) ) $options['text_more_suffix'] = '';

			if( isset($_POST['recommend_id']) ) {
				// Click event. Get and Update Count
				$post_id = str_replace('dot-irecommendthis-', '', $_POST['recommend_id']);
				echo $this->dot_recommend_this($post_id, $options['text_zero_suffix'], $options['text_one_suffix'], $options['text_more_suffix'], 'update');
			} else {
				// AJAXing data in. Get Count
				$post_id = str_replace('dot-irecommendthis-', '', $_POST['post_id']);
				echo $this->dot_recommend_this($post_id, $options['text_zero_suffix'], $options['text_one_suffix'], $options['text_more_suffix'], 'get');
			}

			exit;

		}	//ajax_callback

		/*--------------------------------------------*
		 * Widget
		 *--------------------------------------------*/

		function uncode_add_widget_most_recommended_posts()
		{
			wp_unregister_sidebar_widget('most_recommended_posts');
		}
	}

	global $uncode_irecommendthis;

	// Initiation call of plugin
	$uncode_irecommendthis = new UNCODE_IRecommendThis(WP_PLUGIN_DIR . '/i-recommend-this/dot-irecommendthis.php');

	// register Most_recommended_posts widget
	function register_most_recommended_posts()
	{
		register_widget('Most_recommended_posts');
	}
	add_action('widgets_init', 'register_most_recommended_posts');
}

/**
 * Adds Most_recommended_posts widget.
 */
class Most_recommended_posts extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct('most-recommended-posts', // Base ID
			esc_html__('Most recommended posts', 'dot') , // Name
			array('description' => esc_html__('Your site’s most liked posts.', 'dot') ,) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{

		$numberOf = $instance['number'];
		$show_count = $instance['show_count'];
		$title = $instance['title'];
		$before_widget = $args['before_widget'];
		$after_widget = $args['after_widget'];
		$before_title = $args['before_title'];
		$after_title = $args['after_title'];

		$widget_before = $before_widget;
		$widget_before .= $before_title . $title . $after_title;
		echo wp_kses_post($widget_before);
		echo '<ul class="mostrecommendedposts">';

		most_recommended_posts($numberOf, '<li>', '</li>', $show_count);

		echo '</ul>';
		echo wp_kses_post($after_widget);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('Most recommended posts', 'dot');
		$number = !empty($instance['number']) ? $instance['number'] : 5;
		$show_count = !empty($instance['show_count']) ? true : false;
		?>
    <p>
        <label for="<?php echo  esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'dot'); ?></label>
        <input class="widefat" id="<?php echo  esc_attr($this->get_field_id('title')); ?>" name="<?php echo  esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
        <label for="<?php echo  esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts to show:', 'dot'); ?></label><br />
        <input id="<?php echo  esc_attr($this->get_field_id('number')); ?>" name="<?php echo  esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" style="width: 35px;"> <small>(max. 15)</small></label></p>
    </p>
    <p>
        <label for="<?php echo  esc_attr($this->get_field_id('show_count')); ?>"><?php esc_html_e('Show post count', 'dot'); ?></label>
        <input class="checkbox" type="checkbox" <?php checked($instance['show_count'], '1'); ?> value="1" id="<?php echo  esc_attr($this->get_field_id('show_count')); ?>" name="<?php echo  esc_attr($this->get_field_name('show_count')); ?>" />
    </p>
  	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['number'] = (!empty($new_instance['number'])) ? strip_tags($new_instance['number']) : '';
		$instance['show_count'] = (!empty($new_instance['show_count'])) ? $new_instance['show_count'] : false;

		return $instance;
	}
}

function uncode_wpcf7_ajax_loader() {
	return get_template_directory_uri() . '/library/img/fading-squares.gif';
}

add_filter( 'wpcf7_ajax_loader', 'uncode_wpcf7_ajax_loader', 10 );

add_filter( 'rp4wp_append_content', '__return_false' );

// add Facebook oEmbed
function uncode_oembed_add_provider() {
	$endpoints = array(
		'#https?://www\.facebook\.com/video.php.*#i'          => 'https://www.facebook.com/plugins/video/oembed.json/',
		'#https?://www\.facebook\.com/.*/videos/.*#i'         => 'https://www.facebook.com/plugins/video/oembed.json/',
		'#https?://www\.facebook\.com/.*/posts/.*#i'          => 'https://www.facebook.com/plugins/post/oembed.json/',
		'#https?://www\.facebook\.com/.*/activity/.*#i'       => 'https://www.facebook.com/plugins/post/oembed.json/',
		'#https?://www\.facebook\.com/photo(s/|.php).*#i'     => 'https://www.facebook.com/plugins/post/oembed.json/',
		'#https?://www\.facebook\.com/permalink.php.*#i'      => 'https://www.facebook.com/plugins/post/oembed.json/',
		'#https?://www\.facebook\.com/media/.*#i'             => 'https://www.facebook.com/plugins/post/oembed.json/',
		'#https?://www\.facebook\.com/questions/.*#i'         => 'https://www.facebook.com/plugins/post/oembed.json/',
		'#https?://www\.facebook\.com/notes/.*#i'             => 'https://www.facebook.com/plugins/post/oembed.json/'
	);
	foreach($endpoints as $pattern => $endpoint) {
		wp_oembed_add_provider( $pattern, $endpoint, true );
	}
}

add_action('init', 'uncode_oembed_add_provider');

function uncode_oembed_fetch_url($provider, $url, $args) {
	if (strpos($url, 'facebook') !== false) {
		$locale = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,5) : get_locale();
		$locale = str_replace('-','_',$locale);
		$locale = explode('_', $locale);
		if (isset($locale[0]) && isset($locale[1])) {
			$locale = strtolower($locale[0]) . '_' . strtoupper($locale[1]);
		} else {
			$locale = 'en_US';
		}

		$provider = add_query_arg( 'locale', (string)$locale, $provider );
	}

	return $provider;
}

add_filter('oembed_fetch_url', 'uncode_oembed_fetch_url', 10 ,3);


function uncode_the_content($the_content) {
	$the_content = wptexturize($the_content);
	$the_content = convert_smilies($the_content);
	$the_content = convert_chars($the_content);
	$the_content = wpautop($the_content);
	$the_content = shortcode_unautop($the_content);
	$the_content = do_shortcode($the_content);
	return $the_content;
}

function uncode_remove_wpautop( $content, $autop = false ) {

	if ( $autop ) {
		$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
	}

	return do_shortcode( shortcode_unautop( $content ) );
}
