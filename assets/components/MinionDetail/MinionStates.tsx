import React from "react";
import Card from "@material-ui/core/Card";
import CardContent from "@material-ui/core/CardContent";
import CardHeader from "@material-ui/core/CardHeader";
import Skeleton from "@material-ui/lab/Skeleton";
import Typography from "@material-ui/core/Typography";
import Status from '@material-ui/icons/Info';
import useStyles from "@components/MinionDetail/styles";

interface IMinionStates {
    states?: string[]
}

export default function MinionStates(data:IMinionStates) {

    const classes = useStyles()

    return (
        <>
            <Card>
                <CardHeader title={"Примененные состояния"} avatar={<Status />} />
                <CardContent>
                    {
                        data.states ? (
                                <div className={classes.state_block}>
                                    {
                                        data.states.map(state=><Typography variant={"body2"} className={classes.state_item}>{state}</Typography>)
                                    }
                                </div>

                        ) : (
                            <Skeleton animation={"wave"} height={'5rem'} />
                            )

                    }
                </CardContent>
            </Card>
        </>
    )
}