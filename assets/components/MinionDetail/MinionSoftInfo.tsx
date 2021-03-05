import React, {useEffect, useState} from "react";
import {MinionSoft} from "../../interfaces/MinionDetailInterfaces";
import {DataGrid, ColDef, RowsProp} from "@material-ui/data-grid";
import CardHeader from "@material-ui/core/CardHeader";
import AppsIcon from '@material-ui/icons/Apps';
import CardContent from "@material-ui/core/CardContent";
import Typography from "@material-ui/core/Typography";
import Card from "@material-ui/core/Card/Card";
import numeral from "numeral"
import {renderCellExpand} from "../addons/GridCellExpand";
import CustomGridPagination from "../addons/CustomGridPagination";
import {RU_LOCALE_TEXT} from "../addons/grid_ru";


interface ISoftList {
    soft? : MinionSoft[]
}

function MinionSoftInfo(data:ISoftList){

    const [soft, setSoft] = useState<RowsProp>([])

    useEffect(()=>{
        if (data?.soft){
            setSoft(data.soft)
        }

    },[data.soft])

    const columns: ColDef[] = [
        {field:'name', headerName:'Наименование', flex:1, renderCell: renderCellExpand },
        {
            field:'size',
            headerName:'Размер',
            flex:1,
            type:"number",
            valueFormatter: params => numeral(params.value as number).format('0.00 b')
        },
        {field:'version',headerName:'Версия',type:"string", width:120}
    ]

    return (
        <>
            <Card  >
                <CardHeader
                    title={"Сведения о ПО"}
                    avatar={<AppsIcon/>}
                />
                <CardContent>
                    <div style={{ height: '68vh', width: '100%' }}>
                        <DataGrid
                            columns={columns}
                            rows={soft}
                            loading={!soft.length}
                            autoPageSize={true}
                            disableSelectionOnClick={true}
                            localeText={RU_LOCALE_TEXT}
                            // pageSize={15}
                            density={"compact"}
                            components={{
                                Pagination : CustomGridPagination
                            }}
                        />
                    </div>
                </CardContent>
            </Card>

        </>
    )
}

export default MinionSoftInfo