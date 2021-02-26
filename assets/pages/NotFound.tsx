import React from "react";
import CssBaseline from "@material-ui/core/CssBaseline";
import Grid from "@material-ui/core/Grid";

import {makeStyles } from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';

import Typography from "@material-ui/core/Typography";
import classnames from "classnames";
import Button from "@material-ui/core/Button";
import {Link} from "react-router-dom"

export default function NotFound() {

    const useStyles = makeStyles((theme: Theme) =>
        ({
            root : {
                height: "calc(100vh - 128px)"
            },
            textRow: {
                //marginBottom: theme.spacing(10),
                margin: theme.spacing(2),
                textAlign: "center",
                width: '40vw'
            },
            errorCode: {
                fontSize: 148,
                fontWeight: 600,
                textAlign: "center"
            },
            safetyText: {
                fontWeight: 300,
                // color: theme.palette.text.hint,
            },
            backButton: {
                // boxShadow: theme.customShadows.widget,
                textTransform: "none",
                fontSize: 22,
            },
            item : {
                display: "flex",
                alignItems: "center",
                flexDirection: "column"
            }
        }))

    const classes = useStyles();

    return (
        <>
            <CssBaseline/>
            <Grid container
                  alignItems={"center"}
                  alignContent={"center"}
                  justify={"center"}
                  direction={"row"}
                  className={classes.root}
            >
                <Grid item className={classes.item}>

                    <Typography variant={"h1"} color={"primary"} className={classes.errorCode}>
                        404
                    </Typography>
                    <Typography variant="h5" color="primary" className={classes.textRow}>
                        Ой. Похоже, что страница, которую вы ищете, больше не существует
                    </Typography>

                    <Button
                        variant="contained"
                        color="primary"
                        component={Link}
                        to="/"
                        size="large"
                        className={classes.backButton}
                    >
                        Вернуться домой
                    </Button>
                </Grid>

            </Grid>
        </>
    )
}