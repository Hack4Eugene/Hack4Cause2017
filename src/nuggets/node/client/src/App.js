import React, { Component } from 'react'
import { Link} from 'react-router';
import { Dashboard, Header, Sidebar } from 'react-adminlte-dash';

class App extends Component {
  navItems() {
        return (
            <Header.Item href="/some/link" key="1"/>
        );
    }
  sidebarItems(){
    return(
      <Sidebar.Menu header="NAVIGATION" key="1">
        <Link to="/"><Sidebar.Menu.Item title="Home"/></Link>
        <Link to="/about"><Sidebar.Menu.Item title="About"/></Link>
        <Link to="/weather"><Sidebar.Menu.Item title="Weather"/></Link>
      </Sidebar.Menu>
    );
  }
  render() {
    return (
        <Dashboard
        navbarChildren={this.navItems()}
        sidebarChildren={this.sidebarItems()}
        logoLg={<span><b>Eugene</b>Dashboard</span>}
        logoSm={<span><b>E</b>UG</span>}
        theme="skin-green">
          {this.props.children}
      </Dashboard>
    );
  }
}

export default App



