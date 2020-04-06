google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = new google.visualization.DataTable();
    data.addColumn('datetime', 'Time of Day');
    data.addColumn('number', 'Motivation Level');

    data.addRows([
        [new Date(2015, 0, 1, 0), 33],
        [new Date(2015, 0, 1, 1), 34],
        [new Date(2015, 0, 1, 2), 34],
        [new Date(2015, 0, 1, 3), 36],
        [new Date(2015, 0, 1, 4), 40],
        [new Date(2015, 0, 1, 5), 37],
        [new Date(2015, 0, 1, 6), 39],
        [new Date(2015, 0, 1, 7), 41],
        [new Date(2015, 0, 1, 8), 33],
        [new Date(2015, 0, 1, 9), 35],
        [new Date(2015, 0, 1, 10), 34],
        [new Date(2015, 0, 1, 11), 36],
        [new Date(2015, 0, 1, 12), 37],
        [new Date(2015, 0, 1, 13), 40],
        [new Date(2015, 0, 1, 14), 50],
        [new Date(2015, 0, 1, 15), 51],
        [new Date(2015, 0, 1, 16), 56],
        [new Date(2015, 0, 1, 17), 52],
        [new Date(2015, 0, 1, 18), 47],
        [new Date(2015, 0, 1, 19), 45],
        [new Date(2015, 0, 1, 20), 42],
        [new Date(2015, 0, 1, 21), 40],
        [new Date(2015, 0, 1, 22), 37],
        [new Date(2015, 0, 1, 23), 33],
    ]);

    var options = {
        legend: { position: 'none' },
        enableInteractivity: false,
        chartArea: {
            width: '85%'
        },
        vAxis: {
            title: 'Values in Mg/m3',
        },
        hAxis: {
            title: 'Time',
            gridlines: {
                units: {
                    days: { format: ['MMM dd'] },
                    hours: { format: ['HH:mm', 'ha'] },
                }
            },
            minorGridlines: {
                units: {
                    hours: { format: ['hh:mm:ss a', 'ha'] },
                    minutes: { format: ['HH:mm a Z', ':mm'] }
                }
            }
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

$(window).on("resize", function() {
    drawChart();
});

google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {

    var data = new google.visualization.DataTable();
    data.addColumn('datetime', 'Time of Day');
    data.addColumn('number', 'Motivation Level');

    data.addRows([
        [new Date(2015, 0, 1, 0), 33],
        [new Date(2015, 0, 1, 1), 34],
        [new Date(2015, 0, 1, 2), 34],
        [new Date(2015, 0, 1, 3), 36],
        [new Date(2015, 0, 1, 4), 40],
        [new Date(2015, 0, 1, 5), 37],
        [new Date(2015, 0, 1, 6), 39],
        [new Date(2015, 0, 1, 7), 41],
        [new Date(2015, 0, 1, 8), 45],
        [new Date(2015, 0, 1, 9), 51],
        [new Date(2015, 0, 1, 10), 57],
        [new Date(2015, 0, 1, 11), 56],
        [new Date(2015, 0, 1, 12), 52],
        [new Date(2015, 0, 1, 13), 48],
        [new Date(2015, 0, 1, 14), 50],
        [new Date(2015, 0, 1, 15), 51],
        [new Date(2015, 0, 1, 16), 47],
        [new Date(2015, 0, 1, 17), 51],
        [new Date(2015, 0, 1, 18), 55],
        [new Date(2015, 0, 1, 19), 47],
        [new Date(2015, 0, 1, 20), 43],
        [new Date(2015, 0, 1, 21), 40],
        [new Date(2015, 0, 1, 22), 37],
        [new Date(2015, 0, 1, 23), 33],
    ]);

    var options = {
        legend: { position: 'none' },
        enableInteractivity: false,
        chartArea: {
            width: '85%'
        },
        vAxis: {
            title: 'Values in Mg/m3',
        },
        hAxis: {
            title: 'Time',
            gridlines: {
                units: {
                    days: { format: ['MMM dd'] },
                    hours: { format: ['HH:mm', 'ha'] },
                }
            },
            minorGridlines: {
                units: {
                    hours: { format: ['hh:mm:ss a', 'ha'] },
                    minutes: { format: ['HH:mm a Z', ':mm'] }
                }
            }
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
    chart.draw(data, options);
}

$(window).on("resize", function() {
    drawChart2();
});