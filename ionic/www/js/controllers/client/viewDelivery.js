angular.module('starter.controllers')
    .controller('ClientViewDeliveryCtrl', [
        '$scope','$stateParams','$ionicLoading','$ionicPopup','ClientOrder','UserData',
        function($scope,$stateParams,$ionicLoading,$ionicPopup,ClientOrder,UserData){

            var iconUrl = "http://maps.google.com/mapfiles/kml/pal2";
            $scope.order = {};

            $scope.map = {
                center: {
                    latitude: -23.444,
                    longitude: -46.444
                },
                zoom: 16
            };

            $scope.markers = [
            ];

            $ionicLoading.show({
                template: 'Carregando...'
            });

             ClientOrder.get({id: $stateParams.id,include: "items,cupom"},function(data){
                $scope.order = data.data;
                 $ionicLoading.hide();
                 if($scope.order.status == 1){
                    initMarkers();
                 }else{
                     $ionicPopup.alert({
                         title: "Erro",
                         template: 'Pedido não está em status de entrega!'
                     });
                 }

             },function(responseError){
                 $ionicLoading.hide();
             });

            function initMarkers(){
                var client = UserData.get().client.data,
                address = client.zipcode+", "+client.address+", "+client.city+" - "+client.state;

                createMarkerClient(address);
            }

            function createMarkerClient(address){
                console.log(address);
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    address: address
                },function(results,status){
                    if(status == google.maps.GeocoderStatus.OK){
                        var lat = results[0].geometry.location.lat(),
                            long = results[0].geometry.location.lng();

                        $scope.markers.push({
                            id: 'client',
                            coords: {
                                latitude: lat,
                                longitude: long
                            },
                            options: {
                                title: "Local de entrega",
                                icon: iconUrl+"/icon2.png"
                            }
                        });

                        $scope.map.center = {
                                latitude: lat,
                                longitude: long
                            };


                        console.log($scope.markers);

                    }else{
                        $ionicPopup.alert({
                            title: "Erro",
                            template: 'Endereço não encontrado: '+address
                        });
                    }
                });
            }
    }]);