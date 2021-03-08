import React, {useEffect, useState} from "react";
// import { MouseEvent } from 'react';
import Card from "@material-ui/core/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from '@material-ui/core/CardContent';
import Grid from "@material-ui/core/Grid";
import DataChart from "@components/DataChart";
import {ChartProps, ChartDataItem} from "@components/DataChart/DataChart";

export default function CpuCard(){

    const [data, setData] = useState<ChartDataItem[]>([])

    useEffect(()=>{
        fetch('/api/cpu_model/cpu_static').then(response=>response.json()).then(result=>setData(result))
    },[])

    return (
        <>
            <Grid item lg={4} md={6} sm={12}>
                <Card>
                    <CardHeader title={"CPU"} subheader={"Зоопарк процессоров"}/>
                    <CardContent>

                        <DataChart data={data} height={170}  />

                    </CardContent>
                </Card>
            </Grid>
        </>
    )
}