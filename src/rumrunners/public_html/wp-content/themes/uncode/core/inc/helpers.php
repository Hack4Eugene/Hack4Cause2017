<?php

/**
 * @package uncode
 */


/**
 * Truncate text
 */
function uncode_truncate($text, $length) {
	$text = strip_tags($text, '<img />');
	$length = abs((int)$length);
	if(strlen($text) > $length) {
		$text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
	}
	return($text);
}

/**
 * Parse Loop data
 */
function uncode_parse_loop_data($value) {
	if (is_array($value)) return $value;
	$data = array();
	$values_pairs = preg_split('/\|/', $value);
	foreach ($values_pairs as $pair)
	{
		if (!empty($pair))
		{
			list($key, $value) = preg_split('/\:/', $pair);
			$data[$key] = $value;
		}
	}
	return $data;
}

/**
 * Parse Loop data
 */
function uncode_unparse_loop_data($values) {
	$data = array();
	foreach ($values as $key => $value)
	{
		$data[] = $key.':'.$value;
	}
	return implode('|',$data);
}

/**
 * Random string
 */
function uncode_randomstring($length = 6)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Flat array
 */
if (!function_exists('uncode_flatArray')) {
	function uncode_flatArray($array)
		{
			$flatArray = array();
			foreach ($array as $key => $value)
			{
				$flatArray[$value[0]] = $value[1];
			}
			return $flatArray;
		}
}


/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function uncode_setup_author()
{
	global $wp_query;

	if ($wp_query->is_author() && isset($wp_query->post))
	{
		$GLOBALS['authordata'] = get_userdata($wp_query->post->post_author);
	}
}
add_action('wp', 'uncode_setup_author');

/**
 * Adaptive Images Helper, find closest value
 * @param  [int] $search   image size
 * @param  [array] $arr    array with all steps
 * @return [int]     		   closest size for the image
 */
function uncode_getClosest($search, $arr)
{
	$closest = null;
	if (!empty($arr)) {
		foreach ($arr as $item)
		{
			if ($closest == null || abs($search - $closest) > abs($item - $search))
			{
				$closest = $item;
			}
		}
	}

	return $closest;
}

/** Add a class to self hosted video */
function uncode_back_video_class($class) {
	return 'background-video-shortcode';
}

if ( ! function_exists( 'uncode_estimated_reading_time' ) ) {
	function uncode_estimated_reading_time($post_id) {
		$post_id = apply_filters( 'wpml_object_id', $post_id, 'post' );
		$post_content = get_post_field('post_content', $post_id);
    $words = str_word_count( strip_tags( preg_replace('/\[([^\]]*)\]/', '', $post_content) ) );
    $minutes = floor( $words / 120 );
    $seconds = floor( $words % 120 / ( 120 / 60 ) );

    if ( 1 <= $minutes ) {
    	$estimated_time = $minutes . ' ' . esc_html__('Minutes','uncode');
    } else {
    	$estimated_time = '1 '  . esc_html__('Minute','uncode');
    }

    return $estimated_time;

	}
}

/**
 * Resize and store an image
 * @param  [string] $url
 * @param  [string] $path
 * @param  [int] $originalWidth
 * @param  [int] $originalHeight
 * @param  [int] $single_height
 * @param  [int] $single_height
 * @param  [boolean] $crop
 * @param  [boolean] $fixed_width
 * @return [array]
 */

