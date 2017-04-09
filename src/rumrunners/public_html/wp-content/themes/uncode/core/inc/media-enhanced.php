<?php

function uncode_add_enhanced_panel(){
	add_submenu_page( 'upload.php', esc_html__("Add oEmbed, external IMG, SVG code, HTML or Shortcode",'uncode'), esc_html__("Add Multimedia",'uncode'), 'manage_options', 'add-other', 'uncode_addOtherMedia');
}
add_action('admin_menu', 'uncode_add_enhanced_panel');


function uncode_recordMedia(){

  global $wpdb;

  check_ajax_referer( 'uncode-recordmedia-nonce', 'nonce' );

	$user_id = get_current_user_id();
	$title = $_POST['mle-title'];
	$caption = $_POST['mle-caption'];
	$desc = $_POST['mle-description'];
	$code = $_POST['mle-code'];
	$mime = $_POST['mle-mime'];
	$width = isset($_POST['mle-width']) ? $_POST['mle-width'] : '';
	$height = isset($_POST['mle-height']) ? $_POST['mle-height'] : '';

	$date = date("Y-m-d G:i:s");

	if (isset($_POST['mle-code']) && $_POST['mle-code'] != '') {

		$post_name = sanitize_title($title);

		if ($mime === 'oembed/html' || $mime === 'oembed/svg' || $mime === 'oembed/iframe') {
			$desc = ($mime === 'oembed/html') ? esc_html($code) : $code;
			$code = '';
		}

		$args = array(
		  'post_content'   => $desc,
		  'post_name'      => $post_name,
		  'post_title'     => $title,
		  'post_status'    => 'inherit',
		  'post_type'      => 'attachment',
		  'post_author'    => $user_id,
		  'guid'           => $code,
		  'post_excerpt'   => $caption,
		  'post_date'      => $date,
		  'post_date_gmt'  => $date,
		  'post_mime_type' => $mime,
		);

		if (isset($_POST['postid'])) {
			$args['ID'] = $_POST['postid'];
			$new = wp_insert_post( $args );
			$code = esc_sql($code);
			$update = $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET guid = %s WHERE ID = %d", $code, $new ) );
		} else {
			$new = wp_insert_post( $args );
		}

		if ($mime === 'oembed/svg') {
			$desc = wp_unslash( $desc );
			preg_match_all('/(width|height)=("[^"]*")/i', $desc, $svg_size);
			if (isset($svg_size[2][0])) {
				preg_match("|\d+|", $svg_size[2][0], $width);
				$width = $width[0];
			}
			if (isset($svg_size[2][1])) {
				preg_match("|\d+|", $svg_size[2][1], $height);
				$height = $height[0];
			}
		} else if ($mime === 'image/url') {
			list($width, $height) = @getimagesize( $code );
		}

		$attr = Array('width' => $width, 'height' => $height);
		if ($width !== '' && $height !== '') update_post_meta($new, '_wp_attachment_metadata', $attr);

		if (!isset($_POST['postid'])) {
			$element = array(
				'id' => $new,
				'type' => ($mime === 'image/url') ? 'image' : 'oembed',
				'mime' => $mime,
				'url' => ($mime === 'oembed/html' || $mime === 'oembed/svg' || $mime === 'oembed/iframe') ? (($mime === 'oembed/html') ? esc_html($desc) : $desc) : $code,
			);

			echo json_encode($element);
		}
	}

	die();
}

add_action('wp_ajax_recordMedia', 'uncode_recordMedia');


