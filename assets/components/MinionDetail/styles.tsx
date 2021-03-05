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
        },
        disk_name : {
            fontWeight: 600,
            color: theme.palette.text.primary
        },
        disk_block : {
            paddingBottom : theme.spacing(2),
            paddingTop : theme.spacing(2)
        },
        disk_param_name : {
            fontWeight : 700,
            color: theme.palette.text.secondary
        },
        disk_param_value : {
            fontWeight: 600,
            color: theme.palette.primary.main
        }

    })
)

export default useStyles

