angular.module('starter.controllers')
    .controller('ClientViewOrderCtrl', [
        '$scope','$stateParams','$ionicLoading','Order',
        function($scope,$stateParams,$ionicLoading,Order){

            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando...'
            });

             Order.get({id: $stateParams.id,include: "items,cupom"},function(data){
                $scope.order = data.data;
                 $ionicLoading.hide();
             },function(responseError){
                 $ionicLoading.hide();
             });
    }]);