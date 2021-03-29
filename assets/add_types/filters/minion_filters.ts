
export interface GridMinionItem {
    id : string,
    node_name : string,
    serialnumber : string,
    ip : string,
    mac : string,
    fio_user : string,
    user_phone : string,
    room : string,
    department : string,
    created_at : string,
    updated_at : string
}

export type GridItem = GridMinionItem

export enum CompareType {
    EQUAL = 'EQUAL',
    CONTAINS = 'CONTAINS',
    LESS = 'LESS',
    LESS_AND_EQUAL = 'LESS_AND_EQUAL',
    MORE = 'MORE',
    MORE_AND_EQUAL = 'MORE_AND_EQUAL'
}

export const NODE_NAME = "node_name"
export const SERIALNUMBER = "serialnumber"
export const IP = "ip"
export const MAC = "mac"
export const FIO_USER = "fio_user"
export const USER_PHONE = "user_phone"
export const ROOM = "room"
export const DEPARTMENT = "department"
export const CREATE_AT = "created_at"
export const UPDATED_AT = "updated_at"

export type FilterField = typeof NODE_NAME | typeof SERIALNUMBER | typeof IP | typeof MAC | typeof FIO_USER | typeof USER_PHONE | typeof ROOM | typeof DEPARTMENT | typeof CREATE_AT | typeof UPDATED_AT

export interface CompareItem {
    field : FilterField
    value : string
    compare : CompareType
}
