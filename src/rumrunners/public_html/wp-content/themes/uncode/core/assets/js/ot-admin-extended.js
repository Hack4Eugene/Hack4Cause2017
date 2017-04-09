(function($) {
	OT_UI.uncode_init = function() {
			OT_UI.adaptive();
		},
		OT_UI.adaptive = function() {
			$(document).on('ready', function() {
				$.ajax({
					url: option_tree.ajax,
					type: 'post',
					dataType: "json",
					data: {
						action: 'list_images',
					},
					complete: function(data) {
						$('#setting__uncode_adaptive').append('<div class="ai-space">' + data.responseText + '</div>');
						var button = $('<button class="option-tree-ui-button button button-secondary left" style="margin-left: 0px !important; margin-top: 10px !important;">Delete all AI images</button>');
						button.on('click', function(e) {
							e.preventDefault();
							var button = $(this);
							button.addClass('disabled');
							button.html('Deleting…');
							$.ajax({
								url: option_tree.ajax,
								type: 'post',
								dataType: "json",
								data: {
									action: 'list_images',
									erase: true
								},
								complete: function(data) {
									button.removeClass('disabled');
									button.html('Delete all AI images');
									$('#setting__uncode_adaptive .ai-space').html(data.responseText);
								}
							});
							return false;
						});
						$('#setting__uncode_adaptive').append(button);
					}
				});
			});
		},
		OT_UI.fix_upload_parent = function() {},
		OT_UI.init_select_wrapper = function() {
			$('.option-tree-ui-select').each(function() {
				var selectValue, selectName;
				if (!$(this).parent().hasClass('select-wrapper')) {
					$(this).wrap('<div class="select-wrapper" />');
				}
				if ($(this).hasClass('uncode-color-select')) {
					$(this).closest('.select-wrapper').addClass('select-uncode-colors');
					$(this).easyDropDown({
						cutOff: 10
					});
				}
			});
			$(document).on({
				mouseenter: function() {
					$(this).closest('.select-wrapper.hide-arrow').addClass("hover");
				},
				mouseleave: function() {
					$(this).closest('.select-wrapper.hide-arrow').removeClass("hover");
				}
			}, ".select-input-mixed");
			$(document).on('click', '.select-input-wrapper span', function() {
				$(this).prev('input').val('');
			});
			$(document).on('focus', '.select-input-mixed-field', function() {
				$(this).val('');
			});
			$(document).on('change', 'input.select-input-mixed-field-text', function() {
				$(this).closest('.select-wrapper').find('input.select-input-mixed-field-value').val($(this).val());
			});
			$(document).on($.browser.msie ? 'click' : 'change', '.option-tree-ui-select', function(event) {
				if ($(this).hasClass('select-input-mixed')) {
					$(this).closest('.select-wrapper').find('input.select-input-mixed-field-text ').val($(this).find('option:selected').text());
					$(this).closest('.select-wrapper').find('input.select-input-mixed-field-value').val($(this).find('option:selected').val());
				}
			});
		},
		OT_UI.init_upload = function() {
			// Open up the media manager to handle editing image metadata.
			$(document).on('click', '.ot_upload_media', function(e) {
				e.preventDefault();
				var uncode_frames = {}, // Store our workflows in an object
					frame_id = 'uncode-editor', // Unique ID for each workflow
					default_view = wp.media.view.AttachmentsBrowser, // Store the default view to restore it later
					media = wp.media,
					field_id = $(this).parent('.option-tree-ui-upload-parent').find('input').attr('id'),
					post_id = $(this).attr('rel'),
					save_attachment_id = $('#' + field_id).val(),
					btnContent = '';
				// If the media frame already exists, reopen it.
				if (uncode_frames[frame_id]) {
					uncode_frames[frame_id].open();
					return;
				}
				media.view.uploadMediaView = media.View.extend({
					tagName: 'div',
					className: 'uploader-uncode-media',
					template: media.template('uploader-uncode-media'),
					events: {
						'click .close': 'hide',
						'paste #mle-code': 'entercode',
						'input #mle-code': 'entercode'
					},
					oembed_callback: function($mime, $width, $height) {
						var $this = (window['workflow'] != undefined) ? workflow : wp.media.frame,
							$el = $this.$el;
						$button = $el.find('.media-button'),
							$spinner = $el.find('.spinner');
						if ($mime != '') {
							$el.find('#mle-mime').val($mime);
							$el.find('#mle-width').val($width);
							$el.find('#mle-height').val($height);
							$button.removeAttr('disabled');
							$spinner.removeClass('visible');
						}
					},
					entercode: function(event) {
						var _this = this;
						var $el = $(this.$el),
							$codeInput = $el.find('#mle-code'),
							$codeDiv = $el.find('.oembed_code'),
							$oEmbedRender = $el.find('.oembed'),
							$spinner = $el.find('.spinner'),
							$code;
						setTimeout(function() {
							$code = $codeInput.val();
							if ($codeDiv.length == 0) $oEmbedRender.after('<div class="oembed_code">' + $code + '</div>');
							else $codeDiv.html($code);
							$oEmbedRender.get_oembed(_this.oembed_callback, true);
							$spinner.addClass('visible');
						}, 100);
					},
					recordmedia: function() {
						var $this = this,
							$el = $(this.$el),
							$button = uncode_frames[frame_id].$el.find('.media-button-select');
						if (uncode_frames[frame_id].content.get().el.className == 'uploader-uncode-media') {
							$button.attr('disabled', 'disabled');
							$.ajax({
								type: 'POST',
								dataType: "json",
								url: ajaxurl + '?action=recordMedia',
								data: $el.find('input[name],select[name],textarea[name]').serialize(),
								success: function(data) {
									if (!isNaN(data.id) && data != undefined) {
										btnContent += '<div class="option-tree-ui-image-wrap"><div class="oembed"><span class="spinner" style="display: block; float: left;"></span></div><div class="oembed_code" style="display: none;">' + data.url + '</div></div>';
										$('#' + field_id).val(data.id);
										$('#' + field_id + '_media').remove();
										$('#' + field_id).parent().parent('div').append('<div class="option-tree-ui-media-wrap" id="' + field_id + '_media" />');
										$('#' + field_id + '_media').append(btnContent).slideDown();
										$('#' + field_id + '_media .oembed').get_oembed(null, true);
										$('#' + field_id + '_media .spinner').removeClass('visible');
										$button.removeAttr('disabled');
										uncode_frames[frame_id].off('select');
										uncode_frames[frame_id].close();
									}
								}
							});
						} else {
							$this.select();
						}
					},
					ready: function() {
						var $this = this,
							$button = uncode_frames[frame_id].$el.find('.media-button-select');
						$button.off('click').on('click', function() {
							$this.recordmedia();
						});
					},
					select:function () {
						var selection = media.frame.toolbar.get('selection').selection.single();
						media.frame.close();
					}
				});
				// Create the media frame.
				uncode_frames[frame_id] = media({
					title: $(this).attr('title'),
					button: {
						text: option_tree.upload_text
					},
					multiple: false
				});
				uncode_frames[frame_id].on('router:render:browse', function(routerView) {
					routerView.set({
						upload: {
							text: 'Upload Files',
							priority: 20
						},
						browse: {
							text: 'Media Library',
							priority: 40
						},
						uncode: {
							text: 'Upload oEmbed',
							priority: 30
						}
					});
				});
				uncode_frames[frame_id].on('content:render:uncode', function() {
					uncode_frames[frame_id].content.set(new media.view.uploadMediaView({
						controller: this
					}));
				});
				uncode_frames[frame_id].on('close', function() {
					wp.media.view.AttachmentsBrowser = default_view;
				});
				uncode_frames[frame_id].on('select', function() {
					var attachment = uncode_frames[frame_id].state().get('selection').first(),
						href = attachment.attributes.url,
						attachment_id = attachment.attributes.id,
						mime = attachment.attributes.mime,
						regex = /^image\/(?:jpe?g|png|url|gif|x-icon)$/i;
					if (mime == 'oembed/svg') {
						btnContent += '<div class="option-tree-ui-image-wrap">' + attachment.attributes.description + '</div>';
					} else if (mime.match(regex)) {
						btnContent += '<div class="option-tree-ui-image-wrap"><img src="' + href + '" alt="" /></div>';
					} else {
						btnContent += '<div class="option-tree-ui-image-wrap"><div class="oembed"><span class="spinner" style="display: block; float: left;"></span></div><div class="oembed_code" style="display: none;">' + href + '</div></div>';
					}
					btnContent += '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button button button-secondary light" title="' + option_tree.remove_media_text + '"><span class="icon fa fa-minus2"></span>' + option_tree.remove_media_text + '</a>';
					//$('#'+field_id).val( ( save_attachment_id ? attachment_id : href ) );
					$('#' + field_id).val(attachment_id);
					$('#' + field_id + '_media').remove();
					$('#' + field_id).parent().parent('div').append('<div class="option-tree-ui-media-wrap" id="' + field_id + '_media" />');
					$('#' + field_id + '_media').append(btnContent).slideDown();
					$('#' + field_id + '_media .oembed').get_oembed();
					uncode_frames[frame_id].off('select');
					uncode_frames[frame_id].close();
				});
				uncode_frames[frame_id].on('open',function() {
					var selection = uncode_frames[frame_id].state().get('selection'),
				  attachment = media.attachment(save_attachment_id);
				  attachment.fetch();
				  selection.set( attachment );
				});
				// Finally, open the modal.
				uncode_frames[frame_id].open();
			});
		},
		$(document).ready(function() {
			OT_UI.uncode_init();
		});
})(jQuery);
/*!
 * Fixes the state of metabox radio buttons after a Drag & Drop event.
 */
