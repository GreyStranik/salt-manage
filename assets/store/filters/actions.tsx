import {CompareItem, FilterField} from "@add_types/filters/minion_filters";

export const FILTER_BY = 'FILTER_BY'
export const REMOVE_FILTER = 'REMOVE_FILTER'

interface FilterByAction {
    type: typeof FILTER_BY
    payload : CompareItem
}

interface RemoveFilterAction {
    type: typeof REMOVE_FILTER
    payload  : FilterField
}

export type FilterActions = FilterByAction | RemoveFilterAction

export const filterBy = (p:CompareItem):FilterActions => ({
    type: FILTER_BY,
    payload: p
})

export const removeFilter = (field:FilterField):FilterActions => ({
    type: REMOVE_FILTER,
    payload: field
})