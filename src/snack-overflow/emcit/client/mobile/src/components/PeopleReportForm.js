import React, {Component} from "react";
import {uniqueId, map, assign} from "lodash";
import {PersonForm} from "./PersonForm"
import {categoryOptions} from "common/PersonOptions"
import Button from 'react-toolbox/lib/button';
import Avatar from 'react-toolbox/lib/avatar';
import Chip from 'react-toolbox/lib/chip';
import classes from './PeopleReportForm.css'


export class PeopleReportForm extends Component {

    constructor() {
        super();
        this.state = {
            people: {},
            currentPersonId: null
        }
        this.counter = new Counter();
    }

    updateParent() {
        this.props.onUpdate(Object.values(this.state.people))
    }

    getTitle({age, sex, name}, id) {
        const description = [name, sex, age].filter(v => !!v).join(", ").trim()
        return id + (description && ` [${description}]`)
    }

    renderPersonChips(typeValue) {
        return map(this.state.people, (person, id) => {
            if (person && person.category === typeValue)
                return (
                    <Chip key={id} onClick={() => this.setState({currentPersonId: id})}>
                        <Avatar style={{backgroundColor: 'deepskyblue'}} icon="perm_identity"/>
                        <span>{this.getTitle(person || {}, id)}</span>
                    </Chip>
                )
        })
    }

    onFormSubmit(state) {
        const {currentPersonId} = this.state;
        const people = assign({}, this.state.people, {[currentPersonId]: state});
        this.setState({people, currentPersonId: null}, this.updateParent);
    }

    closeForm() {
        this.setState({currentPersonId: null});
    }

    addForm(category) {
        const id = this.counter.getNextIdFor(category);
        const people = assign({}, this.state.people, {[id]: {category}});
        this.setState({people, currentPersonId: id})
    }

    renderCurrentPerson() {
        const {currentPersonId} = this.state;
        const currentPerson = currentPersonId && this.state.people[currentPersonId];

        return currentPerson &&
            <div className={classes.personReport}>
                <PersonForm
                    id={currentPersonId}
                    initialState={currentPerson}
                    className={classes.personReportInner}
                    person={currentPerson}
                    onSubmit={this.onFormSubmit.bind(this)}
                    closeForm={this.closeForm.bind(this)}/>
            </div>
    }


    render() {
        return (
            <div>
                {categoryOptions.map(({value, label}) => {
                    return (
                        <div key={value}>
                            <h3>{label}</h3>
                            {this.renderPersonChips(value)}
                            <div>
                                <Button accent type='button' icon='add_circle_outline'
                                        onClick={() => this.addForm(value)}>add</Button>
                            </div>

                        </div>)
                })}
                {this.renderCurrentPerson()}
            </div>
        );
    }
}

class Counter {

    constructor() {
        this.keyHolder = {}
    }

    getNextIdFor(str) {
        const currentCount = this.keyHolder[str] || 0;
        this.keyHolder[str] = currentCount + 1;
        return str + this.keyHolder[str];
    }
}
