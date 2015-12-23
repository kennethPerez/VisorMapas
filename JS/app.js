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
        $scope.image = '';
        $scope.mapas = [
            {
                id: '1',
                state: true,
                text: 'Caminos',
                size: '',
                image: ''
            },
            {
                id: '2',
                state: true,
                text: 'Hospitales',
                size: '',
                image: ''
            }
        ];
        
        $scope.changeSize = changeSize;
        $scope.showMap = showMap;
        $scope.hideMap = hideMap;
        $scope.changeMapState = changeMapState;

        function changeSize() {
            $scope.image = './PHP/imagen.php?' + $scope.imageSize;
            angular.forEach($scope.mapas, function(value, key){
                if(!value.state) {
                    value.size = $scope.imageSize;
                    value.image = './PHP/imagen.php?action=' + value.text + '&' + value.size;
                    $scope.image = value.image;
                }
            });
            console.log($scope.image);
        }
        
        function showMap(id, mapa) {
            changeMapState(id);
        }
        
        function hideMap(id, mapa) {
            changeMapState(id);
        }
        
        function changeMapState(id) {
            angular.forEach($scope.mapas, function(value, key){
                if(id === value.id) {
                    value.state = !value.state;
                }
            });
        }
    });