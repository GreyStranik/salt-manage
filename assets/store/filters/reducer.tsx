import {CompareItem} from "@add_types/filters/minion_filters";
import {ALL_MINIONS, FILTER_BY, FILTER_ONLY_BY, FilterActions, REMOVE_FILTER} from "@store/filters/actions";
import {FilterState} from "@store/filters/state";

const initialState:CompareItem[] = []

export const filterReducer = (state=initialState,action:FilterActions):FilterState => {
    switch (action.type) {
        case FILTER_BY:
            return [...state.filter(value => value.field!==action.payload.field),action.payload]
        case FILTER_ONLY_BY:
            return [action.payload]
        case REMOVE_FILTER:
            return state.filter(value => value.field!==action.payload)
        case ALL_MINIONS:
            return []
        default:
            return state
    }
}