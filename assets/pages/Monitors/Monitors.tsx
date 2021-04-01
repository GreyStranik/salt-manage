import React, {useEffect, useState} from "react";
import CssBaseline from "@material-ui/core/CssBaseline";
import Grid from "@material-ui/core/Grid";
import {ColDef, DataGrid} from '@material-ui/data-grid';
import Button from "@material-ui/core/Button";
import XLSL, {writeFile} from 'xlsx'

import {RU_LOCALE_TEXT} from "@components/addons/grid_ru";
import {renderCellExpand} from "@components/addons/GridCellExpand"
import CustomGridPagination from "@components/addons/CustomGridPagination";
import NoDataOverlay from "@components/addons/NoDataOverlay";
import {useStyles} from "@pages/Monitors/styles";
import {filterMinions} from "@pages/Minions/filters";
import {GridMonitorItem} from "@pages/Monitors/interfaces";

function Monitors(){
    const classes = useStyles()

    const [monitors,setMonitors] = useState<GridMonitorItem[]>([])

    useEffect(()=>{
        // setLoading(true);
        fetch('/api/monitor/').then(response=>response.json()).then(result=>{
            // setLoading(false)
            setMonitors(result)
        })
    },[])

    const exportData = () => {
        const data = monitors.map(item=>(
            {
                'Компьютер' : item.node_name,
                'Серийный номер' : item.serial,
                'Принтер' : item.name,
                'Производитель' : item.vendor_name,
            }
        ))
        const book = XLSL.utils.book_new()
        const sheet = XLSL.utils.json_to_sheet(data)
        XLSL.utils.book_append_sheet(book,sheet,"Мониторы")

        writeFile(book,"monitors.xlsx")
    }

    const columns:ColDef[] = [
        {field:'serial',headerName:'Серийный номер',renderCell: renderCellExpand, flex: 1},
        {field:'name',headerName:"Модель",renderCell: renderCellExpand, flex: 1},
        {field:'vendor_name',headerName:"Производитель",renderCell: renderCellExpand, flex:1 },
        {field:'node_name',headerName:"Компьютер",renderCell: renderCellExpand, flex:1}
    ]

    return (
        <>
            <CssBaseline />
            <Grid container  direction={"row"}>

                <Grid item xs={12} className={classes.monitor_title}>
                    <h2>Мониторы</h2>
                    <Button
                        variant={"outlined"}
                        color={"secondary"}
                        className={classes.export_btn}
                        onClick={exportData}
                    >
                        Экспорт
                    </Button>
                </Grid>

                <Grid item xs={12}>
                    <div style={{ height: '78vh', width: '100%' }}>
                        <DataGrid
                            rows={monitors}
                            columns={columns}
                            // pageSize={12}
                            autoPageSize={true}
                            checkboxSelection={false}
                            localeText={RU_LOCALE_TEXT}
                            loading={monitors===undefined}
                            // onStateChange={onStateChange}
                            density={"compact"}
                            // hideFooterPagination={true}
                            // disableColumnFilter
                            components={{
                                // NoRowsOverlay: NoDataOverlay,
                                Pagination : CustomGridPagination
                            }}
                        />
                    </div>
                </Grid>

            </Grid>

        </>
    )
}

export {Monitors}