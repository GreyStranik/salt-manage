import React, {useEffect, useState} from "react";

import DataChart from '@components/DataChart'
import {ChartDataItem} from "@components/DataChart/DataChart";
import Grid from "@material-ui/core/Grid";
import Card from "@material-ui/core/Card/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from "@material-ui/core/CardContent";
import {MANUFACTURER} from "@add_types/filters/minion_filters";

export default function ManufacturerCard(){

    const [data, setData] = useState<ChartDataItem[]>([])

    useEffect(()=>{
        fetch("/api/manufacturer/manufacturer_static").then(response=>response.json()).then(result=>setData(result))
    },[])

    return (
        <>
            <Grid item lg={4} md={6} sm={12}>
                <Card>
                    <CardHeader title={"Производители"} subheader={"Производители компьютеров"}/>
                    <CardContent>
                        <DataChart data={data} height={170} field={MANUFACTURER} />
                    </CardContent>
                </Card>
            </Grid>
        </>
    )
}