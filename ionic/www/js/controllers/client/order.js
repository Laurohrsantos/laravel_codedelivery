angular.module('starter.controllers')
    .controller('ClientOrderCtrl', [
        '$scope','$state','$ionicLoading','Order',
        function($scope,$state,$ionicLoading,Order){
            $scope.orders = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });

            Order.query({id: null},function(data){
                $scope.orders = data.data;
                $ionicLoading.hide();
            },function(dataError){
                $ionicLoading.hide();
            });
    }]);