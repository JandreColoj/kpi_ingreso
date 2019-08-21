app.controller('productos',function($scope, $http, $window, blockUI){ 
   
   $scope.producto = {};
   
   $scope.guardarProducto = function(){
      
      $http.post("api/producto/create", $scope.producto).then(function(response) {

         $scope.producto = {};
         alert('Producto registrado correctamente!');

      });
   }


});