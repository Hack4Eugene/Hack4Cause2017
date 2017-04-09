'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _aphrodite = require('aphrodite');

var _objectAssignDeep = require('object-assign-deep');

var _objectAssignDeep2 = _interopRequireDefault(_objectAssignDeep);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var defaultStyle = {
  container: {
    display: 'none'
  }
};

var images = function images(messages) {
  return messages.map(function (message, i) {
    return message.src && _react2.default.createElement('img', { role: 'presentation', key: i, src: message.src, width: '1px', height: '1px' });
  });
};

var ImageLoader = function ImageLoader(_ref) {
  var messages = _ref.messages,
      styles = _ref.styles;

  var style = _aphrodite.StyleSheet.create((0, _objectAssignDeep2.default)({}, defaultStyle, styles));

  return _react2.default.createElement(
    'div',
    { className: (0, _aphrodite.css)(style.container) },
    images(messages)
  );
};

ImageLoader.propTypes = {
  messages: _react.PropTypes.arrayOf(_react.PropTypes.shape({
    src: _react.PropTypes.string
  })).isRequired,
  styles: _react.PropTypes.object
};

exports.default = ImageLoader;