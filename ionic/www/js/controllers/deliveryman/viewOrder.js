angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl', [
        '$scope','$state','$stateParams','$ionicLoading','$ionicPopup','$cordovaGeolocation','DeliverymanOrder',
        function($scope,$state,$stateParams, $ionicLoading,$ionicPopup,$cordovaGeolocation,DeliverymanOrder){

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

            $scope.finishDelivery = function(){
                DeliverymanOrder.updateStatus({id: $stateParams.id},{status: 2},function(data){
                        $ionicPopup.alert({
                            title: "Status do pedido",
                            template: 'Pedido marcado como ENTREGUE!'
                        }).then(function(){
                            $state.go('deliveryman.order');
                        });
                    },function(){
                    $ionicPopup.alert({
                        title: "Erro",
                        template: 'Erro ao alterar status do pedido'
                    }).then(function(){
                        $state.go('deliveryman.order');
                    });
                });
                };

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