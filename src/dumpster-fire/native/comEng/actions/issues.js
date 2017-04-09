export const REQUEST_ISSUES = 'REQUEST_ISSUES'
export const REQUEST_ISSUES_FAILED = 'REQUEST_ISSUES_FAILED'
export const RECEIVED_ISSUES = 'RECEIVED_ISSUES'


export const requestIssues = () => ({
    type: REQUEST_ISSUES
})


export const receivedIssues = issues => ({
    type: RECEIVED_ISSUES,
    issues
})
