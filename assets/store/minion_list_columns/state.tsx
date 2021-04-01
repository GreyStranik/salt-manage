import {ColumnFields} from "@add_types/filters/minion_filters";


export type MinionsColumnListState = {
    [name in ColumnFields]: boolean;
};

