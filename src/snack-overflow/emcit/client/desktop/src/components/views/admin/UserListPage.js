import React from 'react';
import { connect } from 'react-redux';
import { Table, TableHead, TableRow, TableCell } from 'react-toolbox';
import { getUsers } from 'api';
import { Link } from 'react-router'

class UserListPage extends React.Component {

    componentDidMount() {
        this.props.getUsers()

    }

    render() {
        return (
            <Table selectable={false}>
                <TableHead>
                    <TableCell>Name</TableCell>
                    <TableCell>Role</TableCell>
                    <TableCell>Email</TableCell>
                    <TableCell>Phone</TableCell>
                </TableHead>
                {this.props.list.map((user, idx) => (
                    <TableRow key={idx}>
                        <TableCell><Link to={`/users/${user.id}`}>{user.name}</Link></TableCell>
                        <TableCell>{user.role}</TableCell>
                        <TableCell>{user.email}</TableCell>
                        <TableCell>{user.phone_number}</TableCell>
                    </TableRow>
                ))}
            </Table>
        );
    }
}

const mapStateToProps = ({ users: { list } }) => ({ list });
const mapDispatchToProps = { getUsers };

export default connect(mapStateToProps, mapDispatchToProps)(UserListPage);
