import React from 'react';
import PropTypes from 'prop-types';
import {Grid, Row, Col} from 'react-flexbox-grid';

const Layout = React.createClass({
    propTypes: {
        title: PropTypes.string,
        visualization: PropTypes.element,
        description: PropTypes.element,
        children: PropTypes.element
    },
    render() {
        const {title, description, visualization, children} = this.props;
        return (
            <div className="layout">
                <Grid fluid>
                    <Row center="md">
                        <h1 className="title">{title}</h1>
                    </Row>
                    <Row center="md">
                        <Col xs={9} md={9}>
                            {visualization}
                        </Col>
                    </Row>
                    <Row center="md">
                        <Col xs={9} md={9}>
                            <Row start="xs">
                                <Col xs={12} md={12}>
                                    {description}
                                </Col>
                            </Row>
                            <hr/>
                        </Col>
                    </Row>
                    <Row center="md">
                        <Col xs={9} md={9}>
                            {children}
                        </Col>
                    </Row>
                </Grid>
            </div>
        );
    }
});

export default Layout;
