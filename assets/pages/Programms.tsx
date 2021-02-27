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

interface ProgrammItemName {
    id: string,
    name: string,
    count: number
}

function Programms() {

    const useStyles = makeStyles((theme:Theme)=>({
        find : {
            marginBottom: theme.spacing(4)
        },
        info : {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'flex-end'
        }
    }))

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
                    <Grid container spacing={2}>
                    {
                        data.filter(item => item.name.toLowerCase().includes(find)).map(item =>{

                            return (

                                <Grid item key={item.id} xs={6} sm={3} md={2} >
                                    <Card>
                                        <CardActionArea key={item.id}>
                                            <CardContent>
                                                <Typography
                                                    variant={"h5"}
                                                    color={"textPrimary"}
                                                >
                                                    {item.name}
                                                </Typography>
                                                <div className={classes.info}>
                                                    <Typography variant={"body1"} color={"textSecondary"}>
                                                        Количество установок
                                                    </Typography>
                                                    <Typography variant={"h3"} color={"primary"}>
                                                        {item.count}
                                                    </Typography>
                                                </div>

                                            </CardContent>
                                        </CardActionArea>
                                    </Card>
                                </Grid>
                            )
                        })
                    }
                    </Grid>
                </Grid>
            </Grid>
        </>
    )
}

export default Programms