function uncode_resize_image($url, $path, $originalWidth, $originalHeight, $single_width, $single_height = null, $crop, $fixed_width = null, $async = false)
{
	global $adaptive_images, $adaptive_images_async, $ai_bpoints;

	if ($adaptive_images === 'on' || is_array($async)) {
		if (is_array($async)) {
			$ai_width = (int)$async['images'];
			$ai_screen = (int)$async['screen'];

			if (empty($ai_bpoints)) {
				$ai_sizes = ot_get_option('_uncode_adaptive_sizes');
			  if ($ai_sizes === '') $ai_sizes = '258,516,720,1032,1440,2064,2880';
			  $ai_sizes = preg_replace('/\s+/', '', $ai_sizes);
			  $ai_bpoints = explode(',', $ai_sizes);
			}
		} else {
			if ($adaptive_images_async === 'on') {
				$ai_width = min($ai_bpoints);
				$ai_screen = min($ai_bpoints);
			} else {
				if (isset($_COOKIE['uncodeAI_images']) && isset($_COOKIE['uncodeAI_screen'])) {
					$ai_width = $_COOKIE['uncodeAI_images'];
					$ai_screen = $_COOKIE['uncodeAI_screen'];
				} else {
					$ai_width = min($ai_bpoints);
					$ai_screen = min($ai_bpoints);
					$adaptive_images_async = 'on';
				}
			}
		}

		if ($ai_screen < 781) {
			$closest_size = uncode_getClosest($ai_width , $ai_bpoints);
		} else {
			if ($fixed_width === null) {
				if ($crop) $closest_size = uncode_getClosest(($ai_width / (12 / max($single_width, $single_height))) , $ai_bpoints);
				else {
					$closest_size = uncode_getClosest(($ai_width / (12 / $single_width)) , $ai_bpoints);
				}
			} else {
				if ($crop) $closest_size = uncode_getClosest(max($single_width, $single_height) , $ai_bpoints);
				else {
					if ($fixed_width === 'width') {
						$get_new_height = ($ai_width * $single_width) / $ai_screen;
						$closest_size = uncode_getClosest($get_new_height , $ai_bpoints);
					} else if ($fixed_width === 'height') {
						$get_new_height = uncode_getClosest($single_height , $ai_bpoints);
						$get_new_width = round(($originalWidth * $get_new_height) / $originalHeight);
						$closest_size = uncode_getClosest($get_new_width , $ai_bpoints);
					} else $closest_size = 10000;
					$single_width = (12 * $closest_size) / $ai_width;
				}
			}
		}

	} else {
		$closest_size = 10000;
	}

	if ($crop) {

		if ($closest_size > min($originalWidth, $originalHeight)) $closest_size = min($originalWidth, $originalHeight);

		if ($single_width > $single_height) {
			$dest_w = $closest_size;
			$dest_h = ($closest_size / $single_width) * $single_height;
		} else {
			$dest_h = $closest_size;
			$dest_w = $dest_h * ($single_width / $single_height);
		}

		$new_dimensions = image_resize_dimensions($originalWidth, $originalHeight, $dest_w, $dest_h, $crop);
	} else {

		if ($closest_size > $originalWidth && $fixed_width === null) $closest_size = $originalWidth;
		$new_dimensions = image_resize_dimensions($originalWidth, $originalHeight, $closest_size, $originalHeight, $crop);

	}

	$targetWidth = $new_dimensions[4];
	$targetHeight = $new_dimensions[5];

	// this is an attachment, so we have the ID
	$image_src = array();

	// If the file is relative, prepend upload dir
	if ($url && 0 === strpos($url, '/') && !preg_match('|^.:\\\|', $url) && (($uploads = wp_upload_dir()) && false === $uploads['error'])) $url = get_site_url() . $uploads['baseurl'] . "/$path";
	if ($path && 0 !== strpos($path, '/') && !preg_match('|^.:\\\|', $path) && (($uploads = wp_upload_dir()) && false === $uploads['error'])) $actual_file_path = $uploads['basedir'] . "/$path";

	$image_src[] = $url;
	$image_src[] = $originalWidth;
	$image_src[] = $originalHeight;

	if (!empty($actual_file_path))
	{
		$file_info = pathinfo($actual_file_path);
		$extension = '.' . $file_info['extension'];

		// the image path without the extension
		$no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

		$cropped_img_path = $no_ext_path . '-uai-' . $targetWidth . 'x' . $targetHeight . $extension;

		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ($originalWidth > $targetWidth || $originalHeight > $targetHeight)
		{

			// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
			if (file_exists($cropped_img_path))
			{
				$cropped_img_url = str_replace(basename($url) , basename($cropped_img_path) , $url);
				$vt_image = array(
					'url' => $cropped_img_url,
					'width' => $targetWidth,
					'height' => $targetHeight,
					'single_width' => $single_width,
					'single_height' => $single_height,
				);

				return $vt_image;
			}
			// no cache files - let's finally resize it
			$img_editor = wp_get_image_editor($actual_file_path);
			if (is_wp_error($img_editor) || is_wp_error($img_editor->resize($targetWidth, $targetHeight, $crop)))
			{
				return array(
					'url' => '',
					'width' => '',
					'height' => ''
				);
			}

			/** set image compression quality **/
			$img_quality = ot_get_option('_uncode_adaptive_quality');
			$img_editor->set_quality( $img_quality );
			$suffix = $img_editor->get_suffix();
			$new_img_path = $img_editor->generate_filename('uai-' . $suffix);

			if (is_wp_error($img_editor->save($new_img_path)))
			{
				return array(
					'url' => '',
					'width' => '',
					'height' => ''
				);
			}
			if (!is_string($new_img_path))
			{
				return array(
					'url' => '',
					'width' => '',
					'height' => ''
				);
			}

			$new_img_size = getimagesize($new_img_path);
			$new_img = str_replace(basename($url) , basename($new_img_path) , $url);

			// resized output
			$vt_image = array(
				'url' => $new_img,
				'width' => $new_img_size[0],
				'height' => $new_img_size[1],
				'single_width' => $single_width,
				'single_height' => $single_height,
			);

			//If using Wp Smushit
      if( class_exists('WpSmush') ){
        global $WpSmush;
        if( filesize( $new_img_path ) < WP_SMUSH_MAX_BYTES ){
          $WpSmush->do_smushit($new_img_path, $new_img);
        }
      }

			return $vt_image;
		}

		// default output - without resizing
		$vt_image = array(
			'url' => $url,
			'width' => $originalWidth,
			'height' => $originalHeight,
			'single_width' => $single_width,
			'single_height' => $single_height,
		);

		return $vt_image;
	}
	return false;
}

