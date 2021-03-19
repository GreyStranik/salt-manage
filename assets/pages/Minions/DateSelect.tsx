import React, {useEffect, useState} from "react";
import FormGroup from "@material-ui/core/FormGroup/FormGroup";
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Checkbox from "@material-ui/core/Checkbox/Checkbox";
import Select from "@material-ui/core/Select/Select";
import {CompareType, FilterField} from "@add_types/filters/minion_filters";
import MenuItem from "@material-ui/core/MenuItem";
import {KeyboardDatePicker, MuiPickersUtilsProvider} from "@material-ui/pickers";
import MomentUtils from "@date-io/moment";
import moment from "moment";
import {useDispatch, useSelector} from "react-redux";
import {RootState} from "@store/store";
import {filterBy, removeFilter} from "@store/filters/actions";

interface DateSelectProps {
    title : string
    field : FilterField
}

export function DateSelect(props:DateSelectProps){

    const dispatch = useDispatch()
    const filters = useSelector((state:RootState)=>state.filter)

    const [value,setValue] = useState()
    const tmp_v =  filters.find(item => item.field===props.field)?.value
    const [selectedDate, setSelectedDate] = useState<Date>( new Date(tmp_v!==undefined ? tmp_v : new Date()) );

    const [compare,setCompare] = useState(filters.find(item => item.field===props.field)?.compare ?? CompareType.EQUAL)

    useEffect(()=>{
        if (filters.find(item => item.field===props.field)!==undefined) {
            dispatch(filterBy(
                {
                    field: props.field,
                    value:  selectedDate.toISOString().slice(0,10),
                    compare: compare
                }
            ))
        }

    },[compare,selectedDate])

    const handleDateChange = (date:any,value:any) => {
        setSelectedDate(date._d)
    }

    const handleCompareTypeChanged = (event:React.ChangeEvent<{ value: unknown }>) => {
        setCompare(event.target.value as CompareType)
    }

    const handleCheckActive = (event:React.ChangeEvent<HTMLInputElement>) => {
        event.target.checked ?
        dispatch(filterBy(
            {
                field: props.field,
                value:  selectedDate.toISOString().slice(0,10),
                compare: compare
            }
        )) :
            dispatch(removeFilter(props.field))
    }

    return (
        <>
            <FormGroup row>
                <FormControlLabel
                    control={
                        <Checkbox
                            color={"primary"}
                            checked={filters.find(item => item.field===props.field)!==undefined  }
                            onChange={handleCheckActive} />
                    }
                    label={props.title}
                />

                <Select
                    defaultValue={CompareType.EQUAL}
                    variant={"outlined"}
                    value={compare}
                    onChange={handleCompareTypeChanged}
                    style={{minWidth:150}}
                >
                    <MenuItem value={CompareType.EQUAL}>=</MenuItem>
                    <MenuItem value={CompareType.LESS_AND_EQUAL}>Ранее</MenuItem>
                    <MenuItem value={CompareType.MORE_AND_EQUAL}>Позднее</MenuItem>
                </Select>

                <MuiPickersUtilsProvider utils={MomentUtils} libInstance={moment} locale={'ru'} >
                    <KeyboardDatePicker autoOk
                                        variant={"inline"}
                                        inputVariant={"outlined"}
                                        format={"DD.MM.yyyy"}
                                        value={selectedDate}
                                        InputAdornmentProps={{ position: "start" }}
                                        onChange={(dateComparer,value)=>handleDateChange(dateComparer,value)}

                    />
                </MuiPickersUtilsProvider>
            </FormGroup>
        </>
    )
}