! function($) {
	"use strict";
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
	/*  Base64 class: Base 64 encoding / decoding (c) Chris Veness 2002-2011                          */
	/*    note: depends on Utf8 class                                                                 */
	/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
	var Base64 = {}; // Base64 namespace
	Base64.code = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	/**
	 * Encode string into Base64, as defined by RFC 4648 [http://tools.ietf.org/html/rfc4648]
	 * (instance method extending String object). As per RFC 4648, no newlines are added.
	 *
	 * @param {String} str The string to be encoded as base-64
	 * @param {Boolean} [utf8encode=false] Flag to indicate whether str is Unicode string to be encoded
	 *   to UTF8 before conversion to base64; otherwise string is assumed to be 8-bit characters
	 * @returns {String} Base64-encoded string
	 */
	Base64.encode = function(str, utf8encode) { // http://tools.ietf.org/html/rfc4648
			utf8encode = (typeof utf8encode == 'undefined') ? false : utf8encode;
			var o1, o2, o3, bits, h1, h2, h3, h4, e = [],
				pad = '',
				c, plain, coded;
			var b64 = Base64.code;
			plain = utf8encode ? Utf8.encode(str) : str;
			c = plain.length % 3; // pad string to length of multiple of 3
			if (c > 0) {
				while (c++ < 3) {
					pad += '=';
					plain += '\0';
				}
			}
			// note: doing padding here saves us doing special-case packing for trailing 1 or 2 chars
			for (c = 0; c < plain.length; c += 3) { // pack three octets into four hexets
				o1 = plain.charCodeAt(c);
				o2 = plain.charCodeAt(c + 1);
				o3 = plain.charCodeAt(c + 2);
				bits = o1 << 16 | o2 << 8 | o3;
				h1 = bits >> 18 & 0x3f;
				h2 = bits >> 12 & 0x3f;
				h3 = bits >> 6 & 0x3f;
				h4 = bits & 0x3f;
				// use hextets to index into code string
				e[c / 3] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
			}
			coded = e.join(''); // join() is far faster than repeated string concatenation in IE
			// replace 'A's from padded nulls with '='s
			coded = coded.slice(0, coded.length - pad.length) + pad;
			return coded;
		}
		/**
		 * Decode string from Base64, as defined by RFC 4648 [http://tools.ietf.org/html/rfc4648]
		 * (instance method extending String object). As per RFC 4648, newlines are not catered for.
		 *
		 * @param {String} str The string to be decoded from base-64
		 * @param {Boolean} [utf8decode=false] Flag to indicate whether str is Unicode string to be decoded
		 *   from UTF8 after conversion from base64
		 * @returns {String} decoded string
		 */
	Base64.decode = function(str, utf8decode) {
			utf8decode = (typeof utf8decode == 'undefined') ? false : utf8decode;
			var o1, o2, o3, h1, h2, h3, h4, bits, d = [],
				plain, coded;
			var b64 = Base64.code;
			coded = utf8decode ? Utf8.decode(str) : str;
			for (var c = 0; c < coded.length; c += 4) { // unpack four hexets into three octets
				h1 = b64.indexOf(coded.charAt(c));
				h2 = b64.indexOf(coded.charAt(c + 1));
				h3 = b64.indexOf(coded.charAt(c + 2));
				h4 = b64.indexOf(coded.charAt(c + 3));
				bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
				o1 = bits >>> 16 & 0xff;
				o2 = bits >>> 8 & 0xff;
				o3 = bits & 0xff;
				d[c / 4] = String.fromCharCode(o1, o2, o3);
				// check for padding
				if (h4 == 0x40) d[c / 4] = String.fromCharCode(o1, o2);
				if (h3 == 0x40) d[c / 4] = String.fromCharCode(o1);
			}
			plain = d.join(''); // join() is far faster than repeated string concatenation in IE
			return utf8decode ? Utf8.decode(plain) : plain;
		}
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
	window.itemIndex = function() {
		var $checkIfLoop = $('.wpb_el_type_loop .loop_field').length,
			$checkIfGallery = $('.uncode_gallery').length;
		if ($checkIfLoop == 0) {
			if ($checkIfGallery == 0) return;
		}
		if ($checkIfGallery == 0) {
			if ($checkIfLoop == 0) return;
		}
		/** fix el id field */
		var elId = $('input[name="el_id"]').val();
		if (elId == '') {
			elId = Math.floor(Math.random() * 90000) + 10000;
			if ($checkIfGallery == 1) $('input[name="el_id"]').val('gallery-' + elId);
			else $('input[name="el_id"]').val('index-' + elId);
		} else {
			if (elId.match(/^\d+$/)) {
				if ($checkIfGallery == 1) $('input[name="el_id"]').val('gallery-' + elId);
				else $('input[name="el_id"]').val('index-' + elId);
			}
		}
		/** fix sliders */

		/**
		 * Index specific
		 */
		if ($checkIfLoop == 1) {
			var $mainLoop = $('.wpb_el_type_loop .loop_field').val().split('|'),
				$typeFound = false;
			for (var $loop in $mainLoop) {
				if ($mainLoop[$loop].indexOf('post_type:') != -1) $typeFound = $mainLoop[$loop];
			}

			if ($typeFound) {
				var $typeFound = $typeFound.replace('post_type:', '');
				showHideSection($typeFound.split(','));
			} else showHideSection(new Array('post'));

			$('.vc_loop-build').bind('click', function() {
				setTimeout(function() {
					$.each($('.loop_params_holder select'), function(index, val) {
						if (!$(this).parent().hasClass('select-wrapper')) $(this).wrap('<div class="select-wrapper"></div>');
					});
				}, 2000);
			});
			setTimeout(function() {
				$.each($('.vc_sorted-list-container select'), function(index, val) {
					wrapSelect($(val));
					$(val).bind('change', function(event) {
						var el = event.currentTarget;
						setTimeout(function() {
							fixSortableListCallback($(el).closest('.vc_sorted-list').find('input.text_length'));
						}, 500);
					});
				});

				$(document).on('change', '.vc_sorted-list-container select', function() {
					wrapSelect($(this));
					$(this).bind('change', function(event) {
						var el = event.currentTarget;
						setTimeout(function() {
							fixSortableListCallback($(el).closest('.vc_sorted-list').find('input.text_length'));
						}, 500);
					});
				});
				$('#vc_edit-form-tab-1 .vc_sorted-list-checkbox input').bind('change', function() {
					setTimeout(function() {
						$.each($('.vc_sorted-list-container select'), function(index, val) {
							wrapSelect($(val));
						});
						$.each($('.vc_sorted-list-container .vc_control-text'), function(index, val) {
							fixSortableListEvents($(val));
						});
					}, 500);
				});
				$('#vc_edit-form-tab-1 .vc_sorted-list-container').on("sortupdate", function(event, ui) {
					setTimeout(function() {
						$.each($('.vc_control-text', event.currentTarget), function(index, val) {
							fixSortableListEvents($(val));
						});
					}, 500);
				});
				$.each($('#vc_edit-form-tab-1 .vc_control-text'), function(index, val) {
					fixSortableListEvents($(val));
				});
			}, 2000);
			$('#uncode_items_container').sortable({
				axis: "y"
			});
			$('#uncode_items_container').on("sortupdate", function(event, ui) {
				var $newIds = new Array(),
					$tab_block = $(this).closest('.vc_edit-form-tab');
				$.each($('li', $(this)), function(index, val) {
					if ($(val).attr('data-id') !== undefined) $newIds.push($(val).attr('data-id'));
				});
				$tab_block.find('.order_ids').val($newIds.join());
			});
			$(document).on('change', $('.loop_params_holder input[name="post_type"]'), function() {
				if ($('.loop_params_holder input[name="post_type"]').length) {
					var $types = $('.loop_params_holder input[name="post_type"]').val().split(',');
					showHideSection($types);
				}
			});
			/** update query when some changes are made **/
			$('li[data-tab-index="3"]').on('click', function(event) {
				load_item($('input.loop_field[name="loop"]').val());
			});
			$('li[data-tab-index="2"]').on('click', function(event) {
				$('#uncode_items_container').empty();
			});
		}
		/**
		 * Gallery specific
		 */
		if ($checkIfGallery == 1) {
			var $mainLoop = $('.uncode_gallery .uncode_gallery_attached_images_ids'),
				media = wp.media,
				Attachment = media.model.Attachment;
			$('li[data-tab-index="3"]').on('click', function(event) {
				load_media($mainLoop.val().split(','));
			});
			$('li[data-tab-index="2"]').on('click', function(event) {
				$('#uncode_items_container').empty();
			});
		}

		function fixSortableListEvents(el) {
			var $this = el,
				$list = $this.closest('.vc_sorted-list'),
				$listInput = $list.find('.sorted_list_field'),
				$inputVal = $listInput.val().split(','),
				$textLength = '',
				$textFound = false;
			for (var $index in $inputVal) {
				if ($inputVal[$index].indexOf('text|') != -1) {
					var $values = $inputVal[$index].split('|');
					for (var $i in $values) {
						if (/^\d+$/.test($values[$i])) {
							$textLength = $values[$i];
							$textFound = true;
						}
					}
				}
			}
			if ($list.find('input.text_length').length == 0) {
				if ($textFound) {
					$this.append('<div class="sorted-list-custom-text edit_form_line" style="margin-top: 5px;"><input type="text" class="wpb_vc_param_value text_length" name="text_length" value="' + $textLength + '" placeholder="Chars number…"></div>');
				} else {
					$this.append('<div class="sorted-list-custom-text edit_form_line" style="margin-top: 5px;"><input type="text" class="wpb_vc_param_value text_length" name="text_length" value="" placeholder="Chars number…"></div>');
				}
				$('input', $this).on('change input paste', function() {
					fixSortableListCallback(this);
				});
			} else {
				$.each($('input', $this), function(index, val) {
					fixSortableListCallback(val);
				});
			}
		}

		function fixSortableListCallback(el) {
			var $this = $(el),
				$list = $this.closest('.vc_sorted-list'),
				$listInput = $list.find('.sorted_list_field'),
				$textFound = false;
			if (/^\d+$/.test($this.val()))  {
				var $inputVal = $listInput.val().split(',');
				for (var $index in $inputVal) {
					if ($inputVal[$index].indexOf('text') != -1) {
						var $values = $inputVal[$index].split('|');
						for (var $i in $values) {
							if (/^\d+$/.test($values[$i])) {
								$inputVal[$index] = $inputVal[$index].replace($values[$i], $this.val());
								$textFound = true;
							}
						}
						if (!$textFound) $inputVal[$index] = $inputVal[$index] + '|' + $this.val();
						$inputVal[$index] = $inputVal[$index].replace(/\|$/, "");
					}
				}
				$listInput.val($inputVal.join(','));
			}
		}

		function wrapSelect($this) {
			if (!$this.parent().hasClass('select-wrapper')) $this.wrap('<div class="select-wrapper"></div>');
		}

		function showHideSection($types) {
				if ($types == '') $types = new Array('post');
				$.each($('#vc_edit-form-tab-1 .sorted_list_field'), function(index, val) {
					var $found = false;
					for (var $type in $types) {
						if ($(this).hasClass($types[$type] + '_items')) $found = true;
					}
					if (!$found) $(this).closest('.wpb_el_type_sorted_list').hide();
					else $(this).closest('.wpb_el_type_sorted_list').show();
				});
			}

		var dependent_elements,
			mapped_params,
			$container,
			$containerParent,
			$bundleInput,
			$templateSingle,
			$templateCatEl,
			$templatePostObj,
			$templateMedia,
			$allItems,
			$custom_order,
			$order_ids;

		function load_media($media) {
			$container = $('#uncode_items_container'),
				$containerParent = $container.parent(),
				$templateSingle = $('#vc_edit-form-tab-2').clone(),
				$templateCatEl = $('#vc_edit-form-tab-1 .wpb_el_type_sorted_list'),
				$templateMedia = $('<div />'),
				$bundleInput = $containerParent.find('.uncode_items');
			$('.spinner', $containerParent).css('visibility', 'visible').show();

			var $retrieveBundle;
			mapped_params = {};
			dependent_elements = {};
			/** prepare sort lit templates **/
			$.each($templateCatEl, function(index, val) {
				var $type = $(this).find('.sorted_list_field').attr('name');
				$type = $type.split('_');
				switch (String($type[0])) {
					case ('media'):
						$templateMedia.append($(this).clone());
						break;
				}
			});
			/** reset sort list **/
			$('.vc_sorted-list-container', $templateMedia).html('');
			/** load sort list **/
			$.ajax({
				type: 'POST',
				url: window.ajaxurl,
				data: {
					action: 'uncode_get_medias',
					content: $media,
					templateSingle: $templateSingle.html(),
					templateMedia: $templateMedia.html(),
				},
				dataType: 'html',
			}).done(function(html) {
				init_single_item_list(html);
			});
		}

		function load_item($query) {
			$container = $('#uncode_items_container'),
				$containerParent = $container.parent(),
				$bundleInput = $containerParent.find('.uncode_items'),
				$templateSingle = $('#vc_edit-form-tab-2').clone(),
				$templateCatEl = $('#vc_edit-form-tab-1 .wpb_el_type_sorted_list'),
				$templatePostObj = {},
				$allItems = (($('#pagination-yes')[0].checked || $('#infinite-yes')[0].checked) ? true : false),
				$custom_order = (($('#custom_order-yes')[0].checked) ? true : false),
				$order_ids = $container.closest('.vc_edit-form-tab').find('.order_ids').val();
			$($templateSingle).find('.vc-iconpicker, .vc-icons-selector').remove();
			$('.spinner', $containerParent).css('visibility', 'visible').show();
			$('button', $containerParent).attr('disabled');
			$('button', $containerParent).css('opacity', 0.5);
			/** prepare sort list templates **/
			$.each($templateCatEl, function(index, val) {
				var $type = $(this).find('.sorted_list_field').attr('name'),
				$templatePostType = $('<div />');
				$type = $type.split('_');
				var templateName = 'template' + $type[0].charAt(0).toUpperCase() + $type[0].slice(1);
				$templatePostObj[String(templateName)] = $templatePostType.append($(this).clone()).html();
				/** reset sort list **/
				$('.vc_sorted-list-container', $templatePostObj[String(templateName)]).html('');
			});
			$templatePostObj['action'] = 'uncode_get_query';
			$templatePostObj['content'] = $query;
			$templatePostObj['allItems'] = $allItems;
			$templatePostObj['templateSingle'] = $templateSingle.html();
			$templatePostObj['custom_order'] = $custom_order;
			$templatePostObj['order_ids'] = $order_ids;
			$templatePostObj['postid'] = $bundleInput.attr('data-post');
			/** load sort list **/
			$.ajax({
				type: 'POST',
				url: SiteParameters.admin_ajax,
				data: $templatePostObj,
				dataType: 'html',
			}).done(function(html) {
				init_single_item_list(html);
			});
		}

		function sorted_list_callback(list) {

			var value = _.map(list.find('[data-name]'), function(element) {
				var return_string = encodeURIComponent($(element).data('name'));
				$(element).find('select').each(function() {
					var $sub_control = $(this);
					if ($sub_control.is('select') && $sub_control.val() !== '') {
						return_string += '|' + encodeURIComponent($sub_control.val());
					}
				});
				return return_string;
			}).join(',');
			var getList = list.closest('.vc_sorted-list').find('.sorted_list_field');
			getList.val(value);
			getList.trigger('change');
		}

		function init_single_item_list(html) {
			var $retrieveBundle;
			mapped_params = {};
			dependent_elements = {};
			if (html == '') $container.html('<span class="vc_btn vc_btn-danger">Empty query</span>');
			else $container.html(html);
			$('.spinner', $containerParent).css('visibility', 'hidden').hide();
			$('button', $containerParent).removeAttr('disabled');
			$('button', $containerParent).css('opacity', 1);
			if ($bundleInput.val() != '') {
				$retrieveBundle = JSON.parse(Base64.decode($bundleInput.val()));
				for (var $index in $retrieveBundle) {
					var $item = $('li[data-id="' + parseInt($index) + '"]', $container);
					if ($item.length != 0) {
						$item.addClass('modified');
						$('.option-tree-setting-reset', $item).unbind('*').on('click', function() {
							$("body").addClass('wait');
							var $resetItem = $(this).closest('li'),
								$delIndex = $resetItem.attr('data-id');
							delete $retrieveBundle[$delIndex + '_i'];
							$('.wpb_el_type_uncode_items .uncode_items').val(Base64.encode(JSON.stringify($retrieveBundle)));
							$resetItem.removeClass('modified');
							$("body").removeClass('wait');
						});
						for (var $prop in $retrieveBundle[$index]) {
							var $itemProp = ($prop == 'single_layout') ? $item.find('.sorted_list_field') : $item.find('[name="' + $prop + '"]');
							if (!$itemProp.is('input[type="checkbox"]')) {
								if ($itemProp.hasClass('type_numeric_slider')) {
									var getSlider = $itemProp.closest('.ot-numeric-slider-wrap').find('.ot-numeric-slider');
									getSlider.attr('data-value', $retrieveBundle[$index][$prop]);
								} else {
									$itemProp.val($retrieveBundle[$index][$prop]);
								}
							}
							$itemProp.trigger('change');
							$('span.' + $prop + '_factor', $item).html($retrieveBundle[$index][$prop]);
						}
					}
				}
			} else $retrieveBundle = new Object();
			$('.vc_sorted-list').VcSortedList();
			$('.vc_sorted-list-container').on('sortupdate', function() {
				sorted_list_callback($(this));
			});
			/** fix sliders */
			window.initAllSliders();
			/** fix custom link */
			$.each($('#uncode_items_container .wpb_el_type_vc_link'), function(index, val) {
				var $input = $('input', val),
					$val = $input.val(),
					value_object = $input.data('json'),
					$params_pairs = $val.split('|'),
					$url_label = $(val).find('.url-label'),
					$title_label = $(val).find('.title-label'),
					$result = Object();
				$.each($params_pairs, function(index, val) {
					var $param = val.split(':');
					if ($param[0] != '' && $param[1]) {
						$result[$param[0]] = unescape($param[1]);
					}
				});
				var json = String(JSON.stringify($result)).replace(/\//g, "\\/");
				$input.data('json', $result);
				$input.attr('data-json', json);
				$url_label.html($result.url + (($result.target != undefined) ? $result.target : ''));
				$title_label.html($result.title);
				vc.atts.vc_link.init('vc_link', $(val));
				$url_label.bind('DOMSubtreeModified', function() {
					$input.trigger('change');
				});
			});
			$.each($('.wpb_el_type_dropdown select'), function(index, val) {
				var $select = $(this),
					$container = $select.closest('.wpb_el_type_dropdown');
				$select.on('change', function() {
					var selected = $select.val();
					if (selected != '') {
						$('option', $select).removeAttr('selected');
						$('option[value=' + selected + ']', $select).attr('selected', 'selected');
					}
					if (selected == 'light' || selected == 'dark') {
						var $nextCont = $container.next(),
							$targetEl = $nextCont.find('.dropdown-colors-list li span');
						$.each($targetEl, function(index, val) {
							if ($(val).hasClass('style-light-bg') && selected == 'dark') {
								$(val).attr('class', String($(val).attr('class')).replace('style-light-bg', 'style-dark-bg'));
							}
							if ($(val).hasClass('style-dark-bg') && selected == 'light') {
								$(val).attr('class', String($(val).attr('class')).replace('style-dark-bg', 'style-light-bg'));
							}
						});
					}
				});
				if ($select.hasClass('single_width') || $select.hasClass('single_height')) {
					$select.closest('li').find($('span.' + $select.attr('name') + '_factor')).html($select.val());
				}
				if ($select.is('[class*="_color"]')) {
					var $prevCont = $container.prev(),
						$prevSelect = $prevCont.find('.wpb-select'),
						$dropdownContainer = $select.closest('.colors-dropdown');
					$('.selected', $dropdownContainer).remove();
					$('.carat', $dropdownContainer).remove();
					$('> div', $dropdownContainer).remove();
					$select.unwrap('.old');
					$select.unwrap('.colors-dropdown');
					$select.removeAttr('id');
					$select.easyDropDown({
						cutOff: 10,
					});
					if ($prevSelect.length && ($prevSelect.val() == 'light' || $prevSelect.val() == 'dark')) $prevSelect.trigger('change');
				}
			});
			$.each($('.vc_sorted-list-container select'), function(index, val) {
				if (!$(this).parent().hasClass('select-wrapper')) $(this).wrap('<div class="select-wrapper"></div>');
			});
			$.each($('#uncode_items_container .vc_control-media'), function(index, val) {
				refreshControlMedia(this, $retrieveBundle);
			});
			$.each($('#uncode_items_container .vc_control-text'), function(index, val) {
				refreshControlText(this, $retrieveBundle);
			});
			$.each($('input,select', $container), function(index, val) {
				if (!$(val).attr('bindset')) {
					if ($(this).hasClass('text_length')) $(val).attr('bindset', 'true').bind('change input paste', {
						bundle: $retrieveBundle
					}, buildBundle);
					else if ($(this).hasClass('type_numeric_slider')) {
						var inputSlider = $(this),
							getSlider = inputSlider.closest('.ot-numeric-slider-wrap').find('.ot-numeric-slider');
						getSlider.slider({
    					change: function(event, ui) {
    						var data = { bundle: $retrieveBundle },
    							buildObj = {target: inputSlider, data: data };
        				buildBundle(buildObj);
    					}
						});
					} else $(val).attr('bindset', 'true').bind('change', {
						bundle: $retrieveBundle
					}, buildBundle);
				}
			});

			$.each($('#uncode_items_container input.checkbox'), function(index, val) {
				$(this).removeAttr('id');
				var name = $(this).attr('name'),
					itemId = $(this).closest('.list-list-item').attr('data-id');
				if ($retrieveBundle.hasOwnProperty(String(itemId) + '_i')) {
					if ($retrieveBundle[String(itemId) + '_i'][name] != undefined) {
						if ($retrieveBundle[String(itemId) + '_i'][name] == 'yes') $(this).attr("checked", true);
						else $(this).attr("checked", false);
					}
				}
				$(this).removeAttr('name');
				$(this).attr('name', name + '_' + String(itemId));
			});
			/** fix iconpicker  **/
			$('#uncode_items_container > li .option-tree-setting-edit').bind('click', function() {
				var $container = $(this).closest('li'),
					$iconContainer = $container.find('.wpb_el_type_iconpicker');
				if ($iconContainer.length == 1) {
					$('#uncode_items_container .vc-iconpicker, #uncode_items_container .vc-icons-selector').remove();
					if (!$(this).hasClass('active')) {
						$("body").addClass('wait');
						setTimeout(function() {
							$('.vc-iconpicker-wrapper', $iconContainer).append($('#vc_edit-form-tab-2 .vc-iconpicker').clone());
							var $el = $iconContainer.find('.wpb_vc_param_value');
							var settings = $.extend({
								iconsPerPage: 100, // default icons per page for iconpicker
								iconDownClass: 'fa fa-arrow-down',
								iconUpClass: 'fa fa-arrow-up',
								iconLeftClass: 'fa fa-arrow-left',
								iconRightClass: 'fa fa-arrow-right',
								iconSearchClass: 'fa fa-search',
								iconCancelClass: 'fa fa-remove',
								iconBlockClass: 'fa fa-minus-circle'
							}, $el.data('settings'));
							$iconContainer.find('.vc-iconpicker').vcFontIconPicker(settings).on('change', function(e) {
								var $select = $(this);
								if (!$select.data('vc-no-check')) {
										$el.data('vc-no-check', true).val(this.value).trigger('change');
								}
								$select.data('vc-no-check', false);
							});
							var $select = $iconContainer.find('.vc-iconpicker');
							$select.val($el.val());
							$select.data('vc-no-check', true);
							$select.find('[value="' + $el.val() + '"]').attr('selected', 'selected');
							$select.data('vcFontIconPicker').loadIcons(); // this methods actualy reload "active icon" and triggers event change
							$("body").removeClass('wait');
						}, 100);
					}
				}
			});
			$.each($('#uncode_items_container > li'), function(index, val) {
				var $liContent = $(val),
					callDependencies = {};
				$.each(vc_user_mapper['uncode_index']['params'], function() {
					var param = this;
					if ($.isPlainObject(param) && $.isPlainObject(param.dependency) && $.type(param.dependency.element)) {
						mapped_params[param.param_name] = param;
						var $masters = $('[name=' + ((_.isBoolean(param.dependency.is_empty) || param.dependency.value == 'yes') ? param.dependency.element + '_' + $liContent.attr('data-id') : param.dependency.element) + '].wpb_vc_param_value', $liContent),
							$slave = $('[name= ' + ((param.type == 'checkbox') ? param.param_name + '_' + $liContent.attr('data-id') : param.param_name) + '].wpb_vc_param_value', $liContent);
						$.each($masters, function() {
							var $master = $(this),
								name = $master.attr('name'),
								rules = param.dependency;
							if (!_.isArray(dependent_elements[$master.attr('name')])) dependent_elements[$master.attr('name')] = [];
							dependent_elements[$master.attr('name')].push($slave);
							if (!$master.attr('dependentSetted')) {
								$master.data('dependentSet') && $master.attr('dependentSetted', 'true') && $master.attr('data-dependent-set', 'true') && $master.bind('keyup change', hookDependent);
							}
							if (!callDependencies[name]) {
								callDependencies[name] = $master;
							}
						});
					}
				});
				$.each(callDependencies, function() {
					hookDependent({
						currentTarget: $(this)
					});
				});
				callDependencies = null;
			});
		}

		function hookDependent(e) {
			var $master = $(e.currentTarget),
				$master_container = $master.closest('.vc_column'),
				$list_container = $master.closest('.list-list-item'),
				$list_id = $list_container.attr('data-id'),
				is_empty,
				dependent_elements_hook = _.isArray(dependent_elements) ? dependent_elements_hook : dependent_elements[$master.attr('name')],
				master_value = $master.is(':checkbox') ? _.map($master_container.find('[name=' + $(e.currentTarget).attr('name') + '].wpb_vc_param_value:checked'), function(element) {
					return $(element).val();
				}) : $master.val();
			is_empty = $master.is(':checkbox') ? !$master_container.find('[name=' + $master.attr('name') + '].wpb_vc_param_value:checked').length : !master_value.length;
			if ($master_container.hasClass('vc_dependent-hidden')) {
				_.each(dependent_elements, function($element) {
					$(this).closest('.vc_column').addClass('vc_dependent-hidden');
				});
			} else {

				_.each(dependent_elements_hook, function($element) {
					var $li_element = $element.closest('.list-list-item');
					if ($li_element.attr('data-id') == $list_id) {
						var param_name = $element.attr('name');
						if (/\d/.test(param_name)) {
							param_name = param_name.replace(/\d+/g, '');
							param_name = param_name.substring(0, param_name.length - 1)
						}
						var rules = _.isObject(mapped_params[param_name]) && _.isObject(mapped_params[param_name].dependency) ? mapped_params[param_name].dependency : {},
							$param_block = $element.closest('.vc_column');
						if (_.isBoolean(rules.not_empty) && rules.not_empty === true && !is_empty) { // Check is not empty show dependent Element.
							$param_block.removeClass('vc_dependent-hidden');
						} else if (_.isBoolean(rules.is_empty) && rules.is_empty === true && is_empty) {
							$param_block.removeClass('vc_dependent-hidden');
						} else if (rules.value && _.intersection((_.isArray(rules.value) ? rules.value : [rules.value]), (_.isArray(master_value) ? master_value : [master_value])).length) {
							$param_block.removeClass('vc_dependent-hidden');
						} else if (rules.value_not_equal_to && !_.intersection((_.isArray(rules.value_not_equal_to) ? rules.value_not_equal_to : [rules.value_not_equal_to]), (_.isArray(master_value) ? master_value : [master_value])).length) {
							$param_block.removeClass('vc_dependent-hidden');
						} else {
							$param_block.addClass('vc_dependent-hidden');
						}
						var event = jQuery.Event('change');
						event.extra_type = 'vcHookDepended';
					}
				}, this);
			}
		};

		function buildBundle(e) {
			var $this = $(e.target),
				$retrieveBundle = e.data.bundle,
				$container = $('#uncode_items_container'),
				$containerParent = $container.parent(),
				$bundleInput = $containerParent.find('.uncode_items');
			setTimeout(function() {
				var itemId = $this.closest('.list-list-item').attr('data-id'),
					itemVal = $this.val(),
					itemKey = $this.attr('name');

				if ($this.hasClass('sorted_list_field')) itemKey = 'single_layout';
				/** fix for checkbox **/
				if ($this.is("input") && itemKey.indexOf('_' + itemId) > 0) {
					itemKey = itemKey.replace('_' + itemId, '');
					if (!$this[0].checked) itemVal = 'no';
				}
				if (itemKey == undefined) {
					if ($this.closest('.vc_sorted-list').length) itemKey = 'vc_sorted_list_element';
				}
				/** fix for sorted list elements **/
				if (itemKey == 'vc_sorted_list_element') {
					$.each($('.vc_sorted-list-container select', $this.closest('.vc_sorted-list')), function(index, val) {
						if (!$(this).parent().hasClass('select-wrapper')) $(this).wrap('<div class="select-wrapper"></div>');
					});
					if (itemVal == 'media') {
						if ($this.is(':checked')) refreshControlMedia($this.closest('.vc_sorted-list').find('.vc_control-media'), $retrieveBundle);
					}
					if (itemVal == 'text') {
						if ($this.is(':checked')) refreshControlText($this.closest('.vc_sorted-list').find('.vc_control-text'), $retrieveBundle);
					}
					setTimeout(function() {
						var $listContainer = $this.closest('.vc_sorted-list').find('li[data-name=' + itemVal + ']');
						$.each($('input,select', $listContainer), function(index, val) {
							if (!$(val).attr('bindset')) {
								if ($(this).hasClass('text_length')) $(val).attr('bindset', 'true').bind('change input paste', {
									bundle: $retrieveBundle
								}, buildBundle);
								else $(val).attr('bindset', 'true').bind('change', {
									bundle: $retrieveBundle
								}, buildBundle);
							}
						});
					}, 250);
				}
				/** change visual values **/
				if (itemKey == 'single_width' || itemKey == 'single_height') {
					$this.closest('li').find($('span.' + itemKey + '_factor')).html(itemVal);
				}

				/** change bundle values **/
				if ($retrieveBundle.hasOwnProperty(String(itemId) + '_i')) {
					if (itemKey == 'vc_sorted_list_element' || itemKey == undefined || itemKey == 'back_image') {
						var $listProp = $this.closest('.vc_sorted-list').find('.sorted_list_field').val();
						if (itemKey == 'back_image') $retrieveBundle[String(itemId) + '_i']['back_image'] = itemVal;
						itemKey = 'single_layout';
						if ($listProp != '') $retrieveBundle[String(itemId) + '_i'][itemKey] = $listProp;
						else delete $retrieveBundle[String(itemId) + '_i'][itemKey];
					} else $retrieveBundle[String(itemId) + '_i'][itemKey] = itemVal;
				} else {
					var obj = new Object();
					if (itemKey == 'vc_sorted_list_element' || itemKey == undefined || itemKey == 'back_image') {
						var $listProp = $this.closest('.vc_sorted-list').find('.sorted_list_field').val();
						if (itemKey == 'back_image') obj['back_image'] = itemVal;

						itemKey = 'single_layout';
						if ($listProp != '') obj[itemKey] = $this.closest('.vc_sorted-list').find('.sorted_list_field').val();
					} else obj[itemKey] = itemVal;
					$retrieveBundle[String(itemId) + '_i'] = obj;
				}
				$bundleInput.val(Base64.encode(JSON.stringify($retrieveBundle)));
			}, 250);
		};

		function refreshControlMedia(el, $retrieveBundle) {
			var $this = $(el),
				$list = $this.closest('.vc_sorted-list'),
				$listParentId = $this.closest('.list-list-item').attr('data-id'),
				$listInput = $list.find('.sorted_list_field'),
				$inputVal = $listInput.val().split(','),
				$mediaId = '',
				$mediaFound = false;
			for (var $index in $inputVal) {
				if ($inputVal[$index].indexOf('media|') != -1) $mediaFound = true;
			}
			try {
				$mediaId = $retrieveBundle[$listParentId + '_i']['back_image'];
			} catch (e) {}
			if ($mediaFound && $mediaFound != '') {
				var $div = '<div class="sorted-list-custom-media edit_form_line" style="margin-top: 5px;"><input type="hidden" class="wpb_vc_param_value uncode_gallery_attached_images_ids back_image media_element" name="back_image" value=""><div class="uncode_widget_attached_images"><ul class="uncode_widget_attached_images_list"></ul></div><div class="gallery_widget_site_images"></div><a class="add_media_widget" href="#" use-single="true" title="Add media" style="margin-top: 5px;display: inline-block;">Add media</a></div>';
				if ($mediaId != '' && $mediaId != undefined && $mediaFound) {
					$.ajax({
						type: 'POST',
						url: window.ajaxurl,
						data: {
							action: 'fieldAttachedMedia',
							mediaid: $mediaId
						},
						dataType: 'html',
					}).done(function(html) {
						$mediaId = html;
						$this.append('<div class="sorted-list-custom-media edit_form_line" style="margin-top: 5px;"><input type="hidden" class="wpb_vc_param_value uncode_gallery_attached_images_ids back_image media_element" name="back_image" value=""><div class="uncode_widget_attached_images"><ul class="uncode_widget_attached_images_list">' + $mediaId + '</ul></div><div class="gallery_widget_site_images"></div><a class="add_media_widget" href="#" use-single="true" title="Add media" style="margin-top: 5px;display: inline-block;">Add media</a></div>');
					});
				} else $this.append($div);
			} else $this.append($div);
		}

		function refreshControlText(el, $retrieveBundle) {
			var $this = $(el),
				$list = $this.closest('.vc_sorted-list'),
				$listParentId = $this.closest('.list-list-item').attr('data-id'),
				$listInput = $list.find('.sorted_list_field'),
				$inputVal = $listInput.val().split(','),
				$textLength = '',
				$textFound = false;
			for (var $index in $inputVal) {
				if ($inputVal[$index].indexOf('text|') != -1) $textFound = true;
			}
			try {
				$textLength = $retrieveBundle[$listParentId + '_i']['text_length'];
			} catch (e) {}
			if ($textFound && $textFound != '') {
				var $div = '<div class="sorted-list-custom-text edit_form_line" style="margin-top: 5px;"><input type="text" class="wpb_vc_param_value text_length" name="text_length" value="" placeholder="Chars number…"></div>';
				if ($textLength != '' && $textLength != undefined && $textFound) {
					$this.append('<div class="sorted-list-custom-text edit_form_line" style="margin-top: 5px;"><input type="text" class="wpb_vc_param_value text_length" name="text_length" value="' + $textLength + '" placeholder="Chars number…"></div>');
				} else $this.append($div);
			} else $this.append($div);
		}
	}
}(window.jQuery);