import {MinionsColumnListState} from "@store/minion_list_columns/state";
import {HIDE_COLUMN, SHOW_COLUMN, VisiblesColumnAction} from "@store/minion_list_columns/actions";

const initialState:MinionsColumnListState={
    node_name : true,
    serialnumber : true,
    ip : true,
    mac : true,
    fio_user : true,
    room : true,
    user_phone : true,
    department : false,
    created_at : false,
    updated_at : true
}

export const minionsColumnsReducer=(state=initialState,action:VisiblesColumnAction):MinionsColumnListState => {
    switch (action.type) {
        case SHOW_COLUMN:
            return {...state, [action.payload] : true}
        case HIDE_COLUMN:
            return {...state, [action.payload] : false}
        default:
            return state
    }
}