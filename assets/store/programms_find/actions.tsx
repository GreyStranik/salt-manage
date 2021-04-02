export const PROGRAMM_FIND = "programm_find"
export const CLEAR_FIND = "clear_find"

interface ProgrammFindAction {
    type: typeof PROGRAMM_FIND
    payload: string
}

interface ClearFindAction {
    type: typeof CLEAR_FIND
}

export type ProgrammSearchAction = ProgrammFindAction | ClearFindAction

export const programmFind = (search:string):ProgrammSearchAction => ({
    type: PROGRAMM_FIND,
    payload: search
})

export const programmClearSeach = ():ProgrammSearchAction => ({ type:CLEAR_FIND })