<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Visor de mapas</title>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body ng-controller="visorController">
        <div class="container">
            <!--
            <div id="pcontainer1" class="pancontainer">
                <img src="{{image}}" width="1280" height="782" />
            </div>
            <br>
            
            <button onClick="panimage1.zoom('+1')">zoom In</button>
            <button onClick="panimage1.zoom('-1')">zoom out</button>
            <button onClick="panimage1.zoom(1)">reset</button>
            -->
            
            <div class="col-md-8">
                <!--<div style="position: absolute;">
                    <table>
                        <tr>
                            <td>
                                <img src="./PHP/imagen.php?action=Rios&x=1024&y=840">
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="position: absolute">
                    <table>
                        <tr>
                            <td>
                                <img src="./PHP/imagen.php?action=Caminos&x=1024&y=840">
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="position: absolute;">
                    <table>
                        <tr>
                            <td>
                                <img src="./PHP/imagen.php?action=Hospitales&x=1024&y=840">
                            </td>
                        </tr>
                    </table>
                </div>-->
                <div ng-repeat="mapa in mapas" style="position: absolute;">
                    <table ng-if="mapa.state">
                        <tr>
                            <td>
                                <img src="{{mapa.image}}">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="col-md-12" style="overflow-y:auto; height:215px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="3">Seleccione las capas a mostrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="mapa in mapas">
                                <td><input type="checkbox" ng-click="mapa.state ? showMap(mapa.id) : hideMap(mapa.id)"></td>
                                <td>{{mapa.text}}</td>
                                <td><div style="width: 30px; height: 20px; background-color: rgb({{mapa.color}});"></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Seleccione el tamaño</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" ng-model="imageSize" ng-change="changeSize()">
                                        <option value="x=640&y=480">640x480</option>
                                        <option value="x=760&y=600">760x600</option>
                                        <option value="x=1024&y=840">1024x840</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Seleccione las filas y columnas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control">
                                        <option value="">3x3</option>
                                        <option value="">4x4</option>
                                        <option value="">5x5</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
        
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="./JS/jquery.kinetic.min.js" type="text/javascript"></script>
	<script src="./JS/jquery.mousewheel.min.js"></script>
	<script src="./JS/imagepanner.js"></script>
	<script src="./JS/script.js"></script>
        
        <script src="AngularJS/angular.min.js"> </script>
        <script src="AngularJS/angular-route.min.js"></script>
        <script src="AngularJS/angular-animate.min.js"></script>
        <script src="AngularJS/ui-bootstrap-tpls-0.14.3.min.js"></script>
        <script src="JS/jquery.js"></script>
        <script src="Bootstrap/bootstrap.min.js"></script>
        <script src="JS/app.js"></script>
    </body>
</html>
