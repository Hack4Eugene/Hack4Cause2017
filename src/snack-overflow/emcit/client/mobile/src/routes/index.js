import React from 'react';

import Chrome from 'c/chrome';
import LoginPage from 'common/components/views/LoginPage';
import ReportContainer from "../components/ReportContainer";

const catchAll = {path: '*', onEnter: ({params}, replace) => replace('/desktop')}

const loginRoute = { path: '*', component: LoginPage };
const routes = [
    {path: '/', component: ReportContainer},
    loginRoute,
    catchAll
];

export default function configureRoutes(store) {
    return {
        component: Chrome,
        getChildRoutes(partialNextState, cb) {
            const {user} = store.getState().account;

            if (user) {
                cb(null, routes);
            } else {
                cb(null, loginRoute);

                const unsubscribe = store.subscribe(() => {
                    const { user } = store.getState().account;
                    if (user)  {
                        unsubscribe();
                        cb(null, routes);
                    }
                });
            }
        }
    }
}