/**
 * Media library helper
 * @param  [int] $media_id
 * @return [object]
 */
function uncode_get_media_info($media_id)
{
	if ($media_id !== '') {
		global $wpdb;
		$remove_limit = version_compare($wpdb->db_version(), '5.5', '>=') ? 'SET SESSION SQL_BIG_SELECTS = 1;': 'SET SQL_BIG_SELECTS = 1;';
		$wpdb->query($remove_limit);
		$info = $wpdb->get_row($wpdb->prepare("SELECT {$wpdb->posts}.post_content,{$wpdb->posts}.post_title,{$wpdb->posts}.post_excerpt,{$wpdb->posts}.guid,{$wpdb->posts}.post_mime_type,meta1.meta_value as metadata, meta2.meta_value as alt, meta3.meta_value as path, meta4.meta_value as team, meta5.meta_value as team_social, meta6.meta_value as animated_svg, meta7.meta_value as animated_svg_time, meta8.meta_value as social_original FROM {$wpdb->posts} LEFT OUTER JOIN {$wpdb->postmeta} meta1 ON {$wpdb->posts}.ID = meta1.post_id AND meta1.meta_key = '_wp_attachment_metadata' LEFT OUTER JOIN {$wpdb->postmeta} meta2 ON {$wpdb->posts}.ID = meta2.post_id AND meta2.meta_key = '_wp_attachment_image_alt' LEFT OUTER JOIN {$wpdb->postmeta} meta3 ON {$wpdb->posts}.ID = meta3.post_id AND meta3.meta_key = '_wp_attached_file' LEFT OUTER JOIN {$wpdb->postmeta} meta4 ON {$wpdb->posts}.ID = meta4.post_id AND meta4.meta_key = '_uncode_team_member' LEFT OUTER JOIN {$wpdb->postmeta} meta5 ON {$wpdb->posts}.ID = meta5.post_id AND meta5.meta_key = '_uncode_team_member_social' LEFT OUTER JOIN {$wpdb->postmeta} meta6 ON {$wpdb->posts}.ID = meta6.post_id AND meta6.meta_key = '_uncode_animated_svg' LEFT OUTER JOIN {$wpdb->postmeta} meta7 ON {$wpdb->posts}.ID = meta7.post_id AND meta7.meta_key = '_uncode_animated_svg_time' LEFT OUTER JOIN {$wpdb->postmeta} meta8 ON {$wpdb->posts}.ID = meta8.post_id AND meta8.meta_key = '_uncode_social_original' WHERE ID IN (%d)", $media_id ));
		if (isset($info->post_mime_type) && strpos($info->post_mime_type, 'image') !== false) {
			$file = $info->path;
			// Get upload directory.
			if ( ( $uploads = wp_upload_dir( null, false ) ) && false === $uploads['error'] ) {
				// Check that the upload base exists in the file location.
				if ( 0 === strpos( $file, $uploads['basedir'] ) ) {
					// Replace file location with url location.
					$url = str_replace($uploads['basedir'], $uploads['baseurl'], $file);
				} elseif ( false !== strpos($file, 'wp-content/uploads') ) {
					// Get the directory name relative to the basedir (back compat for pre-2.7 uploads)
					$url = trailingslashit( $uploads['baseurl'] . '/' . _wp_get_attachment_relative_path( $file ) ) . basename( $file );
				} else {
					// It's a newly-uploaded file, therefore $file is relative to the basedir.
					$url = $uploads['baseurl'] . "/$file";
				}
			}
			if ( !empty($url) ) {
				if ( is_ssl() && ! is_admin() && 'wp-login.php' !== $GLOBALS['pagenow'] ) {
					$url = set_url_scheme( $url );
				}
				$info->guid = $url;
			}
		}
		return $info;
	} else return;
}

