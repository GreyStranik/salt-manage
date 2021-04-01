import React, {useState} from "react";
import Button from "@material-ui/core/Button";
import SettingsIcon from '@material-ui/icons/Settings';
import Fade from "@material-ui/core/Fade";
import Paper from '@material-ui/core/Paper';
import Popper from '@material-ui/core/Popper';
import ClickAwayListener from "@material-ui/core/ClickAwayListener";
import FormGroup from '@material-ui/core/FormGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Switch from '@material-ui/core/Switch';
import Typography from "@material-ui/core/Typography";

import {useStyles} from "@pages/Minions/styles";
import {
    ColumnFields,
} from "@add_types/filters/minion_filters";
import {useDispatch, useSelector} from "react-redux";
import {RootState} from "@store/store";
import {hideColumn, showColumn} from "@store/minion_list_columns/actions";
import {minionsColumnList} from "@pages/Minions/columns";
import {MinionListConfig} from "@pages/Minions/MinionListConfig";


export function ColumnConfig() {

    const classes = useStyles()

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
            <Button color={"default"}
                    variant={"outlined"}
                    startIcon={<SettingsIcon/>}
                    style={{marginLeft:'1rem'}}
                    onClick={handleOpen}
                    ref={anchorRef}
            >
                Настройка
            </Button>

            <Popper open={open} anchorEl={anchorRef.current} role={undefined} placement={"bottom"} transition className={classes.popper_column_config}
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

                                    <div className={classes.popper_in}>
                                        <MinionListConfig/>

                                    </div>
                                </Paper>

                            </Paper>
                        </ClickAwayListener>
                    </Fade>
                )}
            </Popper>

        </>
    )
}