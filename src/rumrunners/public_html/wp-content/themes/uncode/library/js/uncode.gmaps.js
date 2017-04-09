(function() {
	"use strict";
	var uncode_gmaps_init = function() {
		var gmaps_single = function($el) {
			//set your google maps parameters
			var map_id = jQuery($el).attr('id'),
				latitude = jQuery($el).data('lat'),
				longitude = jQuery($el).data('lon'),
				map_zoom = jQuery($el).data('zoom'),
				main_color = jQuery($el).data('color'),
				ui_color = jQuery($el).data('ui'),
				brightness_value = jQuery($el).data('brightness'),
				saturation_value = jQuery($el).data('saturation'),
				draggable = jQuery($el).data('draggable'),
				style,
				marker;
			//we define here the style of the map
			if (main_color !== undefined && main_color !== '') {
				style = [{
						//set saturation for the labels on the map
						elementType: "labels",
						stylers: [{
							saturation: saturation_value
						}]
					}, { //poi stands for point of interest - don't show these lables on the map
						featureType: "poi",
						elementType: "labels",
						stylers: [{
							visibility: "off"
						}]
					}, {
						featureType: "road",
						elementType: "labels.icon",
						stylers: [{
							visibility: "off"
						}]
					}, {
						//don't show highways lables on the map
						featureType: 'road.highway',
						elementType: 'labels',
						stylers: [{
							visibility: "off"
						}]
					}, {
						//don't show local road lables on the map
						featureType: "road.local",
						elementType: "labels.icon",
						stylers: [{
							visibility: "off"
						}]
					}, {
						//don't show arterial road lables on the map
						featureType: "road.arterial",
						elementType: "labels.icon",
						stylers: [{
							visibility: "off"
						}]
					}, {
						//don't show road lables on the map
						featureType: "road",
						elementType: "geometry.stroke",
						stylers: [{
							visibility: "off"
						}]
					},
					//style different elements on the map
					{
						featureType: "transit",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "off"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "poi",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "off"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "poi.government",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "off"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "poi.sport_complex",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "off"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "poi.attraction",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "off"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "poi.business",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "off"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "transit",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "off"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "transit.station",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "off"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "transit.station",
						stylers: [{
							visibility: "off"
						}]
					}, {
						featureType: "landscape",
						stylers: [{
							hue: main_color
						}, {
							visibility: "on"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "road",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "on"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "road.highway",
						elementType: "geometry.fill",
						stylers: [{
							hue: main_color
						}, {
							visibility: "on"
						}, {
							lightness: 100
						}, {
							saturation: saturation_value
						}]
					}, {
						featureType: "transit.line",
						elementType: "labels",
						stylers: [{
							visibility: "off"
						}]
					}, {
						featureType: "water",
						elementType: "geometry",
						stylers: [{
							hue: main_color
						}, {
							visibility: "on"
						}, {
							lightness: brightness_value
						}, {
							saturation: saturation_value
						}]
					},
				];
			}

			//set google map options
			var map_options = {
				panControl: false,
				zoomControl: ((ui_color !== undefined && ui_color !== '') ? false : true),
				mapTypeControl: ((ui_color !== undefined && ui_color !== '') ? false : true),
				streetViewControl: false,
				scrollwheel: false,
				draggable: draggable,
				styles: style,
				zoom: map_zoom,
				center: new google.maps.LatLng(latitude, longitude),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
			};
			//inizialize the map
			var map = new google.maps.Map($el, map_options);
			if (ui_color !== undefined && ui_color !== '') {
				var custom_icon = {
					path: 'M -0.700129 -465.882 c -85.1 0 -154.334 69.234 -154.334 154.333 c 0 34.275 21.887 90.155 66.908 170.834 c 31.846 57.063 63.168 104.643 64.484 106.64 l 22.942 34.775 l 22.941 -34.774 c 1.31699 -1.99799 32.641 -49.577 64.483 -106.64 c 45.023 -80.68 66.908 -136.559 66.908 -170.834 c 0.00100708 -85.1 -69.233 -154.334 -154.332 -154.334 Z M -0.700129 -232.592 c -44.182 0 -80 -35.817 -80 -80 s 35.818 -80 80 -80 c 44.182 0 80 35.817 80 80 s -35.819 80 -80 80 Z',
					fillColor: ui_color,
					fillOpacity: 1,
					strokeColor: ui_color,
					strokeWeight: 0,
					scale: (jQuery('html').hasClass('no-hidpi') ? 0.1 : 0.2),
				};
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(latitude, longitude),
					map: map,
					visible: true,
					optimized: false,
					title: 'spot',
					icon: custom_icon,
				});
			} else {
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(latitude, longitude),
					map: map,
					visible: true,
					optimized: false,
					title: 'spot',
				});
			}
			//add the resize event to the map
			google.maps.event.addDomListener(window, 'resize', function() {
				resizeMap();
			});
			window.addEventListener('boxResized', function(e) {
				resizeMap();
			});
			// resize function
			var resizeMap = function() {
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center);
			}
			//add custom buttons for the zoom-in/zoom-out on the map
			var CustomZoomControl = function(controlDiv, map) {
				//grap the zoom elements from the DOM and insert them in the map
				var controlUIzoomIn = document.getElementById(map_id + '-zoom-in'),
					controlUIzoomOut = document.getElementById(map_id + '-zoom-out');
				controlUIzoomIn.innerHTML = '<i class="fa fa-plus"></i>';
				controlUIzoomOut.innerHTML = '<i class="fa fa-minus"></i>';
				controlDiv.appendChild(controlUIzoomIn);
				controlDiv.appendChild(controlUIzoomOut);
				// Setup the click event listeners and zoom-in or out according to the clicked element
				google.maps.event.addDomListener(controlUIzoomIn, 'click', function() {
					map.setZoom(map.getZoom() + 1);
				});
				google.maps.event.addDomListener(controlUIzoomOut, 'click', function() {
					map.setZoom(map.getZoom() - 1);
				});
			};
			if (ui_color !== undefined && ui_color !== '') {
				var zoomControlDiv = document.createElement('div');
				var zoomControl = new CustomZoomControl(zoomControlDiv, map);
				map.controls[google.maps.ControlPosition.LEFT_TOP].push(zoomControlDiv);
			}
			//add a custom marker to the map
			google.maps.event.addListener(map, 'idle', function() {
				jQuery('.gmap-buttons', $el).css('opacity', '1');
			});
		};
		jQuery('.uncode-map-wrapper').each(function() {
			gmaps_single(this);
    });
	};
	google.maps.event.addDomListener(window, 'load', uncode_gmaps_init);
}());