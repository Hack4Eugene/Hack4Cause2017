jQuery(document).ready(function($) {
	window.UncodeRowView = window.VcRowView.extend({
		buildDesignHelpers: function() {
			var color = this.model.getParam('back_color'),
				image = this.model.getParam('back_image'),
				$column_edit = this.$el.find('> .controls .column_edit'),
				$image, $color = '';
			this.$el.find('> .controls .vc_row_color').remove();
			this.$el.find('> .controls .vc_row_image').remove();
			if (color) {
				$color = $('<span class="vc_row_color style-' + color + '-bg"></span>');
				$color.insertAfter($column_edit);
			}
			if (image) {
				$.ajax({
					type: 'POST',
					url: window.ajaxurl,
					data: {
						action: 'uncode_get_media_post',
						content: image
					},
					dataType: 'JSON'
				}).done(function(data) {
					if ($color == '') {
						$color = $('<span class="vc_row_color"></span>');
						$color.insertAfter($column_edit);
					}
					if (data.back_url != '') $color.addClass('image_viewer').html($('<span class="vc_row_image" style="' + data.back_url + '"></span>'));
					if (data.back_icon != '') $color.html($('<span class="vc_row_image" title="' + (data.back_mime).replace("oembed/", "") + '">' + data.back_icon + '</span>'));
				});
			}
		},
		ready: function(e) {
			window.UncodeRowView.__super__.ready.call(this, e);
			if (this.$content.closest('.wpb_uncode_slider').length) {
				var row_inner = this.$content.closest('.wpb_vc_row_inner.wpb_sortable');
				row_inner.prepend("<h3>Slide</h3>");
			}
			return this;
		},
	});
	window.UncodeColumnView = window.VcColumnView.extend({
		buildDesignHelpers: function() {
			var color = this.model.getParam('back_color'),
				image = this.model.getParam('back_image'),
				$column_add = this.$el.find('> .bottom-controls .column_add'),
				$column_edit = this.$el.find('> .vc_controls .column_edit'),
				$column_delete = this.$el.find('> .vc_controls .column_delete'),
				$image, $color = '';
			$column_edit.insertAfter($column_add);
			$column_delete.insertAfter($column_edit);
			this.$el.find('> .bottom-controls .vc_column_color').remove();
			this.$el.find('> .bottom-controls .vc_column_image').remove();
			if (color) {
				$color = $('<span class="vc_control vc_column_color style-' + color + '-bg"></span>');
				$color.insertAfter($column_delete);
			}
			if (image) {
				$.ajax({
					type: 'POST',
					url: window.ajaxurl,
					data: {
						action: 'uncode_get_media_post',
						content: image
					},
					dataType: 'JSON'
				}).done(function(data) {
					if ($color == '') {
						$color = $('<span class="vc_control vc_column_color"></span>');
						$color.insertAfter($column_delete);
					}
					if (data.back_url != '') $color.addClass('image_viewer').html($('<span class="vc_column_image" style="' + data.back_url + '"></span>'));
					if (data.back_icon != '' && data.back_mime != undefined) $color.html($('<span class="vc_column_image" title="' + (data.back_mime).replace("oembed/", "") + '">' + data.back_icon + '</span>'));
				});
			}
		},
	});
	window.UncodeTextView = vc.shortcode_view.extend({
		changeShortcodeParams: function(model) {
			var params = model.get('params');
			value = params['content'];
			$.ajax({
				type: 'POST',
				url: window.ajaxurl,
				data: {
					action: 'uncode_get_html',
					content: value
				},
				dataType: 'html',
				context: this
			}).done(function(html) {
				this.$el.find('.textarea_html').html(html);
			});
			window.UncodeTextView.__super__.changeShortcodeParams.call(this, model);
		}
	});
	window.UncodeAccordionView = window.VcAccordionView.extend({
		render: function() {
			window.UncodeAccordionView.__super__.render.call(this);
			this.$content.sortable({
				axis: "y",
				handle: "h3",
				stop: function(event, ui) {
					// IE doesn't register the blur when sorting
					// so trigger focusout handlers to remove .ui-state-focus
					ui.item.prev().triggerHandler("focusout");
					$(this).find('> .wpb_sortable').each(function() {
						var shortcode = $(this).data('model');
						shortcode.save({
							'order': $(this).index()
						}); // Optimize
					});
				}
			});
			return this;
		},
		addTab: function(e) {
			this.adding_new_tab = true;
			e.preventDefault();
			var row = vc.shortcodes.create({
				shortcode: 'vc_row_inner',
				parent_id: this.model.id
			});
			vc.shortcodes.create({
				shortcode: 'vc_column_inner',
				params: {
					width: '1/1'
				},
				parent_id: row.id
			});
		},
	});
	window.UncodeBlockView = vc.shortcode_view.extend({
		changeShortcodeParams: function ( model ) {
			window.UncodeBlockView.__super__.changeShortcodeParams.call( this, model );
			var wrap = this.$el.closest('.wpb_element_wrapper'),
				container = this.$el.find('.wpb_element_wrapper');
				row = this.$el.closest('.wpb_vc_row');
			if (this.model.getParam('inside_column') != 'yes') {
				wrap.css('padding','0');
				container.css('backgroundColor','#F1FDFF');
				row.find('.vc_row_layouts').hide();
				row.find('.vc_column-edit').hide();
				row.find('.vc_control-column').hide();
			} else {
				wrap.removeAttr('style');
				container.removeAttr('style');
				row.find('.vc_row_layouts').show();
				row.find('.vc_column-edit').show();
				row.find('.vc_control-column').show();
			}
		}
	});
});