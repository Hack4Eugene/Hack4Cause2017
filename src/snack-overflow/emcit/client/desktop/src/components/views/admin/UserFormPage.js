import React from 'react';
import { connect } from 'react-redux';
import { Table, TableHead, TableRow, TableCell } from 'react-toolbox';
import { getUser, createUser, updateUser } from 'api';
import Button from 'react-toolbox/lib/button';
import Input from 'react-toolbox/lib/input';
import FormErrors from 'common/components/form/FormErrors';
import { browserHistory } from 'react-router';
import Dropdown from 'react-toolbox/lib/dropdown';

const roles = [
    { value: 'reporter', label: 'Reporter' },
    { value: 'analyst', label: 'Analyst' },
    { value: 'admin', label: 'Admin' }
]


class UserFormPage extends React.Component {

    constructor(props) {
        super(props);

        this.state = {};

        this.setField = name => val => this.setState({ [name]: val });
        this.setName = this.setField('name');
        this.setEmail = this.setField('email');
        this.setPassword = this.setField('password');
        this.setPhone = this.setField('phone_number');
        this.setRole = this.setField('role');
        this.handleSubmit = (e) => {
            e.preventDefault();
            const { createUser, updateUser, id } = this.props;

            (this.isNewUser() ? createUser(this.state) : updateUser(id, this.state)).then(() => browserHistory.push('/users'));
        }
    }

    componentDidMount() {
        if (!this.isNewUser()) {
            const { id, getUser } = this.props;

            getUser(id);
        }
    }

    componentWillReceiveProps(nextProps) {
        if(nextProps.user) {
            const { name, email, phone_number, role } = nextProps.user;

            this.setState({ name, email, phone_number, role });
        }
    }

    isNewUser() {
        return this.props.id === null;
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                <FormErrors errors={this.state.errors} />
                <Input
                    type='text'
                    label='Name'
                    name='name'
                    value={this.state.name}
                    onChange={this.setName}
                />
                <Input
                    type='email'
                    label='Email'
                    name='email'
                    value={this.state.email}
                    onChange={this.setEmail}
                />
                <Input
                    type='password'
                    label='Password'
                    name='password'
                    value={this.state.password}
                    onChange={this.setPassword}
                />
                <Input
                    type='text'
                    label='Phone'
                    name='phone'
                    value={this.state.phone_number}
                    onChange={this.setPhone}
                />
                <Dropdown
                    allowBlank
                    label="Role"
                    source={roles}
                    onChange={this.setRole}
                    value={this.state.role}
                />
                <Button type='submit' raised primary>
                    { this.isNewUser() ? 'Add User' : 'Update User' }
                </Button>
            </form>
        )
    }
}

export const CreateUserPage = connect(
    () => ({ id: null }),
    { getUser, createUser, updateUser }
)(UserFormPage);

export const UpdateUserPage = connect(
    ({ user }, { params }) => ({ user, id: params.id }),
    { getUser, createUser, updateUser }
)(UserFormPage);
