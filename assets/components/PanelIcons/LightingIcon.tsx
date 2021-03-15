import React from "react";
import Moon from '@material-ui/icons/Brightness4';
import Sun from '@material-ui/icons/Brightness7';
import IconButton from "@material-ui/core/IconButton";
import {useDispatch, useSelector} from "react-redux";
import {RootState} from "@store/store";
import {actionSetDark, actionSetLight} from "@store/theme/actions";
import {DEFAULT_THEME} from "../../themes";

export default function LightingIcon(){

    const theme = useSelector( (state:RootState) => state.theme)

    const dispatch = useDispatch()

    console.log("theme", theme)

    const handleClick = () => {
        dispatch( theme.theme===DEFAULT_THEME ? actionSetDark() : actionSetLight())
    }

    return (
        <>
            <IconButton color={"inherit"} onClick={handleClick}>
                {
                    theme.theme===DEFAULT_THEME ? (<Sun/>) : (<Moon  />)
                }
            </IconButton>
        </>
    )
}
