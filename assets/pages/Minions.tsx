import React, {useEffect, useState} from "react";
import Grid from "@material-ui/core/Grid";
import {DataGrid, ColDef, ValueGetterParams, RowsProp, RowProps, StateChangeParams} from '@material-ui/data-grid';
import {RU_LOCALE_TEXT} from "../components/addons/grid_ru";
import {renderCellExpand} from "../components/addons/GridCellExpand"
import CustomGridPagination from "../components/addons/CustomGridPagination";
import NoDataOverlay from "../components/addons/NoDataOverlay";

import {NavLink , useLocation} from 'react-router-dom';
import {createStyles, makeStyles, Theme} from "@material-ui/core";

const useStyles = makeStyles((theme: Theme) =>
    createStyles({
        table_cell_link : {
            textDecoration : 'none',
            color : theme.palette.text.primary
        }
    }),
);

function Minions() {
    const classes = useStyles()

    const [minions,setMinions] = useState<RowsProp>([])

    const [loading, setLoading] = useState(true)

    const columns: ColDef[] = [
        { field: 'node_name', headerName: 'Компьютер', flex: 1,
            renderCell: params => {
                console.log(params.row.id)
                return  (
                    <NavLink to={`/minions/${params.row.id}`} className={classes.table_cell_link} >
                        {params.value}
                    </NavLink>
                )
            }
        },
        { field: 'selialnumber', headerName: 'Серийный номер', width: 180, renderCell: renderCellExpand },
        { field: 'ip', headerName: 'IP адрес', width: 210, renderCell: renderCellExpand},
        { field: 'mac', headerName: 'MAC адрес', width: 210, renderCell: renderCellExpand},
        { field: 'fio_user', headerName: 'ФИО ответственного', flex: 1, renderCell: renderCellExpand},
        { field: 'user_phone', headerName: 'Телефон', width: 200, renderCell: renderCellExpand},
        { field: 'room', headerName: 'Кабинет', width: 180, renderCell: renderCellExpand},
        {
            field: 'created_at',
            headerName: 'Создано',
            width: 180,
            type:"dateTime",
            hide:true,
            valueFormatter: params => new Date(params.value as string).toLocaleString(),
        },
        {
            field: 'updated_at',
            headerName: 'Обновлено',
            width: 180,
            type:"dateTime",
            valueFormatter: params => new Date(params.value as string).toLocaleString(),

        }
    ];


    useEffect(()=>{
        setLoading(true);
        fetch('/api/minion/').then(response=>response.json()).then(result=>{
            setLoading(false)
            setMinions(result)
        })
    },[])

    return (
        <>
            <Grid container  direction={"row"}>

                <Grid item xs={12}>
                    <h2>Зарегистрированные компьютеры</h2>
                </Grid>

                <Grid item xs={12}>
                    <div style={{ height: '78vh', width: '100%' }}>
                        <DataGrid rows={minions}
                                  columns={columns}
                                  // pageSize={12}
                                  autoPageSize={true}
                                  checkboxSelection={false}
                                  localeText={RU_LOCALE_TEXT}
                                  loading={loading}
                                  // onStateChange={onStateChange}
                                  density={"compact"}
                                  // hideFooterPagination={true}
                                  components={{
                                      NoRowsOverlay: NoDataOverlay,
                                      Pagination : CustomGridPagination
                                  }}
                        />
                    </div>

                </Grid>
            </Grid>

        </>
    )
}

export default Minions