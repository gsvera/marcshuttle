var myPieChart; var myChartTrip;

function handleMonthChart() {
  var date = new Date();
  date.setMonth($('#month-chart').val() -1)
  date.setFullYear($('#year-chart').val());
  setDatesCharts(date);
}


function setDatesCharts(currentDate = new Date()) {

  var labelMonth = { month: 'long' };
  
  var currenMonthLabel = currentDate.toLocaleDateString(undefined, labelMonth);
  currentDate.setDate(1);
  
  var firstDay = currentDate.getDate() < 10 ? '0'+currentDate.getDate() : currentDate.getDate(); 
  var currentMont = (currentDate.getMonth + 1) < 10 ? ('0'+currentDate.getMonth() + 1) : (currentDate.getMonth() + 1);
  var currentYear = currentDate.getFullYear();
  
  currentDate.setMonth(currentDate.getMonth() + 1);
  currentDate.setDate(currentDate.getDate() - 1);
  
  var lastDate = currentDate.getDate();
  
  var starDate = currentYear + '-' + currentMont + '-' + firstDay;
  var endDate = currentYear + '-' + currentMont + '-' + lastDate;
  
  $('.currentMonthTrip').text(currenMonthLabel);
  $('.currentMonthTour').text(currenMonthLabel);

  getTripsChart(starDate, endDate);
  getToursChart(starDate, endDate);

}

function getTripsChart(starDate, endDate) {
    var totalTrip = 0;
    var countTrip = 0;
    var dataLabels = [];
    var dataValue = [];
    var dataColor = [];
    fetch(`/admin-marcshuttle/get-bookings-trip-report?dataArrivalStart=${starDate}&dataArrivalEnd=${endDate}&typeTransfer=0&payMethod=0&dataDepartureStart=&dataDepartureEnd`)
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            result.data.map(item => {
                totalTrip += item.amount;
                countTrip++;
            });
            fetch('/admin-marcshuttle/get-type-trip')
            .then(resType => resType.json())
            .then(resultType => {
                if(resultType.error == false) {
                    resultType.data.map(itemType => {
                        dataLabels.push(itemType.name_es);
                        var color = generarColorRGB();
                        var sumByType = 0;
                        result.data.map(item => {
                            if(item.type_transfer == itemType.id) sumByType += item.amount;
                        })

                        dataColor.push(color);
                        dataValue.push(sumByType);
                    });
                    createChartTrip(dataLabels, dataValue, dataColor, totalTrip);
                    $('#total-trip').text(convertCurrency(totalTrip));
                    $('#count-trips').text(countTrip);
                }
            })
        }
    })
}

function getToursChart(starDate, endDate) {
    var totalTour = 0;
    var countTour = 0;
    var dataLabels = [];
    var dataValue = [];
    var dataColor = [];
    fetch(`/admin-marcshuttle/get-bookings-tour-report?dateDepartureStart=${starDate}&dateDepartureEnd=${endDate}&toursSelect=0&payMethod=0`)
    .then(res => res.json())
    .then(result => {
        if(result.error == false) {
            result.data.map(item => {
                totalTour += item.amount;
                countTour++;
            });
            fetch('/admin-marcshuttle/get-tours')
            .then(resTour => resTour.json())
            .then(resultTour => {
                if(resultTour.error == false) {
                    resultTour.data.map(itemTour => {
                        dataLabels.push(itemTour.name);
                        var color = generarColorRGB();
                        var sumByTour = 0;
                        result.data.map(item => {
                            if(item.id_tour == itemTour.id) sumByTour += item.amount;
                        });

                        dataColor.push(color);
                        dataValue.push(sumByTour);
                    });
                    createCharTour(dataLabels, dataValue, dataColor, totalTour);
                    $('#total-tour').text(convertCurrency(totalTour));
                    $('#count-tour').text(countTour);
                }
            })
        }
    })
}

function createChartTrip(dataLabels = [], dataValue = [], dataColor = [], maxAmount) {

    var ctx = document.getElementById("myChartTrip");
    if(myChartTrip != undefined) 
    {
      myChartTrip.clear();
      myChartTrip.destroy();
    }
    myChartTrip = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: dataLabels,
        datasets: [{
        //   label: "Revenue",
          backgroundColor: dataColor,
          borderWidth: 1,
          hoverBackgroundColor: "#2e59d9",
          data: dataValue,
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            // time: {
            //   unit: 'month'
            // },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 6
            },
            maxBarThickness: 25,
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: Math.round(maxAmount / 1000) * 1000,
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return convertCurrency(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': ' + convertCurrency(tooltipItem.yLabel);
            }
          }
        },
      }
    });
}

function createCharTour(dataLabels = [], dataValue = [], dataColor = []) {
    var ctx = document.getElementById("myChartTour");
    if(myPieChart != undefined) {
      myPieChart.clear();
      myPieChart.destroy();
    }
      myPieChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
          labels: dataLabels,
          datasets: [{
            data: dataValue,
            backgroundColor: dataColor,
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                  var datasetLabel = chart.labels[tooltipItem.index] || '';
                  return datasetLabel + ': ' + convertCurrency(tooltipItem.yLabel);
                }
              }
          },
          legend: {
            display: false
          },
          cutoutPercentage: 80,
        },
        
      });
}

$(document).ready(() => {
    var yearChart = document.getElementById('year-chart');
    var mountChart = document.getElementById('month-chart');
    var currentDate = new Date();

    for(let i = initYear; i < (currentDate.getFullYear() + 1); i ++) {
      var optionYear = `<option value="${i}">${i}</option>`;
      yearChart.insertAdjacentHTML('beforeend', optionYear);
    }

    yearChart.value = currentDate.getFullYear();
    mountChart.value = (currentDate.getMonth + 1) < 10 ? ('0'+currentDate.getMonth() + 1) : (currentDate.getMonth() + 1);
    setDatesCharts(currentDate)
})