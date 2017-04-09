import React from 'react'
import AppBar from 'react-toolbox/lib/app_bar';
import Navigation from 'react-toolbox/lib/navigation';
import { connect } from 'react-redux'
import { Link } from 'react-router'
import cx from 'classnames'

import classes from './Chrome.css'

class Chrome extends React.Component {

    render() {
        const { user } = this.props;
        const { pathname } = this.props.routing.locationBeforeTransitions;
        const isAdmin = user && user.role === 'admin';
        const isAnalyst = user && user.role === 'analyst';
        return (
            <div>
                <AppBar title="Emerald Citizen" fixed>
                    <Navigation type="horizontal" className={classes.centerNav}>
                        {isAnalyst &&
                            <div className={cx({[classes.activeNav]: pathname === '/reports/table'})} data-react-toolbox="link">
                                <Link to="/reports/table">Table</Link>
                            </div>
                        }
                        {isAnalyst &&
                            <div className={cx({[classes.activeNav]: pathname === '/reports/map'})} data-react-toolbox="link">
                                <Link to="/reports/map">Map</Link>
                            </div>
                        }
                        {isAdmin &&
                            <div className={cx({[classes.activeNav]: pathname === '/users/new'})}  data-react-toolbox="link">
                                <Link to="/users/new">New User</Link>
                            </div>
                        }
                        {isAdmin &&
                            <div className={cx({[classes.activeNav]: pathname === '/users'})}  data-react-toolbox="link">
                                <Link to="/users">Users</Link>
                            </div>
                        }
                    </Navigation>
                    <Navigation type="horizontal">
                        {user && <div className={classes.userInfo} data-react-toolbox="link" className={classes.userInfo}>{user.name}</div>}
                        {user && <div className={classes.logoutButton} data-react-toolbox="link"><a href="/logout">Logout</a></div>}
                    </Navigation>
                </AppBar>
                <div className={classes.views}>
                    {this.props.children}
                </div>
            </div>
        )
    }
}

const mapStateToProps = ({ account: { user }, routing }) => ({ user, routing });

export default connect(mapStateToProps, {})(Chrome);
