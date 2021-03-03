import React from "react";
import {GridOverlay} from "@material-ui/data-grid";
import SearchIcon from "@material-ui/core/SvgIcon/SvgIcon";


export default function NoDataOverlay(){
    return (
        <GridOverlay>
            <SearchIcon style={{width:'5rem', height:'5rem'}} />
        </GridOverlay>
    )
}