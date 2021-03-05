import React from "react";
import useStyles from "./styles";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from "@material-ui/core/CardContent";
import Typography from "@material-ui/core/Typography";
import Card from "@material-ui/core/Card/Card";
import CardActionArea from "@material-ui/core/CardActionArea";
import StorageIcon from '@material-ui/icons/Storage';
import {MinionDisk} from "../../interfaces/MinionDetailInterfaces";
import Skeleton from "@material-ui/lab/Skeleton";
import {createStyles, makeStyles, withStyles} from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';
import LinearProgress from "@material-ui/core/LinearProgress";
import Divider from '@material-ui/core/Divider';
import numeral from "numeral"

interface IDiskList {
    disk? : MinionDisk[]
}

const BorderLinearProgress = withStyles((theme: Theme) =>
    createStyles({
        root: {
            height: '1rem',
            borderRadius: 0,
            flex: 1,
            marginRight: theme.spacing(1),
        },
        colorPrimary: {
            backgroundColor: theme.palette.grey[theme.palette.type === 'light' ? 200 : 700],
        },
        bar: {
            borderRadius: 0,
            backgroundColor: theme.palette.primary.main,
        },
    }),
)(LinearProgress);

function MinionDiskInfo(data:IDiskList){
    const classes=useStyles()
    return (
        <>
            <Card >
                <CardHeader
                    title={"Сведения о дисках"}
                    avatar={<StorageIcon/>}
                />
                <CardContent>
                    {
                        data.disk ? (
                                data.disk?.map((item,index)=>(
                                    <>
                                        <CardActionArea key={index} className={classes.disk_block}>

                                            <div className={classes.item}>
                                                <Typography variant={"body1"} className={classes.disk_name}>{item.name} ({item.filesystem})</Typography>
                                                <Typography variant={"body1"} className={classes.disk_param_name}>Доступно <span className={classes.disk_param_value}>{ numeral(item.available*1000).format('0.00 b') } </span></Typography>
                                            </div>

                                            <div className={classes.item}>
                                                <BorderLinearProgress variant={"determinate"} value={(item.used / item.blocks)*100} />
                                                <Typography variant={"body1"}>{ item.capacity }</Typography>
                                            </div>

                                            <div className={classes.item}>
                                                <Typography variant={"body1"} className={classes.disk_param_name}>Емкость <span className={classes.disk_param_value}>{ numeral(item.blocks*1000).format('0.00 b') }</span> </Typography>
                                                <Typography variant={"body1"} className={classes.disk_param_name}>Использовано <span className={classes.disk_param_value}> { numeral(item.used*1000).format('0.00 b') }</span> </Typography>
                                            </div>

                                        </CardActionArea>
                                        <Divider variant={"middle"} />
                                    </>

                                ))
                            ) : (
                            <Skeleton animation={"wave"} height={'20rem'} />
                        )

                    }

                </CardContent>
            </Card>
        </>
    )
}

export default MinionDiskInfo