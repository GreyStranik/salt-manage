import {CompareItem, CompareType, GridMinionItem} from "@add_types/filters/minion_filters";

function filterMinion(minion:GridMinionItem,filters:CompareItem[]):Boolean {

    const expressions = filters.map(filter=>{
        // console.log(minion?.node_name)
        console.log(minion)
        const value = minion[filter.field]
        console.log(filter.field,value,filter.compare,filter.value)
        if (filter.compare===CompareType.CONTAINS){
            return value.toLowerCase().includes(filter.value.toLowerCase())
        }
        if (filter.compare===CompareType.EQUAL){
            return value.toLowerCase()===filter.value.toLowerCase()
        }

    })
    console.log(expressions)
    return expressions.every(value=>value)
}

export const filterMinions=(minions:GridMinionItem[],filters:CompareItem[])=>{
    return minions.filter(minion=>filterMinion(minion,filters))
}