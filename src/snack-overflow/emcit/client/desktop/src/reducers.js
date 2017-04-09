import Immutable from 'seamless-immutable'
import { combineReducers } from 'redux'
import { routerReducer as routing } from 'react-router-redux';

import { account } from 'common/reducers'
import { createReducer } from 'common/util'
import { loadedReports, addFilter, removeFilter, loadedUsers, loadedUser } from 'actions'

const reports = createReducer({
    [loadedReports]: (state, list) => state.merge({ list })
}, Immutable({
    list: []
}))

const filters = createReducer({
    [addFilter]: (state, filter) => state.concat(filter),
    [removeFilter]: (state, filter) => state.filter(f => f !== filter)
}, [])

const users = createReducer({
    [loadedUsers]: (state, list) => state.merge({ list }),
}, Immutable({
    list: []
}))

const user = createReducer({
    [loadedUser]: (state, u) => u,
}, null);

export default combineReducers({
    routing,

    // common reducers
    account,

    // desktop reducers
    reports,
    filters,
    users,
    user
});
