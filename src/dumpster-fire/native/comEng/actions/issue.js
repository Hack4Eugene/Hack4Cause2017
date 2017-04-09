export const UPDATE_ISSUE = 'UPDATE_ISSUE'
export const CREATE_ISSUE = 'CREATE_ISSUE'
export const CREATE_ISSUE_FAIL = 'CREATE_ISSUE_FAIL'
export const CREATE_ISSUE_SUCCESS = 'CREATE_ISSUE_SUCCESS'
export const VOTE_ISSUE = 'VOTE_ISSUE'
export const VOTE_ISSUE_SUCCESS = 'VOTE_ISSUE_SUCCESS'
export const VOTE_ISSUE_FAIL = 'VOTE_ISSUE_FAIL'


export const updateIssue = issue => ({
    type: UPDATE_ISSUE,
    issue
})

export const createIssue = issue => ({
    type: CREATE_ISSUE,
    issue
})

export const createIssueSuccess = issue => ({
    type: CREATE_ISSUE_SUCCESS,
    issue
})

export const createIssueFail = issue => ({
    type: CREATE_ISSUE_FAIL,
    issue
})

export const voteIssue = issueID => ({
    type: VOTE_ISSUE,
    issueID
})
