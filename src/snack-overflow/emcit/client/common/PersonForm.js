import React, {Component} from "react";
import Input from "react-toolbox/lib/input";
import Dropdown from "react-toolbox/lib/dropdown";
import {sexOptions, ageOptions, heightOptions, weightOptions} from 'common/PersonOptions'
import {hairColorOptions, eyeColorOptions} from './PersonOptions'

export class PersonForm extends Component {

    constructor(props) {
        super(props);
        this.state = {
            name: '',
            age: '',
            sex: '',
            height: '',
            weight: '',
            hair_color: '',
            eye_color: '',
            hair_length: '',
            license_plate: '',
            color: '',
            category: props.category,
            other: ''
        };
    }

    updateParent() {
        this.props.onUpdate(this.state)
    }

    render() {
        return (
            <div>
                <a onClick={this.props.onDelete} style={{color: 'red', float: 'right', cursor: 'pointer'}}>X</a>
                <h3>{this.props.id}</h3>
                <hr/>

                <Input
                    label='Name'
                    onChange={name => this.setState({name}, this.updateParent.bind(this))}
                    value={this.state.name}
                />

                <Dropdown
                    auto
                    onChange={age => this.setState({age}, this.updateParent.bind(this))}
                    label='Approx. Age'
                    source={ageOptions}
                    value={this.state.age}
                />

                <Dropdown
                    auto
                    onChange={sex => this.setState({sex}, this.updateParent.bind(this))}
                    label='Sex'
                    source={sexOptions}
                    value={this.state.sex}
                />

                <Dropdown
                    auto
                    onChange={height => this.setState({height}, this.updateParent.bind(this))}
                    label='Approx. Height'
                    source={heightOptions}
                    value={this.state.height}
                />

                <Dropdown
                    auto
                    onChange={weight => this.setState({weight}, this.updateParent.bind(this))}
                    label='Approx. Weight'
                    source={weightOptions}
                    value={this.state.weight}
                />

                <Dropdown
                    auto
                    onChange={hair_color => this.setState({hair_color}, this.updateParent.bind(this))}
                    label='Hair Color'
                    source={hairColorOptions}
                    value={this.state.hair_color}
                />

                <Input
                    label='Hair Length'
                    onChange={hair_length => this.setState({hair_length}, this.updateParent.bind(this))}
                    value={this.state.hair_length}
                />

                <Dropdown
                    auto
                    onChange={eye_color => this.setState({eye_color}, this.updateParent.bind(this))}
                    label='Eye Color'
                    source={eyeColorOptions}
                    value={this.state.eye_color}
                />

                <Input
                    label='Noticeable Characteristics / other'
                    onChange={color => this.setState({color}, this.updateParent.bind(this))}
                    value={this.state.color}
                />

            </div>
        );
    }
}

