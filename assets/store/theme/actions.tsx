import {SET_DARK_THEME, SET_DEFAULT_THEME} from "@store/theme/actionTypes";


interface DarkThemeAction {
    type: typeof SET_DARK_THEME
}

interface DefaultThemeAction {
    type: typeof SET_DEFAULT_THEME
}

// export const actionSetDark = () => ({type:SET_DARK_THEME})
// export const actionSetLight = () => ({type:SET_DEFAULT_THEME})

export type ThemeSwitchAction = DarkThemeAction | DefaultThemeAction

export const actionSetLight = ():ThemeSwitchAction => ({type:SET_DEFAULT_THEME})
export const actionSetDark = ():ThemeSwitchAction => ({type:SET_DARK_THEME})
