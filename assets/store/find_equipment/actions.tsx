export const FIND_MONITOR = "find_monitor"
export const CLEAR_FIND_MONITOR = "clear_find_monitor"
export const FIND_PRINTER = "find_printer"
export const CLEAR_FIND_PRINTER = "clear_find_printer"

interface FindMonitorAction {
    type: typeof FIND_MONITOR
    payload: string
}

interface ClearFindMonitor {
    type: typeof CLEAR_FIND_MONITOR
}

interface FindPrinterAction {
    type: typeof FIND_PRINTER
    payload: string
}

interface ClearFindPrinterAction {
    type: typeof CLEAR_FIND_PRINTER
}

export type FindEquipmentAction = FindMonitorAction | ClearFindMonitor | FindPrinterAction | ClearFindPrinterAction

export const findMonitor = (find:string):FindEquipmentAction => ({
    type: FIND_MONITOR,
    payload: find
})

export const clearFindMonitor = ():FindEquipmentAction => ({type: CLEAR_FIND_MONITOR})

export const findPrinter = (find:string):FindEquipmentAction => ({
    type: FIND_PRINTER,
    payload: find
})

export const clearFindPrinter = ():FindEquipmentAction => ({type: CLEAR_FIND_PRINTER})