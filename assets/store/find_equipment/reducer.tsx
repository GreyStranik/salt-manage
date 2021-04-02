import {FindEquipmentState} from "@store/find_equipment/state";
import {CLEAR_FIND_MONITOR, FIND_MONITOR, FindEquipmentAction} from "@store/find_equipment/actions";

const initialState:FindEquipmentState={
    monitor: ''
}

export const findEquipmentReducer = (state=initialState,action:FindEquipmentAction):FindEquipmentState => {
    switch (action.type){
        case FIND_MONITOR:
            return {...state,monitor:action.payload}
        case CLEAR_FIND_MONITOR:
            return {...state,monitor:''}
        default:
            return state
    }
}