import { createAction } from 'common/util'


export const loadedReports = createAction('LOADED_REPORTS');

export const addFilter = createAction('ADD_FILTER');
export const removeFilter = createAction('REMOVE_FILTER');

export const loadedUser = createAction('LOADED_USER');
export const loadedUsers = createAction('LOADED_USERS');
export const createdUser = createAction('CREATED_USER');
export const updatedUser = createAction('UPDATED_USER');
