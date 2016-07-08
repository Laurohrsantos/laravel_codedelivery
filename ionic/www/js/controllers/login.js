angular.module('starter.controllers',[])
    .controller('LoginCtrl', ['$scope','OAuth', function($scope,OAuth){
        $scope.user = {
            username: '',
            password: ''
        };

        $scope.login = function(){
            OAuth.getAccessToken($scope.user).then(function(data){
                console.log("login functionando");
            },function(responseError){
                console.log("error");
            });
        }
    }]);