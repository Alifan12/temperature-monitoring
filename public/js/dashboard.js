google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

  var data = new google.visualization.DataTable();
  data.addColumn('number', 'Hour');
  data.addColumn('number', 'Temperature');
  data.addColumn('number', 'Humadity');
  data.addColumn('number', 'Substance Concentration');

  data.addRows(dataArray);
  console.log(dataArray);

  var options = {
    chart: {
      title: day,
      subtitle: 'Dashboard Sensor (Temperature, Humadity and ppm)',
      width: 1500
    },
    hAxis: {
      title: 'Hour',
      ticks: [1,4,8,12,16,20,24],
      textStyle: {
        fontSize: 10,
      },
      titleTextStyle: {
        italic: false
      },
      gridlines: {
        count: 24
      },
    },
    vAxis: {
      title: 'Value',
      textStyle: {
        fontSize: 10,
      },
      titleTextStyle: {
        italic: false
      }
    },
    legend: { 
      position: 'top',
      alignment: 'center'
    },
    height: 600,
    chartArea: {
      width: '80%',
      height: '80%'
    },
    textStyle: {
      fontSize: 10
    }
  };

  var chart = new google.visualization.LineChart(document.getElementById('myChart'));
chart.draw(data, options);
}