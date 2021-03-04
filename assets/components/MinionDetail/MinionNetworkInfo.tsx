import React from "react";

import useStyles from "./styles";
import CardHeader from "@material-ui/core/CardHeader";
import CloudQueueIcon from '@material-ui/icons/CloudQueue';
import CardContent from "@material-ui/core/CardContent";
import MinionParamItem from "./MinionParamItem";
import Card from "@material-ui/core/Card/Card";
import Skeleton from "@material-ui/lab/Skeleton";
import {MinionNetwork} from "../../interfaces/MinionDetailInterfaces";

interface INetwokList {
    network? : MinionNetwork[]
}

function MinionNetworkInfo(data:INetwokList){
    return (
        <>
            <Card >
                <CardHeader
                    title={"Сведения о сети"}
                    avatar={<CloudQueueIcon/>}
                />
                <CardContent>
                    {
                        data.network ? (
                            data.network?.map(item => <MinionParamItem title={item.macaddr} value={item.ips}
                                                                   key={item.macaddr}/>)
                        ) : (
                             <Skeleton animation={"wave"} height={'5rem'} />
                        )

                    }
                </CardContent>
            </Card>
        </>
    )
}

export default MinionNetworkInfo