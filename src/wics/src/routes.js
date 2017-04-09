import React, { Component, PropTypes } from 'react';
import { BrowserRouter as Router, Route, history } from 'react-router-dom';
import Home from './components/Home';
import Register from './components/Register';
import Login from './components/Login';
import Apply from './components/Apply';
import NotFound from './components/NotFound';

import theme from './theme';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import {Tabs, Tab} from 'material-ui';

const muiTheme = getMuiTheme(theme);

const Nav = (props, Comp) => {
    return (
        <div>
            <MuiThemeProvider muiTheme={muiTheme}>
                <Tabs
                    onChange={(value) => {
                        props.history.push(value)
                    }}>
                    <Tab label="Home" value="/"  />
                    <Tab label="Login" value="/login" />
                    <Tab label="Register" value="/register" />
                    <Tab label="Apply" value="/apply" />
                </Tabs>
            </MuiThemeProvider>
            <Comp {...props} />
        </div>
    )
}

class Routes extends Component {
    render() {
        return  (
            <Router>
                <div>
                <Route exact path="/" component={(props) => Nav(props, Home)} />
                <Route path="/login" component={(props) => Nav(props, Login)} />
                <Route path="/register" component={(props) => Nav(props, Register)} />
                <Route path="/apply" component={(props) => Nav(props, Apply)} />
                <Route path="/404" component={(props) => Nav(props, NotFound)} />
                {/* TODO: Why isnt asterisk acting as a wildcard */}

                
                </div>
            </Router>
        )
    }
}

export default Routes;