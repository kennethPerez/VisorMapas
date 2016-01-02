angular
    .module("app", ['FBAngular'])
    .controller("visorController", function($scope, Fullscreen) {        
        $scope.imageSize = 'x=500&y=400';
        $scope.rowsColumns = '3';
        $scope.despX = 0.0;
        $scope.despY = 0.0;
        $scope.zoom = 0.0;
        $scope.mapas = [
            {
                id: 0,
                state: false,
                text: 'Distritos',
                color: '0, 178, 48',
                transparency: 10,
                type: 'type=Polygon',
                image: []
            },
            {
                id: 1,
                state: false,
                text: 'Rios',
                color: '30, 115, 190',
                transparency: 10,
                type: 'type=Line',
                image: []
            },
            {
                id: 2,
                state: false,
                text: 'Caminos',
                color: '229, 0, 0',
                transparency: 10,
                type: 'type=Line',
                image: []
            },
            {
                id: 3,
                state: false,
                text: 'Escuelas',
                color: '242, 117, 7',
                transparency: 10,
                type: 'type=Point',
                image: []
            },
            {
                id: 4,
                state: false,
                text: 'Hospitales',
                color: '191, 48, 153',
                transparency: 10,
                type: 'type=Point',
                image: []
            }
        ];
        
        $scope.goFullscreen = goFullscreen;        
        $scope.generateSubImage = generateSubImage;
        $scope.generateImage = generateImage;
        $scope.showHideMap = showHideMap;
        $scope.changeMapState = changeMapState;
        $scope.removeMap = removeMap;
        $scope.resetIdToMap = resetIdToMap;
        $scope.sortMap = sortMap;
        $scope.displacement = displacement;
        $scope.plus = plus;
        $scope.minus = minus;
        
        function plus()
        {
            if($scope.zoom < 0.88){                
                $scope.zoom += 0.1;
                generateImage();
            }            
        } 
        
        function minus()
        {
            if($scope.zoom > 0.0){
                $scope.zoom -= 0.1;
                generateImage();
            }
        } 
        
        function goFullscreen()
        {
            if (Fullscreen.isEnabled())
               Fullscreen.cancel();
            else
               Fullscreen.all();
        }
        
        function generateSubImage(capa) {
            capa.image = [];
            var row = {};
            for(var i=0; i<$scope.rowsColumns; i++) {
                for(var j=0; j<$scope.rowsColumns; j++) {
                    row[j] = {piece:'./PHP/imagen.php?'+capa.type+'&trans='+capa.transparency+'&capa='+capa.text+'&rowsColumns='+$scope.rowsColumns+'&'+$scope.imageSize+'&zoom='+$scope.zoom+'&despX='+$scope.despX+'&despY='+$scope.despY+'&i='+i+'&j='+j};
                }
                capa.image.push(row);
                row = {};
            }
        }
        
        function generateImage() {
            angular.forEach($scope.mapas, function(value, key){
                if(value.state) {
                    generateSubImage(value);
                }
            });
        }
        
        function showHideMap(id) {
            changeMapState(id);
            generateImage();
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
        
        function displacement(way) {
            if(way === 'up') {
                $scope.despY += 0.1;
            }
            else if(way === 'left') {
                $scope.despX = $scope.despX - 0.1;
            }
            else if(way === 'right') {
                $scope.despX += 0.1;
            }
            else if(way === 'down') {
                $scope.despY = $scope.despY - 0.1;
            }
            else {
                $scope.despX = 0.0;
                $scope.despY = 0.0;
            }
            
            generateImage();
        }
    });