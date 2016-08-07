angular.module('starter.controllers')
    .controller('ClientViewOrderCtrl', [
        '$scope','$stateParams','$ionicLoading','ClientOrder',
        function($scope, $stateParams, $ionicLoading, ClientOrder){

            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando...'
            });

             ClientOrder.get({id: $stateParams.id,include: "items,cupom"},function(data){
                $scope.order = data.data;
                 $ionicLoading.hide();
             },function(responseError){
                 $ionicLoading.hide();
             });
    }]);