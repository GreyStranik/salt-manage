import React from "react";
import {theme_default, theme_dark, DEFAULT_THEME} from "./themes";
import App from "./App";
import {ThemeProvider} from "@material-ui/styles";
import {useSelector} from "react-redux";
import {RootState} from "@store/store";
import {createMuiTheme} from "@material-ui/core";

export default function ThemedApp() {

    const theme = useSelector( (state:RootState) => state.theme.theme)

    const app_theme = createMuiTheme({
        palette: {
            primary :{
                dark: theme===DEFAULT_THEME ? "#303f9f" : "#1769aa",
                main: theme===DEFAULT_THEME ? "#3f51b5" : "#2196f3",
                light: theme===DEFAULT_THEME ? "#7986cb" :"#4dabf5"
            },
            type: theme===DEFAULT_THEME ? "light" : "dark"
        }
    })

    return (
        <>
            <ThemeProvider theme={ app_theme}>
                <App />
            </ThemeProvider>
        </>
    )
}