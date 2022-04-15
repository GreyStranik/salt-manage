import React, {useEffect, useState} from "react";

import DataChart from '@components/DataChart'
import {ChartDataItem} from "@components/DataChart/DataChart";
import Grid from "@material-ui/core/Grid";
import Card from "@material-ui/core/Card/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from "@material-ui/core/CardContent";
import {OS, OS_RELEASE} from "@add_types/filters/minion_filters";
import useSWR from "swr";
import {fetcher} from "@pages/fetcher";

export default function OsCard(){

    const {data} = useSWR<ChartDataItem[]>('/api/os/os_static',fetcher)

    return (
        <>
            <Grid item lg={4} md={6} sm={12}>
                <Card>
                    <CardHeader title={"ОС"} subheader={"Операционные системы установленные на миньонах"}/>
                    <CardContent>

                        <DataChart data={data||[]} height={170} field={[OS,OS_RELEASE]} />

                    </CardContent>
                </Card>
            </Grid>
        </>
    )
}