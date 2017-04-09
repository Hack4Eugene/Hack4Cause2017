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
  dot: {
    MozBorderRadius: '40px/40px',
    WebkitBorderRadius: '40px 40px',
    borderRadius: '40px/40px',
    border: 'solid',
    borderWidth: '4px',
    borderColor: '#435AD9',
    float: 'left',
    marginRight: '2.0%'
  }
};

var Typing = function Typing(_ref) {
  var styles = _ref.styles;

  var style = _aphrodite.StyleSheet.create((0, _objectAssignDeep2.default)({}, defaultStyle, styles || {}));
  return _react2.default.createElement(
    'div',
    null,
    _react2.default.createElement(
      'style',
      null,
      '\n        ._chat_template_dot:nth-child(2) {\n          animation: _chat_template_updown1 linear 1.5s infinite;\n        }\n\n        ._chat_template_dot:nth-child(3)  {\n          animation: _chat_template_updown2 linear 1.5s infinite;\n        }\n\n        ._chat_template_dot:nth-child(4)  {\n          animation: _chat_template_updown3 linear 1.5s infinite;\n        }\n\n        @keyframes _chat_template_updown1 {\n          0% {\n            transform: translateY(5px);\n          }\n          25% {\n            transform: translateY(10px);\n          }\n          50% {\n            transform: translateY(15px);\n          }\n          75% {\n            transform: translateY(10px);\n          }\n          100% {\n            transform: translateY(5px);\n          }\n        }\n\n        @keyframes _chat_template_updown2 {\n          from {\n            transform: translateY(10px);\n          }\n          25% {\n            transform: translateY(15px);\n          }\n          50% {\n            transform: translateY(10px);\n          }\n          75% {\n            transform: translateY(5px);\n          }\n          to {\n            transform: translateY(10px);\n          }\n        }\n\n        @keyframes _chat_template_updown3 {\n          from {\n            transform: translateY(15px);\n          }\n          25% {\n            transform: translateY(10px);\n          }\n          50% {\n            transform: translateY(5px);\n          }\n          75% {\n            transform: translateY(10px);\n          }\n          to {\n            transform: translateY(15px);\n          }\n        }\n      '
    ),
    _react2.default.createElement('div', { className: '_chat_template_dot ' + (0, _aphrodite.css)(style.dot) }),
    _react2.default.createElement('div', { className: '_chat_template_dot ' + (0, _aphrodite.css)(style.dot) }),
    _react2.default.createElement('div', { className: '_chat_template_dot ' + (0, _aphrodite.css)(style.dot) })
  );
};

Typing.propTypes = {
  styles: _react.PropTypes.object
};

exports.default = Typing;