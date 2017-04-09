(function($){
	"use strict";

	function get_cart() {
		$.post({
			url: wc_add_to_cart_params.ajax_url,
			dataType: 'JSON',
			data: {action: 'woomenucart_ajax'},
			success: function(data, textStatus, XMLHttpRequest) {
				$('.uncode-cart-dropdown').html(data.cart);
				if (data != '') {
					if ($('.uncode-cart .badge, .mobile-shopping-cart .badge').length) {
						if (data.articles > 0) {
							$('.uncode-cart .badge, .mobile-shopping-cart .badge').html(data.articles);
							$('.uncode-cart .badge, .mobile-shopping-cart .badge').show();
						} else {
							$('.uncode-cart .badge, .mobile-shopping-cart .badge').hide();
						}
					} else $('.uncode-cart .cart-icon-container').append('<span class="badge">'+data.articles+'</span>'); //$('.uncode-cart .badge').html(data.articles);
				}
			}
		});
	}

	function change_images(event, variation) {
		if (variation.image_link !== '') {
			var get_href = $('a[href="'+variation.image_link+'"'),
			image_variable = $('img', get_href),
			getLightbox = UNCODE.lightboxArray[get_href.data('lbox')];
			get_href.data('options',"thumbnail: '"+variation.image_src+"'");
			if (image_variable.hasClass('async-done')) {
				image_variable.removeClass('async-done').addClass('adaptive-async');
				UNCODE.adaptive();
			}
			if (getLightbox != undefined) getLightbox.refresh();
		}
	}

	$(document).ready(function() {
		$('body').bind("added_to_cart", get_cart);
		$('body').bind("wc_fragments_refreshed", get_cart);
		$('.variations_form').bind("show_variation", change_images);
	});

})(jQuery);