!function($) {
	"use strict";
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
		$('.menu_icon_container').focus(function() {
			$(this).loadIcons();
		});
	});
}(window.jQuery);