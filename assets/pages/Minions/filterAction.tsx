import React, {useState} from "react";
import Button from "@material-ui/core/Button";
import Badge from "@material-ui/core/Badge";
import FilterListIcon from '@material-ui/icons/FilterList';
import Fade from "@material-ui/core/Fade";
import Paper from '@material-ui/core/Paper';
import Popper from '@material-ui/core/Popper';

import {useSelector} from "react-redux";
import {RootState} from "@store/store";
import {useStyles} from "@pages/Minions/styles";
import IconButton from "@material-ui/core/IconButton";
import ClickAwayListener from "@material-ui/core/ClickAwayListener/ClickAwayListener";
import {FilterBlock} from "@pages/Minions/filterBlock";

export function FilterAction() {
    const classes = useStyles()

    const filters = useSelector( (state: RootState) => state.filter )
    const [open, setOpen] = useState(false)
    const anchorRef = React.useRef<HTMLButtonElement>(null);
    const [arrowRef, setArrowRef] = React.useState<HTMLElement | null>(null);

    const handleOpen = (event: React.MouseEvent<HTMLButtonElement>) =>{
        setOpen(!open)
    }
    const handleClose = (event: React.MouseEvent<Document>) => {

        if (event.target!==window.document.body)
            setOpen(false)
    }

    return (
        <>
            <Button
                color={"primary"}
                variant={"outlined"}
                onClick={handleOpen}
                ref={anchorRef}
                endIcon={
                    <Badge badgeContent={filters.length} color="primary">
                            <FilterListIcon/>
                    </Badge>
                }
            >
                Фильтры
            </Button>

            <Popper open={open} anchorEl={anchorRef.current} role={undefined} placement={"bottom"} transition className={classes.popper}
                    modifiers={{
                        preventOverflow: {
                            enabled: true,
                            boundariesElement: "window"
                        },
                        arrow: {
                            enabled: true,
                            element: arrowRef
                        },
                    }}
            >
                {({ TransitionProps, placement }) => (
                    <Fade {...TransitionProps} timeout={350}>
                        <ClickAwayListener onClickAway={handleClose} >
                        <Paper >

                                <Paper>
                                    <span className={classes.arrow} ref={setArrowRef} />
                                    <FilterBlock  />
                                </Paper>

                        </Paper>
                    </ClickAwayListener>
                    </Fade>
                )}
            </Popper>


        </>
    )
}