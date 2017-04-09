import React from 'react';
import PropTypes from 'prop-types';
import Selector from './Selector';
import { Row, Col } from 'react-flexbox-grid';
import _ from 'lodash';

/*
 buttonConfig: {
 housingButton: {
 label: <h3>Housing</h3>
 },
 weatherButton: {
 label: <h3>Weather</h3>
 }
 }
 function onSelectCallback(buttons) {
 buttons => [
 "housingButton",
 "weatherButton"
 ] if both selected
 buttons => [
 "housingButton"
 ] if housing button only selected
 }

 */

const ButtonSelector = React.createClass({
    propTypes() {
        return {
            id: PropTypes.string.isRequired,
            selectorElement: PropTypes.element.isRequired,
            isSelected: PropTypes.bool.isRequired,
            onSelectorClicked: PropTypes.func.isRequired
        };
    },
    render() {
        const {selectorElement, isSelected, onSelectorClicked, id} = this.props;
        return (
            <Col xs={3} md={3}>
                <Selector
                    selectorElement={selectorElement}
                    selectorField={id}
                    isSelected={isSelected}
                    onSelectorClicked={onSelectorClicked}
                />
            </Col>

        );

    }
});

const ButtonSelectorMenu = React.createClass({
    propTypes: {
        buttonConfig: PropTypes.object.isRequired,
        onSelectCallback: PropTypes.func.isRequired,
        defaultSelected: PropTypes.array
    },
    getInitialState() {
        return {
            buttonConfig: this.props.buttonConfig,
            selected: _.clone(this.props.defaultSelected) || []
        };
    },
    selectorClicked(id) {
        return () => {
            let selected = _.clone(this.state.selected);
            let buttonConfig = _.cloneDeep(this.state.buttonConfig);

            if (!_.includes(selected, id)) {
                if (selected.length >= 2) {
                    selected.shift();
                }
                selected.push(id);
            } else {
                selected = selected.filter((item) => item !== id);
            }

            this.setState({
                buttonConfig,
                selected
            }, () => this.props.onSelectCallback(selected));
        };
    },
    render() {
        const {buttonConfig} = this.props;
        const buttonMenuJsx = _.keys(buttonConfig)
            .map((buttonId, index) => {
                return (
                    <div key={index}>
                        <Col xs={3} md={3}>
                            <ButtonSelector id={buttonId}
                                            selectorElement={buttonConfig[buttonId].label}
                                            onSelectorClicked={this.selectorClicked(buttonId)}
                                            isSelected={_.includes(this.state.selected, buttonId)}/>
                        </Col>
                    </div>
                );
            });
        return (
            <div>
                <Row start="xs" around="xs">
                    {buttonMenuJsx}
                </Row>
            </div>
        );
    }
});

export default ButtonSelectorMenu;
