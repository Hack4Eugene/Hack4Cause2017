import React from 'react';
import axios from 'axios';
import _ from 'lodash';
import { Grid, Row, Col } from 'react-flexbox-grid';
import CategoryIcon from './Components/CategoryIcon';

import Income from '../../images/profit.png';
import Tie from '../../images/tie.png';
import Tool from '../../images/tool.png';
import Transport from '../../images/transport.png';
import Home from '../../images/home.png';
import Cloud from '../../images/cloud.png';

const iconImageMapping = {
    'profit.png': Income,
    'tie.png': Tie,
    'tool.png': Tool,
    'transport.png': Transport,
    'home.png': Home,
    'cloud.png': Cloud
};

const categoriesEndpoint = 'http://localhost:3001/categories';

export default React.createClass({
    getInitialState() {
        return {
            categories: [],
            errors: []
        }
    },

    componentWillMount() {
        axios.get(categoriesEndpoint)
            .then((res) => {
                this.setState({
                    categories: res.data
                });
            })
            .catch((err) => {
                const errors = this.state.errors.concat([err]);
                this.setState({errors});
            });
    },
    renderIcons() {
        const mappedCategories = [].concat(this.state.categories);

        mappedCategories.shift();

        const categoryIcons = mappedCategories
            .map((category, index) => {
                const icon = iconImageMapping[category.icon];
                const name = category.name;

                return (
                    <div key={index}>
                        <Col xs={3} md={3}>
                            <CategoryIcon icon={icon} name={name} categoryId={category.id} />
                        </Col>
                    </div>
                )
            });

        return (
            <div className="homepage-container">
                <Row start="xs" around="xs">{categoryIcons}</Row>
            </div>
        );
    },

    render() {
        return (
            <Grid fluid>
                <Row center="md">
                    <h1 className="title">Welcome to Eugene</h1>
                </Row>
                <Row center="md">
                    <h3 className="subtext">What would you like to learn about?</h3>
                </Row>
                {this.renderIcons()}
            </Grid>
        );
    }
});