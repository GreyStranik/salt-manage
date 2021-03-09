
export interface MinionListItem {
    id: string
    node_name : string
}

export interface MinionInfo {
    id : string
    detail : MinionDetail
    user : MinionUser
    network? : MinionNetwork[]
    disk? : MinionDisk[]
    soft : MinionSoft[]
}

export interface MinionDetail {
    node_name : string
    serialnumber : string
    biosversion : string
    biosreleasedate : Date
    manufacturer : string
    cpu_model : string
    product_name : string
    saltversion : string
    os : string
    osrelease : string
    created_at : Date
    updated_at : Date
}

export interface MinionUser {
    room : string
    fio_user : string
    user_phone : string
    type : string
    type_dep : string
    department : string
}

export interface MinionNetwork {
    macaddr : string
    ips : string
}

export interface MinionDisk {
    name : string
    used : number
    available : number
    blocks : number
    filesystem : string
    capacity : string
}

export interface MinionSoft {
    id : string
    name : string
    soft_id : string
    size : number
    version : number
}