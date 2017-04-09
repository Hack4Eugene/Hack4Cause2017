// var express = require('express');
// var router = express.Router();

// /* GET home page. */
// router.get('/', function(req, res, next) {
//   res.render('index', { title: 'Express' });
// });

// module.exports = router;

import React from 'react';
import ReactDOM from 'react-dom';
import Routes from './routes.js';

import './index.css';


ReactDOM.render(
  <Routes />,
  document.getElementById('root')
);