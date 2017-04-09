import { createStore, combineReducers, applyMiddleware } from 'redux'
import createHistory from 'history/createMemoryHistory'
import {
    ConnectedRouter,
    routerReducer,
    routerMiddleware as generateRouterMiddleware,
    push
} from 'react-router-redux'
import createSagaMiddleware from 'redux-saga'

import rootSaga from './sagas'
import reducers from './reducers'

export const history = createHistory()
const routerMiddleware = generateRouterMiddleware(history)

const sagaMiddleware = createSagaMiddleware()

const logger = store => next => action => {
    console.log('dispatching', action)
    let result = next(action)
    console.log('next state', store.getState())
    return result
}

const store = createStore(
    combineReducers({
        ...reducers,
        router: routerReducer
    }),
    applyMiddleware(logger, routerMiddleware, sagaMiddleware)
)
sagaMiddleware.run(rootSaga)

export default store
