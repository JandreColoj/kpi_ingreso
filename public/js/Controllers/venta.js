app.controller('venta',function($scope, $http, $window, blockUI){ 
   
   $scope.venta = {};
   
   $scope.getCliente = function(){
      $http.post("api/getClientes",).then(function(response) {
         $scope.clientes = response.data.clientes;
      });
   }
   $scope.getCliente();

   $scope.getProductos = function(){
      $http.post("api/getProductos",).then(function(response) {
         $scope.productos = response.data.productos;        
      });
   }
   $scope.getProductos();

   $scope.guardarVenta = function(){
      
      $http.post("api/venta/register", $scope.venta).then(function(response) {

         $scope.venta = {};
         alert('Venta registrada correctamente!');

      });
   }

});