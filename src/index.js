import React from 'react';
import ReactDOM from 'react-dom';
import registerServiceWorker from './registerServiceWorker';
import './assets/index.css';
import './assets/bootstrap4.0.0-alpha.min.css';

import thunk from 'redux-thunk';
import {applyMiddleware, createStore} from 'redux'
import rootReducer from "./reducers/rootReducer";

import NotFound from "./components/pages/NotFound";
import Home from "./components/pages/Home";
import {BrowserRouter, Route, Switch} from 'react-router-dom';
import {Provider} from 'react-redux';

const store = createStore(rootReducer, applyMiddleware(thunk));

ReactDOM.render(
    <Provider store={store}>
        <BrowserRouter>
            <Switch>
                <Route exact path="/" component={Home}/>
                <Route path="/search/:search" component={NotFound}/>
                <Route path="*" component={NotFound}/>
            </Switch>
        </BrowserRouter>
    </Provider>, document.getElementById('root'));
registerServiceWorker();
