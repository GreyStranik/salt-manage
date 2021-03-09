import React from 'react'

import Toolbar from '@material-ui/core/Toolbar';
import XAppBar from "@components/XAppBar";
import SidePanel from "@components/SidePanel"

import {makeStyles, fade} from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';
// import Toolbar from "@material-ui/core/Toolbar";

import {
    Route,
    Switch,
    Redirect,
    withRouter
} from "react-router-dom"

import Dashboard from "@pages/Dashboard"
import Minions from "@pages/Minions";
import Programms from "@pages/Programms";
import NotFound from "@pages/NotFound";
import Minion from "@pages/Minion";
import Programm from "@pages/Programm";

function App() {

    const useStyles = makeStyles((theme: Theme) => ({
        content : {
            flexGrow: 1,
            padding: theme.spacing(3),
        }
    }));

    const classes = useStyles();

    return (
        <div style={{display: "flex", minHeight: '100vh'}}>
            <XAppBar/>
            <SidePanel />

            <main className={classes.content}>
                <Toolbar  />

                <Switch>
                    <Route exact path="/" render={() => <Redirect to="/dashboard" />} />
                    <Route exact={true} path={"/dashboard"} component={Dashboard} />
                    <Route exact={true} path={"/minions"} component={Minions} />
                    <Route path={"/minions/:id"} component={Minion} />
                    <Route exact={true} path={"/programms"} component={Programms} />
                    <Route path={"/programms/:id"} component={Programm}/>
                    <Route path={'*'} component={NotFound} />
                    {/*<Redirect to={"/dashboard"} from={"/"} />*/}

                </Switch>

            </main>

        </div>
    )
}

export default withRouter(App)