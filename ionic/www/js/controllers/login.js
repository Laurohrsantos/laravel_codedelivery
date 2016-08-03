angular.module('starter.controllers')
    .controller('LoginCtrl', [
        '$scope','$state','$ionicPopup','OAuth','$q', function($scope,$state,$ionicPopup, OAuth,$q){
        $scope.user = {
            username: '',
            password: ''
        };

            function adiarExecucao(){
                var deffered = $q.defer();
                setTimeout(function(){
                    deffered.resolve({name: "ionic"});
                },2000);
                return deffered.promise;
            }

            adiarExecucao().then(function(data){
                console.log(data);
            });

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