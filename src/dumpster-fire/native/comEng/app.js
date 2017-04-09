import React, { Component, PropTypes } from 'react'
import { SideMenu } from 'react-native-elements'
import Icon from 'react-native-vector-icons/FontAwesome';
import {
    StyleSheet,
    StatusBar,
    Text,
    ScrollView,
    View,
    Linking,
} from 'react-native'
import { connect } from 'react-redux'
import { NativeRouter, Route, Link, Redirect } from 'react-router-native'
import Home from './components/home'
import Issue from './components/issue'
import Nav from './components/nav'
import Auth from './components/auth'
import { setSidemenuStatus } from './actions/sidemenu'

class App extends Component {
    render() {
        return (
            <NativeRouter>
                <SideMenu
                    isOpen={this.props.isOpen}
                    onChange={(isOpen) => {
                        this.props.setSidemenuStatus(isOpen)
                    }}
                    menu={<Nav />}>
                    <ScrollView style={styles.container}>
                        <View
                            style={{
                                backgroundColor: '#F9F9F9',
                                justifyContent: 'center',
                                paddingHorizontal: 10,
                                height: 70,
                            }}>
                            <Icon
                                    name="bars"
                                    onPress={() => {
                                        this.props.setSidemenuStatus(!this.props.isOpen)
                                    }}
                                    size={32}
                                    color="#5A5959"/>
                        </View>
                        <Route exact path="/" component={Home}/>
                        <Route path="/auth" component={Auth}/>
                        <Route path="/issue" component={Issue}/>
                    </ScrollView>
                </SideMenu>
            </NativeRouter>
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#F5FCFF',
    },
})

const mapStateToProps = state => ({
    isOpen: state.sidemenu.open,
    user: state.auth.user,
})

const mapDispatchToProps = dispatch => ({
    setSidemenuStatus(isOpen) {
        dispatch(setSidemenuStatus(isOpen))
    },
})

export default connect(mapStateToProps, mapDispatchToProps)(App);
