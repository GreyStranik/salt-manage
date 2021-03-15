import React from "react";
import {ThemeSwitchAction} from "@store/theme/actions";
import {ThemeState} from "@store/theme/state";
import {SET_DARK_THEME, SET_DEFAULT_THEME} from "@store/theme/actionTypes";
import {DARK_THEME, DEFAULT_THEME} from "../../themes";

const initialState:ThemeState = {
    theme : DARK_THEME
}

export const themeReducer = (state=initialState,action:ThemeSwitchAction):ThemeState => {
    switch (action.type) {
        case SET_DARK_THEME:
            return {
                theme: DARK_THEME
            }
        case SET_DEFAULT_THEME:
            return {theme: DEFAULT_THEME}
        default:
            return state
    }
}