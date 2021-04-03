import {createStyles, fade, makeStyles} from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';

export const useStyles = makeStyles((theme:Theme)=>
    createStyles({
        search: {
            position: 'relative',
            borderRadius: theme.shape.borderRadius,
            backgroundColor: fade(theme.palette.common.white, 0.15),
            '&:hover': {
                backgroundColor: fade(theme.palette.common.white, 0.25),
            },
            marginLeft: 0,
            width: '100%',
            [theme.breakpoints.up('sm')]: {
                marginLeft: theme.spacing(1),
                width: 'auto',
            },
        },
        searchIcon: {
            padding: theme.spacing(0, 2),
            height: '100%',
            position: 'absolute',
            pointerEvents: 'none',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
        },
        inputRoot: {
            color: 'inherit',
        },
        inputInput: {
            padding: theme.spacing(1, 1, 1, 0),
            // vertical padding + font size from searchIcon
            paddingLeft: `calc(1em + ${theme.spacing(4)}px)`,
            transition: theme.transitions.create('width'),
            width: '100%',
            [theme.breakpoints.up('sm')]: {
                width: '12ch',
                '&:focus': {
                    width: '20ch',
                },
            },
        },
        popper: {
            zIndex: 2000,
            width: '300px',
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
        partion_header : {
            textAlign: 'right',
            paddingRight: '1rem'
        },
        more_data : {
            cursor: 'pointer',
            color: theme.palette.text.secondary,
            textAlign: 'right',
            paddingRight: '1rem'
        }

    })
)