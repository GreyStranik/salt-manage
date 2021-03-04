
export interface MinionInfo {
    id : string
    info : MinionDetail
    user : MinionUser
    network? : MinionNetwork[]
    disk? : MinionDisk[]
    soft? : MinionDisk[]
}

export interface MinionDetail {
    node_name : string
    selialnumber : string
    biosversion : string
    biosreleasedate : Date
    manufacturer : string
    cpu_model : string
    product_name : string
    saltversion : string
    os : string
    osrelease : string
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
    name : string
    size : number
    version : number
}