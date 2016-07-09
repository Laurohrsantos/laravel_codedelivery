angular.module('starter.controllers')
    .controller('LoginCtrl', [
        '$scope','$state','$ionicPopup','OAuth', function($scope,$state,$ionicPopup, OAuth){
        $scope.user = {
            username: '',
            password: ''
        };

        $scope.login = function(){
            OAuth.getAccessToken($scope.user).then(function(data){
                $state.go('home');
            },function(responseError){
                $ionicPopup.alert({
                    title: "Erro",
                    template: 'Credenciais inválidas!'
                })
            });
        }
    }]);