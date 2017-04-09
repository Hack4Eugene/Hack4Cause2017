import React from 'react'
import { connect } from 'react-redux'
import { Table, TableHead, TableRow, TableCell } from 'react-toolbox';

import { getReports } from 'api';


const ReportModel = {
    date: { type: String },
    location: { type: String },
    room_number: { type: String }
}

class ReportTablePage extends React.Component {

    componentWillMount() {
    }

    renderVehicle(vehicle) {
        return (
            <div>
                <div>{vehicle.color} {vehicle.make} {vehicle.model}</div>
            </div>
        )
    }

    renderPerson({ sex, eye_color, hair_length, hair_color, weight }) {
        const getEyes = () => eye_color ? eye_color.replace('_',' ') + ' eyes' : '';
        const getHair = () => {
            const color = hair_color ? hair_color.replace('_',' ') : null;
            const vals = [hair_length, color].filter(v => !!v);
            if (vals.length > 0)
                return vals.join(' ') + ' hair'
            return ''
        }
        return (
            <div>
                {sex} with {getEyes()} {getHair()} weighing {weight}lbs
            </div>
        )
    }

    render() {
        return (
            <Table selectable={false}>
                <TableHead>
                    <TableCell>Created At</TableCell>
                    <TableCell>Vehicle(s)</TableCell>
                    <TableCell>Suspicious Person(s)</TableCell>
                    <TableCell>Victim(s)</TableCell>
                    <TableCell>Location</TableCell>
                    <TableCell>Room Number</TableCell>
                </TableHead>
                {this.props.list.map((report, idx) => (
                    <TableRow key={idx}>
                        <TableCell>{report.date}</TableCell>
                        <TableCell>{report.vehicles.map(this.renderVehicle)}</TableCell>
                        <TableCell>{report.people.filter(p => p.category === 'victim').map(this.renderPerson)}</TableCell>
                        <TableCell>{report.people.filter(p => p.category === 'suspicious_person' || p.category === 'buyer').map(this.renderPerson)}</TableCell>
                        <TableCell>{report.location}</TableCell>
                        <TableCell>{report.room_number}</TableCell>
                    </TableRow>
                ))}
            </Table>
        );
    }
}

const mapStateToProps = ({ reports: { list } }) => ({ list });

export default connect(mapStateToProps, {
})(ReportTablePage);
