app.controller('welcome',function($scope, $http, $timeout, $log){

   var ctx = document.getElementById('myChart').getContext('2d');

   var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: ['Mysql', 'Postgres', 'SQL Server', 'Oracle'],
         datasets: [{
            label: 'Base de datos',
            data: [12, 19, 3, 16],
            backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
            ],
            borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 1,
         }]
      },
      options: {
         scales: {
            yAxes: [{
               ticks: {
                     fontColor: '#B3B0B0',
                  beginAtZero: true
               }
            }],
            xAxes: [{
               ticks: {
                     fontColor: '#B3B0B0',
                  beginAtZero: true
               }
            }]
         },
         legend: {
            display: true,
            labels: {
               fontColor: '#B3B0B0',
               fontFamily : 'sans-serif', 
            },
         },

      }
   });


});