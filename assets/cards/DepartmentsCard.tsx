import React, {useEffect, useState} from "react";

import DataChart from '@components/DataChart'
import {ChartDataItem} from "@components/DataChart/DataChart";
import Grid from "@material-ui/core/Grid";
import Card from "@material-ui/core/Card/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from "@material-ui/core/CardContent";

export default function DepartmentsCard(){

    const [data, setData] = useState<ChartDataItem[]>([])

    useEffect(()=>{
        fetch("/api/department/departments_static").then(response=>response.json()).then(result=>setData(result))
    },[])

    return (
        <>
            <Grid item lg={4} md={6} sm={12}>
                <Card>
                    <CardHeader title={"Подразделения"} subheader={"Подразделения организации"}/>
                    <CardContent>

                        <DataChart data={data} height={170} />

                    </CardContent>
                </Card>
            </Grid>
        </>
    )
}