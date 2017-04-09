'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _Message = require('./Message');

var _Message2 = _interopRequireDefault(_Message);

var _reactAddonsCssTransitionGroup = require('react-addons-css-transition-group');

var _reactAddonsCssTransitionGroup2 = _interopRequireDefault(_reactAddonsCssTransitionGroup);

var _aphrodite = require('aphrodite');

var _objectAssignDeep = require('object-assign-deep');

var _objectAssignDeep2 = _interopRequireDefault(_objectAssignDeep);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var defaultStyle = {
  container: {
    position: 'absolute',
    bottom: '4%',
    width: '100%',
    overflow: 'hidden'
  }
};

var Messages = function Messages(_ref) {
  var height = _ref.height,
      messages = _ref.messages,
      styles = _ref.styles;

  var style = _aphrodite.StyleSheet.create((0, _objectAssignDeep2.default)({}, defaultStyle, styles));

  return _react2.default.createElement(
    'div',
    { className: (0, _aphrodite.css)(style.container) },
    _react2.default.createElement(
      'style',
      null,
      '\n        .__CHAT_TEMPLATE_MESSAGES_TRANSITION_ELEMENT-enter {\n          transform: translateY(30px);\n          max-height: 1px;\n          transition: all 0.8s ease-in-out;\n        }\n        .__CHAT_TEMPLATE_MESSAGES_TRANSITION_ELEMENT-enter.__CHAT_TEMPLATE_MESSAGES_TRANSITION_ELEMENT-enter-active {\n          transform: translateY(0px);\n          max-height: 300px;\n        }\n        '
    ),
    _react2.default.createElement(
      _reactAddonsCssTransitionGroup2.default,
      { transitionName: '__CHAT_TEMPLATE_MESSAGES_TRANSITION_ELEMENT', transitionEnterTimeout: 55000, transitionLeave: false },
      messages.map(function (message, i) {
        return _react2.default.createElement(_Message2.default, { key: i, height: height, message: message });
      })
    )
  );
};

Messages.propTypes = {
  height: _react.PropTypes.number,
  messages: _react.PropTypes.arrayOf(_react.PropTypes.shape({
    message: _react.PropTypes.string,
    src: _react.PropTypes.string,
    inbound: _react.PropTypes.bool.isRequired,
    avatar: _react.PropTypes.string,
    backColor: _react.PropTypes.string.isRequired,
    textColor: _react.PropTypes.string
  })).isRequired,
  styles: _react.PropTypes.object
};

exports.default = Messages;