import React, { PropTypes } from 'react';
import { Circle } from 'react-leaflet';
import _ from 'lodash';

const circleOpacity = 0.1;
const circleRadius = 500;

const CircleLayer = React.createClass({
    propTypes: {
        dataSet: PropTypes.array
    },

    componentWillMount() {
        this.parseData();
    },

    parseData() {
        let circles = [];
        _.forEach(this.props.dataSet, function (obj) {
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
        _.forEach(this.props.dataSet, function (loc, index) {
            console.log(loc);
            comp = comp.concat(
                <Circle
                    key={index}
                    center={loc}
                    radius={circleRadius}
                    fillOpacity={circleOpacity}
                    stroke={false}
                />
            );
        });
        return comp;
    },

    render() {
        return (
            <div>
                {this.createCircles()}
            </div>
        );
    }
});

export default CircleLayer;
