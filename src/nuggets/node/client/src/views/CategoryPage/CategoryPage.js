import React from 'react';
import axios from 'axios';
import Promise from 'bluebird';
import _ from 'lodash';

import Layout from '../Shared/Layout';
import Graph from '../Shared/Graph';
import ButtonSelectorMenu from '../Shared/ButtonSelectorMenu';

const labelMappings = {
    unemployment: 'Regional Unemployment',
    totalWages: 'Total Wages',
    avgWage: 'Average Wage',
    natHHMedIncome: 'National Average Wage',
    housingMed: 'Median Housing Price',
    zhvi: 'Zillow Median Housing Price',
    natUnemployment: 'National Unemployment'
};

const categoryInfoEndpoint = function (categoryId) {
    return `http://localhost:3001/data/for/category/${categoryId}`;
};

const getCategoryEndpoint = function (categoryId) {
    return {
        1:'http://localhost:3001/income',
        2:'http://localhost:3001/housing',
        3:'http://localhost:3001/eugeneData',
        4:'http://localhost:3001/parking',
        5:'http://localhost:3001/weather',
        6:'http://localhost:3001/development/resedential'
    }[categoryId];
};

const CategoryPage = React.createClass({
    getInitialState() {
        return {
            data: {},
            categoryInfo: {},
            selectedKeys: [],
            errors: []
        }
    },
    componentWillMount() {
        Promise.all([
            axios.get(categoryInfoEndpoint(this.props.routeParams.categoryid)),
            axios.get(getCategoryEndpoint(this.props.routeParams.categoryid))
        ])
        .then((res) => {
            this.parseData(res);
        })
        .catch(function (err) {
            this.setState({
                errors: this.state.errors.concat([err])
            });
        });

    },
    parseData(res) {
        const categoryInfo = res.shift().data;
        const categoryData = res.pop().data;

        const dataSets = Object.keys(_.first(categoryData)).filter(key => !_.includes(categoryData, key));
        const organizedData = {};

        dataSets.forEach((dataSet) => {
            organizedData[dataSet] = {
                data: [],
                label: labelMappings[dataSet]
            };
            categoryData.forEach((yearlyData) => {
                organizedData[dataSet].data.push(yearlyData[dataSet]);
            });
        });


        this.setState({
            data: organizedData,
            categoryInfo: categoryInfo.pop(),
            selectedKeys: [_.first(dataSets)]
        });
    },
    updateSelectedKeys(keys) {
        console.log(keys);
        this.setState({selectedKeys: keys});
    },

    renderSelectors() {
        const dataSets = Object.keys(this.state.data).filter(key => key !== 'year');
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
        if (!_.isEmpty(this.state.errors)) {
            return (
                <div>
                    {this.state.errors}
                </div>
            );
        }
        const graphJsx = (
            <div>
                {_.isEmpty(this.state.data) === false && <Graph datasets={this.state.data} selected={this.state.selectedKeys}/>}
            </div>
        );


        return (
            <Layout title={this.state.categoryInfo.name}
                    visualization={graphJsx}
                    description={<p>{this.state.categoryInfo.text}</p>}>
                {this.renderSelectors()}
            </Layout>
        );
    }
});

export default CategoryPage;
