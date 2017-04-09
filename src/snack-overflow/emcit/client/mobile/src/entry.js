import React from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux';
import { Router, Route, browserHistory } from 'react-router';
import { syncHistoryWithStore } from 'react-router-redux';
import Immutable from 'seamless-immutable'
import './main.css';

import configureRoutes from './routes'
import configureStore from './store'

const state = {
    account: Immutable(INITIAL_STATE.account)
}

const store = configureStore(state);

const routes = configureRoutes(store)

const history = syncHistoryWithStore(browserHistory, store);

render(
    <Provider store={store}>
        <Router history={history} routes={routes} />
    </Provider>
,document.getElementById('entry'));
