<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>Visor de mapas</title>
        <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body ng-controller="visorController">
        <div id="pcontainer1" class="pancontainer">
            <img src="{{image}}" width="1280" height="782" />
	</div>
	<br>
	<button onClick="panimage1.zoom('+1')">zoom In</button>
	<button onClick="panimage1.zoom('-1')">zoom out</button>
	<button onClick="panimage1.zoom(1)">reset</button>
        
        <select id="mySelect" ng-model="imageSize" ng-change="changeSize()">
            <option value="x=640&y=480">640x480</option>
            <option value="x=760&y=600">760x600</option>
        </select>
        
        
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
