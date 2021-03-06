import React, {useEffect, useState} from "react";
import Grid from "@material-ui/core/Grid";
import CssBaseline from "@material-ui/core/CssBaseline/CssBaseline";
import {createStyles, makeStyles} from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';
import {useParams} from 'react-router'
import {
    MinionDetail,
    MinionDisk,
    MinionInfo,
    MinionNetwork,
    MinionSoft,
    MinionUser
} from "../interfaces/MinionDetailInterfaces";
import MinionParamItem from "../components/MinionDetail/MinionParamItem";
import MinionMainInfo from "../components/MinionDetail/MinionMainInfo";
import MinionUserInfo from "../components/MinionDetail/MinionUserInfo";
import MinionNetworkInfo from "../components/MinionDetail/MinionNetworkInfo";
import MinionDiskInfo from "../components/MinionDetail/MinionDiskInfo";
import MinionSoftInfo from "../components/MinionDetail/MinionSoftInfo";

interface RouteParams {
    id: string
}

const useStyles = makeStyles((theme:Theme) =>
    createStyles({
        root : {
            flexGrow: 1
        },
        card : {
            margin: 12
        },
        item :  {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
        },
        item_name : {
            flex : '0 0 40%'
        },
        item_value : {
            flex: '0 0 50%'
        }
    }))


function Minion(){

    const classes = useStyles();

    const {id} = useParams<RouteParams>()
    console.log(id)
    const [info,setInfo] = useState<MinionInfo>()

    useEffect(()=>{
        setInfo(undefined)
        fetch(`/api/minion/${id}`).then(response=>response.json()).then(result=>{
            console.log(result)
            const network:MinionNetwork[] = result['network']
            const disk:MinionDisk[] = result['disks']
            const soft:MinionSoft[] = result['soft']
            const user:MinionUser = {
                room: result['room'],
                department: result['department'],
                fio_user: result['fio_user'],
                user_phone: result['user_phone'],
                type: result['type'],
                type_dep: result['type_dep']
            }
            const detail:MinionDetail = {
                biosreleasedate: new Date(result['biosreleasedate']),
                biosversion: result['biosversion'],
                cpu_model: result['cpu_model'],
                manufacturer: result['manufacturer'],
                node_name: result['node_name'],
                os: result['os'],
                osrelease: result['osrelease'],
                product_name: result['product_name'],
                saltversion: result['saltversion'],
                serialnumber: result['serialnumber']
            }
            const data:MinionInfo = {
                id,
                disk, detail, network, soft, user
            }
            console.log(data)
            setInfo(data)

        })
    },[id]);

    return (
        <>
            <CssBaseline />
            <Grid container  direction={"row"}>

                <Grid item xs={12}>
                    <h1>Информация о компьютере</h1>
                </Grid>

                <Grid item xs={12}>
                    <Grid container spacing={2} >

                        <Grid item sm={12} md={6} lg={8} >

                            <Grid container spacing={2} >

                                <Grid item md={12} lg={6}>
                                    <MinionMainInfo {...info?.detail} />
                                </Grid>

                                <Grid item md={12} lg={6}>
                                    <MinionUserInfo {...info?.user} />
                                </Grid>

                                <Grid item md={12} lg={6}>
                                    <MinionNetworkInfo network={info?.network}/>
                                </Grid>

                                <Grid item md={12} lg={6}>
                                    <MinionDiskInfo disk={info?.disk} />
                                </Grid>

                            </Grid>

                        </Grid>

                        <Grid item sm={12} md={6} lg={4} >

                            <MinionSoftInfo soft={info?.soft} />

                        </Grid>
                    </Grid>
                </Grid>
            </Grid>
        </>
    )
}

export default Minion