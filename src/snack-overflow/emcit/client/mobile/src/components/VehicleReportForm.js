import React, {Component} from "react";
import Input from "react-toolbox/lib/input";
import Button from "react-toolbox/lib/button";

export class VehicleReportForm extends Component {

    constructor() {
        super();
        this.state = {
            make: '',
            model: '',
            license_plate: '',
            color: ''
        };
    }

    updateParent() {
        this.props.onUpdate(this.state)
    }


    render() {
        return (
            <div className={this.props.className}>

                <hr/>
                <Input
                    label='Make'
                    onChange={make => this.setState({make})}
                    value={this.state.make}
                />

                <Input
                    label='Model'
                    onChange={model => this.setState({model})}
                    value={this.state.model}
                />

                <Input
                    label='License Plate'
                    onChange={license_plate => this.setState({license_plate})}
                    value={this.state.license_plate}
                />

                <Input
                    label='Color'
                    onChange={color => this.setState({color})}
                    value={this.state.color}
                />


                <Button type='button' onClick={() => this.props.onSubmit(this.state)}
                        label='Submit' style={{float: 'right'}} raised primary/>

            </div>
        );
    }
}