function uncode_addScripts() {

	?>
	<style type="text/css">

		.media-caption, .media-description {
			float: left;
			clear: both;
			width: 100%;
		}
		#postbox-container-1 .inside {
			padding: 0px;
			margin: 0px;
		}
		.omedia-frame-content {
			background-color: transparent;
		}
		.omedia-frame-content h1 {
			font-size: 22px;
			font-weight: 200;
			line-height: 45px;
			margin: 0;
		}
		#post-body-content input[type=text], .omedia-frame-content textarea {
			font-size: 18px;
			padding: 12px 14px;
			width: 100%;
			min-width: 200px;
			box-shadow: inset 2px 2px 4px -2px rgba(0,0,0,0.1);
		}
		#post-body-content textarea.embed {
			float: left;
			width: 49%;
			min-height: 276px;
		}
		.wp_attachment_details {
			clear: both;
			float: left;
			width: 100%;
		}
		.oembed {
			float: right;
			width: 49%;
			border: 4px dashed #ddd;
			min-height: 276px;
			box-sizing: border-box;
			text-align: center;
			padding: 10px 10px 7px 10px;
		}
		.oembed iframe {
			width: 100%;
			max-height: 100% !important;
			min-height: 250px;
		}
		.oembed img { max-width:100%; height: auto; } /* Enough everywhere except IE8. */
		@media \0screen {.oembed img { width: auto }} /* Prevent height distortion in IE8. */
		.media-caption {
			clear: both;
		}
		#fillError {
			display: none;
		}
	</style>

	<script>

		var arrayRegex = new Array();
		arrayRegex[0] = {domain: '((http|https):\/\/)?(www\.)?(youtube\.com|youtu\.be)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/youtube'};
		arrayRegex[1] = {domain: '((http|https):\/\/)?(www\.)?(blip\.tv)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/blip'};
		arrayRegex[2] = {domain: '((http|https):\/\/)?(www\.)?(vimeo\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/vimeo'};
		arrayRegex[3] = {domain: '((http|https):\/\/)?(www\.)?(dailymotion\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/dailymotion'};
		arrayRegex[4] = {domain: '((http|https):\/\/)?(www\.)?(qik\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/qik'};
		arrayRegex[5] = {domain: '((http|https):\/\/)?(www\.)?(flickr\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/flickr'};
		arrayRegex[6] = {domain: '((http|https):\/\/)?(www\.)?(hulu\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/hulu'};
		arrayRegex[7] = {domain: '((http|https):\/\/)?(www\.)?(viddler\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/viddler'};
		arrayRegex[8] = {domain: '((http|https):\/\/)?(www\.)?(slideshare\.net)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/slideshare'};
		arrayRegex[9] = {domain: '((http|https):\/\/)?(www\.)?(wordpress\.tv)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/wordpress'};
		arrayRegex[10] = {domain: '((http|https):\/\/)?(www\.)?(twitter\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/twitter'};
		arrayRegex[11] = {domain: '((http|https):\/\/)?(www\.)?(scribd\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/scribd'};
		arrayRegex[12] = {domain: '((http|https):\/\/)?(www\.)?(photobucket\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/photobucket'};
		arrayRegex[13] = {domain: '((http|https):\/\/)?(www\.)?(soundcloud\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/soundcloud'};
		arrayRegex[14] = {domain: '((http|https):\/\/)?(www\.)?(instagr\.am|instagram\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/instagram'};
		arrayRegex[15] = {domain: '(.*?<\/iframe>)\/?', type: 'oembed/iframe'};
		arrayRegex[16] = {domain: '((http|https):\/\/)?(www\.)?(flic\.kr)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/flickr'};
		arrayRegex[17] = {domain: '((http|https):\/\/.+?\.jpg|jpeg|png|gif|tiff/gi)/?', type: 'image/url'};
		arrayRegex[18] = {domain: '((http|https):\/\/)?(www\.)?(spotify\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/spotify'};
		arrayRegex[18] = {domain: '((http|https):\/\/)?(www\.)?(facebook\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?', type: 'oembed/facebook'};
		arrayRegex[20] = {domain: '(.*?<\/svg>)\/?', type: 'oembed/svg'};

		jQuery(document).ready(function($) {
			"use strict";

			var inserted = false;

			if ($('textarea.embed').val() != '') getEmbed($('textarea.embed').val());

			function find_add_sizes(mime, width, height) {
				if ( width != undefined && width != 0 && height != undefined && height != 0 && !inserted) {
					$('#mle-mime').after('<input type="hidden" id="#mle-width" name="mle-width" value="'+width+'"/>');
					$('#mle-mime').after('<input type="hidden" id="#mle-height" name="mle-height" value="'+height+'"/>');
					inserted = true;

				}
			}

			function getEmbed(url) {
				var provider;
				var mediacode = url;

				if (mediacode != undefined) {
					mediacode = mediacode.replace(/(\r\n|\n|\r)/gm,"");

					arrayRegex.forEach(function(regex) {
						if (mediacode.match(regex.domain)) {
							provider = regex.type;

							if (provider == 'oembed/iframe') {
								$('.oembed').css('background', 'none');
								$('.oembed').html(mediacode);
							} else if (provider == 'oembed/svg') {
								$('.oembed').css('background', 'none');
								$('.oembed').html(mediacode);
							} else if (provider == 'image/url') {
								$('.oembed').css('background', 'none');
								$('.oembed').html('<img src="' + mediacode + '" />');
							} else if (provider == 'oembed/flickr') {
								$('.oembed_code').html(mediacode);
								$('.oembed').css('background', 'none');
								$('.oembed').get_oembed(find_add_sizes, true);
							} else {
								$('.oembed_code').html(mediacode);
								$('.oembed').get_oembed(find_add_sizes, true);
							}

							$('#mle-mime').val(provider);

						}
					});
				}

				if (provider == undefined) {
					$('#mle-mime').val('oembed/html');
					$('.oembed').css('background', 'none');
					mediacode = mediacode.toString().replace(/</g, '&lt;').replace(/>/g, '&gt;');
					$('.oembed').html('<pre stype="text/plain">'+mediacode+'</pre>');
				}
			}

			$('textarea.embed').on('paste input',function(){
				$('.oembed').css('background', 'url(<?php echo admin_url().'images/wpspin_light.gif' ?>) center center no-repeat');
				getEmbed($(this).val());
			});

		});

	</script>
	<?php

}

