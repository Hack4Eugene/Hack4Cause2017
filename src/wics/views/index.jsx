var React = require('react');
var DefaultLayout = require('./layout/master');

var IndexComponent = React.createClass({
  render: function() {
    return (
      <DefaultLayout name={this.props.name}>
        <div>
          <h1>this was built using react</h1>
        </div>
      </DefaultLayout>
    )
  }
});

module.exports = IndexComponent;