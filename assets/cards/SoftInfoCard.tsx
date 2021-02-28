import React from "react";
import CardActionArea from "@material-ui/core/CardActionArea";
import CardContent from "@material-ui/core/CardContent";
import Typography from "@material-ui/core/Typography";
import Card from "@material-ui/core/Card/Card";
import {ProgrammItemName} from "../interfaces/ProgrammItemName";
import {makeStyles, Theme} from "@material-ui/core/styles";


export default function SoftInfoCard(info:ProgrammItemName){

    const useStyles = makeStyles((theme:Theme)=>({

        info : {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'flex-end'
        }
    }))

    const classes = useStyles()


    return (
        <>
            <Card>
                <CardActionArea key={info.id}>
                    <CardContent>
                        <Typography
                            variant={"h5"}
                            color={"textPrimary"}
                        >
                            {info.name}
                        </Typography>
                        <div className={classes.info}>
                            <Typography variant={"body1"} color={"textSecondary"}>
                                Количество установок
                            </Typography>
                            <Typography variant={"h3"} color={"primary"}>
                                {info.count}
                            </Typography>
                        </div>

                    </CardContent>
                </CardActionArea>
            </Card>
        </>
    )
}