function uncode_addOtherMedia() {

	global $wpdb;

	if (isset($_REQUEST['postid'])) {
		$post = get_post($_REQUEST['postid']);
	}

	uncode_addScripts();
?>

	<script>
		jQuery(document).ready(function() {
			jQuery('#publish').click(function(e) {
				e.preventDefault();
				jQuery('#fillError').hide();
				jQuery('.spinner').show();
				if (jQuery('#title').val() != '' && jQuery('#linkUrl').val() != '') {
					jQuery.ajax({
						type:"POST",
						dataType: "json",
						url: "<?php echo admin_url(); ?>admin-ajax.php?action=recordMedia", // our PHP handler file
						data: jQuery('#media-submit').serialize(),
						success:function(results){
							var originalURL = jQuery('#publish').attr('data-url'),
    					exists = originalURL.indexOf('postid');
    					if (exists === -1) window.location = originalURL + '&postid=' + results.id;
							else window.location = originalURL;
						}
					});
				} else {
					jQuery('#fillError').show();
					jQuery('.spinner').hide();
				}
			});
		});
	</script>
	<div class="wrap">
		<div id="icon-upload" class="icon32"><br></div>
		<h2><?php esc_html_e("Add oEmbed, external IMG, SVG code, HTML or Shortcode",'uncode'); ?> <a href="upload.php?page=add-other" class="add-new-h2"><?php esc_html_e('Add New','uncode'); ?></a></h2>
		<div id="poststuff">
			<?php
			if (isset($_REQUEST['postid'])) { ?>
			<div id="message" class="updated below-h2"><p><?php esc_html_e('Item added to library.','uncode'); ?></p></div>
			<?php } ?>
			<?php
			if (isset($_REQUEST['updated'])) { ?>
			<div id="message" class="updated below-h2"><p><?php esc_html_e('Item updated.','uncode'); ?></p></div>
			<?php } ?>
			<div id="fillError" class='error'><p><?php esc_html_e('Fill all the required fields.','uncode'); ?></p></div>
			<div id="post-body" class="columns-2">
				<div id="post-body-content">
					<form id="media-submit" method="post">
						<div class="omedia-frame-content">
							<div id="content">
								<div id="titlediv" class="controls">
									<div id="titlewrap">
										<input placeholder="<?php esc_html_e('Enter title here*','uncode'); ?>" type="text" name="mle-title" size="30" value="<?php if (isset($post)) echo esc_attr($post->post_title); ?>" id="title" autocomplete="off">
									</div>
									<?php
										if (isset($_REQUEST['postid'])) {
											$get_code = ($post->post_mime_type === 'oembed/iframe' || $post->post_mime_type === 'oembed/svg' || $post->post_mime_type === 'oembed/html') ? $post->post_content : $post->guid;
									?>
									<div class="inside">
										<div id="edit-slug-box" class="hide-if-no-js">
										<strong><?php esc_html_e('Permalink:','uncode'); ?></strong>
										<span id="sample-permalink" tabindex="-1"><?php echo get_site_url().'/?attachment_id='.$_REQUEST['postid']; ?></span>
										<span id="view-post-btn"><a href="<?php echo get_site_url().'/?attachment_id='.$_REQUEST['postid']; ?>" class="button button-small"><?php esc_html_e('View Post','uncode'); ?></a></span>
										</div>
									</div>
									<?php } ?>
								</div>
								<div class="media-embed controls section">
									<p><strong><?php esc_html_e('Insert from URL*','uncode'); ?></strong></p>
									<textarea id="linkUrl" rows="10" name="mle-code" class="embed"><?php if (isset($post)) wp_kses_post($get_code); ?></textarea>
									<input type="hidden" name="mle-mime" id="mle-mime" value="<?php if (isset($post)) echo esc_attr($post->post_mime_type); ?>">
									<div class="oembed"></div><div class="oembed_code" style="display: none;"></div>
								</div>
								<div class="media-caption controls section">
									<p><strong><?php esc_html_e('Caption','uncode'); ?></strong></p>
									<input type="text" name="mle-caption" class="alignment" data-setting="caption" value="<?php if (isset($post)) echo esc_attr($post->post_excerpt); ?>">
								</div>
								<div class="media-description section">
									<p><strong><?php esc_html_e('Description','uncode'); ?></strong></p>
									<?php
									$quicktags_settings = array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close' );
									$editor_args = array(
										'textarea_name' => 'mle-description',
										'textarea_rows' => 5,
										'media_buttons' => false,
										'tinymce' => false,
										'quicktags' => $quicktags_settings,
									);
									wp_editor( (isset($post) && ($post->post_mime_type !== 'oembed/svg' && $post->post_mime_type !== 'oembed/html' && $post->post_mime_type !== 'oembed/iframe')) ? $post->post_content : '', 'attachment_content', $editor_args ); ?>
								</div>
							</div>
							<input type="hidden" name="nonce" value="<?php echo wp_create_nonce("uncode-recordmedia-nonce"); ?>">
							<?php
									if (isset($_REQUEST['postid'])) { ?>
							<input type="hidden" name="postid" value="<?php echo esc_attr($_REQUEST['postid']); ?>">
							<input type="hidden" name="update" value="1">
							<?php } ?>
						</div>
					</form>
				</div>
				<div id="postbox-container-1" class="postbox-container">
					<div id="postimagediv" class="postbox ">
						<div class="handlediv" title="Click to toggle"><br></div>
						<h3 class="hndle"><span><?php esc_html_e('Publish','uncode'); ?></span></h3>
						<div class="inside">
							<div class="submitbox" id="submitpost">
								<div id="major-publishing-actions">
									<div id="publishing-action">
										<span class="spinner"></span>
										<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_html_e('Publish','uncode'); ?>">
										<?php
										if (!isset($_REQUEST['postid'])) { ?>
										<input name="save" type="submit" class="button button-primary button-large" id="publish" data-url="<?php echo get_site_url().'/wp-admin/upload.php?page=add-other'; ?>" value="<?php esc_html_e('Save','uncode'); ?>">
										<?php } ?>
										<?php
										if (isset($_REQUEST['postid'])) { ?>
										<input name="save" type="submit" class="button button-primary button-large" id="publish" data-url="<?php echo get_site_url().'/wp-admin/upload.php?page=add-other&postid='.$_REQUEST['postid'].'&updated=1'; ?>" value="<?php esc_html_e('Update','uncode'); ?>">
										<?php } ?>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }