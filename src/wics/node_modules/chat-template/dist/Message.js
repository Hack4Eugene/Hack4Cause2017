'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _Avatar = require('./Avatar');

var _Avatar2 = _interopRequireDefault(_Avatar);

var _MessageContent = require('./MessageContent');

var _MessageContent2 = _interopRequireDefault(_MessageContent);

var _aphrodite = require('aphrodite');

var _objectAssignDeep = require('object-assign-deep');

var _objectAssignDeep2 = _interopRequireDefault(_objectAssignDeep);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var defaultStyle = {
  container: {
    width: '100%',
    clear: 'both',
    display: 'flex',
    overflow: 'hidden'
  }
};

var Message = function Message(_ref) {
  var height = _ref.height,
      message = _ref.message,
      styles = _ref.styles;

  var style = _aphrodite.StyleSheet.create((0, _objectAssignDeep2.default)({}, defaultStyle, styles));

  var avatarStyles = {
    container: {
      order: message.inbound ? 1 : 3
    }
  };

  return _react2.default.createElement(
    'div',
    { className: (0, _aphrodite.css)(style.container) },
    message.avatar && _react2.default.createElement(_Avatar2.default, { src: message.avatar, styles: avatarStyles }),
    _react2.default.createElement(_MessageContent2.default, { height: height, message: message })
  );
};

Message.propTypes = {
  height: _react.PropTypes.number,
  message: _react.PropTypes.shape({
    message: _react.PropTypes.string,
    src: _react.PropTypes.string,
    inbound: _react.PropTypes.bool.isRequired,
    avatar: _react.PropTypes.string,
    backColor: _react.PropTypes.string.isRequired,
    textColor: _react.PropTypes.string
  }),
  styles: _react.PropTypes.object
};

exports.default = Message;