(function($) {
	var media = wp.media,
		Attachment = media.model.Attachment,
		Attachments = media.model.Attachments,
		Query = media.model.Query,
		l10n = i18nLocaleUncode,
		addButton,
		workflows = {};
	var names = new Array('Images', 'Audio', 'Video', 'Vimeo', 'Youtube', 'Soundcloud', 'Spotify', 'Facebook', 'Twitter', 'Flickr', 'Instagram', 'SVG', 'HTML', 'iFrame');
	var slugs = new Array('image', 'audio', 'video', 'oembed/vimeo', 'oembed/youtube', 'oembed/soundcloud', 'oembed/spotify', 'oembed/facebook', 'oembed/twitter', 'oembed/flickr', 'oembed/instagram', 'oembed/svg', 'oembed/html', 'oembed/iframe');
	var tagFilter = media.view.AttachmentFilters.extend({
		createFilters: function() {
			var filters = {};
			// default "all" filter, shows all tags
			filters.all = {
				text: l10n.all_medias,
				props: {
					// unset tag
					tag: null,
					type: null,
					uploadedTo: null,
					orderby: 'date',
					order: 'DESC'
				},
				priority: 10
			};
			// create a filter for each tag
			var i;
			for (i = 0; i < names.length; i++) {
				filters[slugs[i]] = {
					// tag name
					text: names[i],
					props: {
						// tag slug
						tag: null,
						type: slugs[i],
						uploadedTo: null,
						orderby: 'date',
						order: 'DESC'
					},
					priority: 20 + i
				};
			}
			this.filters = filters;
		}
	});
	// backup the method
	var orig = media.view.AttachmentsBrowser;
	media.view.AttachmentsBrowser = media.view.AttachmentsBrowser.extend({
		createToolbar: function() {
			// call the original method
			orig.prototype.createToolbar.apply(this, arguments);
			// add our custom filter
			this.toolbar.set('tags', new tagFilter({
				controller: this.controller,
				model: this.collection.props,
				// controls the position, left align if < 0, right align otherwise
				priority: -80
			}).render());
		}
	});
	// ---------------------------------
	media.controller.uncodeSingleMedia = media.controller.FeaturedImage.extend({
		defaults: _.defaults({
			id: 'uncode_single-media',
			filterable: 'uploaded',
			library: media.query(),
			multiple: false,
			toolbar: 'uncode_single-media',
			title: l10n.select_media,
			priority: 60,
			syncSelection: false
		}, media.controller.Library.prototype.defaults),
		updateSelection: function() {
			var selection = this.get('selection'),
				id = media.uncodeSingleMedia.getData(),
				attachment;
			if ('' !== id && -1 !== id) {
				attachment = Attachment.get(id);
				attachment.fetch();
			}
			selection.reset(attachment ? [attachment] : []);
		},
	});
	media.controller.uncodeMedia = media.controller.uncodeSingleMedia.extend({
		defaults: _.defaults({
			id: 'uncode_media',
			title: l10n.select_medias,
			toolbar: 'main-insert',
			filterable: 'uploaded',
			library: media.query(),
			multiple: 'add',
			editable: true,
			priority: 60,
			syncSelection: false
		}, media.controller.Library.prototype.defaults),
		updateSelection: function() {
			var selection = this.get('selection'),
				ids = media.uncode_editor.getData(),
				attachments;
			if ('' !== ids && -1 !== ids) {
				attachments = _.map(ids.split(/,/), function(id) {
					var attachment = Attachment.get(id);
					attachment.fetch();
					return attachment;
				});
			}
			selection.reset(attachments);
		},
	});
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
				$spinner.removeClass('visible').css('visibility', 'hidden');
			}
		},
		entercode: function(event) {
			var _this = this,
				$el = $(this.$el),
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
				$spinner.addClass('visible').css('visibility', 'visible');
			}, 100);
		},
		recordmedia: function() {
			media.uncode_editor.recordmedia();
		},
		ready: function() {},
	});
	media.uncodeSingleMedia = {
		getData: function() {
			return this.$hidden_ids.val();
		},
		set: function(selection) {
			var template = _.template($('#uncode_settings-media-block').html());
			var result = template(selection.attributes);
			this.$img_ul.html(result);
			this.$clear_button.show();
			this.$hidden_ids.val(selection.get('id')).trigger('change');
			return false;
		},
		uploadMedia: function() {
			this._frame.content.set(new media.view.uploadMediaView({
				controller: this
			}));
		},
		browseRouter: function(routerView) {
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
		},
		frame: function(element) {
			this.element = element;
			this.$button = $(this.element);
			this.$block = this.$button.closest('.edit_form_line');
			this.$hidden_ids = this.$block.find('.uncode_gallery_attached_images_ids');
			this.$img_ul = this.$block.find('.uncode_widget_attached_images_list');
			this.$clear_button = this.$img_ul.next();
			// TODO: Refactor this all params as template
			if (this._frame) return this._frame;
			this._frame = wp.media({
				state: 'uncode_single-media',
				states: [new wp.media.controller.uncodeSingleMedia()]
			});
			this._frame.on('router:render:browse', this.browseRouter, this);
			this._frame.on('content:render:uncode', this.uploadMedia, this);
			this._frame.on('toolbar:create:uncode_single-media', function(toolbar) {
				this.createSelectToolbar(toolbar, {
					text: l10n.add_media
				});
			}, this._frame);
			this._frame.on('toolbar:render:uncode_single-media', this.mainInsertToolbar, this);
			this._frame.state('uncode_single-media').on('select', this.select);
			return this._frame;
		},
		// Changing main button title
		mainInsertToolbar: function(view) {
			var $that = this;
			view.set('select', {
				style: 'primary',
				priority: 80,
				text: l10n.add_media,
				requires: {
					selection: false
				},
				click: function() {
					if (media.frame.content.get().el.className == 'uploader-uncode-media') {
						media.uncode_editor.recordmedia();
					} else {
						$that.select();
					}
				}
			});
		},
		select: function() {
			var selection = media.frame.toolbar.get('selection').selection.single();
			media.uncodeSingleMedia.set(selection ? selection : -1);
			media.frame.close();
		}
	};
	media.view.MediaFrame.uncodeMedia = media.view.MediaFrame.Post.extend({
		// Define insert-vc state.
		createStates: function() {
			var options = this.options;
			// Add the default states.
			this.states.add([
				// Main states.
				new media.controller.uncodeMedia(),
			]);
		},
		// Removing let menu from manager
		bindHandlers: function() {
			media.view.MediaFrame.Select.prototype.bindHandlers.apply(this, arguments);
			this.on('toolbar:create:main-insert', this.createToolbar, this);
			var handlers = {
				content: {
					'embed': 'embedContent',
					'edit-selection': 'editSelectionContent',
					'uncode': 'uploadMedia'
				},
				toolbar: {
					'main-insert': 'mainInsertToolbar'
				},
			};
			_.each(handlers, function(regionHandlers, region) {
				_.each(regionHandlers, function(callback, handler) {
					this.on(region + ':render:' + handler, this[callback], this);
				}, this);
			}, this);
		},
		browseRouter: function(routerView) {
			routerView.set({
				upload: {
					text: 'Upload Files',
					priority: 20,
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
		},
		uploadMedia: function() {
			this.content.set(new media.view.uploadMediaView({
				controller: this
			}));
		},
		// Changing main button title
		mainInsertToolbar: function(view) {
			var controller = this;
			this.selectionStatusToolbar(view);
			view.set('insert', {
				style: 'primary',
				priority: 80,
				text: l10n.add_medias,
				requires: {
					selection: false
				},
				click: function() {
					if (workflow.content.get().el.className == 'uploader-uncode-media') {
						media.uncode_editor.recordmedia();
					} else {
						var state = controller.state(),
							selection = state.get('selection');
						if (selection.length > 0) {
							controller.close();
							state.trigger('insert', selection).reset();
						}
					}
				}
			});
		}
	});
	media.uncode_editor = _.clone(media.editor);
	_.extend(media.uncode_editor, {
		$uncode_editor_element: null,
		getData: function() {
			var $button = media.uncode_editor.$uncode_editor_element,
				$block = $button.closest('.edit_form_line'),
				$hidden_ids = $block.find('.uncode_gallery_attached_images_ids');
			return $hidden_ids.val();
		},
		insert: function(images) {
			var $button = media.uncode_editor.$uncode_editor_element,
				$block = $button.closest('.edit_form_line'),
				$hidden_ids = $block.find('.uncode_gallery_attached_images_ids'),
				$img_ul = $block.find('.uncode_widget_attached_images_list'),
				$clear_button = $img_ul.next(),
				$thumbnails_string = '';
			_.each(images, function(image) {
				try {
					image.url = image.sizes.thumbnail.url;
				} catch (e) {}
				var template = _.template($('#uncode_settings-media-block').html());
				var result = template(image);
				$thumbnails_string += result;
			});
			$hidden_ids.val(_.map(images, function(image) {
				return image.id;
			}).join(',')).trigger('change');
			$img_ul.html($thumbnails_string);
			if ($thumbnails_string != '') $('#uncode_gallery_div a.btn-remove-all').show();
		},
		open: function(id) {
			//var workflow, editor;
			id = this.id(id);
			workflow = this.get(id);
			// Initialize the editor's workflow if we haven't yet.
			if (!workflow) workflow = this.add(id);
			return workflow.open();
		},
		add: function(id, options) {
			var workflow = this.get(id);
			if (workflow) return workflow;
			workflow = workflows[id] = new media.view.MediaFrame.uncodeMedia(_.defaults(options || {}, {
				state: 'uncode_media',
				title: l10n.add_media,
				library: {
					type: 'image'
				},
				multiple: true
			}));
			workflow.on('insert', function(selection) {
				var state = workflow.state(),
					data = [];
				selection = selection || state.get('selection');
				if (!selection) return;
				this.insert(_.map(selection.models, function(model) {
					return model.attributes;
				}));
			}, this);
			return workflow;
		},
		init: function() {
			$('body').unbind('click.uncodeMediaWidget').on('click.uncodeMediaWidget', '.add_media_widget', function(event) {
				event.preventDefault();
				var $this = addButton = $(this),
					editor = 'uncode_editor';
				wp.media.uncode_editor.$uncode_editor_element = $(this);
				if ($this.attr('use-single') === 'true') {
					wp.media.uncodeSingleMedia.frame(this).open(editor);
					return;
				}
				$this.blur();
				wp.media.uncode_editor.open(editor);
			});
		},
		get: function(id) {
			return workflows[id];
		},
		recordmedia: function() {
			var $that = window['workflow'] || media.frame,
				$el = $that.$el,
				$button = $button = $el.find('.media-button');
			$.ajax({
				type: 'POST',
				dataType: "json",
				url: ajaxurl + '?action=recordMedia',
				data: $el.find('input[name],select[name],textarea[name]').serialize(),
				success: function(data) {
					if (!isNaN(data.id) && data != undefined) {
						var $controller = $that.controller,
							$addButton = media.uncode_editor.$uncode_editor_element,
							$block = $addButton.closest('.edit_form_line'),
							$img_ul = $block.find('.uncode_widget_attached_images_list'),
							$hidden_ids = $block.find('.uncode_gallery_attached_images_ids'),
							thumbnails_string = '',
							attachment,
							$ids = new Array();
						$button.removeAttr('disabled');
						if ($addButton.attr('use-single') === 'true') {
							$ids.push(data.id);
						} else {
							$ids = String($hidden_ids.val()).split(',');
							$ids.push(data.id);
						}

						$ids = $.grep($ids,function(n){ return(n); });

						if (data.mime == 'oembed/svg') data.description = data.url;
						var template = _.template($('#uncode_settings-media-block').html());
						var result = template(data);
						$thumbnails_string = result;

						$hidden_ids.val($ids.join()).trigger('change');
						if ($addButton.attr('use-single') === 'true') $img_ul.html($thumbnails_string);
						else $img_ul.append($thumbnails_string);
						attachment = Attachment.get(data.id);
						attachment.fetch();
						attachment.attributes.id = data.id;
						attachment.attributes.type = data.type;
						attachment.attributes.url = data.url;
						attachment.attributes.mime = data.mime;
						$('.media-frame .media-menu-item').trigger('click');
						$that.off('select');
						$that.close();
					}
				}
			});
		}
	});
	_.bindAll(media.uncode_editor, 'open');
	$(document).ready(function() {
		media.uncode_editor.init();
	});
}(jQuery));