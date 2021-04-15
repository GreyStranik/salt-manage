import React, {useEffect, useState} from "react";

import Grid from "@material-ui/core/Grid";

import Card from "@material-ui/core/Card";
import CardContent from '@material-ui/core/CardContent';
import CardActionArea from "@material-ui/core/CardActionArea";
import Typography from '@material-ui/core/Typography';
import useStyles from "./styles";
import {useDispatch} from "react-redux";
import { useHistory } from "react-router-dom";
import {clearFilters, filterOnlyBy} from "@store/filters/actions";
import {CompareType, UPDATED_AT} from "@add_types/filters/minion_filters";
import useSWR from "swr";
import {fetcher} from "@pages/fetcher";

interface MinionCount {
    count_all : number,
    count_today : number,
    count_low_2week : number,
    count_low_month : number
}

export default function MinionsInfo(){
    const classes = useStyles();
    const dispatch = useDispatch()
    const history = useHistory()

   const initialData = {
        count_all : 0,
        count_today : 0,
        count_low_2week : 0,
        count_low_month : 0
    }
    const {data} = useSWR<MinionCount>('/api/minion/info',fetcher,{initialData,revalidateOnMount:true})

    const handle_low_month = () => {
        const date = new Date()
        const d_val = new Date(date.getTime()-(30*24*60*60*1000)).toISOString().slice(0,10)
        dispatch(filterOnlyBy({ field: UPDATED_AT, compare: CompareType.LESS_AND_EQUAL, value: d_val  }))
        history.push("/minions")
    }

    const handle_low_2week = () => {
        const date = new Date()
        const d_val = new Date(date.getTime()-(14*24*60*60*1000)).toISOString().slice(0,10)
        dispatch(filterOnlyBy({ field: UPDATED_AT, compare: CompareType.LESS_AND_EQUAL, value: d_val  }))
        history.push("/minions")
    }

    const handle_today = () => {
        const date = new Date()
        const d_val = date.toISOString().slice(0,10)
        dispatch(filterOnlyBy({ field: UPDATED_AT, compare: CompareType.LESS_AND_EQUAL, value: d_val  }))
        history.push("/minions")
    }

    const handle_all = () => {
        dispatch(clearFilters())
        history.push("/minions")
    }

    return (
        <>
            <Grid container spacing={2} className={classes.root}>

                <Grid item lg={3} md={6} xs={12}>
                    <Card variant={"outlined"} className={classes.count_all_border}>
                        <CardActionArea onClick={handle_all}>
                            <CardContent>
                                <div className={classes.card_line}>
                                    <Typography variant={"h3"} className={classes.count}>{data?.count_all}</Typography>
                                    <Typography variant={"body1"} className={classes.description} >
                                        Общее количество миньонов
                                    </Typography>
                                </div>

                            </CardContent>
                        </CardActionArea>
                    </Card>
                </Grid>

                <Grid item lg={3} md={6} xs={12}>
                    <Card variant={"outlined"} className={classes.count_today_border}>
                        <CardActionArea onClick={handle_today}>
                            <CardContent>
                                <div className={classes.card_line}>
                                    <Typography variant={"h3"} className={classes.count_today}>{data?.count_today}</Typography>
                                    <Typography variant={"body1"} className={classes.description} >
                                        Обновлено сегодня
                                    </Typography>
                                </div>

                            </CardContent>
                        </CardActionArea>
                    </Card>
                </Grid>

                <Grid item lg={3} md={6} xs={12}>
                    <Card variant={"outlined"} className={classes.count_low_2week_border}>
                        <CardActionArea onClick={handle_low_2week}>
                            <CardContent>
                                <div className={classes.card_line}>
                                    <Typography variant={"h3"} className={classes.count_low_2week}>{data?.count_low_2week}</Typography>
                                    <Typography variant={"body1"} className={classes.description}>
                                        Недоступны более 2х недель
                                    </Typography>
                                </div>

                            </CardContent>
                        </CardActionArea>
                    </Card>
                </Grid>

                <Grid item lg={3} md={6} xs={12}>
                    <Card variant={"outlined"} className={classes.count_low_month_border}>
                        <CardActionArea onClick={handle_low_month}>
                            <CardContent>
                                <div className={classes.card_line}>
                                    <Typography variant={"h3"} className={classes.count_low_month}>{data?.count_low_month}</Typography>
                                    <Typography variant={"body1"} className={classes.description} >
                                        Недоступны более месяца
                                    </Typography>
                                </div>

                            </CardContent>
                        </CardActionArea>
                    </Card>
                </Grid>

            </Grid>
        </>
    )

}