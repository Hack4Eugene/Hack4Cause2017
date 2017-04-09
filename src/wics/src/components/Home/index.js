import React, { Component } from 'react';
import baseTheme from './theme.js';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import RaisedButton from 'material-ui/RaisedButton';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import LogoImg from "./heartgalleryfamilylogo.jpg"

import './style.css';

const button_style = {
	margin: 15,
	alignSelf: "left",
}

const whole_style = {
	display: "flex",
	flexFlow: "column wrap",
	alignContent: "center",
}


export default class Home extends Component {
  constructor(props) {
  	super(props);
  }
    render() {
        return (
          <div>
            <MuiThemeProvider muiTheme={getMuiTheme(baseTheme)} style={whole_style}>
            
            <div style={whole_style}>
              <h1>A Family For Every Child</h1>
              <br/>
              <h2>Home</h2>
              <br/>
              	<img src={LogoImg} width={200}/>	
              	<h3>Contact Information:</h3>
              	<ur>
              	  1675 West 11th Ave <br/>
              	  Eugene, OR 97402 <br/><br/>
              	  Phone: 541-343-2856 <br/>
              	  Toll Free: 877-343-2856 <br/>
              	  Fax: 541-343-2866 <br/>
              	  Email: info@familyforeverychild.com <br/>
              	</ur> 
            </div>
            </MuiThemeProvider>
          </div>
    );
  }
}
