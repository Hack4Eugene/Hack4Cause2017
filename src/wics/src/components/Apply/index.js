import React from 'react';

import baseTheme from './theme.js';
import LinearProgress from 'material-ui/LinearProgress';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import Avatar from 'material-ui/Avatar';
import Chip from 'material-ui/Chip';
import {grey700, red300, grey200} from 'material-ui/styles/colors';
import Card from 'material-ui/Card';
import Checkbox from 'material-ui/Checkbox';
import Drawer from 'material-ui/Drawer';
import RaisedButton from 'material-ui/RaisedButton';
import FlatButton from 'material-ui/FlatButton';
import "./style.css";

const whole_style = {
    display: "flex",
    flexFlow: "column wrap",
    alignContent: "center",
}

const dark_grey = {
    color: "#424242",
}

const style_end= {
    display: "flex",
    alignSelf: "center",
    justifyContent: "flex-end"
}
const styles = {
  chip: {
    margin: 4,
      color: "white"
  },
  wrapper: {
    display: 'flex',
    flexWrap: 'wrap',
  },
}

const bg_grey= {
    backgroundColor: "#BDBDBD",
    padding: "2% 2% 2% 2%"
}

const card_style = {
    width: "40%",
    height: "500px",
    display: "flex",
    flexFlow: "row wrap",
    borderRadius: "8px",
    position: "relative",
    zIndex: "-1"
}

const input_style= {
    display: "flex",
    justifyContent: "center",
    padding: "1% 1% 1.5% 1%",
    height: "25px"
}


    function handleTouchTap() {
}

export default class Apply extends React.Component {
    constructor(props) {
        super(props);


    this.state = {
      completed: 0,
      data: null,
      open: false};
  }

  handleToggle = () => this.setState({open: !this.state.open});
  

  componentDidMount() {
    this.timer = setTimeout(() => this.progress(5), 1000);
  }


    componentWillUnmount() {
        clearTimeout(this.timer);
    }

    progress(completed) {
        if (completed > 100) {
            this.setState({completed: 100});
        } else {
            this.setState({completed});
            const diff = Math.random() * 10;
            this.timer = setTimeout(() => this.progress(completed + diff), 1000);
        }
    }

  render() {
    return (
        <div>
        <MuiThemeProvider muiTheme={getMuiTheme(baseTheme)}>
        <div style={whole_style}>
        <h1>Application Forms</h1>
            <h4 style={dark_grey}>Form Progress:</h4>
        <LinearProgress mode="determinate" value={this.state.completed} />
        <br/>
<span>
<Card style={card_style}>
    <h2 style={bg_grey}>Resources:</h2>
    <span>
        <br/>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference29835g349
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference598
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference1
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference241869821402
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference214
        </Chip>
        <Chip
            backgroundColor={grey200}
            onTouchTap={handleTouchTap}
            style={styles.chip}
        >
                <Avatar size={32} color={red300} backgroundColor={grey700}>
                    MB
                </Avatar>
            reference19846714
        </Chip>
    </span>  
</Card>
<Card style={card_style}>
    <h2 style={bg_grey}>Forms:</h2>
    <Checkbox
        label="Simple1"
    />
    <Checkbox
        label="Simple2"
    />
    <Checkbox
        label="Simple3"
    />
    <Checkbox
        label="Simple4"
    />
    <Checkbox
        label="Simple5"
    />
    <Checkbox
        label="Simple6"
    />
    <Checkbox
        label="Simple"
    />
</Card>
</span>
        <footer style={input_style}>
        
        <RaisedButton 
          label="Chat with Adoption Specialist"
          onTouchTap={this.handleToggle}
        />
        <Drawer width={300} openSecondary={true} open={this.state.open}>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            
            <img src={require('./chatSample.png')} alt="Chat" height={250} style={style_end}/>
            <footer>
            <div>
            <FlatButton label="Send" secondary={true}/>
            <input type="text"/>
                </div>
            </footer>
        </Drawer>
        </footer>
        </div>
        </MuiThemeProvider>
        </div>
    );
  }
}