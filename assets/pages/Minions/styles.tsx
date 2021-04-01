import {createStyles, makeStyles, Theme} from "@material-ui/core";
import {flexbox} from "@material-ui/system";

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
        },
        minion_title: {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center'
        },
        popper_in :{
            padding: theme.spacing(2)
        },
        popper: {
            zIndex: 1000,
            width: '800px',
            padding: theme.spacing(2),
            '&[x-placement*="bottom"] $arrow': {
                top: 0,
                left: 0,
                marginTop: "-0.71em",
                marginLeft: 4,
                marginRight: 4,
                "&::before": {
                    transformOrigin: "0 100%"
                }
            },
            '&[x-placement*="top"] $arrow': {
                bottom: 0,
                left: 0,
                marginBottom: "-0.71em",
                marginLeft: 4,
                marginRight: 4,
                "&::before": {
                    transformOrigin: "100% 0"
                }
            },
            '&[x-placement*="right"] $arrow': {
                left: 0,
                marginLeft: "-0.71em",
                height: "1em",
                width: "0.71em",
                marginTop: 4,
                marginBottom: 4,
                "&::before": {
                    transformOrigin: "100% 100%"
                }
            },
            '&[x-placement*="left"] $arrow': {
                right: 0,
                marginRight: "-0.71em",
                height: "1em",
                width: "0.71em",
                marginTop: 4,
                marginBottom: 4,
                "&::before": {
                    transformOrigin: "0 0"
                }
            }
        },
        popper_column_config: {
            zIndex: 1000,
            width: '360px',
            padding: theme.spacing(2),
            '&[x-placement*="bottom"] $arrow': {
                top: 0,
                left: 0,
                marginTop: "-0.71em",
                marginLeft: 4,
                marginRight: 4,
                "&::before": {
                    transformOrigin: "0 100%"
                }
            },
            '&[x-placement*="top"] $arrow': {
                bottom: 0,
                left: 0,
                marginBottom: "-0.71em",
                marginLeft: 4,
                marginRight: 4,
                "&::before": {
                    transformOrigin: "100% 0"
                }
            },
            '&[x-placement*="right"] $arrow': {
                left: 0,
                marginLeft: "-0.71em",
                height: "1em",
                width: "0.71em",
                marginTop: 4,
                marginBottom: 4,
                "&::before": {
                    transformOrigin: "100% 100%"
                }
            },
            '&[x-placement*="left"] $arrow': {
                right: 0,
                marginRight: "-0.71em",
                height: "1em",
                width: "0.71em",
                marginTop: 4,
                marginBottom: 4,
                "&::before": {
                    transformOrigin: "0 0"
                }
            }
        },

        arrow: {
            overflow: "hidden",
            position: "absolute",
            width: "1em",
            height: "0.71em" /* = width / sqrt(2) = (length of the hypotenuse) */,
            boxSizing: "border-box",
            color: theme.palette.background.paper,
            "&::before": {
                content: '""',
                margin: "auto",
                display: "block",
                width: "100%",
                height: "100%",
                boxShadow: theme.shadows[1],
                backgroundColor: "currentColor",
                transform: "rotate(45deg)"
            }
        },
        setup_header : {
            color : theme.palette.text.secondary
        }

    }),
);