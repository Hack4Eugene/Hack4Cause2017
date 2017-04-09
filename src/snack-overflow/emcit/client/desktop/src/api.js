import { request } from 'common/util'

import { loadedReports, loadedUser, loadedUsers, createdUser, updatedUser } from 'actions'

export const getReports = filters => dispatch =>
    request.post('/api/v1/analytics', filters).then(res => dispatch(loadedReports(res.data)));

export const getUser = (id) => dispatch => request.get(`/api/v1/user/${id}`).then(res => dispatch(loadedUser(res.data)));
export const getUsers = () => dispatch => request.get('/api/v1/user').then(res => dispatch(loadedUsers(res.data)));
export const createUser = (body) => dispatch => request.post('/api/v1/user', body).then(res => dispatch(createdUser(res.data)));
export const updateUser = (id, body) => dispatch => request.put(`/api/v1/user/${id}`, body).then(res => dispatch(updatedUser(res.data)));
