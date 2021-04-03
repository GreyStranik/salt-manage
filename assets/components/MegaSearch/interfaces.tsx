import {string} from "prop-types";

export  interface FindItem  {
    id: string
    value: string
}

export interface FindResult {
    minion: FindItem[]
    soft: FindItem[]
}