/**
 * oEmbed helper
 * @param  [int] $id
 * @param  [string] $url
 * @return [array]
 */
function uncode_get_oembed($id, $url, $mime, $with_poster = false, $excerpt = null, $html = null, $lighbox_code = false)
{
	global $front_background_colors;
	$object_class = $poster = $poster_id = '';
	$oembed_size = uncode_get_dummy_size($id);
	$media_type = 'other';
	if ($with_poster) {
		$poster = get_post_meta($id, "_uncode_poster_image", true);
		$poster_id = $poster;
	}

	switch ($mime) {
		case 'oembed/flickr':
		case 'oembed/Imgur':
		case 'oembed/photobucket':
			$media_type = 'image';
			$media_oembed = wp_oembed_get($url);
			preg_match_all('/src="([^"]*)"/i', $media_oembed, $img_src);
			$media_oembed = (isset($img_src[1][0])) ? str_replace('"', '', $img_src[1][0]) : '';
			if ($mime === 'oembed/flickr') {
				$media_oembed = str_replace(array('_n.','_z.'), '_b.', $media_oembed);
			}
		break;
		case 'oembed/instagram':
			$media_type = 'image';
			$url = 'http://api.instagram.com/oembed?url=' . $url;
			$json = wp_remote_fopen($url);
			$json_data = json_decode($json, true);
			$media_oembed = $json_data['thumbnail_url'];
			$oembed_size['width'] = $oembed_size['height'] = 640;
		break;
		case 'oembed/youtube':
			if ((isset($poster) && $poster !== '' && $with_poster) || $lighbox_code) {
				$get_url = parse_url(htmlspecialchars_decode($url));
				if (isset($get_url['query'])) {
					parse_str($get_url['query'], $query);
					if (isset($query['v'])) {
						$get_id = $query['v'];
						unset($query['v']);
					}
					$get_id .= '?' . http_build_query($query);
					$src_id = $get_id;
				}
				else $src_id = basename($url);
				$media_oembed = 'https://www.youtube.com/embed/' . $src_id;
			}
			else {
				$get_url = parse_url(htmlspecialchars_decode($url));
				if (isset($get_url['query'])) {
					parse_str($get_url['query'], $arguments);
					$media_oembed = wp_oembed_get($url, $arguments);
				} else $media_oembed = wp_oembed_get($url);
			}
			break;

		case 'oembed/vimeo':
			if ((isset($poster) && $poster !== '' && $with_poster) || $lighbox_code) $media_oembed = 'https://player.vimeo.com/video/' . basename($url);
			else {
				$get_url = parse_url(htmlspecialchars_decode($url));
				if (isset($get_url['query'])) {
					parse_str($get_url['query'], $arguments);
					$arguments['title'] = 0;
					$arguments['byline'] = 0;
					$arguments['portrait'] = 0;
				} else {
					$arguments = array();
					$arguments['title'] = 0;
					$arguments['byline'] = 0;
					$arguments['portrait'] = 0;
				}
				$media_oembed = wp_oembed_get($url, $arguments);
			}
			break;

		case 'oembed/soundcloud':
			if ((isset($poster) && $poster !== '' && $with_poster) || $lighbox_code) {
				//Get the JSON data of song details with embed code from SoundCloud oEmbed
				$getValues = wp_remote_fopen('http://soundcloud.com/oembed?format=js&url=' . $url . '&iframe=true');
				//Clean the Json to decode
				$decodeiFrame = substr($getValues, 1, -2);
				//json decode to convert it as an array
				$decodeiFrame = json_decode($decodeiFrame);
				preg_match('/src="([^"]+)"/', $decodeiFrame->html, $iframe_src);
				$media_oembed = $iframe_src[1];
			} else {
				$accent_color = $front_background_colors['accent'];
				$accent_color = str_replace('#', '', $accent_color);
				$getValues = wp_remote_fopen('http://soundcloud.com/oembed?format=js&url=' . $url . '&iframe=true');
				$decodeiFrame = substr($getValues, 1, -2);
				$decodeiFrame = json_decode($decodeiFrame);
				if (isset($decodeiFrame->html)) {
					preg_match('/src="([^"]+)"/', $decodeiFrame->html, $iframe_src);
					$iframe_url = str_replace('visual=true', 'visual=false', $iframe_src[1]);
					$media_oembed = '<iframe width="100%" scrolling="no" frameborder="no" src="' . $iframe_url . '&color='.$accent_color.'&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false"></iframe>';
					if (strpos($iframe_url, '%2Fusers%2F') !== false || strpos($iframe_url, '%2Fplaylists%2F') !== false) $object_class = 'soundcloud-playlist';
					else
					{
						$object_class = 'soundcloud-single';
					}
				} else {
					$media_oembed = '<img src="https://placeholdit.imgix.net/~text?txtsize=33&amp;txt=media+not+available&amp;w=500&amp;h=500" />';
				}
			}
		break;
		case 'oembed/spotify':
			if ((isset($poster) && $poster !== '' && $with_poster) || $lighbox_code) {
				$get_url = parse_url($url);
				$break_spotify = explode('/', $get_url['path']);
				$media_oembed = 'https://embed.spotify.com/?uri=spotify' . implode(':', $break_spotify);
			} else {
				$media_oembed = wp_oembed_get($url);
				$media_oembed = preg_replace('#\s(width)="([^"]+)"#', '', $media_oembed);
				$media_oembed = preg_replace('#\s(height)="([^"]+)"#', '', $media_oembed);
				$object_class = 'object-size spotify';
			}
		break;
		case 'oembed/twitter':
			$social_original = get_post_meta($id, "_uncode_social_original", true);
			if ($social_original) $media_oembed = wp_oembed_get($url);
			else {
				$url = 'https://api.twitter.com/1/statuses/oembed.json?id=' . basename($url);
				$json = wp_remote_fopen($url);
				$json_data = json_decode($json, true);
				$id = basename($json_data['url']);
				$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $json_data['html']);
				$html = str_replace("&mdash; ", '', $html);
				if (function_exists('mb_convert_encoding')) $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
				$dom = new domDocument;
				$dom->loadHTML($html);
				$dom->preserveWhiteSpace = false;
				$twitter_content = $dom->getElementsByTagname('blockquote');
				$twitter_blockquote = '';
				$twitter_footer = '';
				foreach ($twitter_content as $item) {
					$twitter_content_inner = $item->getElementsByTagname('p');
					foreach ($twitter_content_inner as $item_inner) {
						foreach ($item_inner->childNodes as $child) {
							$twitter_blockquote .= $child->ownerDocument->saveXML( $child );
						}
						$item_inner->parentNode->removeChild($item_inner);
					}
					foreach ($item->childNodes as $child) {
						$twitter_footer .= $child->ownerDocument->saveXML( $child );
					}
					$item->parentNode->removeChild($item);
				}
				$media_oembed = '<div class="twitter-item">
										<div class="twitter-item-data">
											<blockquote class="tweet-text pullquote">
												<p>' . $twitter_blockquote . '</p>';
				$media_oembed .= 			'<p class="twitter-footer"><i class="fa fa-twitter"></i><small>' . $twitter_footer . '</small></p>';
				$media_oembed .= 		'</blockquote>
										</div>
									</div>';
				$width = 1;
				$height = 0;
				$object_class = 'tweet object-size regular-text';
			}
		break;
		case 'oembed/html':
			$author = $author_img = '';
			$width = 1;
			$height = 0;
			$poster = get_post_meta($id, "_uncode_poster_image", true);
			$poster_id = $poster;
			if (($poster !== '' && $with_poster) || $lighbox_code) {
				$attr = array(
					'class' => "avatar",
				);
				$author_img = wp_get_attachment_image($poster, 'thumbnail', false, $attr);
				$author_img = '<figure class="gravatar">' . $author_img . '</figure>';
			}
			if ($excerpt) $author = '<p><small>' . $excerpt . '</small></p>';
			$media_oembed = '<blockquote class="pullquote">' . $author_img . '<p>' . esc_html($html) . '</p>' . $author . '</blockquote>';
			$object_class = 'regular-text object-size';
			$poster = '';
		break;
		case 'oembed/facebook':
			$media_oembed = wp_oembed_get($url);
			$pattern = '/(data-width)="[0-9]*"/i';
    	$media_oembed = preg_replace($pattern, 'data-width="auto"', $media_oembed);
    	$pattern = '/(data-height)="[0-9]*"/i';
    	$media_oembed = preg_replace($pattern, 'data-height="auto"', $media_oembed);
		break;
		case 'shortcode':
			$media_oembed = do_shortcode($url);
			$object_class = 'object-size shortcode';
		break;
		default:
			if (strpos($mime, 'audio/') !== false) {
				if ((isset($poster) && $poster !== '' && $with_poster) || $lighbox_code) {
					$media_oembed = $url;
				} else {
					$object_class = 'object-size self-audio';
					$media_oembed = do_shortcode('[audio src="' . $url . '"]');
					$poster = get_post_meta($id, "_uncode_poster_image", true);
					$poster_id = $poster;
				}
			} else if (strpos($mime, 'video/') !== false) {
				if ((isset($poster) && $poster !== '' && $with_poster) || $lighbox_code) {
					$media_oembed = $url;
				}	else {
					$videos = array();
					$exloded_url = explode(".", strtolower($url));
					$ext = end($exloded_url);
					$videos[(String) $ext] = $url;
					$alt_videos = get_post_meta($id, "_uncode_video_alternative", true);

					if (!empty($alt_videos)) {
						foreach ($alt_videos as $key => $value) {
							$exloded_url = explode(".", strtolower($value));
							$ext = end($exloded_url);
							$videos[(String) $ext] = $value;
						}
					} else {
						$videos = array(
							'src' => '"' . $url . '"'
						);
					}

					$video_src = '';
					foreach ($videos as $key => $value) {
						$video_src.= ' ' . $key . '=' . $value;
					}

					$object_class = 'object-size self-video';

					$poster = get_post_meta($id, "_uncode_poster_image", true);
					$poster_url = '';
					$loop = get_post_meta($id, "_uncode_video_loop", true);
					$autoplay = get_post_meta($id, "_uncode_video_autoplay", true);
					$add_loop = $loop ? ' loop="yes"' : '';
					$add_autoplay = $autoplay ? ' autoplay="yes"' : '';
					if (isset($poster) && $poster !=='') {
						$poster_attributes = uncode_get_media_info($poster);
						if (isset($poster_attributes->metadata)) {
							$media_metavalues = unserialize($poster_attributes->metadata);
							$image_orig_w = $media_metavalues['width'];
							$image_orig_h = $media_metavalues['height'];
							global $adaptive_images, $adaptive_images_async;
							if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
								$poster_url = $poster_attributes->guid;
							} else {
								$resized_image = uncode_resize_image($poster_attributes->guid, $poster_attributes->path, $image_orig_w, $image_orig_h, 12, '', false);
								$poster_url = $resized_image['url'];
							}
						}
					}

					if ($poster_url !== '') $poster_url = ' poster="' . $poster_url . '"';
					$media_oembed = do_shortcode('[video' . $video_src . $poster_url . $add_loop . $add_autoplay . ']');
				}
			} else {
				$media_oembed = wp_oembed_get($url);
			}
		break;
	}

	if ($oembed_size['dummy'] == 0) {
		preg_match_all('/width="([^"]*)"/i', $media_oembed, $iWidth);
		$width = (isset($iWidth[1][0])) ? $iWidth[1][0] : 1;
		preg_match_all('/height="([^"]*)"/i', $media_oembed, $iHeight);
		$height = (isset($iHeight[1][0])) ? $iHeight[1][0] : 1;
		if ((int)$width !== 0) $oembed_size['dummy'] = round(($height / $width) * 100, 2);
	}

	return array(
		'code' => $media_oembed,
		'width' => $oembed_size['width'],
		'height' => $oembed_size['height'],
		'dummy' => $oembed_size['dummy'],
		'type' => $media_type,
		'class' => $object_class,
		'poster' => $poster,
		'poster_id' => $poster_id,
	);
}

