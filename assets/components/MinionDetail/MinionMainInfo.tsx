import React from "react";
import useStyles from "./styles";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from "@material-ui/core/CardContent";
import MinionParamItem from "./MinionParamItem";
import Card from "@material-ui/core/Card/Card";
import ComputerIcon from '@material-ui/icons/Computer';
import {MinionDetail} from "../../interfaces/MinionDetailInterfaces";

interface IMinionDetail {
    node_name? : string
    serialnumber? : string
    biosversion? : string
    biosreleasedate? : Date
    manufacturer? : string
    cpu_model? : string
    product_name? : string
    saltversion? : string
    os? : string
    osrelease? : string
}

function MinionMainInfo(detail:IMinionDetail) {
    const classes = useStyles()
    return (
        <>
            <Card >
                <CardHeader
                    title={"Основные сведения"}
                    avatar={<ComputerIcon/>}
                />
                <CardContent>

                    <MinionParamItem title={"Имя компьютера"} value={detail.node_name}/>
                    <MinionParamItem title={"Серийный номер"} value={detail.serialnumber}/>
                    <MinionParamItem title={"Производитель"} value={detail.manufacturer}/>
                    <MinionParamItem title={"Модель"} value={detail?.product_name}/>
                    <MinionParamItem title={"CPU"} value={detail?.cpu_model}/>
                    <MinionParamItem title={"ОС"} value={detail?.os}/>
                    <MinionParamItem title={"Версия BIOS"} value={detail?.biosversion}/>
                    <MinionParamItem title={"Дата BIOS"} value={detail?.biosreleasedate?.toLocaleDateString()}/>
                    <MinionParamItem title={"salt"} value={detail?.saltversion}/>

                </CardContent>
            </Card>
        </>
    )
}

export default MinionMainInfo