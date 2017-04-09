import issueSagas from './issue'
import issuesSagas from './issues'
import { put, takeEvery } from 'redux-saga/effects'


export default function* rootSaga() {
    yield [
        ...issueSagas,
        ...issuesSagas,
    ]
}