add_action( 'UNCODE_AJAX_HANDLER_get_adaptive_async', 'uncode_get_adaptive_async' );
add_action( 'UNCODE_AJAX_HANDLER_nopriv_get_adaptive_async', 'uncode_get_adaptive_async' );

function uncode_get_adaptive_async() {
  $data = json_decode(stripslashes($_POST['images']));
  $images = array();
  foreach($data as $d){
  	$resized = uncode_resize_image($d->url, $d->path, $d->origwidth, $d->origheight, $d->singlew, $d->singleh, $d->crop, $d->fixed, array('images' => $d->images, 'screen' => $d->screen));
  	$resized['unique'] = $d->unique;
  	$images[] = $resized;
  }
 	echo json_encode($images);
  die();
}

/**
 * Retrieve header info for specific page
 * @param  [type] $metabox_data
 * @param  [type] $post_type
 * @param  [type] $media
 * @return [type]
 */
function uncode_get_specific_header_data($metabox_data, $post_type, $media = '') {
	$show_title = true;
	if (isset($metabox_data['_uncode_header_background'][0])) $metabox_data['_uncode_header_background'] = array(unserialize($metabox_data['_uncode_header_background'][0]));
	else {
		$metabox_data['_uncode_header_background'][0]['background-color'] = '';
		$metabox_data['_uncode_header_background'][0]['background-image'] = '';
		$metabox_data['_uncode_header_background'][0]['background-repeat'] = '';
		$metabox_data['_uncode_header_background'][0]['background-position'] = '';
		$metabox_data['_uncode_header_background'][0]['background-size'] = '';
		$metabox_data['_uncode_header_background'][0]['background-attachment'] = '';
	}
	if (isset($metabox_data['_uncode_header_container_background'][0])) $metabox_data['_uncode_header_container_background'] = array(unserialize($metabox_data['_uncode_header_container_background'][0]));
	if (isset($metabox_data['_uncode_header_height'][0])) $metabox_data['_uncode_header_height'] = array(unserialize($metabox_data['_uncode_header_height'][0]));

	if (isset($metabox_data['_uncode_header_title'][0]) && $metabox_data['_uncode_header_title'][0] === 'on') {
		$show_title = false;
	}

	if (isset($metabox_data['_uncode_header_featured']) && $metabox_data['_uncode_header_featured'][0] === 'on' && $metabox_data['_uncode_header_background'][0]['background-image'] === '') {
			$metabox_data['_uncode_header_background'][0]['background-image'] = $media;
			$media = '';
	}

	return array(
		'meta' => $metabox_data,
		'show_title' => $show_title,
		'media' => $media
	);
}

