import React from "react";
import Grid from "@material-ui/core/Grid";

import {
    CREATE_AT,
    FIO_USER,
    IP,
    MAC,
    NODE_NAME,
    ROOM,
    SERIALNUMBER,
    UPDATED_AT,
    USER_PHONE
} from "@add_types/filters/minion_filters";

import {DateSelect} from "@pages/Minions/DateSelect";
import {FilteredElement} from "@pages/Minions/filteredElement";

export function FilterBlock() {

    return (
        <>
            <Grid container spacing={2}>
                <Grid item xs={6}>
                    <FilteredElement title={"Имя компьютера"} field={NODE_NAME}/>
                </Grid>
                <Grid item xs={6}>
                    <FilteredElement title={"Серийный номер"} field={SERIALNUMBER}/>
                </Grid>
                <Grid item xs={6} >
                    <FilteredElement title={"IP-адрес"} field={IP}/>
                </Grid>
                <Grid item xs={6}>
                    <FilteredElement title={"MAC адрес"} field={MAC}/>
                </Grid>
                <Grid item xs={4}>
                    <FilteredElement title={"ФИО ответственного"} field={FIO_USER}/>
                </Grid>
                <Grid item xs={4}>
                    <FilteredElement title={"Телефон"} field={USER_PHONE}/>
                </Grid>
                <Grid item xs={4}>
                    <FilteredElement title={"Кабинет"} field={ROOM}/>
                </Grid>

                <Grid item xs={12}>
                    <DateSelect title={"Дата регистрации миньона"} field={CREATE_AT} /*compare={CompareType.MORE_AND_EQUAL} date={new Date()} */ />
                    <DateSelect title={"Дата обновления миньона"} field={UPDATED_AT}/>
                </Grid>
            </Grid>
        </>
    )
}