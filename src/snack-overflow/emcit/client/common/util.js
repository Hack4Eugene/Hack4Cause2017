import axios from 'axios'


export function createAction(name) {
    const type = Symbol(name);
    const action = payload => ({ type, payload });
    action.type = type;
    action.toString = () => type;
    return action;
}

export const createReducer = (handlers, initialState) =>
    (state = initialState, { type, payload }) =>
            handlers[type] ? handlers[type](state, payload) : state;

const request_factory = csrfToken => {
    return axios.create({
        headers: { 'X-CSRFToken': csrfToken }
    });
}

export const request = request_factory() //(document.getElementById('csrf').content);
