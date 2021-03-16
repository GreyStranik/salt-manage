import { createStore, combineReducers } from 'redux';
import {themeReducer} from "@store/theme/reducers";
import {panelReducer} from "@store/pannel/reducer";
import {composeWithDevTools} from "redux-devtools-extension";
import {filterReducer} from "@store/filters/reducer";

const rootReducer = combineReducers({
    theme : themeReducer,
    panel: panelReducer,
    filter : filterReducer
})

export type RootState = ReturnType<typeof rootReducer>

const store = createStore(rootReducer,composeWithDevTools());

export default store;