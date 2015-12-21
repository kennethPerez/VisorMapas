angular
    .module("app", ["ngRoute", 'ngAnimate', 'ui.bootstrap'])
    .config(function($routeProvider){
        $routeProvider
            .when("/", {
                controller: "visorController",
                templateUrl: "Vistas/visor.html"
            });
    })

    .factory('Data', function () {
        var info = {};
        return info;
    })

    .controller("visorController", function($scope, $http, $location, Data) {        
        $scope.imageSize = '640x480';
        $scope.image = './PHP/imagen.php?x=640&y=480';
        $scope.changeSize = changeSize;

        function changeSize() {
            $scope.image = './PHP/imagen.php?' + $scope.imageSize;
        }
    });