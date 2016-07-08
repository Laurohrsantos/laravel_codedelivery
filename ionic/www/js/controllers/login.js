angular.module('starter.controllers',[])
    .controller('LoginCtrl', [
        '$scope','$cookies','OAuth', function($scope,$cookies, OAuth){
        $scope.user = {
            username: '',
            password: ''
        };

        $scope.login = function(){
            OAuth.getAccessToken($scope.user).then(function(data){
                console.log("login functionando");
                $cookies.getObject('token');
            },function(responseError){
                console.log("error");
            });
        }
    }]);