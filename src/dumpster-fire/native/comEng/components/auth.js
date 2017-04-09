import React, { Component, PropTypes } from 'react'
import {
    Text,
    View,
    Image
} from 'react-native'
import { connect } from 'react-redux'
import { Card, ListItem, Icon, SocialIcon, Grid, Row } from 'react-native-elements'
import { facebook } from 'react-native-simple-auth'
import Logo from '../images/spoke.png'
import { userLogin } from '../actions/auth'

class Auth extends Component {
    static contextTypes = {
        router: PropTypes.shape({
            history: PropTypes.shape({
                push: PropTypes.func.isRequired,
                replace: PropTypes.func.isRequired
            }).isRequired
        }).isRequired
    }
    constructor(props, context) {
        super(props, context)
        this.history = context.router.history
    }
    componentDidMount() {
        if (this.props.user) {
            this.history.push('/')
        }
    }
    render() {
        return (
            <Grid>
                <Row
                    style={{
                        top: 40,
                        alignItems: 'center',
                    }}
                >
                    <Image
                        style={{
                            flex: 1,
                            width: 320,
                            height: 320,
                        }}
                        source={Logo}
                    />
                </Row>
                <Row
                    style={{
                        flex: 1,
                        marginTop: 20,
                        alignItems: 'center',
                    }}
                >
                    <SocialIcon
                        onPress={() => {
                            facebook({
                                appId: '794295424054035',
                                callback: 'fb794295424054035://authorize'
                            }).then((info) => {
                                this.props.userLogin(info.user)
                                this.history.push('/')
                            })
                            .catch(error => {
                                console.log(error)
                            })
                        }}
                        type="facebook"
                    />
                </Row>
            </Grid>
        )
    }
}

const mapStateToProps = state => ({
    user: state.auth.user
})

const mapDispatchToProps = dispatch => ({
    userLogin(user) {
        dispatch(userLogin(user))
    }
})

export default connect(mapStateToProps, mapDispatchToProps)(Auth);
