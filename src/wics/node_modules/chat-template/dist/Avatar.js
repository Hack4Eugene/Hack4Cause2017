'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _aphrodite = require('aphrodite');

var _objectAssignDeep = require('object-assign-deep');

var _objectAssignDeep2 = _interopRequireDefault(_objectAssignDeep);

var _Avatar = require('material-ui/Avatar');

var _Avatar2 = _interopRequireDefault(_Avatar);

var _getMuiTheme = require('material-ui/styles/getMuiTheme');

var _getMuiTheme2 = _interopRequireDefault(_getMuiTheme);

var _MuiThemeProvider = require('material-ui/styles/MuiThemeProvider');

var _MuiThemeProvider2 = _interopRequireDefault(_MuiThemeProvider);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var defaultStyle = {
  container: {
    marginLeft: '1%',
    marginRight: '1%',
    order: 3
  }
};

var muiTheme = (0, _getMuiTheme2.default)({});

var Avatar = function Avatar(_ref) {
  var styles = _ref.styles,
      src = _ref.src;

  var override = _aphrodite.StyleSheet.create((0, _objectAssignDeep2.default)({}, defaultStyle, styles));

  return _react2.default.createElement(
    _MuiThemeProvider2.default,
    { muiTheme: muiTheme },
    _react2.default.createElement(
      'div',
      { className: (0, _aphrodite.css)(override.container) },
      _react2.default.createElement(_Avatar2.default, { src: src })
    )
  );
};

Avatar.propTypes = {
  src: _react.PropTypes.string.isRequired,
  styles: _react.PropTypes.object
};

exports.default = Avatar;