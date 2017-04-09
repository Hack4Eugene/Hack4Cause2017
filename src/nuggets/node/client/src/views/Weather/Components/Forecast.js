import React from 'react';

const Forecast = React.createClass({
    renderForecast(){
        var summary = this.props.weather.daily.summary;
        return summary;
    },
    render() {
        var style = {
            marginTop: "10px",
            marginBottom: "20px",
            marginLeft: "11px",
            fontSize: "16px",
            display: "block",
        }
        return (
            <div>
                <span style={style}>{this.renderForecast()}</span>
            </div>
        )
    }
});

export default Forecast;
