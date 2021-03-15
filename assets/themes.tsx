import React from "react";
import {createMuiTheme} from "@material-ui/core";

const theme_dark = createMuiTheme({
    palette :{
        primary :{
            dark: "#1769aa",
            main: "#2196f3",
            light: "#4dabf5"
        },
        type: "dark"
    }
})

const theme_default = createMuiTheme({
    palette: {
        type: "light"
    }
})

export const DARK_THEME = "dark"
export const DEFAULT_THEME = "light"

export {theme_dark, theme_default}