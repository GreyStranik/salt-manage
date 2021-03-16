import {CompareItem} from "@add_types/filters/minion_filters";
import {FILTER_BY, FilterActions, REMOVE_FILTER} from "@store/filters/actions";
import {FilterState} from "@store/filters/state";

const initialState:CompareItem[] = []

export const filterReducer = (state=initialState,action:FilterActions):FilterState => {
    switch (action.type) {
        case FILTER_BY:
            return [...state,action.payload]
        case REMOVE_FILTER:
            return state.filter(value => value.field!==action.payload)
        default:
            return state
    }
}