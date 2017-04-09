import React, {Component} from "react";
import {uniqueId, map, assign} from "lodash";
import Button from 'react-toolbox/lib/button';
import Avatar from 'react-toolbox/lib/avatar';
import Chip from 'react-toolbox/lib/chip';
import CarForm from 'common/components/form/CarForm'
import classes from './VehiclesReportForm.css'


export class VehiclesReportForm extends Component {

    constructor() {
        super();
        this.state = {
            vehicles: {},
            currentVehicleId: null
        }
    }

    updateParent() {
        this.props.onUpdate(Object.values(this.state))
    }


    getTitle({make, model, color}, id) {
        const description = [make, model, color].filter(v => !!v).join(", ").trim()
        return id + (description && ` [${description}]`)
    }

    renderVehicleChips() {
        return map(this.state.vehicles, (vehicle, id) => {
            if (vehicle)
                return (
                    <Chip key={id} onClick={() => this.setState({currentVehicleId: id})}>
                        <Avatar style={{backgroundColor: '#FF5733'}} icon="directions_car"/>
                        <span>{this.getTitle(vehicle || {}, id)}</span>
                    </Chip>
                )
        })
    }

    onFormSubmit(state) {
        const {currentVehicleId} = this.state;
        const vehicles = assign({}, this.state.vehicles, {[currentVehicleId]: state});
        this.setState({vehicles, currentVehicleId: null}, this.updateParent);
    }

    closeForm() {
        this.setState({currentVehicleId: null});
    }

    addVehicle() {
        const id = uniqueId('vehicles');
        const vehicles = assign({}, this.state.vehicles, {[id]: {}});
        this.setState({vehicles, currentVehicleId: id})
    }

    renderCurrentVehicle() {
        const {currentVehicleId} = this.state;
        const currentVehicle = currentVehicleId && this.state.vehicles[currentVehicleId];

        return currentVehicle &&
            <div className={classes.vehicleReport}>
                <div className={classes.vehicleReportInner}>
                    <a onClick={this.closeForm.bind(this)} style={{color: 'red', float: 'right', cursor: 'pointer'}}>X</a>
                    <h3 >{currentVehicleId}</h3>
                    <CarForm
                        initialState={currentVehicle}
                        vehicle={currentVehicle}
                        onSubmit={this.onFormSubmit.bind(this)}
                        closeForm={this.closeForm.bind(this)}/>
                </div>
            </div>
    }


    render() {
        return (
            <div>
                <h3>Vehicles</h3>
                {this.renderVehicleChips()}
                <div>
                    <Button accent type='button' icon='add_circle_outline'
                            onClick={() => this.addVehicle()}>add</Button>
                </div>
                {this.renderCurrentVehicle()}
            </div>
        )
    }

}

