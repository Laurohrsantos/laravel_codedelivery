angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl', [
        '$scope','$stateParams','$ionicLoading','$ionicPopup','$cordovaGeolocation','DeliverymanOrder',
        function($scope, $stateParams, $ionicLoading,$ionicPopup,$cordovaGeolocation,DeliverymanOrder){

            var watch;

            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando...'
            });

            DeliverymanOrder.get({id: $stateParams.id,include: "items,cupom"},function(data){
                $scope.order = data.data;
                 $ionicLoading.hide();
             },function(responseError){
                 $ionicLoading.hide();
             });

            $scope.goToDelivery = function(){
                $ionicPopup.alert({
                    title: "Enviando localização",
                    template: 'Para cancelar pressione ok'
                }).then(function(){
                    stopWatchPosition();
                });

                DeliverymanOrder.updateStatus({id: $stateParams.id},{status: 1},function(data){
                    var watchOptions = {
                        timeout: 3000,
                        enableHighAccuracy: false
                    };

                    watch = $cordovaGeolocation.watchPosition(watchOptions);
                    watch.then(null,function(responseError){
                        // error
                    },function(position){
                        DeliverymanOrder.geo({id: $stateParams.id},{
                            lat: position.coords.latitude,
                            long: position.coords.longitude
                        });
                    });


                });
            };

            function stopWatchPosition(){
               if(watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')){
                   $cordovaGeolocation.clearWatch(watch.watchID);
               }
            }
    }]);