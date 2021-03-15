import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router  } from "react-router-dom"
import 'fontsource-roboto';
import { ThemeProvider } from '@material-ui/core/styles'
import { Provider } from 'react-redux'

import store from "@store/store";
import ThemedApp from "./ThemedApp";

ReactDOM.render(
    <React.StrictMode>
        <Router>
            <Provider store={store}>
                    <ThemedApp/>
            </Provider>

        </Router>
    </React.StrictMode>,
    document.getElementById('root')
);