import React from "react";
import useStyles from "./styles";
import CardHeader from "@material-ui/core/CardHeader";
import CardContent from "@material-ui/core/CardContent";
import MinionParamItem from "./MinionParamItem";
import Card from "@material-ui/core/Card/Card";
import PersonIcon from '@material-ui/icons/Person';

interface IMinionUser {
    room? : string
    fio_user? : string
    user_phone? : string
    type? : string
    type_dep? : string
    department? : string
}

function MinionUserInfo(user:IMinionUser){
    const classes = useStyles()
    return (
        <>
            <Card >
                <CardHeader
                    title={"Сведения о пользователе"}
                    avatar={<PersonIcon/>}
                />
                <CardContent>
                    <MinionParamItem title={"Пользователь"} value={user.fio_user}/>
                    <MinionParamItem title={"Телефон"} value={user.user_phone}/>
                    <MinionParamItem title={"Тип"} value={user.type}/>
                    <MinionParamItem title={"Подразделение"} value={user.department}/>
                    <MinionParamItem title={"Отделение"} value={user.type_dep}/>
                    <MinionParamItem title={"Кабинет"} value={user.room}/>
                </CardContent>
            </Card>
        </>
    )
}

export default MinionUserInfo