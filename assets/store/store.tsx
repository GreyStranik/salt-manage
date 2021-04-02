import { createStore, combineReducers } from 'redux';
import {themeReducer} from "@store/theme/reducers";
import {panelReducer} from "@store/pannel/reducer";
import {composeWithDevTools} from "redux-devtools-extension";
import {filterReducer} from "@store/filters/reducer";
import {minionsColumnsReducer} from "@store/minion_list_columns/reducer";
import {programmFindReducer} from "@store/programms_find/reducer";
import {findEquipmentReducer} from "@store/find_equipment/reducer";

const rootReducer = combineReducers({
    theme : themeReducer,
    panel: panelReducer,
    filter : filterReducer,
    minions_columns : minionsColumnsReducer,
    programm_find : programmFindReducer,
    equipment_find : findEquipmentReducer
})

export type RootState = ReturnType<typeof rootReducer>

const store = createStore(rootReducer,composeWithDevTools());

export default store;