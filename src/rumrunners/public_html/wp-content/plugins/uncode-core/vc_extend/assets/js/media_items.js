(function($) {
	var InitGalleries = function() {
		// TODO: Backbone style for view binding
		$('.uncode_widget_attached_images_list').unbind('click.removeImage').on('click.removeImage', 'a.icon-remove', function(e) {
			e.preventDefault();
			var $block = $(this).closest('.edit_form_line');
			$(this).parent().remove();
			var img_ids = [];
			$block.find('.thumbnail').each(function() {
				var $value = $(this).attr("rel");
				if ($value != undefined && $value != '') img_ids.push($value);
			});
			$block.find('.uncode_gallery_attached_images_ids').val(img_ids.join(',')).trigger('change');
		});
		$('.uncode_widget_attached_images_list').each(function(index) {
			var $img_ul = $(this);
			$img_ul.sortable({
				forcePlaceholderSize: true,
				placeholder: "widgets-placeholder-gallery",
				cursor: "move",
				items: "li",
				update: function() {
					var img_ids = [];
					$(this).find('.thumbnail').each(function() {
						img_ids.push($(this).attr("rel"));
					});
					$img_ul.closest('.edit_form_line').find('.uncode' + '' + '_gallery_attached_images_ids').val(img_ids.join(',')).trigger('change');
				}
			});
		});
		$('#uncode_gallery_div').unbind('click.removeAll').on('click.removeAll', 'a.btn-remove-all', function(e) {
			e.preventDefault();
			var $block = $(this).closest('.edit_form_line');
			$block.find('.uncode_widget_attached_images_list').html('');
			$block.find('.uncode_gallery_attached_images_ids').val('').trigger('change');
			$(this).hide();
		});
		$.each($(".oembed:not(.rendered)"), function(index, val) {
			$(this).get_oembed(null, true);
		});
	};
	setTimeout(function() {
		new InitGalleries();
	}, 1000);
})(window.jQuery);