angular.module('starter.controllers',[])
    .controller('HomeCtrl', function($scope,$stateParams){
        $scope.nome = $stateParams.nome;
    });