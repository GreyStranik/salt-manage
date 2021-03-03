import React, {useEffect, useState} from "react";
import Grid from "@material-ui/core/Grid";
import {DataGrid, ColDef, ValueGetterParams, RowsProp, RowProps, StateChangeParams} from '@material-ui/data-grid';
import {RU_LOCALE_TEXT} from "../components/addons/grid_ru";
import {renderCellExpand} from "../components/addons/GridCellExpand"
import CustomGridPagination from "../components/addons/CustomGridPagination";
import NoDataOverlay from "../components/addons/NoDataOverlay";

const columns: ColDef[] = [
    { field: 'node_name', headerName: 'Компьютер', flex: 1 },
    { field: 'selialnumber', headerName: 'Серийный номер', width: 180 },
    { field: 'ip', headerName: 'IP адрес', width: 210, renderCell: renderCellExpand},
    { field: 'mac', headerName: 'MAC адрес', width: 210, renderCell: renderCellExpand},
    { field: 'fio_user', headerName: 'ФИО ответственного', flex: 1},
    { field: 'user_phone', headerName: 'Телефон', width: 200},
    { field: 'room', headerName: 'Кабинет', width: 180}
];

function Minions() {

    const [minions,setMinions] = useState<RowsProp>([])

    const [loading, setLoading] = useState(true)

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