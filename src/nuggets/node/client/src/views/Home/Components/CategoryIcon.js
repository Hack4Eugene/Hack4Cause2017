import React from 'react';
import { Link } from 'react-router';
import { Row } from 'react-flexbox-grid';

const CategoryIcon = React.createClass({
    render() {
        const categoryLink = this.props.categoryId !== 4
            ? `/category/${this.props.categoryId}`
            : '/parking';

        return (
            <div>
                <Row center="md">
                    <div className="icon-container">
                        <Link to={categoryLink}>
                            <img src={this.props.icon} alt="Income" className="icon-img" />
                            <div className="icon-desc">{this.props.name}</div>
                        </Link>
                    </div>
                </Row>
            </div>
        )
    }
});

export default CategoryIcon;
