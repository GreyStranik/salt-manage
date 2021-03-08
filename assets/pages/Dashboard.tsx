import React from "react";

import Grid from "@material-ui/core/Grid";
import {createStyles, makeStyles} from "@material-ui/core/styles";
import CpuCard from "@cards/CpuCard";
import DepartmentsCard from "@cards/DepartmentsCard";
import TypeCard from "@cards/TypeCards";
import OsCard from "@cards/OsCard";
import ManufacturerCard from "@cards/ManufacturerCard";
import MinionsInfo from "@components/MinionsInfo";
import CssBaseline from "@material-ui/core/CssBaseline/CssBaseline";

function Dashboard() {

    const useStyles = makeStyles(() =>
        createStyles({
            root : {
                flexGrow: 1
            },
            card : {
                margin: 12
            }
        }))

    const classes = useStyles();

    return (
        <>
            <CssBaseline />
            <Grid container /*direction={"row"}*/ spacing={4} className={classes.root}>

                <Grid item xs={12}>
                    <h1>Панель управления</h1>
                </Grid>

                <MinionsInfo/>

                <Grid item xs={12} >
                    <Grid container spacing={2}>

                        {/*<InfoCard />*/}
                        <CpuCard/>
                        <DepartmentsCard/>

                        <TypeCard />
                        <OsCard/>
                        <ManufacturerCard />

                    </Grid>
                </Grid>

            </Grid>

        </>
    )
}

export default Dashboard