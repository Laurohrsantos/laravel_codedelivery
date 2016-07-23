angular.module('starter.controllers')
    .controller('LoginCtrl', [
        '$scope','$state','$ionicPopup','OAuth', function($scope,$state,$ionicPopup, OAuth){
        $scope.user = {
            username: '',
            password: ''
        };

        $scope.login = function(){
            OAuth.getAccessToken($scope.user).then(function(data){
                $state.go('client.checkout');
            },function(responseError){
                $ionicPopup.alert({
                    title: "Erro",
                    template: 'Credenciais inválidas!'
                })
            });
        }
    }]);