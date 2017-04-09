import React from 'react';

const CurrentTemp = React.createClass({
    renderTemperature(){
        var temperature = this.props.weather.currently.temperature;
        if (temperature === ""){
            temperature = Math.round(temperature) + "°";
        }
        return temperature;
    },
    render() {
        var style = {
            marginTop: "-10px",
            marginLeft: "40px",
            fontSize: "80px",
            fontWeight: "bold",
            display: "block",
        }
        return (
            <div>
                <span style={style}>{this.renderTemperature()}</span>
            </div>
        )
    }
});

export default CurrentTemp;
