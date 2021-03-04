import React from "react";
import {createStyles, makeStyles} from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';

const useStyles = makeStyles((theme:Theme) =>
    createStyles({
        root : {
            flexGrow: 1
        },
        card : {
            margin: 12
        },
        item :  {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'flex-start',
        },
        item_name : {
            flex : '0 0 40%',
            fontWeight : 700,
            color: theme.palette.text.secondary
        },
        item_value : {
            flex: '0 0 60%',
            color: theme.palette.primary.main,
            fontWeight: 600
        }
    })
)

export default useStyles

