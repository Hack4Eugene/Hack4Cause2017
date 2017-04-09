import {
    loggingIn,
    loadedCurrentUser,
    loginFailed
} from 'common/actions';

import { request } from 'common/util'

const networkError = { form: ['Cannot reach server.']}
const getError = response =>
    response ? response.data : networkError

/* Account API */
export const loginUser = (email, password) => dispatch => {
    dispatch(loggingIn());
    request.post('/api/v1/account/login', { email, password })
        .then(res => dispatch(loadedCurrentUser(res.data)))
        .catch(({ response }) => dispatch(loginFailed(getError(response))))
}

export const loadCurrentUser = () => dispatch => {
    request.get('/api/v1/account/me')
        .then(res => dispatch(loadedCurrentUser(res.data)))
        //.catch()
}
