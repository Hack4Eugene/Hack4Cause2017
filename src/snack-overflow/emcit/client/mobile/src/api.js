import { request } from 'common/util'

import { createReport as createReportAction } from 'actions'

export const createReport = report => dispatch => request.post('/api/v1/report', report).then(res => dispatch(createReportAction(res.data)));
