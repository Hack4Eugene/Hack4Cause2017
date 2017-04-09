import { delay } from 'redux-saga'
import { take, put,takeEvery, fork, select } from 'redux-saga/effects'
import {
    REQUEST_ISSUES
} from '../actions/issues'
import {
    CREATE_ISSUE,
    CREATE_ISSUE_SUCCESS,
    CREATE_ISSUE_FAIL ,
    VOTE_ISSUE,
    VOTE_ISSUE_SUCCESS,
    VOTE_ISSUE_FAIL,
} from '../actions/issue'

export function* createIssuesAsync() {
    while (true) {
        const { issue } = yield take(CREATE_ISSUE)
        const { auth } = yield select()
        try {
            issue.issueID = `${(new Date).getTime()}`
            issue.Creator = auth.user.id
            issue.Author = `${auth.user.first_name} ${auth.user.last_name}`
            const issues = yield fetch(
                'https://gabezjlby1.execute-api.us-west-2.amazonaws.com/Hacktest/',
                {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(issue)
                }
            ).then(resp => resp.json())
            yield put({ type: CREATE_ISSUE_SUCCESS, issues })
        } catch (error) {
            yield put({ type: 'REQUEST_ISSUES_FAILED', error })
        }
    }
}

export function* voteIssueAsync() {
    while (true) {
        const { issueID } = yield take(VOTE_ISSUE)
        const { auth } = yield select()
        try {
            const respo = fetch('https://gabezjlby1.execute-api.us-west-2.amazonaws.com/Hacktest/issue', {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ issueID, voteUsers: auth.user.id })
            })
            .then(resp => resp.json())
            yield put({ type: VOTE_ISSUE_SUCCESS, issueID })
            yield delay(1000)
            yield put({ type: REQUEST_ISSUES })
        } catch (error) {
            yield put({ type: VOTE_ISSUE_FAIL, error })
        }
    }
}

export default [
    fork(createIssuesAsync),
    fork(voteIssueAsync),
]
