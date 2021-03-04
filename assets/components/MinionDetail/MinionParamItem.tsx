import React from "react";
import useStyles from "./styles";
import Typography from "@material-ui/core/Typography";
import Skeleton from "@material-ui/lab/Skeleton";

interface MinionParam {
    title : string
    value : any
}

function MinionParamItem(params:MinionParam) {
    const classes = useStyles()
    return (
        <>
            <div className={classes.item}>
                <Typography variant={"body1"} component={'div'} className={classes.item_name} >{params.title}</Typography>
                {
                    params.value!=undefined ? (
                        <Typography variant={"body1"} component={'div'} className={classes.item_value}>{params.value}</Typography>
                    ) : (
                        <Skeleton animation={"wave"} className={classes.item_value}/>
                    )
                }
            </div>
        </>
    )
}

export default MinionParamItem