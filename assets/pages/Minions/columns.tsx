import {
    ColumnFields, CREATE_AT, DEPARTMENT,
    FIO_USER,
    IP,
    MAC,
    NODE_NAME,
    ROOM,
    SERIALNUMBER, UPDATED_AT,
    USER_PHONE
} from "@add_types/filters/minion_filters";

interface MinionColumnsProps {
    title: string
    column: ColumnFields
}

export const minionsColumnList:MinionColumnsProps[]=[
    {title:"Компьютер",column:NODE_NAME},
    {title:"Серийный номер",column:SERIALNUMBER},
    {title:"IP адрес",column:IP},
    {title:"MAC адрес",column:MAC},
    {title:"ФИО ответственного",column:FIO_USER},
    {title:"Телефон",column:USER_PHONE},
    {title:"Кабинет",column:ROOM},
    {title:"Подразделение",column:DEPARTMENT},
    {title:"Создано",column:CREATE_AT},
    {title:"Обновлено",column:UPDATED_AT}
]