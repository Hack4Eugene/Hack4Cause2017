import React, {Component} from "react";
import Input from "react-toolbox/lib/input";
import Dropdown from "react-toolbox/lib/dropdown";
import Button from "react-toolbox/lib/button";
import {sexOptions, ageOptions, heightOptions, weightOptions} from 'common/PersonOptions'
import {hairColorOptions, eyeColorOptions} from 'common/PersonOptions'

export class PersonForm extends Component {

    constructor(props) {
        super(props);
        this.state = props.initialState;
    }


    updateParent() {
        this.props.onUpdate(this.state)
    }


    render() {
        return (
            <div className={this.props.className}>

                    <a onClick={this.props.closeForm.bind(this)} style={{color: 'red', float: 'right', cursor: 'pointer'}}>X</a>
                    <h3>{this.props.id}</h3>
                    <hr/>

                    <Input
                        label='Name'
                        onChange={name => this.setState({name})}
                        value={this.state.name}
                    />

                    <Dropdown
                        auto
                        onChange={age => this.setState({age})}
                        label='Approx. Age'
                        source={ageOptions}
                        value={this.state.age}
                    />

                    <Dropdown
                        auto
                        onChange={sex => this.setState({sex})}
                        label='Sex'
                        source={sexOptions}
                        value={this.state.sex}
                    />

                    <Dropdown
                        auto
                        onChange={height => this.setState({height})}
                        label='Approx. Height'
                        source={heightOptions}
                        value={this.state.height}
                    />

                    <Dropdown
                        auto
                        onChange={weight => this.setState({weight})}
                        label='Approx. Weight'
                        source={weightOptions}
                        value={this.state.weight}
                    />

                    <Dropdown
                        auto
                        onChange={hair_color => this.setState({hair_color})}
                        label='Hair Color'
                        source={hairColorOptions}
                        value={this.state.hair_color}
                    />

                    <Input
                        label='Hair Length'
                        onChange={hair_length => this.setState({hair_length})}
                        value={this.state.hair_length}
                    />

                    <Dropdown
                        auto
                        onChange={eye_color => this.setState({eye_color})}
                        label='Eye Color'
                        source={eyeColorOptions}
                        value={this.state.eye_color}
                    />

                    <Input
                        label='Noticeable Characteristics / other'
                        onChange={color => this.setState({color})}
                        value={this.state.color}
                    />


                    <Button type='button' onClick={() => this.props.onSubmit(this.state)}
                            label='Submit' style={{float: 'right'}} raised primary/>

            </div>
        );
    }
}

