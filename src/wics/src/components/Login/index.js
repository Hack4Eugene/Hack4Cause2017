import React from 'react';
import baseTheme from './theme.js';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import RaisedButton from 'material-ui/RaisedButton';
import TextField from 'material-ui/TextField';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import './style.css';


const button_style = {
    margin: 15,
    alignSelf: "center",
}

const tField_style = {
    alignSelf: "center",
}

const whole_style = {
    display: "flex",
    flexFlow: "column wrap",
    alignContent: "center",
}


export default class Login extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            username: '',
            password: '',
            open: false
        }
    }

    render() {
        return (
          <div>
            <MuiThemeProvider muiTheme={getMuiTheme(baseTheme)} style={whole_style}>
            <div style={whole_style}>
              <h1>Login</h1>
              <TextField
              hintText="Enter your Username"
              floatingLabelText="Username"
              style={tField_style}
              onChange={(event,newValue) => this.setState({username:newValue})}
              />
              <br/>

              <TextField
              type="password"
              hintText="Enter your Password"
              floatingLabelText="Password"
              style={tField_style}
              onChange={(event,newValue) => this.setState({password:newValue})}
              />
              <br/>

              <RaisedButton label="Login" primary={true} style={button_style} onClick={(event) => this.handleClick(event)}/>
            </div>
            </MuiThemeProvider>
          </div>
        );
    }
}