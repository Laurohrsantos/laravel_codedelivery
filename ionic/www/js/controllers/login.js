angular.module('starter.controllers')
    .controller('LoginCtrl', [
        '$scope', '$state', '$ionicPopup', 'UserData', 'User', 'OAuth', 'OAuthToken',
        function ($scope, $state, $ionicPopup, UserData, User, OAuth, OAuthToken) {

            $scope.user = {
                username: '',
                password: ''
            };


            $scope.login = function () {
                var promise = OAuth.getAccessToken($scope.user);
                promise
                    .then(function (data) {
                        return User.authenticated({include: 'client'}).$promise;
                    })
                    .then(function (data) {
                        UserData.set(data.data);
                        $state.go('client.checkout');
                }, function (responseError) {
                    UserData.set(null);
                    OAuthToken.removeToken();
                    $ionicPopup.alert({
                        title: "Erro",
                        template: 'Credenciais inválidas!'
                    });
                    console.log(responseError);
                });
            }
        }]);