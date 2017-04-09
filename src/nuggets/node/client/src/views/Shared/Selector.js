import React, { PropTypes } from 'react';

const Selector = React.createClass({
    propTypes: {
        selectorElement: PropTypes.element,
        isSelected: PropTypes.bool,
        onSelectorClicked: PropTypes.func
    },
    onClick() {
        this.props.onSelectorClicked();
    },
    render() {
        const className = this.props.isSelected
            ? 'selector-button clicked'
            : 'selector-button';

        return (
            <div>
                <a href="#" className={className} onClick={this.onClick}>{this.props.selectorElement}</a>
            </div>
        );
    }
});

export default Selector;