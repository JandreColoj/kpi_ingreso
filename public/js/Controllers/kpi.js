app.controller('KPICtrl',function($scope, $http, $window, blockUI){ 
   
   $scope.seleccionar = function(id){
      
      for (i=0;i<document.f1.elements.length;i++){ 
         if(document.f1.elements[i].type == "checkbox")	
            document.f1.elements[i].checked=0 
      }

      document.getElementById(id).checked = true;
      $scope.db = id;      
   }
     
   //grafica de clientes
   $scope.chart_cliente_pie = function(data){

      var labelClientes = [];
      var dataClientes = []; 
      $scope.clientes = [];

      $http.post("api/getClientes",data).then(function(response) {

         $scope.clientes = response.data.clientes;
         
         response.data.cantidad.forEach(element => {
            labelClientes.push(element.tipoCliente);   
            dataClientes.push(element.cantidad);  
            $scope.total_clientes += element.cantidad;
         });

         // GRAFICA DE PIE
         new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
            labels: labelClientes,
            datasets: [{
               label: "Population (millions)",
               backgroundColor: ["rgba(255, 99, 132, 0.5)", "rgba(54, 162, 235, 0.5)","rgba(255, 206, 86, 0.5)","rgba(75, 192, 192, 0.5)"],
               data: dataClientes,
               fontColor: '#B3B0B0',
               borderWidth: 1
            }]
            },
            options: {
               title: {
                  display: true,
                  text: 'Total de clientes activos '+ $scope.total_clientes,
                  fontColor: '#B3B0B0'
               },
               legend: {
                  display: true,
                  labels: {
                      fontColor: '#B3B0B0'
                  }
              }
            
            }
         });

      },function(response) {
         // $scope.data = response.data || 'Request failed';
         // $scope.status = response.status;
      });

   }

   //grafica de productos
   $scope.chart_productos = function(data){

      var labelCategoria = [];
      var dataCategoria = []; 
      var labelProductos = [];
      var dataProductos = []; 
      $scope.productos = [];

      $http.post("api/getProductos",data).then(function(response) {
  
         $scope.productos = response.data.productos;
         
         $scope.total_productos = $scope.productos.length;
         $scope.total_categorias = response.data.categorias.length;
   
         response.data.categorias.forEach(element => {
            labelCategoria.push(element.categoria);   
            dataCategoria.push(element.cantidad);  
         });
   
         
         new Chart(document.getElementById("doughnut-chart"), {
            type: 'doughnut',
            data: {
              labels: labelCategoria,
              datasets: [
                {
                  label: "Categoria de productos",
                  backgroundColor: ["rgba(255, 99, 132, 0.5)", "rgba(54, 162, 235, 0.5)","rgba(255, 206, 86, 0.5)","rgba(75, 192, 192, 0.5)"],
                  data: dataCategoria,
                  fontColor: '#B3B0B0',
                }
              ]
            },
            options: {
              title: {
                display: true,
                text: 'Total de categorias disponibles '+$scope.total_categorias,
                fontColor: '#B3B0B0'
              },
              legend: {
                  display: true,
                  labels: {
                     fontColor: '#B3B0B0'
                  }
               }
   
            }
         });
   
   
         $scope.productos.forEach(element => {
            labelProductos.push(element.nombre);   
            dataProductos.push(element.stock);  
         });
   
         new Chart(document.getElementById("bar-chart-productos"), {
            type: 'bar',
            data: {
              labels: labelProductos,
              datasets: [
                {
                  label: "Unidades disponibles",
                  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3e95cd",
                                     "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3e95cd", "#8e5ea2",
                                     "#3cba9f","#e8c3b9","#c45850","#3e95cd", "#8e5ea2","#3cba9f",
                                     "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#c45850",
                                     "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#c45850"],
                  data: dataProductos,
                  fontColor: '#B3B0B0',
                },
                
              ]
            },
            options: {
              legend: { display: true,
                  labels: {
                     fontColor: '#B3B0B0'
                  } 
              },
              title: {
                display: true,
                text: 'Existencia de productos',
                fontColor: '#B3B0B0'
              },
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
            }
        });
   
      },function(response) {
         // $scope.data = response.data || 'Request failed';
         // $scope.status = response.status;
      });
   
   }

   $scope.chart_ventasDia = function(data){

      var labelDias = [];
      var DataGTQ = [];
      var DataUSD = [];
      $scope.ventas = [];

      $http.post("api/getVentasDia",data).then(function(response) {

         $scope.ventas = response.data.ventas;

         $scope.ventas.forEach(element => {
            labelDias.push(element.dia); 
            DataGTQ.push(element.gtq); 
            DataUSD.push(element.usd); 
         });

         new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
              labels: labelDias,
              datasets: [{ 
                  data: DataGTQ,
                  label: "Quetzales",
                  borderColor: "#498FAC",
                  fill: false
                }, { 
                  data: DataUSD,
                  label: "Dolares",
                  borderColor: "#E63946",
                  fill: false
                }
              ]
            },
            options: {
               title: {
                  display: true,
                  text: 'Total de ventas diarias',
                  fontColor: '#B3B0B0'
               },
               legend: { display: true,
                  labels: {
                     fontColor: '#B3B0B0'
                  } 
               },
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
            }
          });

      },function(response){
      });

   }

   $scope.chart_ventaMes = function(data){
      
      var labelMes = [];
      var DataGTQ = [];
      var DataUSD = [];
      $scope.ventas = [];

      $http.post("api/getVentasMes",data).then(function(response) {

         $scope.ventas = response.data.ventas;

         $scope.ventas.forEach(element => {
            labelMes.push(element.mes); 
            DataGTQ.push(element.gtq); 
            DataUSD.push(element.usd); 
            $scope.total_ventaGTQ += element.gtq ;
            $scope.total_ventaUSD += element.usd ;
         });

         new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
              labels: labelMes,
              datasets: [
                {
                  label: "Quetzales",
                  backgroundColor: "#3e95cd",
                  data: DataGTQ,
                }, {
                  label: "Dolares",
                  backgroundColor: "#8e5ea2",
                  data: DataUSD
                }
              ]
            },
            options: {
              title: {
                display: true,
                text: 'ventas por mes en quetzales y dolares',
                fontColor: '#B3B0B0',
              },
              legend: { display: true,
               labels: {
                  fontColor: '#B3B0B0'
               } 
              },
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
            }
        });

      },function(response){
      });

   }

   $scope.chart_productos_moda = function(data){

      var labelProductos = [];
      var DataCantidad= [];

      $http.post("api/getProductosModa",data).then(function(response) {

         $scope.prod_moda = response.data.productos;
         $scope.producto_top = $scope.prod_moda[0].nombre;

         $scope.prod_moda.forEach(element => {
            labelProductos.push(element.nombre); 
            DataCantidad.push(element.cantidad);
         });


         new Chart(document.getElementById("bar-chart-horizontal"), {
            type: 'horizontalBar',
            data: {
              labels: labelProductos,
              datasets: [
                {
                  label: "Unidades Vendidas",
                  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850",
                                    "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850",
                                    "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                  data: DataCantidad
                }
              ]
            },
            options: {
              legend: { display: false },
              title: {
                display: true,
                text: '10 principales productos',
                fontColor: '#B3B0B0'
              },
              legend: { display: true,
               labels: {
                  fontColor: '#B3B0B0'
               } 
              },
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
            }
        });


      },function(response){
      });

   }

   $scope.filtro = {};
   $scope.db ='Mysql';

   $scope.init = function(){
      
      $scope.msj = '';
      $scope.total_clientes = 0;
      $scope.total_categorias = 0;
      $scope.total_productos = 0;
      $scope.total_ventaGTQ = 0;
      $scope.total_ventaUSD = 0;
      $scope.producto_top = '';
    
      if (isEmpty($scope.filtro)) {
         var date = new Date();
         $scope.filtro.finicio = new Date(date.getFullYear(), date.getMonth(), 1);
         $scope.filtro.ffin = new Date(date.getFullYear(), date.getMonth() + 1, 0);
      }

      var inicio = dateFormat($scope.filtro.finicio);
      var fin = dateFormat($scope.filtro.ffin);


      if ($scope.filtro.finicio <= $scope.filtro.ffin) {

         var data = {
            finicio : inicio,
            ffin : fin,
            db : $scope.db
         }

         $scope.chart_cliente_pie(data);
         $scope.chart_productos(data);
         $scope.chart_ventasDia(data);
         $scope.chart_ventaMes(data);
         $scope.chart_productos_moda(data);
      }else{
         $scope.msj = 'Fechas incorrecta';
      }
   }

   $scope.init();

   function isEmpty(obj) {
      for(var prop in obj) {
        if(obj.hasOwnProperty(prop)) {
          return false;
        }
      }
    
      return JSON.stringify(obj) === JSON.stringify({});
   }

   function dateFormat(date) {
      var d = date.getDate();
      var m = date.getMonth() + 1;
      var y = date.getFullYear();

      return  y +'-'+ m +'-'+ d;
   }

});