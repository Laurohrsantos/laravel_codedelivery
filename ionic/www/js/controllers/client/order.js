angular.module('starter.controllers')
    .controller('ClientOrderCtrl', [
        '$scope','$state','$ionicLoading','$ionicActionSheet','ClientOrder',
        function($scope,$state,$ionicLoading,$ionicActionSheet,ClientOrder){
            $scope.orders = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });

            $scope.doRefresh = function(){
                getOrders().then(function (data){
                    $scope.orders = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                }, function (dataError) {
                    $scope.$broadcast('scroll.refreshComplete');
                });
            };

            $scope.openOrderDetail = function(order){
                $state.go('client.view_order',{id: order.id});
            };

            $scope.showActionSheet = function(order){
                $ionicActionSheet.show({
                    buttons: [
                        {text: "Ver detalhes"},
                        {text: "Ver entrega"}
                    ],
                    titleText: "Ação",
                    cancelText: "Cancelar",
                    cancel: function(){

                    },
                    buttonClicked: function(index){
                        switch (index){
                            case 0:
                                $scope.openOrderDetail(order);
                                break;
                            case 1:
                                $state.go('client.view_delivery',{id: order.id});
                                break;
                        }
                    }
                });
            };

            function getOrders(){
                return ClientOrder.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc',
                }).$promise;
            };

            getOrders().then(function (data){
                $scope.orders = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });
    }]);