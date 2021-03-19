import {createStyles, makeStyles, Theme} from "@material-ui/core";

export const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        table_cell_link : {
            textDecoration : 'none',
            color : theme.palette.text.primary
        },
        formControl: {
            margin: theme.spacing(3),
        },
        formItem: {
            marginBottom: theme.spacing(1)
        }
    }),
);