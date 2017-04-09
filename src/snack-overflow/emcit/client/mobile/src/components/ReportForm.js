import React, {Component} from 'react';
import Input from 'react-toolbox/lib/input';
import FontIcon from 'react-toolbox/lib/font_icon';
import DatePicker from 'react-toolbox/lib/date_picker';
import TimePicker from 'react-toolbox/lib/time_picker';
import Button from 'react-toolbox/lib/button';
import GeoLocation from "./GeoLocation";
import {VehiclesReportForm} from "./VehiclesReportForm";
import {PeopleReportForm} from "./PeopleReportForm";


import classes from './ReportForm.css'

export class ReportForm extends Component {

    constructor() {
        super();
        this.state = {
            date: new Date(),
            details: '',
            vehicles: [],
            people: [],
            location: '',
            room_number: ''
        };
    }

    onSubmit(e){
        e.preventDefault();
        this.props.onSubmit(this.state);
    }

    render() {
        return (
            <div className={classes.reportContainer}>
                <form onSubmit={this.onSubmit.bind(this)}>
                    <h1><FontIcon style={{fontSize: '1.5em', marginRight: 5, bottom: '-.2em', position: 'relative'}} value='note_add' /> Incident Report</h1>

                    <DatePicker
                        label='Date of Incidence'
                        sundayFirstDayOfWeek
                        onChange={date => this.setState({date})}
                        value={this.state.date} />

                    <TimePicker
                        label='Time of Incidence'
                        onChange={date => this.setState({date})}
                        value={this.state.date}
                        format='ampm'
                    />


                    <GeoLocation
                        placeholder='Location of Incident'
                        style={{paddingTop: 50}}
                        onUpdate={({lat, lng, address}) => this.setState({
                            location: address,
                            geo_latitude: lat,
                            geo_longitude: lng
                        })}/>

                    <Input
                        label='Room Number'
                        onChange={room_number => this.setState({room_number})}
                        value={this.state.room_number}
                    />


                    <PeopleReportForm onUpdate={people => {this.setState({people})}} />

                    <VehiclesReportForm onUpdate={vehicles => {this.setState({vehicles})}} />

                    <Input
                        id='incidentDetails'
                        multiline={true}
                        className={classes.details}
                        value={this.state.details}
                        label='Incident Details'
                        hint='Please write everything you witness in as much detail as possible.
                            Any detail could help.'
                        onChange={details => this.setState({details})}/>

                    <Button type='submit' label='Submit' className={classes.submitButton} raised primary/>

                </form>
            </div>
        );
    }
}

