import React from 'react';
import Skycons from 'react-skycons';


const CurrentIcon = React.createClass({
    getIcon(){
        var icon = this.props.weather.currently.icon;
        if (icon !== ""){
            icon = icon.toUpperCase();
            icon = icon.replace(/[_-]/g, "_"); 
        }
        console.log('icon', icon);
        return icon;
    },
    renderTemperature(){
        var temperature = this.props.weather.currently.temperature;
        if (temperature !== ""){
            temperature = Math.round(temperature) + "°";
        }
        return temperature;
    },
    render() {
        var style = {
            width: "230px",
            marginLeft:"-20px",
            marginTop:"10px"
        }
        return (
            <div>
                <Skycons style={style} color='#333' autoplay={true} icon={this.getIcon()}/>
            </div>
        )
    }
});

export default CurrentIcon;
