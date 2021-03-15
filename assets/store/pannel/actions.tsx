
export const EXPAND = 'EXPAND'
export const COLLAPSE = 'COLLAPSE'

interface CollapseAction {
    type: typeof COLLAPSE
}

interface ExpandAction {
    type: typeof EXPAND
}

export type PanelStatusAction = CollapseAction | ExpandAction

export const expandPanel = ():PanelStatusAction => ({type:EXPAND})
export const collapsePanel = ():PanelStatusAction => ({type:COLLAPSE})