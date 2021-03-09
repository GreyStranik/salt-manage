import React, {useEffect, useState} from "react";
import {useParams} from "react-router";
import Grid from "@material-ui/core/Grid";
import Typography from "@material-ui/core/Typography";
import Box from "@material-ui/core/Box";
import Skeleton from "@material-ui/lab/Skeleton";
import {createStyles, makeStyles, Theme} from "@material-ui/core";
import {RowsProp, ColumnProp, ColDef, DataGrid} from "@material-ui/data-grid";
import numeral from "numeral";
import {RU_LOCALE_TEXT} from "@components/addons/grid_ru";
import CustomGridPagination from "@components/addons/CustomGridPagination";
import CssBaseline from "@material-ui/core/CssBaseline/CssBaseline";

interface RouteParams {
    id: string
}

interface ShortSoftInfo {
    id : string
    node_name : string
    size : number
    version : number
    installed_at : Date
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

export default function Programm(){

    const classes = useStyles()
    const {id} = useParams<RouteParams>()
    const [softName,setSoftName] = useState('')
    const [installed,setInstalled] = useState<RowsProp>([])

    useEffect(()=>{
        fetch(`/api/soft/${id}`).then(response=>response.json()).then(result=>{
            setSoftName(result['name'])
            setInstalled(result['installed'])
        })
    },[id])

    const columns:ColDef[] = [
        {field:'node_name',headerName:"Компьютер",flex:1},
        {
            field:'size',
            headerName:'Размер',
            flex:1,
            type:"number",
            valueFormatter: params => numeral(params.value as number).format('0.00 b')
        },
        {field:'version',headerName:'Версия',type:"string", width:240},
        {
            field:'installed_at',headerName:'Дата установки',width:240,
            valueFormatter: params => params.value ? new Date(params.value as string).toLocaleString() : ''
        }
    ]

    return (
        <>
            <CssBaseline />
            <Grid container  direction={"row"}>

                <Grid item xs={12}>
                    <Box display={"flex"} mt={2} mb={3} justifyContent={"space-between"}>

                        <Typography variant={"h5"} color={"textSecondary"} > Информация о программе  </Typography>
                        {
                            softName ? (
                                <Box color={"primary.main"}>
                                    <Typography variant={"h5"} >  {softName} </Typography>
                                </Box>
                            ) : (
                                <Skeleton animation={"wave"} className={classes.item_value} width={1/4} />
                            )
                        }

                    </Box>

                </Grid>

                <Grid item xs={12}>
                    <div style={{ height: '80vh', width: '100%' }}>
                        <DataGrid
                            columns={columns}
                            rows={installed}
                            loading={!installed.length}
                            autoPageSize={true}
                            disableSelectionOnClick={true}
                            localeText={RU_LOCALE_TEXT}
                            // pageSize={15}
                            density={"compact"}
                            components={{
                                Pagination : CustomGridPagination
                            }}
                        />
                    </div>
                </Grid>

            </Grid>

        </>
    )
}