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
        $scope.imageSize = '';
        $scope.mapas = [
            {
                id: 0,
                state: false,
                text: 'Rios',
                color: '30, 115, 190',
                size: '',
                image: ''
            },
            {
                id: 1,
                state: false,
                text: 'Caminos',
                color: '0, 178, 48',
                size: '',
                image: ''
            },
            {
                id: 2,
                state: false,
                text: 'Escuelas',
                color: '242, 117, 7',
                size: '',
                image: ''
            },
            {
                id: 3,
                state: false,
                text: 'Hospitales',
                color: '191, 48, 153',
                size: '',
                image: ''
            }
        ];
        
        $scope.changeSize = changeSize;
        $scope.showHideMap = showHideMap;
        $scope.changeMapState = changeMapState;
        $scope.removeMap = removeMap;
        $scope.resetIdToMap = resetIdToMap;
        $scope.sortMap = sortMap;

        function changeSize() {
            angular.forEach($scope.mapas, function(value, key){
                value.size = $scope.imageSize;
                if(value.state) {
                    value.image = './PHP/imagen.php?action=' + value.text + '&' + value.size;
                }
            });
        }
        
        function showHideMap(id) {
            changeMapState(id);
        }
        
        function changeMapState(id) {
            angular.forEach($scope.mapas, function(value, key){
                if(id === value.id) {
                    value.state = !value.state;
                }
            });
        }
        
        function removeMap(mapa) {
            $scope.mapas = $scope.mapas.filter(function(item) {
                return mapa !== item;
            });
        }
        
        function resetIdToMap() {
            var i = 0;
            angular.forEach($scope.mapas, function(value, key){
                value.id = i;
                i++;
            });
        }
        
        function sortMap(action, id, mapa) {
            if(action === 'up') {
                if(id !== 0) {
                    removeMap(mapa);
                    $scope.mapas.splice(id-1, 0, mapa);
                    resetIdToMap();
                }
            }
            else {
                if(id !== $scope.mapas.length-1) {
                    removeMap(mapa);
                    $scope.mapas.splice(id+1, 0, mapa);
                    resetIdToMap();
                }
            }
        }
    });