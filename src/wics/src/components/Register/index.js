import React, { Component } from 'react';
import baseTheme from './theme.js';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import RaisedButton from 'material-ui/RaisedButton';
import TextField from 'material-ui/TextField';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import SelectField from 'material-ui/SelectField';
import MenuItem from 'material-ui/MenuItem';
import injectTapEventPlugin from 'react-tap-event-plugin';
injectTapEventPlugin();

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

function handleClick() {
    console.log("A user registered!");
    alert("!!!");

    fetch("http://localhost:9000/api/register", { method: "POST", body: {username: this.state.username, password: this.state.password} });
}

export default class Register extends Component {
    constructor(props) {
        super(props);
        this.state = {
            username: '',
            password: '',
            value: 1
        }
    }

    handleChange = (event, index, value) => this.setState({value});

    render() {
        return (
          <div>
            <MuiThemeProvider muiTheme={getMuiTheme(baseTheme)}>
            <div style={whole_style}>
                <h1>Register</h1>
                <TextField
                 hintText="Enter your username"
                 floatingLabelText="Username"
                 style={tField_style}
                 onChange = {(event,newValue) => this.setState({username:newValue})}
                />
                <br/>
                <TextField
                   type="password"
                   hintText="Enter your password"
                   floatingLabelText="Password"
                   style={tField_style}
                   onChange={(event,newValue) => this.setState({password:newValue})}
                />
                <br/>
                <TextField
                   type="email"
                   hintText="Enter your email address"
                   floatingLabelText="Email"
                   style={tField_style}
                   onChange={(event,newValue) => this.setState({email:newValue})}
                />
                <br/>
                <div style={tField_style}>
                    <TextField
                       type="first_name"
                       hintText="Enter your first name"
                       floatingLabelText="First Name"
                       style={tField_style}
                       onChange={(event,newValue) => this.setState({first_name:newValue})}
                    />
                    <TextField
                       type="last_name"
                       hintText="Enter your last name"
                       floatingLabelText="Last Name"
                       style={tField_style}
                       onChange={(event,newValue) => this.setState({last_name:newValue})}
                    />
                </div>

                <br/>

                <div style={tField_style}>
                    <TextField
                       type="home_phone"
                       hintText="Enter your home phone number"
                       floatingLabelText="Home Phone"
                       style={tField_style}
                       onChange={(event,newValue) => this.setState({phone_home:newValue})}
                    />
                    <TextField
                       type="cell_phone"
                       hintText="Enter your cell number"
                       floatingLabelText="Cell Phone"
                       style={tField_style}
                       onChange={(event,newValue) => this.setState({phone_cell:newValue})}
                    />
                </div>

                <br/>

                <div style={tField_style}>
                    <TextField
                       type="address"
                       fieldWidth="true"
                       hintText="Enter your mailing address"
                       floatingLabelText="Address"
                       multiLine={true}
                       maxLength="2"
                       style={tField_style}
                       onChange={(event,newValue) => this.setState({address:newValue})}
                    />
                </div>

                <SelectField floatingLabelText="Account Type" style={tField_style} value={this.state.value} onChange={this.handleChange}>
                    <MenuItem value={1} primaryText="Parent" />
                    <MenuItem value={3} primaryText="Administrator" />
                    <MenuItem value={2} primaryText="Worker" />
                </SelectField>
                <RaisedButton label="Register" primary={true} style={button_style} onClick={this.handleClick}/>
            </div>
            </MuiThemeProvider>
            </div>
        );
    }
}