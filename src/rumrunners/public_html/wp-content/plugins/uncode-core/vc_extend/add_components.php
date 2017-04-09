<?php

	function uncode_type_numeric_slider_settings_field($settings, $value) {
	   return '<div class="ot-numeric-slider-wrap">
	   		<input name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'" type="hidden" value="'.$value.'"/>
	   		<span class="numeric-slider-helper-input">'.$value.'</span>
	   		<div class="ot-numeric-slider '.$settings['param_name'].'" data-value="'.$value.'" data-min="'.$settings['min'].'" data-max="'.$settings['max'].'" data-step="'.$settings['step'].'"></div>
	   	</div>';
	}
	vc_add_shortcode_param('type_numeric_slider', 'uncode_type_numeric_slider_settings_field', plugins_url( 'assets/js/fix_inputs_init.js', __FILE__ ));

	function uncode_items_settings_field($settings, $value) {
	   global $post;
	   $current_value = $value;

	   return '<input name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'" type="hidden" data-post="'.$_REQUEST['post_id'].'" value="'.$value.'"/>
	   		  <span class="spinner" style="float: left;width: 100%;"></span>
	   		  <ul id="uncode_items_container" class="option-tree-setting-wrap"></ul>';
	}
	vc_add_shortcode_param('uncode_items', 'uncode_items_settings_field', plugins_url( 'assets/js/index_items_init.js', __FILE__ ));

	function uncode_fieldAttachedMedia( $att_ids = array() ) {
		$output = '';
		if (isset($_POST['mediaid'])) $att_ids[] = $_POST['mediaid'];

		foreach ( $att_ids as $th_id ) {
			$thumb_src = wp_get_attachment_image_src( $th_id, 'thumbnail' );
			if ( $thumb_src ) {
				$thumb_src = $thumb_src[0];
				$output .= '
				<li class="added attachment">
					<div class="attachment-preview landscape">
						<div class="thumbnail" rel="' . $th_id . '">
							<div class="centered">
								<img src="' . $thumb_src . '" />
							</div>
						</div>
					</div>
					<a href="#" class="icon-remove fa fa-times"></a>
				</li>';
			} else {
				$post = get_post($th_id);
				$internal = '';
				if (isset($post->post_mime_type)) {
					$type = $post->post_mime_type;
					if (strpos($type,'audio/') !== false) {
						$internal = '<i class="fa fa-music fa-4x" style="display: block; margin-top: 30%;" /></i>';
					} else if (strpos($type,'video/') !== false) {
						$type = $post->post_mime_type;
						$poster = get_post_meta($th_id, "_uncode_poster_image", true);
						$thumb_src = wp_get_attachment_image_src( $poster, 'thumbnail' );
						if ( $thumb_src ) {
							$thumb_src = $thumb_src[0];
							$internal = '<div class="centered">
														<img src="' . $thumb_src . '" />
													</div>';
						}
						$internal .= '<i class="fa fa-play-circle-o fa-4x" style="display: block; margin-top: 30%;" /></i>';
					} else {
						switch ($type) {
							case 'image/jpeg':
							case 'image/png':
							case 'image/gif':
							case 'image/url':
								$internal = '<img src="' . $post->guid . '" />';
							break;
							case 'oembed/html':
							case 'oembed/iframe':
								$internal = '<i class="fa fa-html5 fa-4x" style="display: block; margin-top: 10%;"" /></i>';
								break;
							case 'oembed/svg':
								$internal = '<div class="oembed-svg">' . $post->post_content . '</div>';
								break;
							default:
								$internal = '<div class="centered"><div id="oembed-'.$post->ID.'" class="oembed"><span class="spinner" style="display: block;float: none;margin: auto;left: -50%;position: relative;margin-top: -10px;"></span></div><div class="oembed_code" style="display: none;">' . $post->guid . '</div></div>';
							break;
						}
					}
				} else {
					$internal = '';
				}
				$output .= '
				<li class="added attachment">
					<div class="attachment-preview landscape">
						<div class="thumbnail" rel="' . $th_id . '">
							'.$internal.'
						</div>
					</div>
					<a href="#" class="icon-remove fa fa-times"></a>
				</li>';
			}
		}
		if ( $output != '' ) {
			if (isset($_POST['mediaid'])) {
				echo do_shortcode( shortcode_unautop( $output ) );
				die();
			}
			return $output;
		}

	}

	add_action( 'wp_ajax_fieldAttachedMedia', 'uncode_fieldAttachedMedia');

	function uncode_media_element_settings_field($settings, $value) {
	  	return '<input type="hidden" class="wpb_vc_param_value uncode_gallery_attached_images_ids ' . $settings['param_name'] . ' ' . $settings['type'] . '" name="' . $settings['param_name'] . '" value="' . $value . '" />
	   		<div class="uncode_widget_attached_images">
				<ul class="uncode_widget_attached_images_list">
					'.(( $value != '' ) ? uncode_fieldAttachedMedia( explode( ",", $value ) ) : '').'
				</ul>
			</div>
			<div class="gallery_widget_site_images">
			</div>
	   		<a class="add_media_widget" href="#" use-single="'. ($settings['param_name'] === 'medias' ? 'false' : 'true' ) .'" title="' . esc_html__( 'Add media', "uncode" ) . '">' . esc_html__( 'Add media', "uncode" ) . '</a>';
	}

	vc_add_shortcode_param('media_element', 'uncode_media_element_settings_field', plugins_url( 'assets/js/media_items.js', __FILE__ ));

	function uncode_add_tmpl_attachment() { ?>
		<script type="text/html" id="uncode_settings-media-block">
			<li class="added attachment">
				<div class="attachment-preview landscape">
					<div class="thumbnail" rel="<%= id %>">
						<% if ( mime == 'oembed/svg') { %>
							<div class="oembed-svg"><%= description %></div>
						<% } else if ( mime == 'oembed/html' || mime == 'oembed/iframe') { %>
							<i class="fa fa-html5 fa-4x" style="display: block; margin-top: 30%;" /></i>
						<% } else { %>
						<div class="centered">
							<% if ( type == 'image' || type == 'svg' ) { %>
							<img src="<%= url %>" />
							<% } else { %>
							<div class="oembed"></div><div class="oembed_code" style="display: none;"><%= url %></div>
							<% }} %>
						</div>
					</div>
				</div>
				<a href="#" class="icon-remove fa fa-times"></a>
			</li>
		</script>

		<script type="text/html" id="tmpl-attachment-details-two-column">
			<div class="attachment-media-view {{ data.orientation }}">
				<div class="thumbnail thumbnail-{{ data.type }}">
					<# if ( data.uploading ) { #>
						<div class="media-progress-bar"><div></div></div>
					<# } else if ( 'image' === data.type && data.sizes && data.sizes.large ) { #>
						<img class="details-image" src="{{ data.sizes.large.url }}" draggable="false" />
					<# } else if ( 'image' === data.type && data.sizes && data.sizes.full ) { #>
						<img class="details-image" src="{{ data.sizes.full.url }}" draggable="false" />
					<# } else if ( 'image/url' === data.mime ) { #>
						<span class="spinner" style="display: block; float: left"></span>
						<img class="details-image" src="{{ data.url }}" draggable="false" />
					<# } else if ( 'oembed/svg' === data.mime ) { #>
						{{{ data.description }}}
					<# } else if (((data.mime).indexOf("oembed") >= 0) ) { #>
					<# if ( 'oembed/html' === data.mime || 'oembed/iframe' === data.mime ) { #>
						{{{ data.description }}}
					<# } else { #>
						<div class="oembed"><span class="spinner" style="display: block; float: left"></span></div><div class="oembed_code" style="display: none;">{{ data.url }}</div>
					<# } #>
					<# } else if ( 'audio' === data.type ) { #>
					<div class="wp-media-wrapper">
						<audio style="visibility: hidden" controls class="wp-audio-shortcode" width="100%" preload="none">
							<source type="{{ data.mime }}" src="{{ data.url }}"/>
						</audio>
					</div>
					<# } else if ( 'video' === data.type ) {
						var w_rule = h_rule = '';
						if ( data.width ) {
							w_rule = 'width: ' + data.width + 'px;';
						} else if ( wp.media.view.settings.contentWidth ) {
							w_rule = 'width: ' + wp.media.view.settings.contentWidth + 'px;';
						}
						if ( data.height ) {
							h_rule = 'height: ' + data.height + 'px;';
						}
					#>
					<div style="{{ w_rule }}{{ h_rule }}" class="wp-media-wrapper wp-video">
						<video controls="controls" class="wp-video-shortcode" preload="metadata"
							<# if ( data.width ) { #>width="{{ data.width }}"<# } #>
							<# if ( data.height ) { #>height="{{ data.height }}"<# } #>
							<# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>
							<source type="{{ data.mime }}" src="{{ data.url }}"/>
						</video>
					</div>
					<# } else { #>
					<img class="details-image" src="{{ data.icon }}" class="icon" draggable="false" />
					<# } #>
					<div class="attachment-actions">
						<# if ( 'image' === data.type && ! data.uploading && data.sizes ) { #>
							<a class="button edit-attachment" href="#"><?php esc_html_e( 'Edit Image', 'uncode'); ?></a>
						<# } #>
					</div>
				</div>
			</div>
			<div class="attachment-info">
				<span class="settings-save-status">
					<span class="spinner"></span>
					<span class="saved"><?php esc_html_e('Saved.','uncode'); ?></span>
				</span>
				<div class="details">
					<div class="filename"><strong><?php esc_html_e( 'File name:' , 'uncode') ; ?></strong> {{ data.filename }}</div>
					<div class="filename"><strong><?php esc_html_e( 'File type:' , 'uncode') ; ?></strong> {{ data.mime }}</div>
					<div class="uploaded"><strong><?php esc_html_e( 'Uploaded on:' , 'uncode') ; ?></strong> {{ data.dateFormatted }}</div>

					<div class="file-size"><strong><?php esc_html_e( 'File size:' , 'uncode') ; ?></strong> {{ data.filesizeHumanReadable }}</div>
					<# if ( 'image' === data.type && ! data.uploading ) { #>
						<# if ( data.width && data.height ) { #>
							<div class="dimensions"><strong><?php esc_html_e( 'Dimensions:' , 'uncode') ; ?></strong> {{ data.width }} &times; {{ data.height }}</div>
						<# } #>
					<# } #>

					<# if ( data.fileLength ) { #>
						<div class="file-length"><strong><?php esc_html_e( 'Length:' , 'uncode') ; ?></strong> {{ data.fileLength }}</div>
					<# } #>

					<# if ( 'audio' === data.type && data.meta.bitrate ) { #>
						<div class="bitrate">
							<strong><?php esc_html_e( 'Bitrate:' , 'uncode') ; ?></strong> {{ Math.round( data.meta.bitrate / 1000 ) }}kb/s
							<# if ( data.meta.bitrate_mode ) { #>
							{{ ' ' + data.meta.bitrate_mode.toUpperCase() }}
							<# } #>
						</div>
					<# } #>

					<div class="compat-meta">
						<# if ( data.compat && data.compat.meta ) { #>
							{{{ data.compat.meta }}}
						<# } #>
					</div>
				</div>

				<div class="settings">
					<label class="setting" data-setting="url">
						<span class="name"><?php esc_html_e('URL', 'uncode') ; ?></span>
						<# if ( 'oembed' === data.type ) { #>
						<textarea>{{ data.url }}</textarea>
						<# } else { #>
						<input type="text" value="{{ data.url }}" readonly />
						<# } #>
					</label>
					<# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>
					<label class="setting" data-setting="title">
						<span class="name"><?php esc_html_e('Title', 'uncode') ; ?></span>
						<input type="text" value="{{ data.title }}" {{ maybeReadOnly }} />
					</label>
					<# if ( 'audio' === data.type ) { #>
					<?php foreach ( array(
						'artist' => esc_html__( 'Artist' , 'uncode') ,
						'album' => esc_html__( 'Album' , 'uncode') ,
					) as $key => $label ) : ?>
					<label class="setting" data-setting="<?php echo esc_attr( $key ) ?>">
						<span class="name"><?php echo esc_html($label); ?></span>
						<input type="text" value="{{ data.<?php echo esc_attr($key); ?> || data.meta.<?php echo esc_attr($key); ?> || '' }}" />
					</label>
					<?php endforeach; ?>
					<# } #>
					<label class="setting" data-setting="caption">
						<span class="name"><?php esc_html_e( 'Caption' , 'uncode') ; ?></span>
						<textarea {{ maybeReadOnly }}>{{ data.caption }}</textarea>
					</label>
					<# if ( 'image' === data.type ) { #>
						<label class="setting" data-setting="alt">
							<span class="name"><?php esc_html_e( 'Alt Text' , 'uncode') ; ?></span>
							<input type="text" value="{{ data.alt }}" {{ maybeReadOnly }} />
						</label>
					<# } #>
					<label class="setting" data-setting="description">
						<span class="name"><?php esc_html_e('Description', 'uncode') ; ?></span>
						<textarea {{ maybeReadOnly }}>{{ data.description }}</textarea>
					</label>
					<label class="setting">
						<span class="name"><?php esc_html_e( 'Uploaded By' , 'uncode') ; ?></span>
						<span class="value">{{ data.authorName }}</span>
					</label>
					<# if ( data.uploadedTo ) { #>
						<label class="setting">
							<span class="name"><?php esc_html_e( 'Uploaded To' , 'uncode') ; ?></span>
							<# if ( data.uploadedToLink ) { #>
								<span class="value"><a href="{{ data.uploadedToLink }}">{{ data.uploadedToTitle }}</a></span>
							<# } else { #>
								<span class="value">{{ data.uploadedToTitle }}</span>
							<# } #>
						</label>
					<# } #>
					<div class="attachment-compat"></div>
				</div>

				<div class="actions">
					<a class="view-attachment" href="{{ data.link }}"><?php esc_html_e( 'View attachment page' , 'uncode') ; ?></a> |
					<a href="post.php?post={{ data.id }}&action=edit"><?php esc_html_e( 'Edit more details' , 'uncode') ; ?></a>
					<# if ( ! data.uploading && data.can.remove ) { #> |
							<?php if ( MEDIA_TRASH ): ?>
							<# if ( 'trash' === data.status ) { #>
								<a class="untrash-attachment" href="#"><?php esc_html_e( 'Untrash' , 'uncode') ; ?></a>
							<# } else { #>
								<a class="trash-attachment" href="#"><?php esc_html_e( 'Trash' , 'uncode') ; ?></a>
							<# } #>
							<?php else: ?>
								<a class="delete-attachment" href="#"><?php esc_html_e( 'Delete Permanently' , 'uncode') ; ?></a>
							<?php endif; ?>
						<# } #>
				</div>

			</div>
		</script>

		<script type="text/html" id="tmpl-attachment">
			<div class="attachment-preview js--select-attachment type-{{ data.type }} subtype-{{ data.subtype }} {{ data.orientation }}">
				<#  if ( data.uploading ) { #>
					<div class="media-progress-bar"><div></div></div>
				<# } else if ( 'image' === data.type ) { #>
					<div class="thumbnail" rel="{{ data.id }}">
						<div class="centered">
							<img src="{{ data.size.url }}" draggable="false" />
						</div>
						<# if ( 'image/url' === data.mime ) { #>
						<div class="filename">
							<div><?php echo esc_html__('External Image','uncode'); ?></div>
						</div>
						<# } #>
					</div>
				<# } else if ( 'oembed' === data.type ) { #>
					<div class="thumbnail" rel="{{ data.id }}">
						<# if ( 'oembed/html' === data.mime || 'oembed/iframe' === data.mime ) { #>
						<i class="fa fa-html5 fa-4x" style="display: block; margin-top: 30%;" /></i>
						<div class="filename">
							<div style="text-transform: capitalize;">{{ data.title }}</div>
						</div>
						<# } else if ( 'oembed/svg' === data.mime ) { #>
						<div class="oembed-svg">{{{ data.description }}}</div>
						<div class="filename">
							<div style="text-transform: capitalize;">{{ data.title }}</div>
						</div>
						<# } else { #>
						<div class="centered">
							<div class="oembed">
								<span class="spinner"></span>
							</div>
							<div class="oembed_code" style="display: none;">{{ data.url }}</div>
						</div>
						<div class="filename">
							<div style="text-transform: capitalize;">{{ data.mime }}</div>
						</div>
						<# } #>
					</div>
				<# } else { #>
					<div class="thumbnail" rel="{{ data.id }}">
						<div class="centered">
							<img src="{{ data.icon }}" class="icon" draggable="false" />
						</div>
						<div class="filename">
							<div>{{ data.filename }}</div>
						</div>
					</div>
				<# } #>

				<# if ( data.buttons.close ) { #>
					<a class="close media-modal-icon" href="#" title="<?php esc_html_e('Remove', 'uncode') ; ?>"></a>
				<# } #>

				<# if ( data.buttons.check ) { #>
					<a class="check" href="#" title="<?php esc_html_e('Deselect', 'uncode') ; ?>"><div class="media-modal-icon"></div></a>
				<# } #>
			</div>
			<#
			var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly';
			if ( data.describe ) { #>
				<# if ( 'image' === data.type ) { #>
					<input type="text" value="{{ data.caption }}" class="describe" data-setting="caption"
						placeholder="<?php esc_attr_e('Caption this image&hellip;','uncode'); ?>" {{ maybeReadOnly }} />
				<# } else { #>
					<input type="text" value="{{ data.title }}" class="describe" data-setting="title"
						<# if ( 'video' === data.type ) { #>
							placeholder="<?php esc_attr_e('Describe this video&hellip;','uncode'); ?>"
						<# } else if ( 'audio' === data.type ) { #>
							placeholder="<?php esc_attr_e('Describe this audio file&hellip;','uncode'); ?>"
						<# } else { #>
							placeholder="<?php esc_attr_e('Describe this media file&hellip;','uncode'); ?>"
						<# } #> {{ maybeReadOnly }} />
				<# } #>
			<# } #>
		</script>

		<script type="text/html" id="tmpl-uploader-uncode-media">
			<div class="edit-attachment-frame">
				<div class="attachment-media-view landscape">
					<div class="thumbnail thumbnail-image oembed_container">
						<div class="oembed"></div>
						<div class="oembed_code"></div>
					</div>
				</div>
			</div>
			<div class="media-sidebar">
				<h3><span class="spinner"></span>Media Details</h3>
				<label class="setting" data-setting="url">
					<span class="name">Title</span>
					<input type="text" name="mle-title" value="" id="title" autocomplete="off">
				</label>
				<label class="setting" data-setting="oembed">
					<span class="name">oEmbed code</span>
					<textarea id="mle-code" name="mle-code"></textarea>
				</label>
				<label class="setting" data-setting="caption">
					<span class="name">Caption</span>
					<input type="text" name="mle-caption" value="" autocomplete="off">
				</label>
				<label class="setting" data-setting="description">
					<span class="name">Description</span>
					<textarea name="mle-description" ></textarea>
				</label>
				<input type="hidden" name="mle-width" id="mle-width" value="">
				<input type="hidden" name="mle-height" id="mle-height" value="">
				<input type="hidden" name="mle-mime" id="mle-mime" value="">
				<input type="hidden" name="nonce" value="<?php echo wp_create_nonce("uncode-recordmedia-nonce"); ?>">
			</div>
		</script>

	<?php }

	add_action( 'admin_footer', 'uncode_add_tmpl_attachment' );

	add_filter('wpb_widget_title', 'uncode_override_widget_title', 10, 2);

	function uncode_override_widget_title($output = '', $params = array('')) {
		$extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
		return '<h3 class="widget-title'.$extraclass.'">'.$params['title'].'</h3>';
	}

?>