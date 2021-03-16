import React from "react";
import {createStyles, makeStyles} from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';

const useStyles = makeStyles((theme:Theme) =>
    createStyles({
        root : {
            flexGrow: 1,
            marginLeft: 8,
            marginRight: 8
        },
        card : {
            margin: 12
        },
        card_line :  {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center'
        },
        description : {
            color: theme.palette.text.secondary,
            width: '50%'
        },
        count : {
            color: theme.palette.primary.main,
            fontSize: 64,
            fontWeight: 600,
        },
        count_today : {
            color: theme.palette.success.main,
            fontSize: 64,
            fontWeight: 600,
        },
        count_low_2week : {
            color: theme.palette.warning.main,
            fontSize: 64,
            fontWeight: 600,
        },
        count_low_month : {
            color: theme.palette.error.main,
            fontSize: 64,
            fontWeight: 600,
        },
        card_border : {
            border: '1px',
            borderStyle: 'solid',
        },
        count_all_border : {
            borderColor: theme.palette.primary.main
        },
        count_today_border : {
            borderColor: theme.palette.success.main
        },
        count_low_2week_border : {
            borderColor: theme.palette.warning.main
        },
        count_low_month_border : {
            borderColor: theme.palette.error.main
        }
    }))

export default useStyles