angular.module('starter.controllers')
    .controller('LoginCtrl', [
        '$scope', '$state', '$ionicPopup', 'UserData', 'User', 'OAuth', 'OAuthToken','$localStorage',
        function ($scope, $state, $ionicPopup, UserData, User, OAuth, OAuthToken,$localStorage) {

            $scope.user = {
                username: '',
                password: ''
            };


            $scope.login = function () {
                var promise = OAuth.getAccessToken($scope.user);
                promise
                    .then(function (data) {
                        var token = $localStorage.get('device_token');
                        return User.updateDeviceToken({},{device_token: token}).$promise;
                    })
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