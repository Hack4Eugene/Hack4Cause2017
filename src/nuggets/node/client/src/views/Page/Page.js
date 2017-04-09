import React from 'react';
import axios from 'axios';
import _ from 'lodash';
import Layout from '../Shared/Layout';
import Graph from '../Shared/Graph';
import ButtonSelectorMenu from '../Shared/ButtonSelectorMenu';

const eugeneOverviewEndpoint = 'http://localhost:3001/eugeneData';
const ignoreFields = ['index', 'rentMed', 'year'];

const labelMappings = {
    unemployment: 'Regional Unemployment',
    totalWages: 'Total Wages',
    avgWage: 'Average Wage',
    natHHMedIncome: 'National Average Wage',
    housingMed: 'Median Housing Price',
    zhvi: 'Zillow Median Housing Price',
    natUnemployment: 'National Unemployment'
};

export default React.createClass({
    getInitialState() {
        return {
            data: {},
            selectedKeys: ['housingMed', 'zhvi'],
            errors: []
        }
    },

    componentWillMount() {
        axios.get(eugeneOverviewEndpoint)
            .then((res) => {
                this.parseData(res.data);
            })
            .catch((err) => {
                const errors = this.state.errors.concat([err]);
                this.setState({errors});
            });
    },

    parseData(returnedData) {
        const dataSets = Object.keys(_.first(returnedData)).filter(key => !_.includes(ignoreFields, key));
        const organizedData = {};

        dataSets.forEach((dataSet) => {
            organizedData[dataSet] = {
                data: [],
                label: labelMappings[dataSet]
            };
            returnedData.forEach((yearlyData) => {
                organizedData[dataSet].data.push(yearlyData[dataSet]);
            });
        });

        this.setState({
            data: organizedData
        });
    },

    updateSelectedKeys(keys) {
        this.setState({selectedKeys: keys});
    },

    renderSelectors() {
        const dataSets = Object.keys(labelMappings);
        const buttonConfig = {};

        dataSets.forEach((set) => {
            const text = labelMappings[set];
            buttonConfig[set] = {
                label: <span>{text}</span>
            };
        });

        return (
            <ButtonSelectorMenu defaultSelected={this.state.selectedKeys} buttonConfig={buttonConfig} onSelectCallback={this.updateSelectedKeys} />
        );
    },

    render() {
        console.log(this.state);
        if (!_.isEmpty(this.state.errors)) {
            return (
                <div>
                    {this.state.errors}
                </div>
            );
        }

        const descriptionJsx = (
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut doloribus enim in minima modi molestiae, nostrum soluta temporibus. Explicabo porro sequi tenetur. Autem, eligendi, error. Facilis iste modi sequi similique.</p>
        );
        const graphJsx = (
            <div>
                {_.isEmpty(this.state.data) === false && <Graph title={"Income Change"} datasets={this.state.data} selected={this.state.selectedKeys}/>}
            </div>
        );

        return (
                <Layout title={"Income"}
                        visualization={graphJsx}
                        description={descriptionJsx}>
                    {this.renderSelectors()}
                </Layout>
        );
    }
});
