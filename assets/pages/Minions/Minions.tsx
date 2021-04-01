import React, {useEffect, useState} from "react";
import Grid from "@material-ui/core/Grid";
import {ColDef, DataGrid} from '@material-ui/data-grid';
import Button from "@material-ui/core/Button";
import XLSL, {WorkBook, writeFile, XLSX$Utils} from 'xlsx'

import {RU_LOCALE_TEXT} from "@components/addons/grid_ru";
import {renderCellExpand} from "@components/addons/GridCellExpand"
import CustomGridPagination from "@components/addons/CustomGridPagination";
import NoDataOverlay from "@components/addons/NoDataOverlay";

import {NavLink} from 'react-router-dom';
import {
    GridMinionItem,
} from "@add_types/filters/minion_filters";


import { useSelector} from "react-redux";

import CssBaseline from "@material-ui/core/CssBaseline/CssBaseline";
import {RootState} from "@store/store";

import {useStyles} from "@pages/Minions/styles";

import {filterMinions} from "@pages/Minions/filters";
import {FilterBlock} from "@pages/Minions/filterBlock";
import {FilterAction} from "@pages/Minions/filterAction";


function Minions() {
    const classes = useStyles()

    const filters = useSelector((state:RootState)=>state.filter)

    const [minions,setMinions] = useState<GridMinionItem[]>([])
    const [loading, setLoading] = useState(true)

    useEffect(()=>{
        setLoading(true);
        fetch('/api/minion/').then(response=>response.json()).then(result=>{
            setLoading(false)
            setMinions(result)
        })
    },[])

    const exportData = () => {
        const data = filterMinions(minions,filters).map(item=>(
            {
                'Компьютер' : item.node_name,
                'Серийный номер' : item.serialnumber,
                'Подразделение' : item.department,
                'Пользователь' : item.fio_user,
                'Кабинет' : item.room,
                'Производитель' : item.manufacturer,
                'ОС' : item.os
            }
        ))
        const book = XLSL.utils.book_new()
        const sheet = XLSL.utils.json_to_sheet(data)
        XLSL.utils.book_append_sheet(book,sheet,"Компьютеры")

        writeFile(book,"computers.xlsx")
    }

    const columns: ColDef[] = [
        { field: 'node_name', headerName: 'Компьютер', flex: 1,
            renderCell: params => {
                return  (
                    <NavLink to={`/minions/${params.row.id}`} className={classes.table_cell_link} >
                        {params.value}
                    </NavLink>
                )
            }
        },
        { field: 'serialnumber', headerName: 'Серийный номер', width: 180, renderCell: renderCellExpand },
        { field: 'ip', headerName: 'IP адрес', width: 210, renderCell: renderCellExpand},
        { field: 'mac', headerName: 'MAC адрес', width: 210, renderCell: renderCellExpand},
        { field: 'fio_user', headerName: 'ФИО ответственного', flex: 1, renderCell: renderCellExpand},
        { field: 'user_phone', headerName: 'Телефон', width: 200, renderCell: renderCellExpand},
        { field: 'room', headerName: 'Кабинет', width: 180, renderCell: renderCellExpand},
        { field: "department", headerName: 'Подразделение', flex: 1, renderCell: renderCellExpand, hide: true},
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

    return (
        <>
            <CssBaseline />
            <Grid container  direction={"row"}>

                <Grid item xs={12} className={classes.minion_title}>
                    <h2>Зарегистрированные компьютеры</h2>

                    <span>
                        <FilterAction/>
                        <Button
                            variant={"outlined"}
                            color={"secondary"}
                            style={{marginLeft:'1rem'}}
                            onClick={exportData}
                        >
                            Экспорт
                        </Button>
                    </span>


                </Grid>

                <Grid item xs={12}>
                    <div style={{ height: '78vh', width: '100%' }}>
                        <DataGrid rows={filterMinions(minions,filters)}
                                  columns={columns}
                                  // pageSize={12}
                                  autoPageSize={true}
                                  checkboxSelection={false}
                                  localeText={RU_LOCALE_TEXT}
                                  loading={loading}
                                  // onStateChange={onStateChange}
                                  density={"compact"}
                                  // hideFooterPagination={true}
                                  disableColumnFilter
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