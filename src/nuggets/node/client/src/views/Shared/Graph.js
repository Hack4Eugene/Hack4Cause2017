import React, { PropTypes } from 'react';
import { Line } from 'react-chartjs';
import _ from 'lodash';

function colorGenerator() {
    let r = _.random(0, 255);
    let g = _.random(0, 255);
    let b = _.random(0, 255);
    return (opacity) => {
        return `rgba(${r}, ${g}, ${b}, ${opacity})`;
    };
}

function dataTemplate(label, dataset) {
    const color = colorGenerator();
    return {
        label: label,
        fill: false,
        lineTension: 0.1,
        borderCapStyle: 'butt',
        borderDash: [],
        borderDashOffset: 0.0,
        borderJoinStyle: 'miter',
        pointBorderWidth: 1,
        pointHoverRadius: 5,
        pointHoverBorderWidth: 2,
        pointRadius: 1,
        pointHitRadius: 10,
        redraw: true,
        fillColor: color('0.4'),
        strokeColor: color('1'),
        pointColor: color('1'),
        pointBackgroundColor: color('1'),
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: color('1'),
        data: dataset,
        spanGaps: false
    };
}

export default React.createClass({
    propTypes: {
        title: PropTypes.string,
        datasets: PropTypes.object.isRequired,
        selected: PropTypes.array.isRequired
    },
    render(){
        const {title, datasets, selected} = this.props;

        console.log(datasets);
        console.log(selected);

        const chartData = {
            labels: _.range(2001, 2016, 1),
            datasets: _.keys(datasets)
                .filter((key) => _.includes(selected, key))
                .map((key) => {
                    return dataTemplate(datasets[key].label, datasets[key].data);
                })
        };

        console.log(chartData);

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            tooltipTemplate: "<%= value + '% change' %>",
        };
        return (
            <div className="card">
                <div className="container">
                    <h3>{title}</h3>
                    <Line data={chartData} options={chartOptions} width="100%" height="100%"/>
                </div>
            </div>
        )
    }
});