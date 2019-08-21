app.controller('clientes',function($scope, $http, $window, blockUI){ 
   
   $scope.cliente = {};
   
   $scope.guardarCliente = function(){
      
      $http.post("api/cliente/create", $scope.cliente).then(function(response) {
         console.log(response);
         
         $scope.cliente = {};
         alert('Cliente registrado correctamente!');

      });
   }


});