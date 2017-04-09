import React, { Component } from 'react'
import { AppRegistry } from 'react-native'
import { Provider } from 'react-redux'
import { ConnectedRouter } from 'react-router-redux'
import App from './app'
import store, { history } from './store'


export default class comEng extends Component {
    render() {
        return (
            <Provider store={store}>
                <ConnectedRouter history={history}>
                    <App />
                </ConnectedRouter>
            </Provider>
        );
    }
}

AppRegistry.registerComponent('comEng', () => comEng);
