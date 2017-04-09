!function($) {
	"use strict";
	window.fixallInputs = function() {
		$('.wpb_el_type_checkbox:not(.checkbox_converted)').each(function(index) {
			var $checkboxCont = $(this),
				$checkbox = $(this).find('input'),
				vals = new Array();
			$(this).addClass('checkbox_converted');
			if ($checkbox.length == 1) {
				$checkboxCont.addClass('uncode-checkbox');
				$checkbox.wrap('<div class="on-off-switch" />');
				if ($checkbox.hasClass('row_height_use_pixel') || $checkbox.hasClass('media_width_use_pixel') || $checkbox.hasClass('column_width_use_pixel')) {
					vals[0] = 'px';
					vals[1] = '%';
				} else if ($checkbox.hasClass('unlock_row')) {
					vals[0] = 'Full';
					vals[1] = 'Limit';
				} else if ($checkbox.hasClass('unlock_row_content')) {
					vals[0] = 'Full';
					vals[1] = 'Limit';
				} else if ($checkbox.hasClass('desktop_visibility') || $checkbox.hasClass('medium_visibility') || $checkbox.hasClass('mobile_visibility')) {
					vals[0] = 'Hidden';
					vals[1] = 'Visible';
				} else {
					vals[0] = 'Yes';
					vals[1] = 'No';
				}
				$checkbox.on('change', function() {
					if ($(this).is(':checked')) $(this).attr('checked', true);
					else $(this).removeAttr('checked');
				});
				$('<span class="slide-button"></span><label class="on-off-switch-label"><span class="on-off-switch-inner">' + vals[0] + '</span><span class="on-off-switch-inner">' + vals[1] + '</span></label>').insertAfter($checkbox);
			}
		});
		$('.wpb_el_type_dropdown select').each(function(index) {
			var $select = $(this),
				$wrapper = $select.closest('.select-wrapper').addClass('select-uncode-colors');
			if ($(this).is('[name$=_color]')) {
				$(this).easyDropDown({
					cutOff: 10,
				});
			} else $select.wrap('<div class="select-wrapper" />');
		});

		window.initAllSliders();

		function sanitizeSlug(element) {
			var el = $(element),
			elValue = el.val(),
			elParent = el.closest('.wpb_el_type_textfield'),
			elLabel = elParent.find('.wpb_element_label'),
			elLabelSpan = elLabel.find('.section-slug');
			if (elValue != '') {
				elValue = elValue.toLowerCase().replace(/ /g, "-");
				if (!elLabelSpan.length) elLabel.append(' - <span>Slug:</span><span class="section-slug">#'+elValue+'</span>');
				else {
					elLabelSpan.html('#'+elValue);
				}
			}
		}
		$('input[name="row_name"]').each(function(index, value) {
			sanitizeSlug(value);
			$(value).on('change input paste', function(e) {
				sanitizeSlug(e.target);
			});
		});
	}

	window.initAllSliders = function() {
		var sliders = $(".vc_ui-panel-content-container .ot-numeric-slider");
		sliders.each(function(i) {
			var slider = $(sliders[i]);
			slider.empty().slider({
				value: (slider.attr("data-value") != '') ? parseInt(slider.attr("data-value")) : 0,
				range: "min",
				step: parseInt(slider.attr("data-step")),
				min: parseInt(slider.attr("data-min")),
				max: parseInt(slider.attr("data-max")),
				slide: function(event, ui) {
					window.fixallInputs.refreshValue(ui.value, $(this))
				},
				stop: function(event, ui) {
					window.fixallInputs.refreshValue(ui.value, $(this))
				},
				change: function(event, ui) {
					window.fixallInputs.refreshValue(ui.value, $(this))
				},
				create: function(event, ui) {
					window.fixallInputs.refreshValue($(this).attr("data-value"), $(this))
				}
			});
		});
	};

	window.fixallInputs.refreshValue = function($value, $el) {
		var $input = $el.closest(".ot-numeric-slider-wrap").find("input"),
			$marker = $el.closest(".vc_shortcode-param").find(".numeric-slider-helper-input");
		$input.val($value);
		if ($value == 0) {
			if ($input.hasClass("row_height_percent") || $input.hasClass("row_inner_height_percent") || $input.hasClass("row_width")) {
				$marker.html("Auto");
			} else if ($input.hasClass("gutter_size")) {
				$marker.html("0");
			} else if ($input.hasClass("empty_h")) {
				$marker.html('0.25x');
			} else $marker.html($value);
		} else if ($value == parseInt($el.attr("data-max"))) {
			if ($input.hasClass("medium_width")) {
				$marker.html('12/12');
			} else if ($input.hasClass("row_height_percent") || $input.hasClass("row_width")) {
				$marker.html("Full");
			} else if ($input.hasClass("gutter_size")) {
				if ($value == 6) $marker.html('4x');
				else $marker.html("2x");
			} else if ($input.hasClass("top_padding") || $input.hasClass("bottom_padding") || $input.hasClass("h_padding") || $input.hasClass("shift_x") || $input.hasClass("shift_y") || $input.hasClass("zoom_width") || $input.hasClass("zoom_height")) {
				$marker.html('6x');
			} else if ($input.hasClass("column_padding") || $input.hasClass("single_padding") || $input.hasClass("media_padding") || $input.hasClass("empty_h")) {
				$marker.html('4x');
			} else $marker.html($value);
		} else {
			if ($input.hasClass("medium_width")) {
				switch (parseInt($value)) {
					case 1:
						$marker.html('2/12');
						break;
					case 2:
						$marker.html('3/12');
						break;
					case 3:
						$marker.html('4/12');
						break;
					case 4:
						$marker.html('6/12');
						break;
					case 5:
						$marker.html('8/12');
						break;
					case 6:
						$marker.html('9/12');
						break;
				}
			} else if ($input.hasClass("gutter_size")) {
				switch (parseInt($value)) {
					case 1:
					case 50:
						$marker.html('1px');
						break;
					case 2:
						$marker.html('0.5x');
						break;
					case 3:
						$marker.html('1x');
						break;
					case 4:
						$marker.html('2x');
						break;
					case 5:
						$marker.html('3x');
						break;
					case 6:
						$marker.html('3x');
						break;
					case 7:
						$marker.html('3x');
						break;
				}
			} else if ($input.hasClass("empty_h") || $input.hasClass("single_padding") || $input.hasClass("media_padding") || $input.hasClass("shift_x") || $input.hasClass("shift_y") || $input.hasClass("zoom_width") || $input.hasClass("zoom_height")) {
				switch (parseInt($value)) {
					case 1:
						$marker.html('0.5x');
						break;
					case 2:
						$marker.html('1x');
						break;
					case 3:
						$marker.html('2x');
						break;
					case 4:
						$marker.html('3x');
						break;
					case -1:
						$marker.html('-0.5x');
						break;
					case -2:
						$marker.html('-1x');
						break;
					case -3:
						$marker.html('-2x');
						break;
					case -4:
						$marker.html('-3x');
						break;
					case -5:
						$marker.html('-4x');
						break;
				}
			} else if ($input.hasClass("top_padding") || $input.hasClass("bottom_padding") || $input.hasClass("column_padding") || $input.hasClass("h_padding")) {
				switch (parseInt($value)) {
					case 1:
						$marker.html('1px');
						break;
					case 2:
						$marker.html('1x');
						break;
					case 3:
						$marker.html('2x');
						break;
					case 4:
						$marker.html('3x');
						break;
					case 5:
						$marker.html('4x');
						break;
					case 6:
						$marker.html('5x');
						break;
				}
			} else $marker.html($value);
		}
	}
}(window.jQuery);