<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Visor de mapas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body ng-controller="visorController">
        <div>
            <div class="col-md-9">
                <div ng-repeat="mapa in mapas" style="position: absolute;">
                    <table ng-if="mapa.state">
                        <tr ng-repeat="image in mapa.image">
                            <td ng-repeat="subImage in image">
                                <img src="{{subImage.piece}}">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="col-md-12" style="overflow-y:auto; height:260px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="5">Seleccione las capas a mostrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="mapa in mapas">
                                <td><input class="hand" type="checkbox" ng-click="showHideMap(mapa.id)"></td>
                                <td>{{mapa.text}}</td>
                                <td><span class="glyphicon glyphicon-arrow-up hand" ng-click="sortMap('up',mapa.id,mapa)"></span>
                                    <span class="glyphicon glyphicon-arrow-down hand" ng-click="sortMap('down',mapa.id,mapa)"></span></td>
                                <td><input type="range" min="0" max="127" step="1" value="mapa.transparency" ng-model="mapa.transparency" ng-change="generateImage();"></td>
                                <td><div style="width: 30px; height: 20px; background-color: rgb({{mapa.color}});"></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Configuraciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tamaño</td>
                                <td>
                                    <select class="form-control hand" ng-model="imageSize" ng-change="generateImage()">
                                        <option value="x=500&y=400">500x400</option>
                                        <option value="x=640&y=480">640x480</option>
                                        <option value="x=760&y=600">760x600</option>
                                        <option value="x=880&y=720">880x720</option>
                                        <option value="x=1024&y=768">1024x768</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Filas y columnas</td>
                                <td>
                                    <select class="form-control hand" ng-model="rowsColumns" ng-change="generateImage()">
                                        <option value="3">3x3</option>
                                        <option value="4">4x4</option>
                                        <option value="5">5x5</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Zoom</td>
                                <td><span class="glyphicon glyphicon-zoom-out hand" ng-click="zoom('out')"></span>
                                    &nbsp;&nbsp;&nbsp;
                                    <span class="glyphicon glyphicon-zoom-in hand" ng-click="zoom('in')"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="3">Desplazamiento de las capas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td><center><span class="glyphicon glyphicon-triangle-top hand" ng-click="displacement('up');"></span></center></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><center><span class="glyphicon glyphicon-triangle-left hand" ng-click="displacement('left');"></span></center></td>
                                <td></td>
                                <td><center><span class="glyphicon glyphicon-triangle-right hand" ng-click="displacement('right');"></span></center></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><center><span class="glyphicon glyphicon-triangle-bottom hand" ng-click="displacement('down');"></span></center></td>
                                <td></td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="3">Fullscreen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td><center><span class="glyphicon glyphicon-fullscreen hand" ng-click="goFullscreen()"></span></center></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
             
        <script src="JS/angular.min.js"> </script>
        <script src="JS/angular-fullscreen.js"></script>
        <script src="JS/app.js"></script>
    </body>
</html>