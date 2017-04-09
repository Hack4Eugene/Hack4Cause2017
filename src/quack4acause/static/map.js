Date.prototype.getUnixTime = function() { return this.getTime()/1000|0 };
if(!Date.now) Date.now = function() { return new Date(); }
Date.time = function() { return Date.now().getUnixTime(); }
var map;
//#141414

function initMap(){
  map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 44.052,
      lng: -123.086
    },
    zoom: 14
  });
  marker = new google.maps.Marker({
      map: map
    });
  map.addListener('rightclick', function(e) {
        createWindow(e);
    });

    //addMarkers();
}

function createWindow(e) {
    marker.setPosition(e.latLng);

    //set position data
    var latitude = e.latLng.lat();
    var longitude = e.latLng.lng();
    var lat = document.getElementById("lat");
    lat.setAttribute("value", latitude);
    var long = document.getElementById("long");
    long.setAttribute("value", longitude);
    console.log("Latitude: " + latitude +'\n' +"Longitude: " + longitude);

    infowindow = new google.maps.InfoWindow;
    var formData = document.getElementById('form');
    infowindow.setContent(formData);
    infowindow.open(map, marker);
    google.maps.event.addListener(infowindow,'click',function(){
        window.location.reload();
    // then, remove the infowindows name from the array
    });

}

function addMarkers(markersOld) {
      console.log(markersOld);
      /*var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
          Event: {
            icon: iconBase + 'parking_lot_maps.png'
          },
          Crime: {
            icon: iconBase + 'info-i_maps.png'
          }
        };*/

    /*var markersOld = [
        [ 44.052, -123.086, "This is a test event","event",1591709677],
        [ 44.042, -123.084, "A murder happened here","crime",1490709677]
    ];*/
    /*var locations = [];
    for(i = 0; i < markersOld.length; i++)
    {
        var aLoc = {lat: markersOld[i][0], lng: markersOld[i][1]};
        locations.push(aLoc);
    }
    var markers = locations.map(function(location, i) {
        return new google.maps.Marker({
            position: location
        });
    });*/

    // Add a marker clusterer to manage the markers.
    /*var markerCluster = new MarkerClusterer(map, markers,
        {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    */
     var infoWindow = new google.maps.InfoWindow(), marker, i;
     for( i = 0; i < markersOld.length; i++ ) {
        var position = new google.maps.LatLng(markersOld[i][0], markersOld[i][1]);
        var animation;
        var theTime = new Date();
        var theResult = theTime.getUnixTime()-markersOld[i][4];
        console.log(theTime.getUnixTime()-markersOld[i][4]);
        if(theResult<300){  
            animation = google.maps.Animation.BOUNCE;
        }
        else{
            animation = null;
        }
        var aIcon;
        if(markersOld[i][3]){
            aIcon = 'https://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png';
        }
        else{
            aIcon = 'https://maps.google.com/mapfiles/kml/shapes/info-i_maps.png';
        }
        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: aIcon,//icons[markersOld[i][3]].icon,
            animation: animation
        });

        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent("<b>Type: </b><i>" + markersOld[i][3] + "</i><br>"
                + "<b>Desc: </b><i>" + markersOld[i][2]+"</i>");
                infoWindow.open(map, marker);
                marker.setAnimation(null);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
    }
}

// When the button is clicked, fetch the details about the entered flight ident.
$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: '/_getMarkers',
    data: { },
    success : function(result) {
      if (result.error) {
        alert('Failed to fetch');
        return;
      }
      console.log(result);
      addMarkers(result.result);

      //alert('Did not find any useful flights');
    }
  });
});

