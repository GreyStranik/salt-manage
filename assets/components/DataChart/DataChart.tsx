import React, {useState} from "react";

import {Cell, Legend, Pie, PieChart, ResponsiveContainer, Sector} from "recharts";
import {CompareItem, CompareType, FilterField} from "@add_types/filters/minion_filters";
import {useDispatch} from "react-redux";
import {filterBy, filterOnlyBy} from "@store/filters/actions";
import {useHistory} from "react-router";

export interface ChartDataItem {
    name : string,
    value : number
}

export interface ChartProps {
    data : ChartDataItem[],
    height?: number,
    legendWidth?: number
    field?: FilterField|FilterField[]
}

function DataChart({data, height=250, legendWidth=160, field }:ChartProps){

    const dispatch = useDispatch()
    const history = useHistory()

    const [activeIndex, setActiveIndex] = useState(-1)

    const COLORS = ['#0088FE', '#00C49F', '#FFBB28',
        '#FF8042','#D8241F','#BCBF00'];

    const filter = (value:string) => {

        if (field) {
            if(Array.isArray(field)){
                const vals = value.split(' ')
                const v2 = vals.pop()
                const v1 = vals.join(' ')
                const item1:CompareItem = {
                    field:field[0] ,
                    compare: CompareType.EQUAL,
                    value: v1
                }
                dispatch(filterOnlyBy(item1))
                const item2:CompareItem = {
                    field:field[1],
                    compare: CompareType.EQUAL,
                    value: v2 as string
                }
                dispatch(filterBy(item2))
                history.push("/minions")
            } else {
                if (value!=="Прочие"){
                    const item:CompareItem = {
                        field:field as FilterField,
                        compare: CompareType.EQUAL,
                        value: value
                    }
                    dispatch(filterOnlyBy(item))
                    history.push("/minions")
                }
            }

        }
    }

    const onPieEnter = (_:any,index:number) => {
        setActiveIndex(index)
    }

    const onPieClick = (d:any,index:number) => {
        console.log(d.name)
        filter(d.name)
    }

    const activeSector = (props : any) => {
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

    const handleLegendClick = (e:any) => {
        console.log(e.value)
        filter(e.value)
    }

    return (
        <>
            <ResponsiveContainer height={height} >
                <PieChart  height={height}>
                    <Legend onMouseEnter={handleLegendEnter}
                            onClick={handleLegendClick}
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
                         onClick={onPieClick}
                    >
                        {
                            data.map((item,index)=>(
                                <Cell key={`$(index)`} fill={COLORS[index]} />
                            ))
                        }
                    </Pie>
                </PieChart>
            </ResponsiveContainer>

        </>
    )
}

export {DataChart}