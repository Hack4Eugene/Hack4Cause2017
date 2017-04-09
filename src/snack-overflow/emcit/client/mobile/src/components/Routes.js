import * as React from 'react';
import { Router, Route, browserHistory } from 'react-router';
import { ReportContainer } from './ReportContainer';
import {NotFoundPage} from "./NotFoundPage";
import {LoginPage} from "./auth/LoginPage";



export const Routes = (
    <Router  onUpdate={() => window.scrollTo(0, 0)} history={browserHistory}>
        <Route path='/' component={ReportContainer} />
        <Route path='/login' component={LoginPage} />
        <Route path='*' component={NotFoundPage} />
    </Router>
);

export default Routes;
