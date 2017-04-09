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
  contentBase: {
    backgroundColor: 'white',
    maxWidth: '60%',
    wordWrap: 'break-word',
    color: '#262626',
    borderRadius: '10px',
    padding: '2%',
    borderColor: 'grey',
    boxShadow: '1px 5px 10px rgba(0,0,0,.13)',
    marginBottom: '2%',
    order: '2'
  },
  contentRight: {
    marginLeft: 'auto'
  },
  image: {
    width: '100%'
  },
  imageContainer: {
    minHeight: '100px',
    height: '100px',
    width: '100%',
    margin: '0px'
  }
};

var MessageContent = function MessageContent(_ref) {
  var height = _ref.height,
      message = _ref.message,
      styles = _ref.styles;

  var style = _aphrodite.StyleSheet.create((0, _objectAssignDeep2.default)({}, defaultStyle, {
    contentBase: {
      color: message.textColor || defaultStyle.contentBase.color,
      backgroundColor: message.backColor || defaultStyle.contentBase.backgroundColor
    }
  }, styles || {}));

  var imageContainer = function imageContainer(src) {
    var heightNeeded = (height || 0) / 3;
    return src && _react2.default.createElement(
      'div',
      { className: (0, _aphrodite.css)(style.imageContainer) },
      _react2.default.createElement('img', { src: src, role: 'presentation', height: heightNeeded + 'px', className: (0, _aphrodite.css)(style.image) })
    );
  };

  return _react2.default.createElement(
    'div',
    { className: (0, _aphrodite.css)(style.contentBase, !message.inbound && style.contentRight) },
    _react2.default.createElement(
      'span',
      null,
      message.message
    ),
    imageContainer(message.src, height)
  );
};

MessageContent.propTypes = {
  height: _react.PropTypes.number,
  message: _react.PropTypes.shape({
    message: _react.PropTypes.string,
    src: _react.PropTypes.string,
    inbound: _react.PropTypes.bool.isRequired,
    avatar: _react.PropTypes.string,
    backColor: _react.PropTypes.string.isRequired,
    textColor: _react.PropTypes.string
  }).isRequired,
  styles: _react.PropTypes.object
};

exports.default = MessageContent;