import React, {useEffect, useState} from "react";
import CssBaseline from "@material-ui/core/CssBaseline";
import Grid from "@material-ui/core/Grid";
import {ColDef, DataGrid} from '@material-ui/data-grid';

import {RU_LOCALE_TEXT} from "@components/addons/grid_ru";
import {renderCellExpand} from "@components/addons/GridCellExpand"
import CustomGridPagination from "@components/addons/CustomGridPagination";
import NoDataOverlay from "@components/addons/NoDataOverlay";
import {GridPrinterItem} from "@pages/Printers/interfaces";
import {useStyles} from "@pages/Printers/styles";
import XLSL, {writeFile} from "xlsx";
import Button from "@material-ui/core/Button";
import {useDispatch, useSelector} from "react-redux";
import {RootState} from "@store/store";
import {clearFindPrinter, findPrinter} from "@store/find_equipment/actions";
import FormControl from "@material-ui/core/FormControl";
import InputLabel from "@material-ui/core/InputLabel";
import OutlinedInput from "@material-ui/core/OutlinedInput";
import InputAdornment from "@material-ui/core/InputAdornment";
import IconButton from "@material-ui/core/IconButton";
import ClearIcon from "@material-ui/icons/Clear";

const findPrinters = (printers:GridPrinterItem[],find:string):GridPrinterItem[] => {
    return printers.filter(item =>
        item.name.toLowerCase().includes(find.toLowerCase())
        ||  item.serial.toLowerCase().includes(find.toLowerCase())
        ||  item.node_name.toLowerCase().includes(find.toLowerCase())
    )
}

function Printers(){
    const classes = useStyles()
    const [printers,setPrinters] = useState<GridPrinterItem[]>([])

    const find = useSelector((state:RootState) => state.equipment_find.printer)
    const dispatch = useDispatch()

    useEffect(()=>{
        // setLoading(true);
        fetch('/api/printer/').then(response=>response.json()).then(result=>{
            // setLoading(false)
            setPrinters(result)
        })
    },[])

    const handleFindChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        dispatch(findPrinter(event.target.value.toLowerCase()))
    }

    const columns:ColDef[] = [
        {field:'serial',headerName:'Серийный номер',renderCell: renderCellExpand, flex: 1},
        {field:'name',headerName:"Модель",renderCell: renderCellExpand, flex: 1},
        {field:'vendor_name',headerName:"Производитель",renderCell: renderCellExpand, flex:1 },
        {field:'node_name',headerName:"Компьютер",renderCell: renderCellExpand, flex:1}
    ]

    const exportData = () => {
        const data = printers.map(item=>(
            {
                'Компьютер' : item.node_name,
                'Серийный номер' : item.serial,
                'Принтер' : item.name,
                'Производитель' : item.vendor_name,
            }
        ))
        const book = XLSL.utils.book_new()
        const sheet = XLSL.utils.json_to_sheet(data)
        XLSL.utils.book_append_sheet(book,sheet,"Принтера")

        writeFile(book,"printers.xlsx")
    }

    return (
        <>
            <CssBaseline />
            <Grid container  direction={"row"} spacing={1}>

                <Grid item xs={12} className={classes.printer_title}>
                    <h2>Принтера</h2>
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
                    <FormControl variant={"filled"} fullWidth /*className={classes.find} */ >
                        <InputLabel htmlFor={"printer-find"}>Поиск принтеров</InputLabel>
                        <OutlinedInput
                            id={"printer-find"}
                            value={find}
                            onChange={handleFindChange}
                            endAdornment={
                                <InputAdornment position={"end"}>
                                    <IconButton onClick={() =>{dispatch(clearFindPrinter())} }>
                                        <ClearIcon />
                                    </IconButton>
                                </InputAdornment>
                            }
                        />
                    </FormControl>
                </Grid>

                <Grid item xs={12}>
                    <div style={{ height: '72vh', width: '100%' }}>
                        <DataGrid
                            rows={findPrinters(printers,find)}
                            columns={columns}
                            // pageSize={12}
                            autoPageSize={true}
                            checkboxSelection={false}
                            localeText={RU_LOCALE_TEXT}
                            loading={printers===undefined}
                            // onStateChange={onStateChange}
                            density={"compact"}
                            disableColumnFilter
                            hideFooterSelectedRowCount={true}
                            hideFooterRowCount={false}
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