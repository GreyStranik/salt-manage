import React, {useEffect, useState} from "react";

import Card from "@material-ui/core/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from "@material-ui/core/CardContent";
import MinionParamItem from "@components/MinionDetail/MinionParamItem";
import {Monitor, Printer} from "@interfaces/MinionDetailInterfaces";
import Skeleton from "@material-ui/lab/Skeleton";

interface IEquipments {
    monitors?: Monitor[]
    printers?: Printer[]
}

export default function MinionEquipment(data:IEquipments){

    const [monitorNames, setMonitorNames] = useState("")
    const [printerNames, setPrinterNames] = useState<string>()

    useEffect( () => {
        console.log(data)
        const monitorModels = data.monitors?.reduce<string[]>( (arr:string[], current) => ( [...arr, current.model]) , [] )
        const printerModels = data.printers?.reduce<string[]>( (arr:string[], current) => ( [...arr, current.model]) , [] )
        console.log(monitorModels?.join(",  "))
        setMonitorNames(monitorModels?.join(",  ") ?? '')
        setPrinterNames(printerModels?.join(", ") ?? '')
    }, [data])

    return (
        <>
            <Card >
                <CardHeader  title={"Оборудование"}/>
                <CardContent>
                    {
                        data.monitors ? (<MinionParamItem title={"Монитор"} value={monitorNames} />  )
                            :(<Skeleton animation={"wave"} height={'1rem'} />)
                    }
                    {
                        data.printers ? (<MinionParamItem title={"Принтер"} value={printerNames} />)
                            :(<Skeleton animation={"wave"} height={'1rem'} />)
                    }

                </CardContent>
            </Card>
        </>
    )
}