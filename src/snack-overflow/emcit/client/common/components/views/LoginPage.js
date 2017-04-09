import React, {Component} from "react";
import { withRouter } from 'react-router'
import { connect } from 'react-redux';
import Input from 'react-toolbox/lib/input';
import Button from 'react-toolbox/lib/button';

import { FormErrors } from 'common/components/form';
import { clearLoginErrors } from 'common/actions';
import { loginUser } from 'common/api';

import classes from './LoginPage.css'


class LoginPage extends Component {

    constructor() {
        super();
        this.state = {
            email: '',
            password: ''
        };
    }

    componentWillMount() {
        this.props.clearLoginErrors();
    }

    componentWillReceiveProps({ user }) {
        if (user) {
            this.props.router.push('/')
        }
    }

    onSubmit(e) {
        e.preventDefault();
        const { email, password } = this.state;
        this.props.loginUser(email, password)
    }

    render() {
        const { loginError } = this.props;
        return (
            <div className={classes.loginPage}>
                <div className={classes.loginBox}>
                    <form onSubmit={this.onSubmit.bind(this)} className="loginForm">
                        <div className={classes.logo}>
                            <img src="/static/EmeraldCitizen.svg" alt="Emerald Citizen logo"/>
                        </div>
                        <FormErrors errors={loginError.form} />
                        <Input
                            value={this.state.email}
                            className='email'
                            type="email"
                            label='Email'
                            error={loginError.email && loginError.email.join('\r\n')}
                            onChange={email => this.setState({email})} />
                        <Input
                            value={this.state.password}
                            className='password'
                            type="password"
                            label='Password'
                            error={loginError.password && loginError.password.join('\r\n')}
                            onChange={password => this.setState({password})}/>
                        <Button className='submitButton' type='submit' raised primary>Login</Button>
                    </form>

                </div>
            </div>
        );
    }
}

const mapStateToProps = ({ account: { user, loginError }}) => ({ user, loginError });

export default connect(mapStateToProps, {
    clearLoginErrors,
    loginUser
})(withRouter(LoginPage));
