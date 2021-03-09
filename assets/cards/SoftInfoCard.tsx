import React from "react";
import CardActionArea from "@material-ui/core/CardActionArea";
import CardContent from "@material-ui/core/CardContent";
import Typography from "@material-ui/core/Typography";
import Card from "@material-ui/core/Card/Card";
import {Link} from "react-router-dom";
import {ProgrammItemName} from "@interfaces/ProgrammItemName";
import {makeStyles, Theme} from "@material-ui/core/styles";

interface FilteredProgrammItemName extends ProgrammItemName{
    filter : string
}
export default function SoftInfoCard(data:FilteredProgrammItemName){

    const useStyles = makeStyles((theme:Theme)=>({

        info : {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'flex-end'
        },
        finded : {
            color : theme.palette.primary.main,
            fontWeight : 600
        }
    }))

    const classes = useStyles()


    const filter_parse = (name:string,filter:string) => {
        const start = name.toLocaleLowerCase().indexOf(filter.toLowerCase())
        const filter_end = start + filter.length
        return {start,filter_end}
    }

    const {start,filter_end} = filter_parse(data.name,data.filter)


    return (
        <>
            <Card>
                <CardActionArea key={data.id} component={Link} to={`/programms/${data.id}`}>
                    <CardContent>
                        <Typography
                            variant={"h5"}
                            color={"textPrimary"}
                        >
                            {
                                data.filter ? (
                                    <>
                                        <>{data.name.slice(0,start)}</>
                                        <span className={classes.finded}>{data.name.slice(start,filter_end)}</span>
                                        <>{data.name.slice(filter_end)}</>
                                    </>
                                    )
                                    : (<>{data.name}</>)
                            }

                        </Typography>
                        <div className={classes.info}>
                            <Typography variant={"body1"} color={"textSecondary"}>
                                Количество установок
                            </Typography>
                            <Typography variant={"h3"} color={"primary"}>
                                {data.count}
                            </Typography>
                        </div>

                    </CardContent>
                </CardActionArea>
            </Card>
        </>
    )
}