import React from 'react';
import _ from 'lodash';

const CurrentWind = React.createClass({
    renderWindspeed(){
        return _.isEmpty(this.props.weather.currently.windSpeed)
            ? ''
            : `${this.props.weather.currently.windSpeed} mph`;
    },
    render() {
        const style = {
            marginTop: "10px",
            marginLeft: "11px",
            fontSize: "40px",
            fontWeight: "bold",
            display: "block",
        }
        return (
            <div>
                <span style={style}>{this.renderWindspeed()}</span>
            </div>
        )
    }
});

export default CurrentWind;