/**
 * Retrieve header info for general category
 * @param  [type] $metabox_data
 * @param  [type] $post_type
 * @param  [type] $media
 * @return [type]
 */
function uncode_get_general_header_data($metabox_data, $post_type, $media = '', $title = '') {
	$show_title = true;
	$page_header_type = ot_get_option('_uncode_'.$post_type.'_header');

	if ($page_header_type === 'header_basic') {
		$page_header_type = ot_get_option('_uncode_'.$post_type.'_header');
		$metabox_data['_uncode_header_style'] = array(ot_get_option('_uncode_'.$post_type.'_header_style'));
		$metabox_data['_uncode_header_background'] = array(ot_get_option('_uncode_'.$post_type.'_header_background'));
		if (!isset($metabox_data['_uncode_header_background'][0]['background-color']) || $metabox_data['_uncode_header_background'][0]['background-color'] === '') $metabox_data['_uncode_header_background'][0]['background-color'] = '';
		$header_title = ot_get_option('_uncode_'.$post_type.'_header_title');
		if (empty($header_title) || $header_title === 'on') {
			$metabox_data['_uncode_header_title'] = array('on');
			$show_title = false;
		} else {
			$metabox_data['_uncode_header_title'] = array('off');
		}

		$metabox_data['_uncode_header_featured'] = array(ot_get_option('_uncode_'.$post_type.'_header_featured'));

		if ($metabox_data['_uncode_header_featured'][0] === 'on' && $media !== '') {
			$metabox_data['_uncode_header_background'][0]['background-image'] = $media;
			$media = '';
		}

		$metabox_data['_uncode_header_title_custom'] = array(ot_get_option('_uncode_'.$post_type.'_header_title_custom'));
		$metabox_data['_uncode_header_text'] = array(ot_get_option('_uncode_'.$post_type.'_header_text'));
		$metabox_data['_uncode_header_text_animation'] = array(ot_get_option('_uncode_'.$post_type.'_header_text_animation'));
		$metabox_data['_uncode_header_animation_speed'] = array(ot_get_option('_uncode_'.$post_type.'_header_animation_speed'));
		$metabox_data['_uncode_header_animation_delay'] = array(ot_get_option('_uncode_'.$post_type.'_header_text_delay'));
		$metabox_data['_uncode_header_title_font'] = array(ot_get_option('_uncode_'.$post_type.'_header_title_font'));
		$metabox_data['_uncode_header_title_size'] = array(ot_get_option('_uncode_'.$post_type.'_header_title_size'));
		$metabox_data['_uncode_header_title_height'] = array(ot_get_option('_uncode_'.$post_type.'_header_title_height'));
		$metabox_data['_uncode_header_title_spacing'] = array(ot_get_option('_uncode_'.$post_type.'_header_title_spacing'));
		$metabox_data['_uncode_header_title_weight'] = array(ot_get_option('_uncode_'.$post_type.'_header_title_weight'));
		$metabox_data['_uncode_header_title_italic'] = array(ot_get_option('_uncode_'.$post_type.'_header_title_italic'));
		$metabox_data['_uncode_header_title_transform'] = array(ot_get_option('_uncode_'.$post_type.'_header_title_transform'));
		$metabox_data['_uncode_header_full_width'] = array(ot_get_option('_uncode_'.$post_type.'_header_width'));
		$metabox_data['_uncode_header_content_width'] = array(ot_get_option('_uncode_'.$post_type.'_header_content_width'));
		$metabox_data['_uncode_header_custom_width'] = array(ot_get_option('_uncode_'.$post_type.'_header_custom_width'));
		$metabox_data['_uncode_header_align'] = array(ot_get_option('_uncode_'.$post_type.'_header_align'));
		$metabox_data['_uncode_header_height'] = array(ot_get_option('_uncode_'.$post_type.'_header_height'));
		$metabox_data['_uncode_header_min_height'] = array(ot_get_option('_uncode_'.$post_type.'_header_min_height'));
		$metabox_data['_uncode_header_position'] = array(ot_get_option('_uncode_'.$post_type.'_header_position'));
		$metabox_data['_uncode_header_breadcrumb'] = array(ot_get_option('_uncode_'.$post_type.'_header_breadcrumb'));
		$metabox_data['_uncode_header_parallax'] = array(ot_get_option('_uncode_'.$post_type.'_header_parallax'));
		$metabox_data['_uncode_header_overlay_color'] = array(ot_get_option('_uncode_'.$post_type.'_header_overlay_color'));
		$metabox_data['_uncode_header_overlay_color_alpha'] = array(ot_get_option('_uncode_'.$post_type.'_header_overlay_color_alpha'));
		$metabox_data['_uncode_header_overlay_pattern'] = array(ot_get_option('_uncode_'.$post_type.'_header_overlay_pattern'));

	} else if ($page_header_type === 'header_uncodeblock') {
		if ($media !== '') {
			if (isset($metabox_data['_uncode_header_background'][0])) $metabox_data['_uncode_header_background'] = array(unserialize($metabox_data['_uncode_header_background'][0]));
			$metabox_data['_uncode_header_background'][0]['background-image'] = $media;
			$media = '';
		}
		$get_uncodeblock_id = ot_get_option('_uncode_'.$post_type.'_blocks');
		$metabox_data['_uncode_blocks_list'] = array($get_uncodeblock_id);
	} else if ($page_header_type === 'header_revslider') {
		$get_rev_id = ot_get_option('_uncode_'.$post_type.'_revslider');
		$metabox_data['_uncode_revslider_list'] = array($get_rev_id);
	} else if ($page_header_type === 'header_layerslider') {
		$get_layer_id = ot_get_option('_uncode_'.$post_type.'_layerslider');
		$metabox_data['_uncode_layerslider_list'] = array($get_layer_id);
	}

	$metabox_data['_uncode_header_scroll_opacity'] = array(ot_get_option('_uncode_'.$post_type.'_header_scroll_opacity'));
	$metabox_data['_uncode_header_scrolldown'] = array(ot_get_option('_uncode_'.$post_type.'_header_scrolldown'));

	return array(
		'meta' => $metabox_data,
		'show_title' => $show_title,
		'media' => $media
	);
}

function uncode_compress_css_inline($inline_css) {
	// Remove comments
	$inline_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $inline_css);

	// Remove space after colons
	$inline_css = str_replace(': ', ':', $inline_css);

	// Remove whitespace
	$inline_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $inline_css);

	// Write everything out
	return $inline_css;
}
