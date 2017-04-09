'use strict';

var _index = require('../index');

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var showChatTemplate = function showChatTemplate(messages, element) {
  var delay = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;
  var height = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 300;

  _reactDom2.default.render(_react2.default.createElement(_index.Conversation, { delay: delay, height: height, messages: messages }), element);
};

module.exports = showChatTemplate;