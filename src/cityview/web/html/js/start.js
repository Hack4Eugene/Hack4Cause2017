'use strict';

var map = L.map('map').setView([44.0539, -123.0944], 12);

// http://a.tile.stamen.com/toner/${z}/${x}/${y}.png
L.tileLayer("http://a.tile.stamen.com/terrain/{z}/{x}/{y}.png", { maxzoom : 18 }).addTo(map)

var droot = "data/";
var D = {
	"permits":	droot + "permits.json",
	"neighbors":	droot + "neighborhoods_geo.json",
}


var colors = {
	"active":	'#ff5e00',
	"unactive":	'#3388ff',
}


// add neighborhoods
var httpRequest = new XMLHttpRequest();
httpRequest.onreadystatechange = function(){
	if (httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200){
		console.log('done');
	}
}
var permits = httpRequest.open("GET", D["permits"], true);
		console.log(permits);

function assignNeighborhoodInfo(feature, layer){
	//popup on hover
	var popup = L.popup({
		"closeButton": false,
		"className": "neighbor-popup",
		"autoPan": true,
	});
	popup.setContent(feature.properties.name);
 	layer.bindPopup(popup);
	
	layer.addEventListener('mouseover', function (e) {
	        this.openPopup();
		this.setStyle({color: colors['active']});
     	});

        layer.addEventListener('mouseout', function (e) {
                this.closePopup();
		this.setStyle({color: colors['unactive']});
	});
	
}
var neighborStyle = {
	"weight": 1,
}

var neighborPolys = new L.GeoJSON.AJAX("data/neighborhoods_geo.json",{
	onEachFeature:assignNeighborhoodInfo,
	style:neighborStyle,
});

neighborPolys.addTo(map);

