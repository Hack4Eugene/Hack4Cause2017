import Immutable from 'seamless-immutable';

import { createReducer } from 'common/util';
import {
    clearLoginErrors,
    loggingIn,
    loadedCurrentUser,
    loginFailed
} from 'common/actions';


export const account = createReducer({
    [clearLoginErrors]: state => state.merge({ loginError: {} }),
    [loggingIn]: state => state.merge({ loggingIn: true, loginError: {} }),
    [loadedCurrentUser]: (state, user) => state.merge({ logginIn: false, user }),
    [loginFailed]: (state, loginError) => state.merge({ logginIn: false , loginError })
}, Immutable({
    user: null,
    loggingIn: false,
    loginError: {}
}));
