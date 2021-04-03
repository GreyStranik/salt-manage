import React, {useEffect, useState} from "react";
import SearchIcon from "@material-ui/icons/Search";
import InputBase from "@material-ui/core/InputBase/InputBase";
import ClickAwayListener from '@material-ui/core/ClickAwayListener';
import Grow from '@material-ui/core/Grow';
import Fade from "@material-ui/core/Fade";
import Paper from '@material-ui/core/Paper';
import Popper from '@material-ui/core/Popper';

import {useStyles} from "@components/MegaSearch/styles";
import {FindItem, FindResult} from "@components/MegaSearch/interfaces";
import {SearchResult} from "@components/MegaSearch/SearchResult";

export function MegaSearch() {
    const classes = useStyles()
    const [find, setFind] = useState<string>('')
    const [open, setOpen] = useState(false)

    const anchorRef = React.useRef<HTMLButtonElement>(null);
    const [arrowRef, setArrowRef] = React.useState<HTMLElement | null>(null);

    const [res,setRes] = React.useState<FindResult>()

    useEffect(()=>{

        setRes(undefined)
        if (find.length>=3){
            fetch(`/api/search?q=${find}`).then(response=>response.json()).then(result=>{
                const minion:FindItem[] = result['minion']
                const soft:FindItem[] = result['soft']
                const searchRes:FindResult = {
                    minion, soft
                }
                setRes(searchRes)
                setOpen(minion.length>0 || soft.length>0)
            })
        } else {
            setOpen(false)
        }

    },[find])

    return (
        <>
            <div className={classes.search} >
                <div className={classes.searchIcon}>
                    <SearchIcon />
                </div>
                <InputBase
                    ref={anchorRef}
                    placeholder="Поиск…"
                    classes={{
                        root: classes.inputRoot,
                        input: classes.inputInput,
                    }}
                    inputProps={{ 'aria-label': 'search' }}
                    value={find}
                    onChange={event => setFind(event.target.value)}
                />
            </div>

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
                    }} >
                {({ TransitionProps, placement }) => (
                    /*     <Grow
                             {...TransitionProps}
                             style={{ transformOrigin: placement === 'bottom' ? 'center top' : 'center bottom' }}
                         > */
                    <Fade {...TransitionProps} timeout={350}>
                        <Paper>
                            <ClickAwayListener onClickAway={()=>setOpen(false)}>
                                <Paper>
                                    <span className={classes.arrow} ref={setArrowRef} />
                                    {/*<div>*/}
                                    {/*    <h2>Компьютеры</h2>*/}
                                    {/*</div>*/}
                                    <SearchResult {...res} find={find} />
                                </Paper>

                            </ClickAwayListener>
                        </Paper>
                     </Fade>
                                    /*  </Grow> */
                )}
            </Popper>


        </>
    )
}