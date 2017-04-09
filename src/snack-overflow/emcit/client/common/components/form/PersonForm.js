import React, {Component} from "react";
import Input from "react-toolbox/lib/input";
import Dropdown from "react-toolbox/lib/dropdown";
import {Button} from 'react-toolbox/lib/button';
import {sexOptions, ageOptions, heightOptions, weightOptions} from './PersonOptions'
import {hairColorOptions, eyeColorOptions} from './PersonOptions'

const categoryOptions = [
    { value: 'suspicious_person', label: 'Suspicious Person' },
    { value: 'buyer', label: 'Buyer' },
    { value: 'victim', label: 'Victim' }
]

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
            _category: '',
            other: ''
        };
    }

    updateParent() {
    }

    handleSubmit() {
        const { sex, hair_color, eye_color, _category: category } = this.state;
        this.props.onSubmit({ sex, hair_color, eye_color, category, type: 'person' });
    }

    render() {
        const { filterForm } = this.props;
        return (
            <div>
                { !filterForm && <a onClick={this.props.onDelete} style={{color: 'red', float: 'right', cursor: 'pointer'}}>X</a>}
                { !filterForm && <h3>{this.props.id}</h3> }
                { !filterForm && <hr/> }

                { !filterForm && <Input
                    label='Name'
                    onChange={name => this.setState({name}, this.updateParent.bind(this))}
                    value={this.state.name}
                /> }

                { !filterForm && <Dropdown
                    auto
                    onChange={age => this.setState({age}, this.updateParent.bind(this))}
                    label='Approx. Age'
                    source={ageOptions}
                    value={this.state.age}
                /> }

                { filterForm && <Dropdown
                    label='Type of Person'
                    onChange={_category => this.setState({_category}) }
                    source={categoryOptions}
                    value={this.state._category}
                /> }

                <Dropdown
                    auto
                    onChange={sex => this.setState({sex}, this.updateParent.bind(this))}
                    label='Sex'
                    source={sexOptions}
                    value={this.state.sex}
                />

                { !filterForm && <Dropdown
                    auto
                    onChange={height => this.setState({height}, this.updateParent.bind(this))}
                    label='Approx. Height'
                    source={heightOptions}
                    value={this.state.height}
                /> }

                { !filterForm  && <Dropdown
                    auto
                    onChange={weight => this.setState({weight}, this.updateParent.bind(this))}
                    label='Approx. Weight'
                    source={weightOptions}
                    value={this.state.weight}
                /> }

                <Dropdown
                    auto
                    onChange={hair_color => this.setState({hair_color}, this.updateParent.bind(this))}
                    label='Hair Color'
                    source={hairColorOptions}
                    value={this.state.hair_color}
                />

                { !filterForm && <Input
                    label='Hair Length'
                    onChange={hair_length => this.setState({hair_length}, this.updateParent.bind(this))}
                    value={this.state.hair_length}
                /> }

                <Dropdown
                    auto
                    onChange={eye_color => this.setState({eye_color}, this.updateParent.bind(this))}
                    label='Eye Color'
                    source={eyeColorOptions}
                    value={this.state.eye_color}
                />

                { !filterForm && <Input
                    label='Noticeable Characteristics / other'
                    onChange={color => this.setState({color}, this.updateParent.bind(this))}
                    value={this.state.color}
                /> }

                { filterForm && <Button label='Add Person' raised primary onClick={this.handleSubmit.bind(this)} />}
            </div>
        );
    }
}
