import { combineReducers } from 'redux'
import { routerReducer as routing } from 'react-router-redux';
import { account } from 'common/reducers'
import { createReducer } from 'common/util';
import { createReport } from 'actions'

const report = createReducer({
    [createReport]: (state, report) => report
}, null);


export default combineReducers({
    routing,
    account,
    report
});
