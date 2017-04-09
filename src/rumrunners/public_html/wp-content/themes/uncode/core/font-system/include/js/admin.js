$ = jQuery.noConflict();

jQuery(document).ready(function($) {
	$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
	postboxes.add_postbox_toggles('uncodefont');

	var UncodeFontFontStack = UncodeFontJS.font_stack;
	UncodeFontFontStack = $.parseJSON(UncodeFontFontStack);
	var UncodeFontFontVariations = {
		n1: 'Thin',
		n2: 'Extra Light',
		n3: 'Light',
		n4: 'Regular',
		n5: 'Medium',
		n6: 'Demi-bold',
		n7: 'Bold',
		n8: 'Heavy',
		n9: 'Black',
		n10: 'Extra Black',
		i1: 'Thin Italic',
		i2: 'Extra Light Italic',
		i3: 'Light Italic',
		i4: 'Regular Italic',
		i5: 'Medium Italic',
		i6: 'Demi-bold Italic',
		i7: 'Bold Italic',
		i8: 'Heavy Italic',
		i9: 'Black Italic',
		i10: 'Extra Black Italic',
		'100': 'Thin',
		'200': 'Extra Light',
		'300': 'Light',
		'400': 'Regular',
		'500': 'Medium',
		'600': 'Demi-bold',
		'700': 'Bold',
		'800': 'Heavy',
		'900': 'Black',
		'1000': 'Extra Black',
		'100italic': 'Thin Italic',
		'200italic': 'Extra Light Italic',
		'300italic': 'Light Italic',
		'400italic': 'Regular Italic',
		'500italic': 'Medium Italic',
		'600italic': 'Demi-bold Italic',
		'700italic': 'Bold Italic',
		'800italic': 'Heavy Italic',
		'900italic': 'Black Italic',
		'1000italic': 'Extra Black Italic'
	}

	$('.uf-group-key').click(function() {
		var clickedId = this.id;
		var showId = clickedId + '-fonts';
		if ($(this).hasClass('uf-group-key-gf')) {
			$('.uf-group-key-for-gf').removeClass('shown').addClass('hidden');
		}
		if ($(this).hasClass('uf-group-key-tk')) {
			$('.uf-group-key-for-tk').removeClass('shown').addClass('hidden');
		}
		if ($(this).hasClass('uf-group-key-fs')) {
			$('.uf-group-key-for-fs').removeClass('shown').addClass('hidden');
		}
		$('#' + showId).removeClass('hidden').addClass('shown');
		return false;
	});

	$('#uf-font-stack li').live('click', function() {
		$(this).addClass('selected').siblings().removeClass('selected');
		var fontFamily = $(this).find('.uf-font-family').text();
		var len = UncodeFontFontStack.length;
		for (var i=0; i<len; i++) {
			var font = UncodeFontFontStack[i];
			if (fontFamily == font.family) {
				var details = "<h2>" + font.family + "</h2>";
				if (font.generic != '') {
					details += "<strong>Generic</strong>: <em>" + font.generic + "</em><br/>";
				}
				if (font.source != '') {
					details += "<strong>From</strong>: <em>" + font.source + "</em>";
				}
				var j, checked, match, matching, variantStr, subsetStr;
				variantStr = '';
				subsetStr = '';
				if (typeof font.variants != 'undefined') {
					var variants, selvariants;
					if (font.variants.indexOf(',') < 0) {
						variants = new Array();
						variants[0] = font.variants;
					}
					else {
						variants = font.variants.split(',');
					}

					selvariants = font.selvariants;

					var variantSelectors;
					var vlen = variants.length;
					var weight, style;
					if (vlen > 0) {
						variantStr += "<div class='uf-all-variants'>";
						variantStr += "<h3>";
						variantStr += "Variants";
						if (font.source == 'Font Squirrel') {
							variantStr += '<span class="selectors">Selectors</span>';
						}
						variantStr += "</h3>";
						variantStr += "<ul class='uf-variant-list'>";
						if (vlen == 1) {
							variantStr += "<li>";
							if (typeof UncodeFontFontVariations[variants[0]] != 'undefined') {
								weight = UncodeFontFontVariations[variants[0]];
								variantStr += weight + ' (' + variants[0] + ')';
							}
							else {
								variantStr += variants[0].substr(0, 1).toUpperCase() + variants[0].substr(1);
							}
							if (font.source == 'Font Squirrel') {
								variantSelectors = font.variantselectors;
								variantStr += '<input type="text" class="uf-variant-font-selector uf-variant-font-selector-' + variants[0] + ' uf-variant-font-selector-base-' + font.stub + '" value="' + variantSelectors +'"/>';
							}
							variantStr += "</li>"
						}
						else {
							if (font.source == 'Font Squirrel') {
								variantSelectors = font.variantselectors;
								variantSelectors = variantSelectors.split('|');
							}

							for (j=0; j<vlen; j++) {
								variantStr += "<li>";
								variantStr += "<label>";
								match = new RegExp("\\b"+variants[j]+"\\b");
								matching = match.exec(selvariants);
								if (matching != null) {
									checked = " checked='checked' ";
								}
								else {
									checked = '';
								}

								variantStr += "<input type='checkbox' " + checked + " class='uf-variant-list-cb' id='uf-variant-" + variants[j] + "'/>";
								if (typeof UncodeFontFontVariations[variants[j]] != 'undefined') {
									weight = UncodeFontFontVariations[variants[j]];
									variantStr += weight + ' (' + variants[j] + ')';
								}
								else {
									variantStr += variants[j].substr(0, 1).toUpperCase() + variants[j].substr(1);
								}
								variantStr += "</label>";
								if (font.source == 'Font Squirrel') {
									variantStr += '<input type="text" class="uf-variant-font-selector uf-variant-font-selector-' + variants[j] + ' uf-variant-font-selector-base-' + font.stub + '" value="' + variantSelectors[j] + '" />';
								}
								variantStr += "</li>";
							}
						}
						variantStr += "</ul>";
						variantStr += '</div>';
					}
				}

				if (typeof font.subsets != 'undefined' && font.subsets != '') {
					var subsets, selsubsets;
					selsubsets = font.selsubsets;
					if (font.subsets.indexOf(',') < 0) {
						subsets = new Array();
						subsets[0] = font.subsets;
					}
					else {
						subsets = font.subsets.split(',');
					}

					var slen = subsets.length;
					if (slen > 0) {
						subsetStr += "<div class='uf-all-subsets'>";
						subsetStr += "<h3>Subsets</h3>";
						subsetStr += "<ul class='uf-subset-list'>";
						if (slen == 1) {
							subsetStr += "<li>" + subsets[0].substr(0, 1).toUpperCase() + subsets[0].substr(1) + "</li>";
						}
						else {
							for (j=0; j<slen; j++) {
								subsetStr += "<li>";
								subsetStr += "<label>";
								match = new RegExp("\\b"+subsets[j]+"\\b");
								matching = match.exec(selsubsets);
								if (matching != null) {
									checked = " checked='checked' ";
								}
								else {
									checked = '';
								}
								subsetStr += "<input type='checkbox' " + checked + " class='uf-subset-list-cb' id='uf-subset-" + subsets[j] + "'/>";
								subsetStr += subsets[j].substr(0, 1).toUpperCase() + subsets[j].substr(1);
								subsetStr += "</label>";
								subsetStr += "</li>";
							}
						}
						subsetStr += "</ul>";
						subsetStr += '</div>';
					}
				}
				if (subsetStr == '' || variantStr == '') {
					details += variantStr + subsetStr;
				}
				else {
					details += '<div class="uf-variant-subset">' + variantStr + subsetStr + '</div>'
				}

				if (font.source != 'Font Squirrel') {
					var selectorStr = '';
					if (typeof font.selectors != 'undefined' && font.selectors != '') {
						selectorStr = font.selectors;
					}
					details += "<div class='uf-selector'><h3>Selectors</h3>" +
						"<label>CSS Selectors (Enter a comma-separated list. E.g. h1,h2,.pagetitle,#post-id):" +
						"<input type='text' id='uf-font-selectors' value='" + selectorStr + "'/>" +
						"</label></div>";
				}
				$('#uf-font-details').hide().html(details).fadeIn();
				break;
			}
		}
	});

	$('.uf-variant-list-cb,.uf-subset-list-cb,#uf-font-selectors').live('change', function() {
		var fontName = $(this).parents('#uf-font-details').find('h2').text();
		var selectionId;
		if ($(this).hasClass('uf-variant-list-cb')) {
			selectionId = this.id.substr(11);
		}
		else if ($(this).hasClass('uf-subset-list-cb')) {
			selectionId = this.id.substr(10);
		}
		var len = UncodeFontFontStack.length;
		var font;
		for (var i=0; i<len; i++) {
			if (UncodeFontFontStack[i].family == fontName) {
				font = UncodeFontFontStack[i];
				var selections;
				if ($(this).hasClass('uf-variant-list-cb')) {
					selections = font.selvariants;
				}
				else if ($(this).hasClass('uf-subset-list-cb')) {
					selections = font.selsubsets;
				}
				if ($(this).hasClass('uf-variant-list-cb') || $(this).hasClass('uf-subset-list-cb')) {
					if (selections.indexOf(',') > -1) {
						selections = selections.split(',');
					}
					else {
						selections = new Array(selections);
					}
					selections = $.map(selections, function(value) {
						if (selectionId == value) {
							return null;
						}
						return value;
					});
					selections = selections.join(',');
				}
				else {
					selections = $(this).val();
				}
				if ($(this).hasClass('uf-variant-list-cb')) {
					UncodeFontFontStack[i].selvariants = selections;
				}
				else if ($(this).hasClass('uf-subset-list-cb')) {
					UncodeFontFontStack[i].selsubsets = selections;
				}
				else {
					UncodeFontFontStack[i].selectors = selections;
				}
				break;
			}
		}
		$('#font_stack').val(JSON.stringify(UncodeFontFontStack));
	});

	$('.uf-variant-font-selector').live('change', function() {
		var classes = $(this).attr('class').split(/\s+/);
		var len = classes.length;
		for (var i=0; i<len; i++) {
			if (classes[i].substr(0, 30) == 'uf-variant-font-selector-base-') {
				var stub = classes[i].substr(30);
				var fontLen = UncodeFontFontStack.length;
				for (var j=0; j<fontLen; j++) {
					if (typeof UncodeFontFontStack[j].stub != 'undefined' && UncodeFontFontStack[j].stub == stub) {
						var variantSelectors = new Array();
						var selectors = $('.uf-variant-font-selector');
						$.each(selectors, function(index){
							variantSelectors[index] = $(this).val();
						});
						variantSelectors = variantSelectors.join('|');
						UncodeFontFontStack[j].variantselectors = variantSelectors;
					}
				}
				break;
			}
		}
		$('#font_stack').val(JSON.stringify(UncodeFontFontStack));
	});

	$('.uf-add-font').live('click', function() {
		var family = $(this).parents('.uf-fonts-for li').children('.uf-list-family').text();
		var len = UncodeFontFontStack.length;
		for (var i=0; i<len; i++) {
			if (family == UncodeFontFontStack[i].family) {
				return false;
			}
		}

		var lineItem = $(this).parents('.uf-fonts-for li');
		var source, variants, subsets, generic, stub, files, link, familyID, fontFamily, variantSelectors;
		files = '';
		familyID = '';
		fontFamily = '';
		variantSelectors = '';
		if ($(this).hasClass('uf-add-font-gf')) {
			link = $('<link>');
			link.attr({
				type: 'text/css',
				rel: 'stylesheet',
				href: '//fonts.googleapis.com/css?family=' + encodeURIComponent(family)
			});
			$('head').append(link);
			source = 'Google Web Fonts';
			generic = '';
			stub = '';
			variants = $(lineItem).children('.uf-font-variants').text();
			subsets = $(lineItem).children('.uf-font-subsets').text();
		}
		else if ($(this).hasClass('uf-add-font-tk')) {
			source = 'Typekit';
			generic = '';
			stub = $(lineItem).children('.uf-font-stub').text();
			variants = $(lineItem).children('.uf-font-variants').text();
			subsets = $(lineItem).children('.uf-font-subsets').text();
		}
		else if ($(this).hasClass('uf-add-font-fd')) {
			source = 'Fontdeck';
			generic = '';
			stub = '';
			variants = $(lineItem).children('.uf-font-variants').text();
			subsets = $(lineItem).children('.uf-font-subsets').text();
		}
		else if ($(this).hasClass('uf-add-font-fs')) {
			source = 'Font Squirrel';
			generic = '';
			stub = $(lineItem).children('.uf-font-stub').text();
			link = $('<link>');
			link.attr({
				type: 'text/css',
				rel: 'stylesheet',
				href: UncodeFontJS.font_dir_url + stub + '/stylesheet.css'
			});
			$('head').append(link);
			variants = $(lineItem).children('.uf-font-variants').text();
			var variantArray = variants.split(',');
			var selectorArray = new Array();
			for (var ctr = 0; ctr < variantArray.length; ctr++) {
				selectorArray[ctr] = '';
			}
			variantSelectors = selectorArray.join('|');
			if (variants.indexOf(',') > 0) {
				fontFamily = variants.substr(0, variants.indexOf(','));
			}
			else {
				fontFamily = variants;
			}

			files = $(lineItem).children('.uf-font-variants-files').text();
			subsets = $(lineItem).children('.uf-font-subsets').text();
			familyID = $(lineItem).children('.uf-font-family-id').text();
		}

		if (fontFamily == '') {
			if (stub == '') {
				fontFamily = "\"" + family + "\"";
			}
			else {
				fontFamily = stub;
			}
		}

		$('#uf-font-stack').append($("<li><span class='sample' style='font-family: " + fontFamily + ";'>Mr. Jock, TV quiz Ph.D., bags few lynx.</span><span class='uf-stack-meta'><span class='uf-font-family'>" + family + "</span> <a href='#' class='uf-remove-font' title='Remove'>&nbsp;</a></span></span></li>").hide().fadeIn());
		UncodeFontFontStack[UncodeFontFontStack.length] = {
			family: family,
			familyID: familyID,
			source: source,
			stub: stub,
			generic: generic,
			variants: variants,
			selvariants: variants,
			variantselectors: variantSelectors,
			files: files,
			subsets: subsets,
			selsubsets: subsets
		};

		$('#font_stack').val(JSON.stringify(UncodeFontFontStack));
		$('html, body').animate({
			scrollTop: 0
		}, 'slow');
		return false;
	});

	$('.uf-download-font').live('click', function(e) {
		var button = $(this);
		var lineItem = $(this).parents('.uf-fonts-for li');
		var addButton = "<a href='#' class='uf-add-font uf-add-font-fs' title='Add'><i class='fa fa-plus2'></i></a>";
		var deleteButton = "<a href='#' class='uf-delete-download uf-delete-download-fs' title='Delete Download'><i class='fa fa-cross'></i></a>";
		var family = $(lineItem).children('.uf-font-stub').text();
		var variants = $(lineItem).children('.uf-font-variants');
		var files = $(lineItem).children('.uf-font-variants-files');
		if (variants.length == 0) {
			variants = $("<span class='uf-font-variants'></span>").appendTo(lineItem);
		}
		if (files.length == 0) {
			files = $("<span class='uf-font-variants-files'></span>").appendTo(lineItem);
		}

		if ($(this).hasClass('uf-download-font-fs')) {
			var url = "http://www.fontsquirrel.com/fontfacekit/" + encodeURIComponent(family);
			$('<div class="uf-font-wip">&nbsp;</div>').prependTo($(this).parents('li'));
			$.post(UncodeFontJS.ajaxurl, "action=uncodefont_download_font&font_url=" + url + "&nonce=" + UncodeFontJS.nonce, function(data) {
				if (data.indexOf("<form") > -1) {
					$('.uf-font-wip').after( $(data) );
					$('.uf-font-wip').remove();
					$('#uf-fs-Blackletter-fonts form').on( 'submit', function (e) {
						e.preventDefault();
						$.post(this.getAttribute('action') + '&fileaccess=other', "action=uncodefont_download_font&font_url=" + url + "&" + $(this).serialize(), function(data) {
							var response = $.parseJSON(data);
							if (typeof response.success == 'undefined') {
								alert("Font download failed!");
							}
							else {
								if (typeof response.variants != 'undefined') {
									$(variants).text(response.variants);
								}
								if (typeof response.files != 'undefined') {
									$(files).text(response.files);
								}
								$(button).fadeOut(500, function(e) {
									var buttonPanel = $(lineItem).children('.uf-prev-add');
									$(this).remove();
									$(buttonPanel).append(addButton).fadeIn();
									$(buttonPanel).append(deleteButton).fadeIn();
								});
							}
							$('.uf-font-wip').remove();
							$('#uf-fs-Blackletter-fonts form').remove();
						});
						return false;
					});
					return false;
				} else {
					var response = $.parseJSON(data);
					if (typeof response.success == 'undefined') {
						alert("Font download failed!");
					}
					else {
						if (typeof response.variants != 'undefined') {
							$(variants).text(response.variants);
						}
						if (typeof response.files != 'undefined') {
							$(files).text(response.files);
						}
						$(button).fadeOut(500, function(e) {
							var buttonPanel = $(lineItem).children('.uf-prev-add');
							$(this).remove();
							$(buttonPanel).append(addButton).fadeIn();
							$(buttonPanel).append(deleteButton).fadeIn();
						});
					}
					$('.uf-font-wip').remove();
				}
			});
		}

		return false;
	});

	$('.uf-delete-download').live('click', function(e) {
		var button = $(this);
		var downloadButton = "<a href='#' class='uf-download-font uf-download-font-fs' title='Download'><i class='fa fa-arrow-down2'></i></a>";
		var family = $(this).parents('.uf-fonts-for li').children('.uf-font-stub').text();
		if ($(this).hasClass('uf-delete-download-fs')) {
			$('<div class="uf-font-wip">&nbsp;</div>').prependTo($(this).parents('li'));
			$.post(UncodeFontJS.ajaxurl, "action=uncodefont_delete_download&font_family=" + family, function(data) {
				var response = $.parseJSON(data);
				if (typeof response.success == 'undefined') {
					alert("Font deletion failed!");
				}
				else {
					$(button).fadeOut(500, function(e) {
						var buttonPanel = $(this).parents('.uf-fonts-for li').children('.uf-prev-add');
						var addButton = $(buttonPanel).children('.uf-add-font');
						$(addButton).fadeOut().remove();
						$(this).remove();
						$(buttonPanel).append(downloadButton).fadeIn();
					});
				}
				$('.uf-font-wip').remove();
			});
		}

		return false;
	});

	$('.uf-remove-font').live('click', function() {
		var font_to_remove = $(this).siblings('.uf-font-family').text();
		UncodeFontFontStack = $.map(UncodeFontFontStack, function(value) {
			if (font_to_remove == value['family']) {
				return null;
			}
			return value;
		});
		$(this).parents('#uf-font-stack li').fadeOut(500, function(){
			$(this).remove();
			if ($('#uf-font-stack').children().length == 0) {
				$('.uf-font-details').html("<h2>Add Fonts</h2>You have no fonts in your stack. Please add a font first from the sources below. If you don't see any fonts below, make sure you have set up the <a href='admin.php?page=uncodefont-settings'>Font Sources</a> correctly.");
			}
			else if ($('.uf-font-details h2').text() == font_to_remove) {
				$('.uf-font-details').html('<h2>Preview</h2>Select a font from the left to see its details.');
			}
		});
		$('#font_stack').val(JSON.stringify(UncodeFontFontStack));
		return false;
	});

});