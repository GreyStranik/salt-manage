import React, {useEffect, useState} from "react";
import Grid from "@material-ui/core/Grid";
import TextField from "@material-ui/core/TextField";
import CssBaseline from "@material-ui/core/CssBaseline";
import Container from "@material-ui/core/Container";
import Card from "@material-ui/core/Card";
import CardHeader from "@material-ui/core/CardHeader";
import CardActionArea from "@material-ui/core/CardActionArea";
import CardContent from '@material-ui/core/CardContent';
import Typography from "@material-ui/core/Typography";
import {makeStyles } from "@material-ui/core/styles";
import { Theme } from '@material-ui/core/styles/createMuiTheme';
import {ProgrammItemName} from "../interfaces/ProgrammItemName";
import SoftInfoCard from "../cards/SoftInfoCard";
import {VirtuosoGrid} from "react-virtuoso";
import styled from "styled-components";

function Programms() {

    const useStyles = makeStyles((theme:Theme)=>({
        find : {
            marginBottom: theme.spacing(4)
        },
        gridItem : {
            display: 'flex',
            flexWrap: 'wrap',
            // height: '80vh'
        }
    }))

    const ItemContainer = styled.div`
    padding: 0.5rem;
    width: 25%;
    display: flex;
    flex: none;
    align-content: stretch;

    @media (max-width: 1024px) {
      width: 50%;
    }

    @media (max-width: 480px) {
      width: 100%;
    }
  `

    const ItemWrapper = styled.div`
    flex: 1;
    text-align: center;
    font-size: 20px;
    padding: 1rem 1rem;
    // border: 1px solid red;
    // white-space: nowrap;
    // background-color: white
  `

    const ListContainer = styled.div`
    display: flex;
    flex-wrap: wrap;
  `

    const classes = useStyles()

    const [data, setData] = useState<ProgrammItemName[]>([])
    const [loading, setLoading] = useState(true)
    const [find, setFind] = useState('')

    const handleFindChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFind(event.target.value.toLowerCase());
    };

    useEffect(()=>{
        setLoading(true)
        fetch("/api/soft/soft_static").then(response=>response.json()).then(result=>{
            setData(result)
            setLoading(false)
        })
    },[])

    return (
        <>
            <CssBaseline />
            <Grid container  direction={"column"}>
            {/*<Container maxWidth={"lg"} >*/}
                <Grid item xs={12}>
                    <h1>Состав программного обеспечения</h1>
                </Grid>
                <Grid item xs={12} >
                    <TextField id="soft-find"
                               label="Поиск программ"
                               value={find}
                               fullWidth
                               onChange={handleFindChange}
                               className={classes.find}
                    />
                </Grid>
            {/*</Container>*/}
                <Grid item xs={12}>

                    <VirtuosoGrid
                        totalCount={data.filter(item => item.name.toLowerCase().includes(find)).length}
                        overscan={10}
                        style={{ height: '70vh', width: '100%' }}
                        components={{
                            Item: ItemContainer,
                            List: ListContainer,
                            ScrollSeekPlaceholder: (props, context) => (
                                <ItemContainer>
                                    <ItemWrapper>Загрузка</ItemWrapper>
                                </ItemContainer>
                            )
                        }}

                        itemContent={index => {
                                const soft_info = data.filter(item => item.name.toLowerCase().includes(find))[index]
                                return (
                                    <ItemWrapper>
                                        <SoftInfoCard {...soft_info} />
                                    </ItemWrapper>
                                )
                            }
                        }
                        scrollSeekConfiguration={{
                            enter: velocity => Math.abs(velocity) > 200,
                            exit: velocity => Math.abs(velocity) < 30,
                            change: (_, range) => console.log({ range }),
                        }}
                    />

                    {/*<Virtuoso*/}
                    {/*    style={{ height: '200px' }}*/}
                    {/*    totalCount={200}*/}
                    {/*    itemContent={index => <div>Item {index}</div>}*/}
                    {/*/>*/}

                </Grid>
            </Grid>
        </>
    )
}

export default Programms