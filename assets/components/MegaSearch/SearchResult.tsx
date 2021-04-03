import React from "react";
import MenuList from "@material-ui/core/MenuList";
import MenuItem from "@material-ui/core/MenuItem";
import Typography from "@material-ui/core/Typography";
import {useStyles} from "@components/MegaSearch/styles";
import {FindItem} from "@components/MegaSearch/interfaces";
import {Link, useHistory} from "react-router-dom";
import {useDispatch} from "react-redux";
import {CompareItem, CompareType, FilterField, NODE_NAME} from "@add_types/filters/minion_filters";
import {filterOnlyBy} from "@store/filters/actions";
import {programmFind} from "@store/programms_find/actions";

interface SearchResultProps {
    minion?: FindItem[]
    soft?: FindItem[]
    find: string
}


export function SearchResult({minion=[],soft=[], find}:SearchResultProps){

    const classes = useStyles()
    const history = useHistory()
    const dispath = useDispatch()

    const moreComputers = () => {
        const filter:CompareItem={
            field : NODE_NAME as FilterField,
            compare : CompareType.CONTAINS,
            value : find
        }
        dispath(filterOnlyBy(filter))
        history.push("/minions")
    }

    const morePrograms = () => {
        dispath(programmFind(find.toLowerCase()))
        history.push("/programms")
    }

    return (
        <>
            <MenuList>
                {
                    minion.length>0
                        ? (<>
                            <Typography variant={"body1"} color={"textSecondary"} className={classes.partion_header}>Компьютеры</Typography>
                            {
                                minion.filter((item,index)=>index<3).map(item=>(<MenuItem key={item.id} component={Link} to={`/minions/${item.id}`}>{item.value}</MenuItem> ))
                            }
                            {
                                minion.length>3 ? (<Typography variant={"body2"} onClick={moreComputers}  className={classes.more_data}>Больше результатов &#62; </Typography>) : (<></>)
                            }
                        </>)
                        : (<></>)
                }
                {
                    soft.length>0
                    ? (<>
                            <Typography variant={"body1"} color={"textSecondary"} className={classes.partion_header}>Программы</Typography>
                            {
                                soft.map(item=>(<MenuItem key={item.id} component={Link} to={`/programms/${item.id}`}>{item.value}</MenuItem>))
                            }
                            {
                                soft.length>3 ? (<Typography variant={"body2"} onClick={morePrograms} className={classes.more_data}>Больше результатов &#62;</Typography>) : (<></>)
                            }
                        </>)
                    : (<></>)
                }
                {/*<Typography variant={"body1"} color={"textSecondary"} className={classes.partion_header}>Компьютеры</Typography>*/}
                {/*{*/}
                {/*    props?.minion?.map(item=>(<MenuItem key={item.id}>{item.value}</MenuItem> ))*/}
                {/*}*/}
            </MenuList>
        </>
    )
}