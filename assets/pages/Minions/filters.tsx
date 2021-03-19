import {CompareItem, CompareType, CREATE_AT, GridMinionItem, UPDATED_AT} from "@add_types/filters/minion_filters";

function filterMinion(minion:GridMinionItem,filters:CompareItem[]):Boolean {

    const expressions = filters.map(filter=>{

        const value = minion[filter.field]
        if ( (filter.field===CREATE_AT) || (filter.field===UPDATED_AT) ) {

            const sDate = new Date(filter.value)
            const minionDate = new Date(value.slice(0,10))

            switch (filter.compare) {
                case CompareType.EQUAL:
                    return minionDate.getTime()===sDate.getTime()
                case CompareType.LESS_AND_EQUAL:
                    return minionDate<=sDate
                case CompareType.MORE_AND_EQUAL:
                    return minionDate>=sDate
                default:
                    return true
            }
        } else {
            if (filter.compare===CompareType.CONTAINS){
                return value.toLowerCase().includes(filter.value.toLowerCase())
            }
            if (filter.compare===CompareType.EQUAL){
                return value.toLowerCase()===filter.value.toLowerCase()
            }
        }
    })

    return expressions.every(value=>value)
}

export const filterMinions=(minions:GridMinionItem[],filters:CompareItem[])=>{
    return minions.filter(minion=>filterMinion(minion,filters))
}