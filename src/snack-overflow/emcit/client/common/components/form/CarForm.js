import React from 'react'
import Button from 'react-toolbox/lib/button';
import Dropdown from 'react-toolbox/lib/dropdown';
import Input from 'react-toolbox/lib/input';

import FormErrors from './FormErrors';


const makes = [
    { value: 'ford', label: 'Ford' },
    { value: 'honda', label: 'Honda' },
    { value: 'subaru', label: 'Subaru' }
]

const models = {
    ford: [
        { value: 'f150', label: 'F150' },
        { value: 'pinto', label: 'Pinto' }
    ],
    honda: [
        { value: 'accord', label: 'Accord' },
        { value: 'civic', label: 'Civic' }
    ],
    subaru: [
        { value: 'forester', label: 'Forester'},
        { value: 'outback', label: 'Outback'}
    ]
}

const allModels = Object.keys(models).reduce((arr, make) =>
    arr.concat(models[make].map(model => Object.assign({}, model, {make})))
, [])

const color = [
    { value: 'blue', label: 'Blue' },
    { value: 'red', label: 'Red' },
    { value: 'yellow', label: 'Yellow'}
]

export default class CarForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            make: null,
            model: null,
            color: null,
            license_plate: '',
            errors: []
        }
    }

    handleSubmit(e) {
        e.stopPropagation();
        e.preventDefault();
        const { make, model, color, license_plate } = this.state;
        if (!make && !model && !color && !license_plate) {
            return this.setState({ errors: ['Please select at least a Make, Model, Color or specify License Plate'] })
        }
        this.props.onSubmit({ make, model, color, license_plate, type: 'vehicle' });
    }

    setMake(make) {
        const update = { make }
        if (this.state.model && !models[make].some(m => m.value === this.state.model)) {
            update.model = null;
        }
        this.setState(update);
    }

    setModel(model) {
        const update = { model }
        if (!this.state.make) {
            update.make = allModels.find(m => m.value === model).make;
        }
        this.setState(update);
    }

    render() {
        const modelSource = this.state.make ? models[this.state.make] : allModels;
        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <FormErrors errors={this.state.errors} />
                <Dropdown
                  allowBlank
                  label="Make"
                  source={makes}
                  onChange={make => this.setMake(make)}
                  value={this.state.make}
                />
                <Dropdown
                  allowBlank
                  label="Model"
                  source={modelSource}
                  onChange={model => this.setModel(model)}
                  value={this.state.model}
                />
                <Dropdown
                  allowBlank
                  label="Color"
                  source={color}
                  onChange={color => this.setState({color})}
                  value={this.state.color}
                />
                <Input
                  type='text'
                  label='License Plate'
                  name='license_plate'
                  value={this.state.license_plate}
                  onChange={license_plate => this.setState({license_plate})}
                />
                <Button type='submit' raised primary>Add Vehicle</Button>
            </form>
        )
    }
}
