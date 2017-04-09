import React, { Component, PropTypes } from 'react'
import {
    View,
    StyleSheet,
    TouchableHighlight,
    Text,
} from 'react-native'
import { connect } from 'react-redux'
import { List, ListItem } from 'react-native-elements'
import { setSidemenuStatus } from '../actions/sidemenu'
import { Icon } from 'react-native-elements'

class Nav extends Component {
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
    render () {
        return (
            <View style={styles.navs}>
                <ListItem
                    hideChevron
                    iconType="fontawesome"
                    leftIcon={{ name: 'home'}}
                    onPress={() => {
                        this.props.setSidemenuStatus(!this.props.isOpen)
                        this.history.push('/')
                    }}
                    title="Home"
                />
                <ListItem
                    hideChevron
                    leftIcon={{ name: 'file-upload' }}
                    onPress={() => {
                        this.props.setSidemenuStatus(!this.props.isOpen)
                        this.history.push('/issue')
                    }}
                    title="Issue"
                />
            </View>
        )
    }
}

const styles = StyleSheet.create({
    navs: {
        flex: 1,
        backgroundColor: '#ededed',
        paddingTop: 50,
    },
    nav: {
        paddingHorizontal: 20,
        marginBottom: 10,
    },
    navText: {
        fontSize: 16,
    }
});


const mapStateToProps = state => ({
    isOpen: state.sidemenu.open
})

const mapDispatchToProps = dispatch => ({
    setSidemenuStatus(isOpen) {
        dispatch(setSidemenuStatus(isOpen))
    },
})

export default connect(mapStateToProps, mapDispatchToProps)(Nav)
