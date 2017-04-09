import React from 'react';

const CurrentHumidity = React.createClass({
    renderHumidity(){
        var humidity = this.props.weather.currently.humidity;
        if (humidity !== ""){
            humidity = humidity*100 + "%";
        }
        return humidity;
    },
    render() {
        var style = {
            marginTop: "0px",
            marginLeft: "35px",
            fontSize: "60px",
            fontWeight: "bold",
            display: "block",
        }
        return (
            <div>
                <span style={style}>{this.renderHumidity()}</span>
            </div>
        )
    }
});

export default CurrentHumidity;
