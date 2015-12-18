angular.module("app", ["ngRoute", 'ngAnimate', 'ui.bootstrap'])
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
       $scope.e = "Hola";
    });