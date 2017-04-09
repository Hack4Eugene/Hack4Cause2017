import React from 'react';
import ReactDOM from 'react-dom';
import Home from './components/Home';

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<Home />, div);
});

const app = require('../server/app');

describe('builds application', function () {
  it('builds to "build" directory', function () {
    // Disable mocha time-out because this takes a lot of time
    this.timeout(0);

    // Run process
    return exec('npm run build');
  });
});