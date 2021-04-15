import React, {useEffect, useState} from "react";

import DataChart from '@components/DataChart'
import {ChartDataItem} from "@components/DataChart/DataChart";
import Grid from "@material-ui/core/Grid";
import Card from "@material-ui/core/Card/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from "@material-ui/core/CardContent";
import {DEPARTMENT} from "@add_types/filters/minion_filters";
import useSWR from "swr";
import {fetcher} from "@pages/fetcher";

export default function DepartmentsCard(){

    const { data } = useSWR<ChartDataItem[]>('/api/department/departments_static',fetcher)

    return (
        <>
            <Grid item lg={4} md={6} sm={12}>
                <Card>
                    <CardHeader title={"Подразделения"} subheader={"Подразделения организации"}/>
                    <CardContent>
                        <DataChart data={data||[]} height={170} legendWidth={240} field={DEPARTMENT} />
                    </CardContent>
                </Card>
            </Grid>
        </>
    )
}