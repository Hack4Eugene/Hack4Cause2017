import React  from 'react'
import { Router, Route, IndexRoute, browserHistory } from 'react-router';
import App from './App';
import {HomePage} from './views/Home';
import {AboutPage} from './views/About';
import {Page} from './views/Page';
import MapPage from './views/Map';
import CategoryPage from './views/CategoryPage';
import {WeatherPage} from './views/Weather';

const Routes = (
      <Router history={browserHistory}>
        <Route path='/' component={App} >
            <IndexRoute title="Home" component={HomePage} />
            <Route path='/about' component={AboutPage} />
            <Route path='/category/:categoryid' component={Page}/>
            <Route path='/page' component={Page} />
            <Route path='/parking' component={MapPage} />
            <Route path='/weather' component={WeatherPage} />
        </Route>
      </Router>
);

export default Routes;