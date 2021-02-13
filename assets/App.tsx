import React from 'react'

import Toolbar from '@material-ui/core/Toolbar';
import XAppBar from "./components/XAppBar";
import SidePanel from "./components/SidePanel"

import {makeStyles, fade} from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';
// import Toolbar from "@material-ui/core/Toolbar";

import {
    Route,
    Switch,
    Redirect,
    withRouter
} from "react-router-dom"

import Dashboard from "./pages/Dashboard"
import Minions from "./pages/Minions";
import Programms from "./pages/Programms";

function App() {

    const useStyles = makeStyles((theme: Theme) => ({
        content : {
            flexGrow: 1,
            padding: theme.spacing(3),
        }
    }));

    const classes = useStyles();

    return (
        <div style={{display: "flex"}}>
            <XAppBar/>
            <SidePanel />

            <main className={classes.content}>
                <Toolbar  />

                <Switch>
                    <Route path={"/dashboard"} component={Dashboard} />
                    <Route path={"/minions"} component={Minions} />
                    <Route path={"/programms"} component={Programms} />
                    <Redirect to={"/dashboard"} from={"/"} />
                </Switch>

            </main>

        </div>
    )
}

export default withRouter(App)