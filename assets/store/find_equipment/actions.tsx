export const FIND_MONITOR = "find_monitor"
export const CLEAR_FIND_MONITOR = "clear_find_monitor"

interface FindMonitorAction {
    type: typeof FIND_MONITOR
    payload: string
}

interface ClearFindMonitor {
    type: typeof CLEAR_FIND_MONITOR
}

export type FindEquipmentAction = FindMonitorAction | ClearFindMonitor

export const findMonitor = (find:string):FindEquipmentAction => ({
    type: FIND_MONITOR,
    payload: find
})

export const clearFindMonitor = ():FindEquipmentAction => ({type: CLEAR_FIND_MONITOR})