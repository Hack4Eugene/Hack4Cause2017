import React from 'react'
import { findDOMNode } from 'react-dom'
import { connect } from 'react-redux';

import classes from './ReportMapPage.css'

/*const lats = []
const lngs = []
window.lats = lats;
window.lngs = lngs;*/
class ReportMapPage extends React.Component {

    constructor(props) {
        super(props)
        this.markers = [];
    }

    componentDidMount() {
        const mapContainer = findDOMNode(this.mapContainer)
        const map = window.map = this.map = L.map(this.mapContainer).setView([45.11326925230233, -122.46597290039064], 9)
            /*.on('click', e => {
                lats.push(e.latlng.lat)
                lngs.push(e.latlng.lng)
                console.log(lats.length)
            });*/
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        this.renderMarkers(this.props.list);
    }

    componentWillReceiveProps(nextProps) {
        this.renderMarkers(nextProps.list)
    }

    renderMarkers(list) {
        this.markers.map(marker => this.map.removeLayer(marker));
        this.markers = []
        list.forEach(report => {
            if (!report.lat || !report.lng) {
                return;
            }
            const marker = L.marker([report.lat, report.lng]);
                marker.addTo(this.map)
                .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            this.markers.push(marker)
        });
    }

    render() {
        return (
            <div className={classes.mapContainer} ref={e => this.mapContainer = e}></div>
        )
    }
}

const mapStateToProps = ({ reports: { list } }) => ({ list });

export default connect(mapStateToProps, {
})(ReportMapPage);
