import { delay } from 'redux-saga'
import { put, takeEvery, fork } from 'redux-saga/effects'
import { REQUEST_ISSUES, REQUEST_ISSUES_FAILED, RECEIVED_ISSUES } from '../actions/issues'

export function* requestIssuesAsync() {
    try {
        const issues= yield fetch('https://gabezjlby1.execute-api.us-west-2.amazonaws.com/Hacktest/listissues', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(resp => resp.json())
        yield put({ type: RECEIVED_ISSUES, issues })
    } catch (error) {
        yield put({ type: REQUEST_ISSUES_FAILED, error })
    }
}

export function* watchRequestIssuesAsync() {
    yield takeEvery('REQUEST_ISSUES', requestIssuesAsync)
}

export default [
    fork(watchRequestIssuesAsync)
]
