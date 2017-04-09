import { SET_SIDEMENUSTATUS } from '../actions/sidemenu'

export const initialState = {
    open: false
}


export default sidemenu = (state = initialState, action) => {
    switch (action.type) {
        case SET_SIDEMENUSTATUS:
            return {
                open: action.isOpen
            }
        default:
            return state;
    }
}
