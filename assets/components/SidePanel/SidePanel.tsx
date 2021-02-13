import React from "react";
import { Theme, makeStyles, createStyles } from '@material-ui/core/styles';
import Toolbar from '@material-ui/core/Toolbar';
import Drawer from '@material-ui/core/Drawer';
import CssBaseline from '@material-ui/core/CssBaseline';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import Typography from '@material-ui/core/Typography';
import {NavLink , useLocation} from 'react-router-dom';

import DashboardRoundedIcon  from '@material-ui/icons/DashboardRounded';
import AppsIcon from '@material-ui/icons/Apps';
import DesktopWindowsIcon from '@material-ui/icons/DesktopWindows';

const drawerWidth = 240;

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        root: {
            display: 'flex',
        },
        drawer: {
            width: drawerWidth,
            flexShrink: 0,
        },
        drawerPaper: {
            width: drawerWidth,
        },
        drawerContainer: {
            overflow: 'auto',
        },
        content: {
            flexGrow: 1,
            padding: theme.spacing(3),
        },
        menu_item : {
            textDecoration : 'none',
            color : theme.palette.text.primary
        }
    }),
);

function SidePanel() {
    const classes = useStyles();
    const location = useLocation();

    return (
        <>
            <Drawer
                className={classes.drawer}
                variant={"permanent"}
                classes={{
                    paper: classes.drawerPaper
                }}
            >
                <Toolbar />
                <List >
                    <NavLink to={"/dashboard"} className={classes.menu_item}>
                        <ListItem button selected={location.pathname=="/dashboard"}>
                            <ListItemIcon>
                                <DashboardRoundedIcon />
                            </ListItemIcon>
                            <ListItemText primary={"Панель"} secondary={"Приборная панель"} />
                        </ListItem>
                    </NavLink>
                    <NavLink to={"/minions"} className={classes.menu_item}>
                        <ListItem button selected={location.pathname=="/minions"}>
                            <ListItemIcon >
                                <DesktopWindowsIcon />
                            </ListItemIcon>
                            <ListItemText primary={"Компьютеры"} secondary={"Зарегистрированые миньоны"} />
                        </ListItem>
                    </NavLink>
                    <NavLink to={"/programms"} className={classes.menu_item}>
                        <ListItem button selected={location.pathname=="/programms"}>
                            <ListItemIcon>
                                <AppsIcon/>
                            </ListItemIcon>
                            <ListItemText primary={"Программы"} secondary={"Состав программного обеспечения"} />
                        </ListItem>
                    </NavLink>


                </List>

            </Drawer>
        </>
    )
}

export {SidePanel}