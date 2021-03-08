import React, {useEffect, useState} from "react";

import Grid from "@material-ui/core/Grid";

import Card from "@material-ui/core/Card";
import CardContent from '@material-ui/core/CardContent';
import Typography from '@material-ui/core/Typography';
import useStyles from "./styles";

import classnames from "classnames";

interface MinionCount {
    count_all : number,
    count_today : number,
    count_low_2week : number,
    count_low_month : number
}

export default function MinionsInfo(){
    const classes = useStyles();
    const [minionsCount,setMinionsCount] = useState<MinionCount>({
        count_all : 0,
        count_today : 0,
        count_low_2week : 0,
        count_low_month : 0
    });

    useEffect(()=>{
        fetch('/api/minion/info').then(responce=>responce.json()).then(result=>setMinionsCount(result));
    },[])

    return (
        <>
            <Grid container spacing={2} className={classes.root}>

                <Grid item lg={3} md={6} xs={12}>
                    <Card variant={"outlined"} className={classes.count_all_border}>
                        <CardContent>
                            <div className={classes.card_line}>
                                <Typography variant={"h3"} className={classes.count}>{minionsCount.count_all}</Typography>
                                <Typography variant={"body1"} className={classes.description} >
                                    Общее количество миньонов
                                </Typography>
                            </div>

                        </CardContent>
                    </Card>
                </Grid>

                <Grid item lg={3} md={6} xs={12}>
                    <Card variant={"outlined"} className={classes.count_today_border}>
                        <CardContent>
                            <div className={classes.card_line}>
                                <Typography variant={"h3"} className={classes.count_today}>{minionsCount.count_today}</Typography>
                                <Typography variant={"body1"} className={classes.description} >
                                    Обновлено сегодня
                                </Typography>
                            </div>

                        </CardContent>
                    </Card>
                </Grid>

                <Grid item lg={3} md={6} xs={12}>
                    <Card variant={"outlined"} className={classes.count_low_2week_border}>
                        <CardContent>
                            <div className={classes.card_line}>
                                <Typography variant={"h3"} className={classes.count_low_2week}>{minionsCount.count_low_2week}</Typography>
                                <Typography variant={"body1"} className={classes.description}>
                                    Недоступны более 2х недель
                                </Typography>
                            </div>

                        </CardContent>
                    </Card>
                </Grid>

                <Grid item lg={3} md={6} xs={12}>
                    <Card variant={"outlined"} className={classes.count_low_month_border}>
                        <CardContent>
                            <div className={classes.card_line}>
                                <Typography variant={"h3"} className={classes.count_low_month}>{minionsCount.count_low_month}</Typography>
                                <Typography variant={"body1"} className={classes.description} >
                                    Недоступны более месяца
                                </Typography>
                            </div>

                        </CardContent>
                    </Card>
                </Grid>

            </Grid>
        </>
    )

}