import React, { PropTypes }  from 'react';
import axios from 'axios';
import _ from 'lodash';
import { Map, TileLayer } from 'react-leaflet';
import CircleLayer from './components/circleLayer';

const circleOpacity = 0.1;
const circleRadius = 500;
const eugeneBPData = 'http://localhost:3001/development/residential';

const stamenTonerTiles = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const stamenTonerAttr = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';
const mapCenter = [44.05207, -123.0009]; // Eugene

const MapComponent = React.createClass({
    propTypes: {
        circleData: PropTypes.array
    },
    getInitialState() {
        return {
            zoomBy: 0,
            zoomLevel: 12,
            errors: []
        }
    },

    componentDidMount() {
        this.parseData();
    },

    handleZoom(arg) {
        let zoomBy = (arg.target._zoom*25);
        this.setState({ zoomBy });
    },

    renderExtraLayers() {
        console.log(this.props.additionalLayers);
        return this.props.additionalLayers.map(layer => layer);
    },

    parseData() {
        let circles = [];
        _.forEach(this.props.circleData, function (obj) {
            if (!(obj.lat === null || obj.lng === null)) {
                circles.push([parseFloat(obj.lat), parseFloat(obj.lng)]);
            }
        });

        this.setState({
            circles: circles
        });
    },

    createCircles() {
        let comp = [];
        _.forEach(this.props.circleData, function (loc, index) {
            console.log(loc);
            comp = comp.concat(
                <Circle
                    key={index}
                    center={loc}
                    radius={circleRadius - this.state.zoomBy}
                    fillOpacity={circleOpacity}
                    stroke={false}
                />
            );
        });
        return comp;
    },


    render() {
        if (!_.isEmpty(this.state.errors)) {
            return (
                <div>
                    {this.state.errors}
                </div>
            );

        }

        let zoomLevel = this.state.zoomLevel;
        return (
            <div className="map" id="map">
                <Map
                    center={mapCenter}
                    zoom={zoomLevel}
                    onZoom={this.handleZoom}
                >
                    <TileLayer
                        url={stamenTonerTiles}
                        attribute={stamenTonerAttr}
                    />
                    {this.createCircles()}
                </Map>
            </div>

        );
    }
});

const MapPage = React.createClass({
    getInitialState() {
        return {
            circles: []
        };
    },
    componentWillMount() {
        axios.get(eugeneBPData)
            .then((res) => {
                this.setState({
                    circles: res.data
                });
            })
            .catch((err) => {
                const errors = this.state.errors.concat([err]);
                this.setState({errors});
            });

    },
    render() {
        return (
            <div>
                <MapComponent circleData={this.state.circles} />
            </div>
        );
    }
});

export default MapPage;
