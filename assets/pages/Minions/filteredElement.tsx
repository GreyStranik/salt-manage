import React from "react";
import {CompareItem, CompareType, FilterField, NODE_NAME} from "@add_types/filters/minion_filters";
import {useDispatch, useSelector} from "react-redux";
import {RootState} from "@store/store";
import {filterBy, removeFilter} from "@store/filters/actions";
import TextField from "@material-ui/core/TextField/TextField";

interface FilteredElementPropt {
    title: string
    field: FilterField
    compare?: CompareType
}

export function FilteredElement({field, title, compare=CompareType.CONTAINS}:FilteredElementPropt){

    const dispatch = useDispatch()
    const filters = useSelector((state:RootState)=>state.filter)

    const filterParamChanged = (event: React.ChangeEvent<HTMLInputElement>) => {
        const value = event.target.value
        const filter:CompareItem={
            field : event.target.name as FilterField,
            compare,
            value
        }
        value!=="" ? dispatch(filterBy(filter)) : dispatch(removeFilter(event.target.name as FilterField))

    }

    return (
        <>
            <TextField
                label={title}
                variant={"outlined"}
                name={field as string}
                value={filters.find(item=>item.field===field)?.value}
                onChange={filterParamChanged}
                size={"small"}
                fullWidth
            />
        </>
    )
}