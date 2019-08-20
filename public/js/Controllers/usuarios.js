app.controller('usuariosCtrl',function($scope, $http, $window, blockUI){ 
   
   $scope.usuarios = function(){

      $http.post("api/getUsuarios").then(function(response) {

         $scope.usuarios = response.data.usuarios;      

      });
   }
   $scope.usuarios();

});