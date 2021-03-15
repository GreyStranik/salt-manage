import { createStore, combineReducers } from 'redux';
import {themeReducer} from "@store/theme/reducers";
import {panelReducer} from "@store/pannel/reducer";

const rootReducer = combineReducers({
    theme : themeReducer,
    panel: panelReducer
})

export type RootState = ReturnType<typeof rootReducer>

const store = createStore(rootReducer);

export default store;