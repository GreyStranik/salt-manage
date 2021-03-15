import {PanelState} from "@store/pannel/state";
import {COLLAPSE, EXPAND, PanelStatusAction} from "@store/pannel/actions";

const initialState:PanelState={
    open: false
}

export const panelReducer=(state=initialState,action:PanelStatusAction):PanelState=>{
    switch (action.type) {
        case EXPAND:
            return {...state,open:true}
        case COLLAPSE:
            return {...state,open:false}
        default:
            return state
    }
}