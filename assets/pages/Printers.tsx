import React, {useEffect, useState} from "react";
import CssBaseline from "@material-ui/core/CssBaseline";
import Grid from "@material-ui/core/Grid";
import {ColDef, DataGrid} from '@material-ui/data-grid';

import {RU_LOCALE_TEXT} from "@components/addons/grid_ru";
import {renderCellExpand} from "@components/addons/GridCellExpand"
import CustomGridPagination from "@components/addons/CustomGridPagination";
import NoDataOverlay from "@components/addons/NoDataOverlay";

function Printers(){

    const [printers,setPrinters] = useState([])

    useEffect(()=>{
        // setLoading(true);
        fetch('/api/printer/').then(response=>response.json()).then(result=>{
            // setLoading(false)
            setPrinters(result)
        })
    },[])

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

                <Grid item xs={12}>
                    <h2>Принтера</h2>
                </Grid>

                <Grid item xs={12}>
                    <div style={{ height: '78vh', width: '100%' }}>
                        <DataGrid
                            rows={printers}
                            columns={columns}
                            // pageSize={12}
                            autoPageSize={true}
                            checkboxSelection={false}
                            localeText={RU_LOCALE_TEXT}
                            loading={printers===undefined}
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

export default Printers