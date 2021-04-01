import React from "react";
import {useDispatch, useSelector} from "react-redux";
import {RootState} from "@store/store";
import {hideColumn, showColumn} from "@store/minion_list_columns/actions";
import {ColumnFields} from "@add_types/filters/minion_filters";
import Typography from "@material-ui/core/Typography";
import {minionsColumnList} from "@pages/Minions/columns";
import FormGroup from "@material-ui/core/FormGroup/FormGroup";
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Switch from "@material-ui/core/Switch/Switch";

export function MinionListConfig() {
    const columns = useSelector((state:RootState)=>state.minions_columns)
    const dispatch = useDispatch()

    const handleColumnToggle = (event: React.ChangeEvent<HTMLInputElement>, checked:boolean) => {
        console.log(event.target.name,checked)
        checked ? dispatch(showColumn(event.target.name as ColumnFields))
            : dispatch(hideColumn(event.target.name as ColumnFields))
    }

    return (
        <>
            <Typography variant={"body1"} color={"textSecondary"}>Настройка колонок</Typography>
            {
                minionsColumnList.map((item,index)=>(
                    <FormGroup key={index} >
                        <FormControlLabel
                            control={
                                <Switch
                                    color={"primary"}
                                    checked={columns[item.column]}
                                    onChange={handleColumnToggle}
                                    name={item.column}
                                />
                            }
                            label={item.title}
                        />
                    </FormGroup>
                ))
            }

        </>
    )
}