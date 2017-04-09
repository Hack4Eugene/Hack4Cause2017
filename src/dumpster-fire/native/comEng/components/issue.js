import React, { Component, PropTypes } from 'react';
import {
  StyleSheet,
  TextInput,
  Text,
  View,
  Picker,
} from 'react-native';
import { Card, Button, FormLabel, FormInput } from 'react-native-elements'
import { connect } from 'react-redux'
import { updateIssue, createIssue } from '../actions/issue'
import config from '../config'

const { Item } = Picker

class Issue extends Component {
    static contextTypes = {
        router: PropTypes.shape({
            history: PropTypes.shape({
                push: PropTypes.func.isRequired,
                replace: PropTypes.func.isRequired
            }).isRequired
        }).isRequired
    }
    componentWillMount() {
        if (!this.props.user) {
            this.history.push('/auth')
        }
    }
    constructor(props, context) {
        super()
        super(props, context)
        this.history = context.router.history
        this.state = {
            showPicker: false
        }
    }

    render() {
        return (
            <Card
                title="Submit"
            >
                <FormLabel>Headline</FormLabel>
                <FormInput
                    onChangeText={(issueName) => {
                        this.props.updateIssue({
                            ...this.props.issue,
                            issueName
                        })
                    }}
                    value={this.props.issue.issueName}
                />
                <FormLabel>Categor</FormLabel>
                <Button
                    large
                    backgroundColor="#f1f1f1"
                    buttonStyle={{
                        marginVertical: 20
                    }}
                    color="#000"
                    borderRadius={40}
                    title={ this.props.issue.Topic || "Pick one category" }
                    onPress={() => {
                        this.setState({
                            showPicker: !this.state.showPicker
                        })
                    }}
                />
                {
                    this.state.showPicker &&
                    (
                        <Picker
                            selectedValue={this.props.issue.Topic}
                            onValueChange={(category) => {
                                this.props.updateIssue({
                                    ...this.props.issue,
                                    Topic: category,
                                })
                            }}
                        >
                            {
                                config.categories.map((category) => (
                                    <Item key={category} label={category} value={category}/>
                                ))
                            }
                        </Picker>
                    )
                }
                <FormLabel>Summary</FormLabel>
                <FormInput
                    multiline
                    value={this.props.issue.Summary}
                    onChangeText={(Summary) => {
                        this.props.updateIssue({
                            ...this.props.issue,
                            Summary
                        })
                    }}
                    inputStyle={{
                        height: 120
                    }}
                />
                <FormLabel>Tags</FormLabel>
                <FormInput
                    value={this.props.issue.Tags}
                    onChangeText={(Tags) => {
                        this.props.updateIssue({
                            ...this.props.issue,
                            Tags
                        })
                    }}
                />
                <Button
                    buttonStyle={{
                        marginTop: 10,
                    }}
                    onPress={() => {
                        this.props.createIssue(this.props.issue)
                    }}
                    backgroundColor="#159489"
                    color="#fff"
                    title="Submit"
                />
            </Card>
        )
    }
}

const mapStateToProps = state => ({
    issue: state.issue,
    user: state.auth.user,
})

const mapDispatchToProps = dispatch => ({
    updateIssue(issue) {
        dispatch(updateIssue(issue))
    },
    createIssue(issue) {
        dispatch(createIssue(issue))
    }
})

export default connect(mapStateToProps, mapDispatchToProps)(Issue)
