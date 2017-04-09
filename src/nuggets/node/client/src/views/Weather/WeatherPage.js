import React from 'react';
import axios from 'axios';
import _ from 'lodash';
import { Grid, Row, Col } from 'react-flexbox-grid';
import Forecast from './Components/Forecast.js';
import CurrentTemp from './Components/CurrentTemp.js';
import CurrentIcon from './Components/CurrentIcon.js';
import CurrentWind from './Components/CurrentWind.js';
import CurrentHumidity from './Components/CurrentHumidity.js';

const weatherEndpoint = 'http://localhost:3001/weather-forecast';


export default React.createClass({
    getInitialState() {
        return {
            currently: {
                temperature: "",
                windSpeed: "",
                icon: "",
                humidity: ""
            },
            daily: {
                summary: ""
            }
        }
    },
    componentWillMount() {
        axios.get(weatherEndpoint)
            .then((res) => {
                // this.setState({
                //     categories: res.data
                // });
                this.setState(JSON.parse(res.data.text))
            })
            .catch((err) => {
                const errors = this.state.errors.concat([err]);
                this.setState({errors});
            });
    },
    render() {
        var style = {
            marginLeft: "20px"
        };
        var containerStyle = {
            marginLeft: "20px", height: "140px"
        }
        return (
            <Grid fluid>
                <Row>
                    <Col md={3} xs={3}>
                        <div className="card">
                            <div className="container" style={containerStyle}>
                                <h3 style={{ marginBottom: "0px", paddingBottom: "0px", marginLeft: "20px"}}>Current Temperature</h3>
                                <CurrentTemp weather={this.state}></CurrentTemp>
                            </div>
                        </div>
                    </Col>
                    <Col md={3} xs={3}>
                        <div className="card">
                            <div className="container" style={containerStyle}>
                                <CurrentIcon  weather={this.state}></CurrentIcon>
                            </div>
                        </div>
                    </Col>
                    <Col md={3} xs={3}>
                        <div className="card">
                            <div className="container" style={containerStyle}>
                                <h3 style={{ marginBottom: "0px", paddingBottom: "0px", marginLeft: "20px"}}>Current Wind Speed</h3>
                                <CurrentWind weather={this.state}></CurrentWind>
                            </div>
                        </div>
                    </Col>
                    <Col md={3} xs={3}>
                        <div className="card">
                            <div className="container" style={containerStyle}>
                                <h3 style={{ marginBottom: "0px", paddingBottom: "0px", marginLeft: "20px"}}>Current Humidity</h3>
                                <CurrentHumidity weather={this.state}></CurrentHumidity>
                            </div>
                        </div>
                    </Col>
                </Row>
                <Row>
                    <Col md={12} xs={12}>
                        <div className="card">
                            <div className="container" style={style}>
                                <h3>Weather Forecast</h3>
                                <Forecast weather={this.state}></Forecast>
                            </div>
                        </div>
                    </Col>
                </Row>
                <Row>
                    <Col md={12} xs={12}>
                        <div className="card">
                            <div className="container" style={style}>
                                <h3>Monthly Averages</h3>
                            </div>
                        </div>
                    </Col>
                </Row>
            </Grid>
        );
    }
});