! function($) {
	$(document).on('ready', function() {
		$.fn.loadIcons = function() {
			var icons = $(this).fontIconPicker({
				theme: 'fip-bootstrap'
			});
			// Get the JSON file
			$.ajax({
				url: SiteParameters.OT_PATH + 'selection.json',
				type: 'GET',
				dataType: 'json'
			}).done(function(response) {
				// Get the class prefix
				var classPrefix = 'fa ' + response.preferences.fontPref.prefix,
					icomoon_json_icons = [],
					icomoon_json_search = [];
				// For each icon
				$.each(response.icons, function(i, v) {
					// Set the source
					icomoon_json_icons.push(classPrefix + v.properties.name.split(',')[0]);
					// Create and set the search source
					if (v.icon && v.icon.tags && v.icon.tags.length) {
						icomoon_json_search.push(v.properties.name + ' ' + v.icon.tags.join(' '));
					} else {
						icomoon_json_search.push(v.properties.name);
					}
				});
				// Set new fonts on fontIconPicker
				icons.setIcons(icomoon_json_icons, icomoon_json_search);
			});
		}
		$('.button_icon_container').focus(function() {
			$(this).loadIcons();
		});
		// detect mousedown and store all checked radio buttons
		$('.hndle').on('mousedown', function() {
			// get parent element of .hndle selected.
			// We only need to monitor radios insde the object that is being moved.
			var parent_id = $(this).closest('div').attr('id')
				// set live event listener for mouse up on the content .wrap
				// then give the dragged div time to settle before firing the reclick function
			$('.wrap').on('mouseup', function() {
				var ot_checked_radios = {}
					// loop over all checked radio buttons inside of parent element
				$('#' + parent_id + ' input[type="radio"]').each(function() {
						// stores checked radio buttons
						if ($(this).is(':checked')) {
							ot_checked_radios[$(this).attr('name')] = $(this).val()
						}
						// write to the object
						$(document).data('ot_checked_radios', ot_checked_radios)
					})
					// restore all checked radio buttons
				setTimeout(function() {
					// get object of checked radio button names and values
					var checked = $(document).data('ot_checked_radios')
						// step thru each object element and trigger a click on it's corresponding radio button
					for (key in checked) {
						$('input[name="' + key + '"]').filter('[value="' + checked[key] + '"]').trigger('click')
					}
					$('.wrap').unbind('mouseup')
				}, 50)
			})
		});
		$.each($('.section-title-wrap'), function() {
			$(this).addClass('closed');
			var newWrap = $(this).nextUntil('.section-title-wrap').wrapAll('<div class="hidden" />');
			var innerWrap = new Array();
			$.each(newWrap, function(index, el) {
				if ($(el).hasClass('break-master-wrap')) innerWrap.push(el);
			});
			$(innerWrap).wrapAll('<div class="overridable-wrap"><div class="overridable-inner"></div></div>');
			$(this).on('click', function() {
				$(this).toggleClass('closed');
				$(this).next().slideToggle();
			});
		});
	})
}(window.jQuery);