'use strict';

var map = L.map('map').setView([44.04826224757115, -123.08966159820558], 15);

// http://a.tile.stamen.com/toner/${z}/${x}/${y}.png
L.tileLayer("http://a.tile.stamen.com/terrain/{z}/{x}/{y}.png", { maxzoom : 18 }).addTo(map)


function makeMeterMarker(m) {
	//console.log(f, f.geometry);
	var i = L.divIcon({className: 'meter-marker'})
	//console.log(i);
	var coo = L.latLng(m.geometry.coordinates[1], m.geometry.coordinates[0])
	//console.log(coo)
	var mark = L.marker(coo, {icon: i});
	
	mark.addTo(map);
	var extent = (2+Math.pow(m.properties.count, 3)*.0005)
	mark._icon.style.borderTopWidth = extent + "px";
	mark._icon.style.top = "-" + extent + "px";
	return mark;
}
/*
var pmPoints = new L.GeoJSON.AJAX("data/parking_meters.json",{
 	onEachFeature:assignMeterInfo,
})
*/

var httpRequest = new XMLHttpRequest();
httpRequest.onload = function(e){

	if (httpRequest.status === 200){
		var data = JSON.parse(httpRequest.response);
		console.log(data['features'])
		for (var i=0; i<data['features'].length; i++) {
			var meter = data['features'][i];
			makeMeterMarker(meter);
		}
	}
}
httpRequest.open("GET", "data/parking_meters.json", true);
httpRequest.send();


//pmPoints.addTo(map);
