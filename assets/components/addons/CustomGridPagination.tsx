import React from "react";
import { makeStyles } from '@material-ui/core/styles';
import { DataGrid, BaseComponentProps } from '@material-ui/data-grid';
import Pagination from '@material-ui/lab/Pagination';

const useStyles = makeStyles({
    root: {
        display: 'flex',
    },
});

export default function CustomGridPagination(props: BaseComponentProps) {
    const { state, api } = props;
    const classes = useStyles();

    return (
        <Pagination
            className={classes.root}
            color="primary"
            shape={"rounded"}
            page={state.pagination.page}
            count={state.pagination.pageCount}
            onChange={(event, value) => api.current.setPage(value)}
            variant={"outlined"}
        />
    );
}