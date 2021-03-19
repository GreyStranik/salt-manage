import {CompareItem, FilterField} from "@add_types/filters/minion_filters";

export const FILTER_BY = 'FILTER_BY'
export const FILTER_ONLY_BY = 'FILTER_ONLY_BY'
export const REMOVE_FILTER = 'REMOVE_FILTER'
export const ALL_MINIONS = 'ALL_MINIONS'

interface FilterByAction {
    type: typeof FILTER_BY
    payload : CompareItem
}

interface FinterOnlyByAction {
    type: typeof FILTER_ONLY_BY
    payload: CompareItem
}

interface RemoveFilterAction {
    type: typeof REMOVE_FILTER
    payload  : FilterField
}

interface AllMinionsAction {
    type: typeof ALL_MINIONS
}

export type FilterActions = FilterByAction | FinterOnlyByAction | RemoveFilterAction | AllMinionsAction

export const filterBy = (p:CompareItem):FilterActions => ({
    type: FILTER_BY,
    payload: p
})

export const filterOnlyBy = (item:CompareItem): FilterActions=> ({
    type: FILTER_ONLY_BY,
    payload: item
})

export const removeFilter = (field:FilterField):FilterActions => ({
    type: REMOVE_FILTER,
    payload: field
})

export const crearFilters = ():FilterActions => ({
    type: ALL_MINIONS
})