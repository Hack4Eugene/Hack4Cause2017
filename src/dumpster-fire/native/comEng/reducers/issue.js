import { UPDATE_ISSUE, CREATE_ISSUE_SUCCESS } from '../actions/issue'

const initalState = {
    issueName: null,
    Topic: null,
    Summary: null,
    Tags: null,
}

export default issue = (state = initalState, action) => {
    switch (action.type) {
        case UPDATE_ISSUE:
            return {
                ...state,
                ...action.issue
            }
            break;
        case CREATE_ISSUE_SUCCESS:
            return initalState
            break;
        default:
            return state;
    }
}
