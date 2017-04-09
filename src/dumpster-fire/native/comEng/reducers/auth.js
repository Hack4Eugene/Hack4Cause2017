import {
    USER_LOGIN
} from '../actions/auth'
export const initialState = {
    user: null
}

export default auth = (state = initialState, action) => {
    switch (action.type) {
        case USER_LOGIN:
            return {
                ...state,
                user: action.user,
            }
            break;
        default:
            return state;
    }
}
