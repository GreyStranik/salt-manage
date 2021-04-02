import {ProgrammSearchState} from "@store/programms_find/state";
import {CLEAR_FIND, PROGRAMM_FIND, ProgrammSearchAction} from "@store/programms_find/actions";

const initialState:ProgrammSearchState = {
    find: ''
}

export const programmFindReducer = (state=initialState,action:ProgrammSearchAction):ProgrammSearchState => {
    switch (action.type) {
        case PROGRAMM_FIND :
            return {...state,find:action.payload}
        case CLEAR_FIND:
            return {...state,find:''}
        default:
            return state
    }
}