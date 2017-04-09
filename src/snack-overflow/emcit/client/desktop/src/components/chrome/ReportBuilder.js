import React from 'react'
import { findDOMNode } from 'react-dom'
import { connect } from 'react-redux'
import {Button} from 'react-toolbox/lib/button';
import Dropdown from 'react-toolbox/lib/dropdown';
import Chip from 'react-toolbox/lib/chip';
import cx from 'classnames'

import CarForm from 'common/components/form/CarForm';
import { PersonForm } from 'common/components/form/PersonForm';
import classes from './ReportBuilder.css'

import { getReports } from 'api'
import { addFilter, removeFilter } from 'actions'



function capitalize(str) {
    return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
}
const CHIP_BAR_HEIGHT = 42;

class ReportBuilder extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            filterForm: null,
            filters: [],
            offsetView: 0
        }
    }

    componentWillMount() {
        this.getReports();
    }

    componentDidUpdate() {
        const node = findDOMNode(this.chipBar)
        const offsetView = node.clientHeight - CHIP_BAR_HEIGHT
        if (node.clientHeight > CHIP_BAR_HEIGHT && this.state.offsetView !== offsetView) {
            this.setState({ offsetView })
        } else if (node.clientHeight === CHIP_BAR_HEIGHT && this.state.offsetView !== 0) {
            this.setState({ offsetView: 0 })
        }
    }

    getReports() {
        this.props.getReports(this.state.filters.map(f => {
            const filter = {entity: f.type, values:{}}
            const filterSchema = data =>
                Object.keys(data).forEach(key => {
                    if (data[key] && key !== 'type') {
                        filter.values[key] = data[key]
                    }
                })
            filterSchema(f);
            return filter;
        }))
    }

    handleFilterSubmit(filter) {
        const filters = this.state.filters.concat(filter)
        this.setState({ filterForm: null, filters }, this.getReports);
    }

    handleDeleteFilter(filter) {
        const filters = this.state.filters.filter(f => f !== filter);
        this.setState({ filters }, this.getReports)
    }

    setFormData(key, value) {
        const { filterFormData } = this.state;
        filterFormData[key] = value;
        this.setState({ filterFormData });
    }

    getChipText(filter) {
        const formatters = {
            vehicle: ({ make, model, color, license_plate }) =>
                [color, make, model].filter(v => !!v).map(capitalize).concat(license_plate ? license_plate.toUpperCase() : []).join(' '),
            person: ({ category, sex, hair_color, eye_color }) => {
                let cat = category ? category.split('_').map(capitalize).join(' ') + ': ' : null;
                let hair = hair ? hair_color + ' hair' : ''
                let eyes = eye_color ? eye_color + ' eyes' : ''
                return [cat, sex, eyes, hair].filter(v => !!v).map(capitalize).join(' ')
            }
        }
        return formatters[filter.type](filter);
    }

    renderForm() {
        const forms = {
            vehicle: (<CarForm onSubmit={this.handleFilterSubmit.bind(this)} />),
            person: <PersonForm onSubmit={this.handleFilterSubmit.bind(this)} filterForm />
        }
        const titles = {
            vehicle: 'Add Vehicle',
            person: 'Add Person'
        }
        return (
            <div>
                <Button label='Cancel' accent raised onClick={e => this.setState({ filterForm: null })} />
                <h3 className={classes.title}>{titles[this.state.filterForm]} Filter</h3>
                {forms[this.state.filterForm]}
            </div>
        )
    }

    render() {
        const { filterForm, filters } = this.state;
        const viewStyle = { marginTop: this.state.offsetView }
        const chipBarClass = cx(classes.chipBar, {[classes.emptyChipBar]: filters.length === 0})
        return (
            <div className={classes.reportBuilder}>
                <div className={chipBarClass} ref={c => this.chipBar = c}>
                    {filters.length === 0 &&
                        <div>No Filters Selected</div>
                    }
                    {filters.map((filter, idx) => (
                        <Chip className={classes.chip} deletable onDeleteClick={e => this.handleDeleteFilter(filter)}>
                            {this.getChipText(filter)}
                        </Chip>
                    ))}
                </div>
                <div className={classes.filters}>
                    { !filterForm &&
                        <div>
                            <h3 className={classes.title}>Filter Reports</h3>
                            <div className={classes.addFilterButton}>
                                <Button
                                  label='Add Vehicle'
                                  raised
                                  primary
                                  onClick={e => this.setState({ filterForm: 'vehicle' }) } />
                            </div>
                            <div className={classes.addFilterButton}>
                                <Button
                                  label='Add Person'
                                  raised primary
                                  onClick={e => this.setState({ filterForm: 'person' }) } />
                            </div>
                        </div>
                    }
                    { filterForm &&
                        this.renderForm()
                    }
                </div>
                <div className={classes.reportView} style={viewStyle}>
                    {this.props.children}
                </div>
            </div>
        )
    }
}

const mapStateToProps = ({ filters }) => ({ filters });

export default connect(mapStateToProps, {
    getReports,
})(ReportBuilder);
