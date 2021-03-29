import React, {useEffect, useState} from "react";
import Select from "@material-ui/core/Select";
import MenuItem from "@material-ui/core/MenuItem";
import FormControl from "@material-ui/core/FormControl";
import InputLabel from "@material-ui/core/InputLabel";
import { createStyles, makeStyles, Theme } from '@material-ui/core/styles';
import {CompareItem, CompareType, FilterField} from "@add_types/filters/minion_filters";
import {useDispatch, useSelector} from "react-redux";
import {RootState} from "@store/store";
import {filterBy, removeFilter} from "@store/filters/actions";

interface IDataItem {
    id : string
    name : string
}

interface FilteredSelectableElementProps {
    title  : string
    field : FilterField
}

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        formControl: {
            // margin: theme.spacing(1),
            minWidth: 120,
        },
        selectEmpty: {
            marginTop: theme.spacing(2),
        },
    }),
);

export default function FilteredSelectableElement(props:FilteredSelectableElementProps){

    const classes = useStyles()

    const [dataItems, setDataItems] = useState<IDataItem[]>([])
    const dispatch = useDispatch()
    const filters = useSelector((state:RootState)=>state.filter)

    useEffect(()=>{
        fetch(`/api/${props.field as string}/`).then(response=>response.json()).then(result=>setDataItems(result))
    },[])

    const handleChange = (event:React.ChangeEvent<{ value: unknown }>) => {
        console.log(event.target.value)
        const value = event.target.value as string
        const filter:CompareItem={
            field : props.field as FilterField,
            compare : CompareType.EQUAL,
            value
        }
        value!=="" ? dispatch(filterBy(filter)) : dispatch(removeFilter(props.field as FilterField))

    }

    return (
        <>
            <FormControl className={classes.formControl} variant={"outlined"} size={"small"} fullWidth>
                <InputLabel>{props.title}</InputLabel>
                <Select
                    defaultValue={""}
                    name={props.field as string}
                    value={filters.find(item=>item.field===props.field)?.value}
                    onChange={handleChange}
                    label={props.title}
                >
                    <MenuItem value={""}>Все </MenuItem>
                    {
                        dataItems.map(item=>{
                            return (
                                <MenuItem key={item.id} value={item.name}>{item.name}</MenuItem>
                            )
                        })
                    }
                </Select>
            </FormControl>

        </>
    )
}