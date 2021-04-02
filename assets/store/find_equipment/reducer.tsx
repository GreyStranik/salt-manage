import {FindEquipmentState} from "@store/find_equipment/state";
import {
    CLEAR_FIND_MONITOR,
    CLEAR_FIND_PRINTER,
    FIND_MONITOR,
    FIND_PRINTER,
    FindEquipmentAction
} from "@store/find_equipment/actions";

const initialState:FindEquipmentState={
    monitor: '',
    printer: ''
}

export const findEquipmentReducer = (state=initialState,action:FindEquipmentAction):FindEquipmentState => {
    switch (action.type){
        case FIND_MONITOR:
            return {...state,monitor:action.payload}
        case CLEAR_FIND_MONITOR:
            return {...state,monitor:''}
        case FIND_PRINTER:
            return {...state,printer:action.payload}
        case CLEAR_FIND_PRINTER:
            return {...state,printer: ''}
        default:
            return state
    }
}