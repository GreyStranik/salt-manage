import {ColumnFields, FilterField} from "@add_types/filters/minion_filters";

export const SHOW_COLUMN = "show_column"
export const HIDE_COLUMN = "hide_column"

interface ShowColumnAction {
    type : typeof SHOW_COLUMN
    payload : ColumnFields
}

interface HideColumnAction {
    type : typeof HIDE_COLUMN
    payload : ColumnFields
}

export type VisiblesColumnAction = ShowColumnAction | HideColumnAction

export const showColumn = (column:ColumnFields):VisiblesColumnAction =>({
    type: SHOW_COLUMN,
    payload: column
})

export const hideColumn = (column:ColumnFields):VisiblesColumnAction => ({
    type: HIDE_COLUMN,
    payload: column
})