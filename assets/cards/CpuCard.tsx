import React, {useEffect, useState} from "react";
// import { MouseEvent } from 'react';
import Card from "@material-ui/core/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import Typography from '@material-ui/core/Typography';
import Grid from "@material-ui/core/Grid";
import { Theme, makeStyles, createStyles } from '@material-ui/core/styles';
import {Cell, Pie, PieChart, Legend, Sector} from "recharts";

interface CpuChartLitsItem {
    name : string,
    value : number
}

export default function CpuCard(){

    const [data, setData] = useState<CpuChartLitsItem[]>([])
    // const data = [
    //     {
    //         name : 'Xeon',
    //         value : 14
    //     },
    //     {
    //         name : 'Celeron',
    //         value : 5
    //     }
    // ]

    const [activeIndex, setActiveIndex] = useState(-1)

    const COLORS = ['#0088FE', '#00C49F', '#FFBB28',
        '#FF8042','#D8241F','#BCBF00'];

    useEffect(()=>{
        fetch('/api/cpu_model/cpu_static').then(response=>response.json()).then(result=>setData(result))
    },[])

    const onPieEnter = (_:any,index:number) => {
        setActiveIndex(index)
        console.log(index)
    }

    const activeSector = (props : any) => {
        console.log(props)
        const RADIAN = Math.PI / 180;
        const { cx, cy, midAngle, innerRadius, outerRadius, startAngle, endAngle, fill, payload, percent, value } = props;
        const sin = Math.sin(-RADIAN * midAngle);
        const cos = Math.cos(-RADIAN * midAngle);
        const sx = cx + (outerRadius + 10) * cos;
        const sy = cy + (outerRadius + 10) * sin;
        const mx = cx + (outerRadius + 30) * cos;
        const my = cy + (outerRadius + 30) * sin;
        const ex = mx + (cos >= 0 ? 1 : -1) * 22;
        const ey = my;
        const textAnchor = cos >= 0 ? 'start' : 'end';

        return (
            <g>
                <text x={cx} y={cy} dy={8} textAnchor="middle" fill={fill}>
                    {payload.value}
                </text>

                <Sector
                    cx={cx}
                    cy={cy}
                    innerRadius={innerRadius}
                    outerRadius={outerRadius}
                    startAngle={startAngle}
                    endAngle={endAngle}
                    fill={fill}
                />
                <Sector
                    cx={cx}
                    cy={cy}
                    startAngle={startAngle}
                    endAngle={endAngle}
                    // innerRadius={outerRadius + 6}
                    // outerRadius={outerRadius + 10}
                    innerRadius={innerRadius - 10}
                    outerRadius={innerRadius - 6}
                    fill={fill}
                />

            </g>
        )
    }

    const handleLegendEnter = ( e : any /* React.MouseEvent<Element,MouseEvent>*/) => {

        const index = data.findIndex(item => {
            return item.name == e.value
        })
        setActiveIndex(index)
    }

    return (
        <>
            <Grid item>
                <Card>
                    <CardHeader title={"CPU"} subheader={"Зоопарк процессоров"}/>
                    <CardContent>

                        <PieChart width={400} height={210}>
                            <Legend onMouseEnter={handleLegendEnter}
                                    layout='vertical'
                                    verticalAlign='middle'
                                    align="right"
                                    width={160}
                            />
                            <Pie data={data}
                                 cx="50%" cy="50%"
                                 dataKey={"value"}
                                 innerRadius={60} outerRadius={80}
                                 paddingAngle={5}
                                 activeIndex={activeIndex}
                                 activeShape={activeSector}
                                 onMouseEnter={onPieEnter}
                            >
                                {
                                    data.map((item,index)=>(
                                        <Cell key={`$(index)`} fill={COLORS[index]} />
                                    ))
                                }
                            </Pie>
                        </PieChart>
                    </CardContent>
                </Card>
            </Grid>
        </>
    )
}