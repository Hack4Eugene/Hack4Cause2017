import {Component, ElementRef} from '@angular/core';

import 'leaflet-map';
import 'style-loader!./leafletMaps.scss';

@Component({
  selector: 'leaflet-maps',
  templateUrl: './leafletMaps.html'
})
export class LeafletMaps {

  constructor(private _elementRef:ElementRef) {
  }

  ngAfterViewInit() {
    let el = this._elementRef.nativeElement.querySelector('.leaflet-maps');

    L.Icon.Default.imagePath = 'assets/img/theme/vendor/leaflet';
    // var map = L.map(el).setView([51.505, -0.09], 13);
    var map = L.map(el).setView([44.0489713,-123.0944854], 14);
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // const url = 'http://catalog.civicdashboards.com/dataset/55f42995-22c7-4443-9b3d-c6b7c6455021/resource/90bb52c9-43b5-4512-a669-77de23f6705a/download/56a4b377822a4b06813e4da751825d91temp.geojson';
    const citiesURL = 'assets/geo/orcities.geojson';
    var citiesSearch = [];
    var cities = L.geoJson(null, {
      style: function (feature) {
        return {
          color: "blue",
          fill: false,
          opacity: 1,
          clickable: false
        };
      },
      onEachFeature: function (feature, layer) {
        citiesSearch.push({
          name: layer.feature.properties.name,
          source: "Cities",
          id: L.stamp(layer),
          bounds: layer.getBounds()
        });
      }
    });
    $.getJSON(citiesURL, function (data) {
      cities.addData(data);
    });
    cities.addTo(map);

    var neighborhoods;

    var info = L.control();

    info.onAdd = function (map) {
      this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
      this.update();
      return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function (props) {
      console.log('info.update', props);
      // this._div.innerHTML = '<h4>Population Density</h4>' +  (props ?
      //   '<b>' + props.name + '</b><br />' + props.density + ' people / mi<sup>2</sup>'
      //   : 'Hover over a neighborhood');
      this._div.innerHTML = props ? ('<h5>Neighborhood</h5>' + props.NAME + '<h6>Population (2000)</h6>' + props.POP_2000) :
                                '???';
      this._div.style.color = 'black';
      this._div.style.padding = '5px';
      this._div.style.backgroundColor = 'aliceblue';
      this._div.style.border = '1px solid lightgray';
    };

    info.addTo(map);
    //info.valueOf()._icon.style.color = 'black';

    function highlightFeature(e) {
      var layer = e.target;
      layer.setStyle({
        weight: 5,
        color: '#55F',
        dashArray: '',
        fillOpacity: 0.7
       });

      if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
      }
      info.update(layer.feature.properties);
    }

    function resetHighlight(e) {
      neighborhoods.resetStyle(e.target);
    }

    function zoomToFeature(e) {
      console.log('clicking')
      map.fitBounds(e.target.getBounds());
    }

    const neighborhoodsURL = 'assets/geo/COE_Neighborhoods_7April2017.geojson';
    var neighborhoodsSearch = [];
    neighborhoods = L.geoJson(null, {
      style: function (feature) {
        return {
          color: "green",
          weight: 3,
          fill: false,
          opacity: 1
        };
      },
      onEachFeature: function (feature, layer) {
        // console.log('start', feature, layer, layer.feature.properties.NAME);
        var label = L.marker(layer.getBounds().getCenter(), {
          icon: L.divIcon({
            className: 'label',
            html: feature.properties.NAME,
            iconSize: [80, 20]
          })
        }).addTo(map);
        label.valueOf()._icon.style.color = 'black';

        //layer.on({
          //mouseover: highlightFeature,
          //mouseout: resetHighlight,
          //click: zoomToFeature
        //});

        // console.log('layer', layer, feature.properties.NAME);
        layer.bindPopup(
          feature.properties.NAME + '\nPopulation(2000):' + feature.properties.POP_2000,
          {
            closeButton: false,
            offset: L.point(0, -20)
          });
        label.on('mouseover', function(e) { console.log('label mouseover', feature.properties.NAME); layer.openPopup(); });
        label.on('mouseout', function(e) { console.log('label mouseout', feature.properties.NAME); layer.closePopup(); });
        label.on('click', function(e) { console.log('label click', feature.properties.NAME); layer.openPopup(); });
        layer.on('mouseover', function(e) { console.log('layer mouseover', feature.properties.NAME); highlightFeature(e);});
        layer.on('mouseout', function(e) { console.log('layer mouseout', feature.properties.NAME); resetHighlight(e);});
        layer.on('click', function (e) {console.log('click', feature.properties.NAME, e.target)});


        neighborhoodsSearch.push({
          name: layer.feature.properties.NAME,
          source: "neighborhoods",
          id: L.stamp(layer),
          bounds: layer.getBounds()
        });
      }
    });


    $.getJSON(neighborhoodsURL, function (data) {
      neighborhoods.addData(data);
    });
    neighborhoods.addTo(map);


    L.marker([44.0489713,-123.0944854]).addTo(map)
      .bindPopup('Downtown Athletic Club.<br> Hack for a Cause.')
      .openPopup();
  }
}
