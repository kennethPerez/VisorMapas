<?php
    require './graficos.php';
    //header('Content-Type: image/png');
    
    $type = $_REQUEST['type'];    
    $capa = $_REQUEST['capa'];
    $trans = $_REQUEST['trans'];
    $i = $_REQUEST['i'];
    $j = $_REQUEST['j'];
    
    $width = 1024;
    $height = 768;
    $filas = 3;
    $columnas = 3;
    $zoom = 0.1; // 0.0 a 0.95
    
    $graficos = new graficos();
    
    if($type == "Polygon")
    {
        $img = $graficos->CreatePolygon($capa, $width, $height, $filas, $columnas, $trans, $zoom, $i, $j);
    }
    if($type == "Point")
    {
        $img = $graficos->CreatePoint($capa, $width, $height, $filas, $columnas, $trans, $zoom, $i, $j);
    }
    if($type == "Line")
    {
        $img = $graficos->CreateLine($capa, $width, $height, $filas, $columnas, $trans, $zoom, $i, $j);
    }       
    
    imagepng($img);
    imagedestroy($img);