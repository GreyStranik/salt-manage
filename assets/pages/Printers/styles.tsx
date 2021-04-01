import {createStyles, makeStyles, Theme} from "@material-ui/core";

export const useStyles = makeStyles((theme:Theme)=>
    createStyles({
        printer_title: {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center'
        },
        export_btn : {
            marginLeft:'1rem'
        }
    }))