import React, {useEffect, useState} from "react";

import Card from "@material-ui/core/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import Typography from '@material-ui/core/Typography';
import Grid from "@material-ui/core/Grid";
import { Theme, makeStyles, createStyles } from '@material-ui/core/styles';

interface MinionCount {
    count_all : number,
    count_today : number,
    count_low_month : number
}

export default function InfoCard(){

    const useStyles = makeStyles(() =>
                createStyles({
                    num : {
                        fontWeight: 'bold'
                    }
                }))

    const classes = useStyles();

    const [minionsCount,setMinionsCount] = useState<MinionCount>({
        count_all : 0,
        count_today : 0,
        count_low_month : 0
    });

    useEffect(()=>{
        fetch('/api/minion/info').then(responce=>responce.json()).then(result=>setMinionsCount(result));
    },[])

    return (
        <Grid item>
            <Card>
                <CardHeader title={"Количество миньонов"}/>

                <CardContent>
                    <Typography variant={"body1"} component={"p"}>
                        Общее количество миньенов: <span className={classes.num}>{minionsCount.count_all}</span>
                    </Typography>
                    <Typography variant={"body1"} component={"p"}>
                        Обновлено сегодня: <span className={classes.num}>{minionsCount.count_today}</span>
                    </Typography>
                    <Typography variant={"body1"} component={"p"}>
                        Недоступны более месяца: <span className={classes.num}>{minionsCount.count_low_month}</span>
                    </Typography>
                </CardContent>

            </Card>
        </Grid>
    )
}