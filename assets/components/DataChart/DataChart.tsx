import React, {useState} from "react";

import {Cell, Pie, PieChart, Legend, Sector} from "recharts";

export interface ChartDataItem {
    name : string,
    value : number
}

export interface ChartProps {
    data : ChartDataItem[],
    width?: number,
    height?: number,
    legendWidth?: number

}

function DataChart({data, width=400, height=250, legendWidth=160 }:ChartProps){

    const [activeIndex, setActiveIndex] = useState(-1)

    const COLORS = ['#0088FE', '#00C49F', '#FFBB28',
        '#FF8042','#D8241F','#BCBF00'];

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
            <PieChart width={width} height={height}>
                <Legend onMouseEnter={handleLegendEnter}
                        layout='vertical'
                        verticalAlign='middle'
                        align="right"
                        width={legendWidth}
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
        </>
    )
}

export {DataChart}